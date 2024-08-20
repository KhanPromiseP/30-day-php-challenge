<?php

require 'logic.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $priority = $_POST['priority'] ?? 'Low';
    $deadline = $_POST['deadline'] ?? '';

    createTask($name, $description, $priority, $deadline);


    header('location:index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <link rel="stylesheet" href="styles.css">
</head>
<main>

    <body>
        <header>
            <h1>Create Task</h1>
            <nav>
                <a href="index.php">Back to Task List</a>
            </nav>
        </header>
        <form action="create.php" method="POST">
            <div class='createform'>
                <label for="name">Task Name:</label>
                <input type="text" id="name" name="name" required>
                <br>
                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>
                <br>
                <label for="priority">Priority:</label>
                <select id="priority" name="priority">
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
                <br>
                <label for="deadline">Deadline:</label>
                <input type="date" id="deadline" name="deadline">
                <br>
                <button type="submit" name="create">Add Task</button>
                <div>
        </form>
    </body>
</main>

</html>