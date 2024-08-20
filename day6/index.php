<?php
session_start();


if (!isset($_SESSION['tasks']) && isset($_COOKIE['tasks'])) {
    $_SESSION['tasks'] = json_decode($_COOKIE['tasks'], true);
}

if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [];
}

if (isset($_POST['add_task'])) {
    $task = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'priority' => $_POST['priority'],
        'deadline' => $_POST['deadline'],
        'status' => 'pending',
    ];

    $_SESSION['tasks'][] = $task;
    setcookie('tasks', json_encode($_SESSION['tasks']), time() + (86400 * 30), "/");
}


if (isset($_POST['update_task'])) {
    $index = $_POST['task_index'];
    $_SESSION['tasks'][$index]['title'] = $_POST['title'];
    $_SESSION['tasks'][$index]['description'] = $_POST['description'];
    $_SESSION['tasks'][$index]['priority'] = $_POST['priority'];
    $_SESSION['tasks'][$index]['deadline'] = $_POST['deadline'];
    setcookie('tasks', json_encode($_SESSION['tasks']), time() + (86400 * 30), "/");
}


if (isset($_POST['delete_task'])) {
    $index = $_POST['task_index'];
    array_splice($_SESSION['tasks'], $index, 1);
    setcookie('tasks', json_encode($_SESSION['tasks']), time() + (86400 * 30), "/");
}




if (isset($_POST['toggle_status'])) {
    $index = $_POST['task_index'];
    $_SESSION['tasks'][$index]['status'] = $_SESSION['tasks'][$index]['status'] === 'pending' ? 'completed' : 'pending';
    setcookie('tasks', json_encode($_SESSION['tasks']), time() + (86400 * 30), "/");
}



$search_query = isset($_GET['search']) ? strtolower($_GET['search']) : '';




function sort_tasks(&$tasks)
{
    usort($tasks, function ($a, $b) {
        $priority_order = ['high' => 1, 'medium' => 2, 'low' => 3];
        if ($priority_order[$a['priority']] == $priority_order[$b['priority']]) {
            return strtotime($a['deadline']) - strtotime($b['deadline']);
        }
        return $priority_order[$a['priority']] - $priority_order[$b['priority']];
    });
}

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$filtered_tasks = array_filter($_SESSION['tasks'], function ($task) use ($filter, $search_query) {
    $matches_filter = $filter === 'all' || $task['status'] === $filter;
    $matches_search = $search_query === '' || strpos(strtolower($task['title']), $search_query) !== false;
    return $matches_filter && $matches_search;
});

sort_tasks($filtered_tasks);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List Application</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>My To-Do List</h1>
        <a href="previous_page.php" class="back-button">Go Back</a>
    </header>

    <div class="container">



        <form method="POST" action="">
            <input type="text" name="title" placeholder="Task Title" required>
            <textarea name="description" placeholder="Task Description"></textarea>
            <select name="priority" required>
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>
            <input type="date" name="deadline" required>
            <button type="submit" name="add_task">Add Task</button>
        </form>


        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search Tasks" value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit">Search</button>
        </form>


        <div class="filter-links">
            <a href="?filter=all">All Tasks</a>
            <a href="?filter=pending">Pending Tasks</a>
            <a href="?filter=completed">Completed Tasks</a>
        </div>


        <?php
        foreach ($filtered_tasks as $index => $task) {
        ?>
            <div class="task <?php echo ($task['status'] === 'completed') ? 'task-completed' : ''; ?>">
                <h3><?php echo htmlspecialchars($task['title']); ?></h3>
                <p><?php echo htmlspecialchars($task['description']); ?></p>
                <p>Priority: <?php echo htmlspecialchars($task['priority']); ?></p>
                <p>Deadline: <?php echo htmlspecialchars($task['deadline']); ?></p>


                <form method="POST" action="">
                    <input type="hidden" name="task_index" value="<?php echo $index; ?>">
                    <button type="submit" name="toggle_status">
                        <?php echo ($task['status'] === 'pending') ? 'Mark as Completed' : 'Unmark as Completed'; ?>
                    </button>
                </form>


                <form method="POST" action="">
                    <input type="hidden" name="task_index" value="<?php echo $index; ?>">
                    <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
                    <textarea name="description"><?php echo htmlspecialchars($task['description']); ?></textarea>
                    <select name="priority" required>
                        <option value="high" <?php echo ($task['priority'] === 'high') ? 'selected' : ''; ?>>High</option>
                        <option value="medium" <?php echo ($task['priority'] === 'medium') ? 'selected' : ''; ?>>Medium
                        </option>
                        <option value="low" <?php echo ($task['priority'] === 'low') ? 'selected' : ''; ?>>Low</option>
                    </select>
                    <input type="date" name="deadline" value="<?php echo htmlspecialchars($task['deadline']); ?>" required>
                    <button type="submit" name="update_task">Update Task</button>
                </form>


                <form method="POST" action="">
                    <input type="hidden" name="task_index" value="<?php echo $index; ?>">
                    <button type="submit" name="delete_task">Delete Task</button>
                </form>
            </div>
        <?php
        }
        ?>
    </div>
</body>

</html>