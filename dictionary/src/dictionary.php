<?php

$config = require dirname(__DIR__) . '/config/db.php';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=eng_dictionary;charset=utf8', $config['user'], $config['password']);
    $statement = $pdo->query('SELECT * FROM words;');
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        echo $row['id'], ' ', $row['en_words'], ' ', $row['ru_words'], ' ', '<br>';
    
    }   
} catch(PDOException $e) {
    echo $e->getMessage();
}



