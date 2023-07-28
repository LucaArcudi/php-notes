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

    public function createNote($note) {
        $statement = $this->pdo->prepare('INSERT INTO notes (title, description, create_date) 
                                        VALUES (:title, :description, :date)');
        $statement->bindValue('title', $note['title']);
        $statement->bindValue('description', $note['description']);
        $statement->bindValue('date', date('Y-m-d H:i:s'));
        return $statement->execute();
    }

    public function getNoteById($id) {
        $statement = $this->pdo->prepare('SELECT * FROM notes WHERE id = :id');
        $statement->bindValue('id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function updateNote($id, $note) {
        $statement = $this->pdo->prepare('UPDATE notes SET title = :title, description = :description WHERE id = :id');
        $statement->bindValue('id', $id);
        $statement->bindValue('title', $note['title']);
        $statement->bindValue('description', $note['description']);
        $statement->execute();
    }

    public function deleteNote($id) {
        $statement = $this->pdo->prepare('DELETE FROM notes WHERE id = :id');
        $statement->bindValue('id', $id);
        $statement->execute();
    }
}

return new Connection();