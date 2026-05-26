<?php
require_once 'db.php';

// Users
if (R::count('user') == 0) {
    $user = R::dispense('user');
    $user->phone = '+6281234567890';
    $user->role = 'admin';
    $user->created_at = date('Y-m-d H:i:s');
    R::store($user);
}

// Teams
if (R::count('team') == 0) {
    $teams = [
        ['name' => 'Real Madrid', 'logo' => 'https://imgchest.com/p/8oqzv7x67pt'],
        ['name' => 'Manchester City', 'logo' => 'https://imgchest.com/p/n87grl2m4yx'],
        ['name' => 'Liverpool', 'logo' => 'https://imgchest.com/p/vj4jw29m48m'],
    ];
    foreach ($teams as $t) {
        $team = R::dispense('team');
        $team->import($t);
        R::store($team);
    }
}

// Matches
if (R::count('match') == 0) {
    $match = R::dispense('match');
    $match->team_a = 'Real Madrid';
    $match->team_b = 'Manchester City';
    $match->score_a = 3;
    $match->score_b = 3;
    $match->time = date('Y-m-d H:i:s');
    $match->status = 'LIVE';
    R::store($match);
}

// News
if (R::count('news') == 0) {
    $news = R::dispense('news');
    $news->title = 'Champions League Thriller';
    $news->content = 'A classic encounter at the Bernabeu ends in a draw.';
    $news->image = 'https://imgchest.com/p/dl7pvg2z7ox';
    $news->created_at = date('Y-m-d H:i:s');
    R::store($news);
}

response(true, null, 'Database initialized');
