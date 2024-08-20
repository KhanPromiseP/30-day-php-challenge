<?php

require 'logic.php';
var_dump($_GET);
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'date_added';


$tasks = getTasks($filter);

if (is_array($tasks)) {
    sortTasks($tasks, $sortBy);
} else {
    $tasks = [];
}

if (isset($_POST['mark']) && isset($_SESSION['tasks'])) {
    $index = $_POST['mark'];
    if (isset($_SESSION['tasks'][$index])) {
        toggleTaskCompletion($index);
    }
}


$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($searchQuery) {
    $tasks = array_filter($_SESSION['tasks'], function ($task) use ($searchQuery) {
        return stripos($task['name'], $searchQuery) !== false;
    });
} else {
    $tasks = $_SESSION['tasks'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <main>
        <div class="formcontainer">
            <header>
                <h1>To-do List</h1>
            </header>

            <button id='btn'><a href="create.php"><abbr title="Create a task" id="create">+</abbr></a></button>

            <form method="GET" action="index.php">
                <div class="search-bar">
                    <input type="text" name="search" placeholder="Search tasks..." value="<?= htmlspecialchars($searchQuery) ?>">
                    <button type="submit">Search</button>
                </div>
            </form>

            <form action="index.php" method="GET">
                <div class="choose">
                    <label for="filter">Filter:</label>
                    <select id="filter" name="filter">
                        <option value="all" <?= $filter === 'all' ? 'selected' : '' ?>>All</option>
                        <option value="completed" <?= $filter === 'completed' ? 'selected' : '' ?>>Completed</option>
                        <option value="pending" <?= $filter === 'pending' ? 'selected' : '' ?>>Pending</option>
                    </select>
                    <label for="sort">Sort By:</label>
                    <select id="sort" name="sort">
                        <option value="date_added" <?= $sortBy === 'date_added' ? 'selected' : '' ?>>Date Added</option>
                        <option value="deadline" <?= $sortBy === 'deadline' ? 'selected' : '' ?>>Deadline</option>
                        <option value="priority" <?= $sortBy === 'priority' ? 'selected' : '' ?>>Priority</option>
                    </select>

                    <button type="submit">Apply</button>
                </div>
            </form>

            <ul>
                <?php foreach ($tasks as $index => $task) : ?>
                    <?php
                    $priorityClass = '';
                    switch ($task['priority']) {
                        case 'High':
                            $priorityClass = 'high-priority';
                            break;
                        case 'Medium':
                            $priorityClass = 'medium-priority';
                            break;
                        case 'Low':
                            $priorityClass = 'low-priority';
                            break;
                    }

                    $isOverdue = strtotime($task['deadline']) < time() && !$task['completed'];
                    ?>
                    <li class="<?= $priorityClass ?> <?= $isOverdue ? 'overdue' : '' ?>">
                        <?= htmlspecialchars($task['name']) ?>

                        <?php $taskStyle = $task['completed'] ? 'text-decoration:line-through;' : '' ?>
                        <form method='POST' action="index.php" style='display: inline'>
                            <input type='hidden' name="mark" value='<?= $index ?>'>
                            <span class="<?php echo $task['completed'] ? 'completed-task' : 'uncompleted' ?>"></span>
                            <button type="submit" style="<?= $taskStyle ?>">Mark</button>

                        </form>
                        <a href="toggle_complete.php?index=<? $index ?>">marked</a>

                        <button onclick="location.href='details.php?index=<?= $index ?>'">View</button>
                        <button><a href="deletetask.php?index=<?= $index ?>&filter=<?= $filter ?>&sort=<?= $sortBy ?>">Delete</a></button>
                        <button><a href="update.php?index=<?= $index ?>">Edit</a></button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </main>
</body>

</html>