<?php
// session_start();
include 'apps.php';
$tasks = isset($_SESSION['tasks']) ? $_SESSION['tasks'] : [];

// $filter = isset($_POST['filter']) ? $_POST['filter'] : 'all';

// $tasks = filterTasks($filter);

// if ($filter === 'priority' && isset($_POST['priority'])) {
//     $tasks = filterTasks($filter);
// } else if ($filter === 'deadline') {
//     usort($tasks, function ($a, $b) {
//         return strtotime($a['deadline']) - strtotime($b['deadline']);
//     });
// } else {
//     return filterTasks($filter);
// }
// return $filterTasks;


// $tasks = array_filter(
//     $_SESSION['tasks'],
//     function ($task) {
//         return $task['completed'] == false;
//     }
// );

// } else (
//     $tasks = array_filter(
//         $_SESSION['tasks'],
//         function ($task) {
//             return $task['completed'] == false;
//         }
//     )
// )

//     unsort($tasks, function ($a, $b) {
//         return strtotime($a) - strtotime($b);
//     });
// }
// 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do-App</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form method="POST" action='apps.php'>
        <div class="header">
            <h2>Hello <?php $_SESSION['username'] ?>.</h2>
            <h4>You have 1 uncomplete task!</h4>
            <label for="sort_by">Sort</label>
            <select name="filters" value='Sortby'>
                <option><a href="home.php?filter=all">All tasks</a></option>
                <option><a href="home.php?filter=completed">Completed</a></option>
                <option><a href="home.php?filter=pending">Pending</a></option>
                <option><a href="home.php?filter=priority&priority=High">High</a></option>
                <option><a href="home.php?filter=priority&priority=Medium">Medium</a></option>
                <option><a href="home.php?filter=priority&priority=Low">Low</a></option>
                <option><a href="home.php?filter=deadline">Deadline</a></option>
            </select>
        </div>
        <div class="btn">
            <input type="search" name="searchbar" placeholder="search task..."></input>
            <input type="submit" name="seach" value='seach'></input>
            <a href="create.php"><abbr title="Create a task" id="create">+</abbr></a>



        </div>
        <div class="ul">
            <ul>

                <?php foreach ($tasks as $index => $task) : ?>
                    <?php echo htmlspecialchars($task['name']) . " "; ?>
                    <?php echo htmlspecialchars($task['priority']) . " " ?>
                    <?php echo htmlspecialchars($task['deadline']) . " " ?>
                    <a href="task.php? index=<?php echo $index; ?>">view </a>
                    <a href="delete.php? index=<?php echo $index; ?>">delete </a>
                <?php endforeach; ?>

            </ul>
        </div>

    </form>
</body>

</html>