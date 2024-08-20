<?php
session_start();
require 'apps.php';

if (isset($_GET['index'])) {
    $index = (int)$_GET['index'];
    deleteTask($index);
}

header('Location: home.php');
// exit();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete</title>
</head>

<body>
    <form method="post" action="delete.php">
        <h2>Delete</h2>
        <p>Are you sure you want to delete this task: <?php echo $task['name'] ?></p>
        <button type="submit" name="deletebtn">Yes</button>
        <a href="home.php">No</a>

    </form>
</body>

</html>