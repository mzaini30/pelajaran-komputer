<?php
require_once 'db.php';

$news = R::findAll('news', 'ORDER BY created_at DESC');
response(true, R::exportAll($news));
