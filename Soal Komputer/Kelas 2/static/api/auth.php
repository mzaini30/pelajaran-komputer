<?php
require_once 'db.php';

$action = $_GET['action'] ?? '';
$phone = $_POST['phone'] ?? '';
$otp = $_POST['otp'] ?? '';

const SIDOBE_API_KEY = 'VcJqLUgSbgLBKvafcqWEErqRxhRjFEYiryEpHfhlrQZKQuOTSr000';

if ($action == 'send_otp') {
    if (empty($phone)) response(false, null, 'Phone is required');
    
    // Format phone
    if (strpos($phone, '08') === 0) {
        $phone = '+62' . substr($phone, 1);
    }
    
    $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    $expires_at = time() + (5 * 60); // 5 minutes
    
    $auth = R::findOne('otp', 'phone = ?', [$phone]);
    if (!$auth) $auth = R::dispense('otp');
    
    $auth->phone = $phone;
    $auth->code = $code;
    $auth->expires_at = $expires_at;
    R::store($auth);
    
    // Send via Sidobe
    $ch = curl_init('https://api.sidobe.com/wa/v1/send-message');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-Secret-Key: ' . SIDOBE_API_KEY,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'phone' => $phone,
        'message' => "OTP Anda untuk Football Info adalah: $code. Berlaku 5 menit."
    ]));
    $res = curl_exec($ch);
    curl_close($ch);
    
    response(true, null, 'OTP sent');
}

if ($action == 'verify_otp') {
    if (empty($phone) || empty($otp)) response(false, null, 'Phone and OTP required');
    
    if (strpos($phone, '08') === 0) {
        $phone = '+62' . substr($phone, 1);
    }
    
    $auth = R::findOne('otp', 'phone = ? AND code = ?', [$phone, $otp]);
    if (!$auth || $auth->expires_at < time()) {
        response(false, null, 'Invalid or expired OTP');
    }
    
    // Clear OTP
    R::trash($auth);
    
    // Login/Register User
    $user = R::findOne('user', 'phone = ?', [$phone]);
    if (!$user) {
        $user = R::dispense('user');
        $user->phone = $phone;
        $user->role = 'user';
        $user->created_at = date('Y-m-d H:i:s');
        R::store($user);
    }
    
    $token = base64_encode($phone . '|' . time());
    response(true, ['token' => $token, 'user' => $user->export()], 'Login success');
}

response(false, null, 'Invalid action');
