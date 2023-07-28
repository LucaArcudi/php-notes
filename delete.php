<?php

$connection = require_once __DIR__ . '/Connection.php';

$id = $_POST['id'] ?? '';

if ($id) {
    $connection->deleteNote($id);
    header('Location: index.php');
} else {
    header('Location: index.php');
}