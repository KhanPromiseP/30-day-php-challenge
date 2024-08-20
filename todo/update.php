<?php
session_start();
include_once 'app.php';


if (isset($_GET['index'])) {
    $index = (int)$_GET['index'];
    $task = $_SESSION['tasks'][$index];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    if ($name && $description && $priority && $deadline) {
        updateTask($index, $name, $description, $priority, $deadline);
        // header('Location: tasks.php'); 
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Task</title>
</head>

<body>
    <h1>Update Task</h1>
    <form method="POST" action="">
        <label for="name">Task Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($task['name']); ?>"
            required><br><br>

        <label for="priority">Priority:</label><br>
        <select id="priority" name="priority" required>
            <option value="1" <?php echo $task['priority'] == 1 ? 'selected' : ''; ?>>Low</option>
            <option value="2" <?php echo $task['priority'] == 2 ? 'selected' : ''; ?>>Medium</option>
            <option value="3" <?php echo $task['priority'] == 3 ? 'selected' : ''; ?>>High</option>
        </select><br><br>

        <label for="deadline">Deadline:</label><br>
        <input type="datetime-local" id="deadline" name="deadline"
            value="<?php echo htmlspecialchars($task['deadline']); ?>" required><br><br>

        <input type="submit" value="Update Task">
    </form>
</body>

</html>