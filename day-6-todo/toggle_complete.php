<?php
include 'logic.php';

$tasks = getTasks();

if (isset($_GET['index'])) {
    $index = $_GET['index'];

    toggleTaskCompletion($index);
    header("Location: index.php");
    exit();
} else {
    echo "Task index not provided.";
}
