<?php

include dirname(__DIR__) . '/src/DbRegistration.php';

$config = require dirname(__DIR__) . '/config/db.php';

$db = new DbRegistration($config['user'], $config['password']);

if (isset($_POST['Name'])) {
    $name = $_POST['Name'];
    
} elseif ($name == '') {
    echo 'Error 400';
}

if (isset($_POST['Login'])) {
    $login = $_POST['Login'];
    
} elseif ($login == '') {
    echo 'Error 400';
}

if (isset($_POST['Password'])) {
    $pass = $_POST['Password'];
    
} elseif ($pass == '') {
    echo 'Error 400';
}

$name = $_POST['Name'];
$login = $_POST['Login'];
$pass = $_POST['Password'];

$db->addUser(string $name, string $login, string $pass);
    
  

