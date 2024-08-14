<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $taskdesc = $_POST['taskdesc'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    $_SESSION['name'] = $_POST['name'];
    $_SESSION['$taskdesc'] = $_POST['taskdesc'];
    $_SESSION['$priority'] = $_POST['priority'];
    $_SESSION['$deadline'] = $_POST['deadline'];


    if (!isset($_SESSION['tasks'])) {
        $_SESSION['tasks'] = [];
    }

    $task = [
        'name' => $name,
        'taskdesc' => $taskdesc,
        'priority' => $priority,
        'deadline' => $deadline
    ];
    $_SESSION['tasks'] = array_values($_SESSION['tasks']);


    array_push($_SESSION['tasks'], $task);
    header('location: home.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Task</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <form action="create.php" method="POST">
        <h5>Create a New Task</h5>
        <label for="name">Task Name</label><br>
        <input type="text" name='name' required><br>
        <label for="taskdesc">Task Description</label><br>
        <textarea name="taskdesc" placeholder="Your Task Description here..." required></textarea><br>
        <label for="priority">Priority</label>
        <select name="priority" id="priority">
            <option value="High">High</option>
            <option value="Medium">Medium</option>
            <option value="Low">Low</option>
        </select>

        <label for="deadline">Deadline</label>
        <input type='datetime-local' name="deadline">

        <input type="submit" name="submit" value="Create">


    </form>

</body>

</html>