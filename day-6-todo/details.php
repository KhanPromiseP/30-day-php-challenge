<?php

include 'logic.php';

// Get task index from URL
$index = isset($_GET['index']) ? $_GET['index'] : null;
$task = getTask($index);

if ($task === null) {
    echo "Task not found.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Task Details</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Task Details</h1>
        <nav>
            <a href="index.php">Back to Task List</a>
        </nav>
    </header>
    <main>
        <h2><?= htmlspecialchars($task['name']) ?></h2>
        <p><strong>Description:</strong> <?= htmlspecialchars($task['description']) ?></p>
        <p><strong>Priority:</strong> <?= htmlspecialchars($task['priority']) ?></p>
        <p><strong>Deadline:</strong> <?= htmlspecialchars($task['deadline']) ?></p>
        <p><strong>Date Added:</strong> <?= htmlspecialchars($task['date_added']) ?></p>
        <p><strong>Status:</strong> <?= $task['completed'] ? 'Completed' : 'Pending' ?></p>
    </main>
</body>

</html>