<?php

function startTask()
{
    if (isset($_SESSION['tasks']) && isset($_COOKIE['tasks'])) {
        $_SESSION['tasks'] = unserialize($_COOKIE['tasks']);
    }
    if (!isset($_SESSION['tasks'])) {
        $_SESSION['tasks'] = [];
    }
    setTaskInCookies();
}
startTask();
function setTaskInCookies()
{
    setcookie('task', serialize($_SESSION['tasks']), time() + (86400 * 30), '/');
}
function addtask($tasskname, $priority, $dateline)
{
    $task = [
        'name' => $tasskname,
        'priority' => $priority,
        'dateline' => $dateline,
        'completed' => false,
    ];
    $_SESSION['tasks'][] = $task;
    
    setTaskInCookies();
}


function markCompleted($index)
{
    $_SESSION['tasks'][$index]['completed'] = !$_SESSION['tasks'][$index]['completed'];
    setTaskInCookies();
}

function updateTasck($index, $name, $description, $priority, $deadline)
{
    if (isset($_SESSION['tasks'][$index])) {
        $_SESSION['tasks'][$index] = [
            'name' => $name,
            'description' => $description,
            'priority' => $priority,
            'deadline' => $deadline,
            'date' => $_SESSION['tasks'][$index]['date'],
            'completed' => $_SESSION['tasks'][$index]['completed'],
        ];
        setTaskInCookies();
    }
}

function deleteTAsk($index)
{
    array_splice($_SESSION['tasks'], $index, 1);
    setTaskInCookies();
}

function filterTasks($filter)
{
    $filterTasks = array();
    foreach ($_SESSION['tasks'] as $index => $task) {
        if ($filter === 'completed' && $task['completed'] || $filter === 'pending' && !$task['completed']) {

            $filterTasks = array_merge($filterTasks, $_SESSION['tasks'][$index + 1]);
            // } else if ($filter === 'all') {
            //     $filterTasks = array_merge($filterTasks, $_SESSION['tasks']);
            // }

            return $filterTasks;


            if ($filter === 'deadline') {
                usort($filterTasks, function ($a, $b) {
                    $a = DateTime::createFromFormat('dmY H:i', $a['deadline']);
                    $b = DateTime::createFromFormat('dmY H:i', $b['deadline']);

                    if ($a == $b) {
                        return 0;
                    }
                    return ($a > $b) ? -1 : 1;
                });


                return $filterTasks;
            }
            if ($filter === 'priority') {
                usort($filterTasks, function ($a, $b) {
                    return $a['priority'] <=> $b['priority'];
                });


                return $filter;
            }
        }
    }
}
