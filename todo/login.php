<?php
session_start();

if (isset($_POST['login'])) {
    $username = filter_var($_POST['username']);
    $_SESSION['username'] = htmlspecialchars($username);

    header('location:home.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form method="POST" action='login.php'>
        <h1>Login</h1>
        <label for="username">Username</label>
        <input type="text" name="username" required>
        <button type="submit" name="login">Login</button>
    </form>

</body>

</html>