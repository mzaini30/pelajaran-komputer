<?php
require_once 'db.php';

const OPENROUTER_API_KEY = 'sk-or-v1-1d2503cacedcf511b61a6b3a8526250fb2b005f8760bfdc39c5abe6d0c5cd8ef000';

$prompt = "Generate 3 latest football news items in JSON format. Each item should have 'title', 'content', and 'image_description' (for finding an image). Focus on major leagues.";

$ch = curl_init('https://openrouter.ai/api/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . OPENROUTER_API_KEY,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'model' => 'openrouter/free',
    'messages' => [
        ['role' => 'user', 'content' => $prompt]
    ]
]));

$res = curl_exec($ch);
curl_close($ch);

$data = json_decode($res, true);
$content = $data['choices'][0]['message']['content'] ?? '';

// Try to parse JSON from content
preg_match('/\[.*\]/s', $content, $matches);
if (isset($matches[0])) {
    $news_items = json_decode($matches[0], true);
    if ($news_items) {
        foreach ($news_items as $item) {
            $news = R::dispense('news');
            $news->title = $item['title'];
            $news->content = $item['content'];
            // For image, just use a placeholder or a search query style URL
            $news->image = 'https://imgchest.com/p/dl7pvg2z7ox'; 
            $news->created_at = date('Y-m-d H:i:s');
            R::store($news);
        }
        response(true, count($news_items), 'News generated');
    }
}

response(false, null, 'Failed to generate news');
