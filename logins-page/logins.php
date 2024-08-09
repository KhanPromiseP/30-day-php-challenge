<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css.css">
</head>

<body>
    <form action="pro.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" name="username" placeholder="Username" required>
        <label for="password">Password:</label><br>
        <input type="password" name="password" placeholder="Password" required>
        <small>
            <?php
            if (isset($_SESSION['passwordLower'])) {
                echo $_SESSION['passwordLower'].'<br>'; 
            }
            if (isset($_SESSION['passwordUpper'])) {
                echo $_SESSION['passwordUpper'].'<br>';
            }
            if (isset($_SESSION['passwordNumber'])) {
                echo $_SESSION['passwordNumber'].'<br>';
            }
            if (isset($_SESSION['username_and_password'])) {
                echo $_SESSION['username_and_password'].'<br>';
            }
            if (isset($_SESSION['length'])) {
                echo $_SESSION['length'].'<br>';
            }
            ?>
        </small>
        <button type="submit" name="login">Login</button>
    </form>
</body>

</html>