<?php
require_once 'logic.php';

$index = $_GET['index'] ?? null;
$task = getTask($index);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $task !== null) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    updateTask($index, $name, $description, $priority, $deadline);
    header('Location: index.php');
    exit;
}

if ($task === null) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="styles.css">
</head>
<main>

    <body>
        <header>
            <h1>Edit Task</h1>
            <nav>
                <a href="index.php">Back to Task List</a>
            </nav>
        </header><br>
        <form method="POST">
            Task name:<br><input type="text" name="name" value="<?= htmlspecialchars($task['name']) ?>" required><br>
            description:<br><input type="text" name="description" value="<?= htmlspecialchars($task['description']) ?>" required><br>
            <select name="priority" required><br>
                <option value="High" <?= $task['priority'] === 'High' ? 'selected' : '' ?>>High</option>
                <option value="Medium" <?= $task['priority'] === 'Medium' ? 'selected' : '' ?>>Medium</option>
                <option value="Low" <?= $task['priority'] === 'Low' ? 'selected' : '' ?>>Low</option>
            </select><br>
            Deadline:<br><input type="date" name="deadline" value="<?= htmlspecialchars($task['deadline']) ?>" required><br>
            <button type="submit">Update Task</button>
        </form>
    </body>
    <main>

</html>