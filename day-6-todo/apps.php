<?php
// Start the session
session_start();

function startTask()
{
    if (isset($_COOKIE['tasks'])) {
        $_SESSION['tasks'] = unserialize($_COOKIE['tasks']);
    }

    if (!isset($_SESSION['tasks'])) {
        $_SESSION['tasks'] = [];
    }


    setTaskInCookies();
}


function setTaskInCookies()
{
    setcookie('tasks', serialize($_SESSION['tasks']), time() + (86400 * 30), '/');
}

function addTask($taskName, $description, $priority, $deadline)
{
    $task = [
        'name' => $taskName,
        'priority' => $priority,
        'deadline' => $deadline,
        'completed' => false,
    ];
    $_SESSION['tasks'][] = $task;
    setTaskInCookies();
}


function markCompleted($index)
{
    if (isset($_SESSION['tasks'][$index])) {
        $_SESSION['tasks'][$index]['completed'] = !$_SESSION['tasks'][$index]['completed'];
        setTaskInCookies();
    }
}

function updateTask($index, $name, $description, $priority, $deadline)
{
    if (isset($_SESSION['tasks'][$index])) {
        $_SESSION['tasks'][$index] = [
            'name' => $name,
            'description' => $description,
            'priority' => $priority,
            'deadline' => $deadline,
            'completed' => $_SESSION['tasks'][$index]['completed'],
        ];
        setTaskInCookies();
    }
}


function deleteTask($index)
{
    if (isset($_SESSION['tasks'][$index])) {
        array_splice($_SESSION['tasks'], $index, 1);
        setTaskInCookies();
    }
}


function filterTasks($filter)
{
    $filteredTasks = [];

    foreach ($_SESSION['tasks'] as $task) {
        if ($filter === 'completed' && $task['completed']) {
            $filteredTasks[] = $task;
        } elseif ($filter === 'pending' && !$task['completed']) {
            $filteredTasks[] = $task;
        }
    }

    //     if ($filter === 'deadline') {
    //         usort($filteredTasks, function ($a, $b) {
    //             return strtotime($a['deadline']) <=> strtotime($b['deadline']);
    //         });
    //     } elseif ($filter === 'priority') {
    //         usort($filteredTasks, function ($a, $b) {
    //             return $a['priority'] <=> $b['priority'];
    //         });
    //     }

    //     return $filteredTasks;
    // }


    if ($filter === 'deadline') {
        usort($filteredTasks, function ($a, $b) {
            return strtotime($a['deadline']) - strtotime($b['deadline']);
        });
    } elseif ($filter === 'priority') {
        usort($filteredTasks, function ($a, $b) {
            return $a['priority'] - $b['priority'];
        });
    }


    startTask();
}
