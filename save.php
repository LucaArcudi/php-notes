<?php

$connection = require_once __DIR__ . '/Connection.php';

$id = $_POST['id'] ?? '';

if (!$id) {
    $connection->createNote($_POST);
    header('Location: index.php');
} else {
    $connection->updateNote($_POST['id'], $_POST);
    header('Location: index.php');
}