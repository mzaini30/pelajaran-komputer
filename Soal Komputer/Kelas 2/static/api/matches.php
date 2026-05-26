<?php
require_once 'db.php';

$matches = R::findAll('match', 'ORDER BY time DESC');
response(true, R::exportAll($matches));
