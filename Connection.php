<?php

class Connection {

    public $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:server=localhost;dbname=notes_app_db', 'root', 'root');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getNotes() {
        $statement = $this->pdo->prepare('SELECT * FROM notes ORDER BY create_date DESC');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}