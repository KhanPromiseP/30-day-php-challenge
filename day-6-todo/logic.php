<?php
session_start();

if (!isset($_SESSION['tasks'])) {
    if (isset($_COOKIE['tasks'])) {
        $_SESSION['tasks'] = unserialize($_COOKIE['tasks']);
    } else {
        $_SESSION['tasks'] = [];
    }
}

function createTask($name, $description, $priority, $deadline)
{
    $task = [
        'name' => $name,
        'description' => $description,
        'priority' => $priority,
        'deadline' => $deadline,
        'date_added' => date('Y-m-d'),
        'completed' => false,
    ];

    $_SESSION['tasks'][] = $task;
    updateCookie();
}

function updateTask($index, $name, $description, $priority, $deadline)
{
    if (isset($_SESSION['tasks'][$index])) {
        $_SESSION['tasks'][$index] = [
            'name' => $name,
            'description' => $description,
            'priority' => $priority,
            'deadline' => $deadline,
            'date_added' => $_SESSION['tasks'][$index]['date_added'],
            'completed' => $_SESSION['tasks'][$index]['completed'],
        ];

        updateCookie();
    }
}

function deleteTask($index)
{
    if (isset($_SESSION['tasks'][$index])) {
        unset($_SESSION['tasks'][$index]);
        $_SESSION['tasks'] = array_values($_SESSION['tasks']);
        updateCookie();
    }
}

function toggleTaskCompletion($index)
{
    if (isset($_SESSION['tasks'][$index])) {
        $_SESSION['tasks'][$index]['completed'] = !$_SESSION['tasks'][$index]['completed'];
        updateCookie();
    }
}

function getTasks($filter = 'all', $search = '')
{
    $tasks = $_SESSION['tasks'] ?? [];

    if ($filter === 'completed') {
        $tasks = array_filter($tasks, fn ($task) => $task['completed']);
    } elseif ($filter === 'pending') {
        $tasks = array_filter($tasks, fn ($task) => !$task['completed']);
    }

    if (!empty($search)) {
        $tasks = array_filter($tasks, function ($task) use ($search) {
            return stripos($task['name'], $search) !== false;
        });
    }

    return $tasks;
}

function sortTasks(&$tasks, $sortBy)
{
    if (is_array($tasks)) {
        usort($tasks, function ($a, $b) use ($sortBy) {
            switch ($sortBy) {
                case 'priority':
                    return strcmp($a['priority'], $b['priority']);
                case 'deadline':
                    return strcmp($a['deadline'], $b['deadline']);
                case 'date_added':
                    return strcmp($a['date_added'], $b['date_added']);
                default:
                    return 0;
            }
        });
    }
}

function updateCookie()
{
    setcookie('tasks', serialize($_SESSION['tasks']), time() + (86400 * 30), "/");
}

// function clearAllTasks()
// {
//     $_SESSION['tasks'] = [];
//     setcookie('tasks', '', time() - 3600, "/");
// }

function getTask($index)
{
    return $_SESSION['tasks'][$index] ?? null;
}
