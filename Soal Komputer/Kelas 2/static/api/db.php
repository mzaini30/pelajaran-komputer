<?php
require_once __DIR__ . '/../library/rb-sqlite.php';

$dbPath = __DIR__ . '/../database.db';
R::setup("sqlite:$dbPath");
R::freeze(false);

header('Content-Type: application/json');

function response($is_success, $data = null, $message = '') {
    echo json_encode([
        'is_success' => $is_success,
        'data' => $data,
        'message' => $message
    ]);
    exit;
}
