<?php

use PDO;

class DbGateway
{
    private PDO $connection;
    
    public function __construct(string $user, string $password)
    {
        $this->connection = new PDO('mysql:host=localhost;dbname=eng_dictionary;charset=utf8', $user, $password);
    }
    
    public function addWord(string $enWord, string $ruWord)
    {
        $this->connection->prepare('INSERT INTO words (user_id, en_words, ru_words) VALUES (:user_id, :en_words, :ru_words)');

    }
}
