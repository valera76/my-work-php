<?php

use PDO;

class DbRegistration
{
    private PDO $connection;
    
    public function __construct(string $user, string $password)
    {
        $this->connection = new PDO('mysql:host=localhost;dbname=eng_dictionary;charset=utf8', $user, $password);
    }
    
    public function addUser(string $name, string $login, string $pass)
    {
        $this->connection->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

    }
}
