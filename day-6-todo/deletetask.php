<?php

require 'logic.php';

if (isset($_GET['index'])) {
    $index = (int)$_GET['index'];
    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
    $sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'date_added';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
        deleteTask($index);
        header("Location: index.php?filter=$filter&sort=$sortBy");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Confirm Deletion</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Confirm Deletion</h1>
        <nav>
            <a href="index.php">Back to Home</a>
        </nav>
    </header>
    <main>
        <h2>Are you sure you want to delete this task?</h2>
        <form action="deletetask.php?index=<?= htmlspecialchars($index) ?>" method="post">
            <button type="submit" name="confirm">Delete</button>
            <button> <a href="index.php?filter=<?= htmlspecialchars($filter) ?>&sort=<?= htmlspecialchars($sortBy) ?>">Cancel</a></button>
        </form>
    </main>
</body>

</html>