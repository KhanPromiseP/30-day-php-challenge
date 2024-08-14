<?php
// session_start();
include_once 'apps.php';


if (isset($_GET['submit'])) {
    $index = $_GET['index'];
    $task = $_SESSION['tasks'][$index];
}
// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
//     $name = $_POST['name'];
//     $taskdesc = $_POST['taskdesc'];
//     $priority = $_POST['priority'];
//     $deadline = $_POST['deadline'];

//     $_SESSION['name'] = $_POST['name'];
//     $_SESSION['$taskdesc'] = $_POST['taskdesc'];
//     $_SESSION['$priority'] = $_POST['priority'];
//     $_SESSION['$deadline'] = $_POST['deadline'];


//     // if (!isset($_SESSION['tasks'])) {
//     //     $_SESSION['tasks'] = [];
//     // }

//     $task = [
//         'name' => $name,
//         'taskdesc' => $taskdesc,
//         'priority' => $priority,
//         'deadline' => $deadline
//     ];
//     $_SESSION['tasks'] = array_values($_SESSION['tasks']);


//     array_push($_SESSION['tasks'], $task);
//     header('location: home.php');
// }


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];
    $task = array($name, $description, $priority, $deadline);
    $_SESSION['tasks'][$id] = $task;
    header('Location: home.php');

    if ($name && $description && $priority && $deadline) {
        updateTask($index, $name, $description, $priority, $deadline);
        header('Location: home.php');
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form method="POST" action="home.php">
        <h3>Feal free to update your Task here.</h3>
        <label for="name">Task Name</label>
        <input type="text" name='name' value="<?php echo $task[0] ?>" required><br>
        <label for="taskdesc">Task Description</label>
        <textarea name="taskdesc" required><?php echo htmlspecialchars($task['description']); ?></textarea>
        <label for="priority">Priority</label>
        <select name="priority" id="priority">
            <option value="High" <?php echo $task['priority'] == 'High' ? 'selected' : ''; ?>>High</option>
            <option value="Medium" <?php echo $task['priority'] == 'Medium' ? 'selected' : ''; ?>>Medium</option>
            <option value="Low" <?php echo $task['priority'] == 'Low' ? 'selected' : ''; ?>>Low</option>
        </select>

        <label for="deadline">Deadline</label>
        <input type="datetime-local" name="deadline" value="<?php htmlspecialchars($task['deadline']); ?>" required><br><br>
        <input type="hidden" name="id" value="<?php echo $index; ?>">
        <a href="complete.php?index=<?php echo $index; ?>">complete</a>
        <a href="update.php?index=<?php echo $index; ?>">edit</a>

        <button type="submit" name="submit">Update</button>

    </form>

</body>

</html>