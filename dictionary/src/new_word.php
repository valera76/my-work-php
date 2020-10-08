<?php

include dirname(__DIR__) . '/src/DbGateway.php';

$config = require dirname(__DIR__) . '/config/db.php';

$db = new DbGateway($config['user'], $config['password']);

$enWord = $_POST['English words'];
$ruWord = $_POST['Russian words'];

if (isset($_POST['English words'])) {
    $enWord = $_POST['English words'];
    
} elseif ($enWord == '') {
    echo 'Error 400';
    exit;
}

if (isset($_POST['Russian words'])) {
    $ruWord = $_POST['Russian words'];
    
} elseif ($ruWord == '') {
    echo 'Error 400';
    exit;
}

$db->addWord(string $enWord, string $ruWord);
    
  

