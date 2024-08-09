<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form action="process.php" method="post">
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <small class="error">
            <?php 
            if(isset($_SESSION['username_and_password'])){
                echo $_SESSION['username_and_password'];
            }
            ?>
        </small>
        <small class="error">
            <?php 
            if(isset($_SESSION['length'])){
                echo $_SESSION['length'];
            }
            ?>
        </small>
        <small class="error">
            <?php 
            if(isset($_SESSION['passwordLower'])){
                echo $_SESSION['passwordLower'];
            }
            ?>
        </small>
        <small class="error">
            <?php 
            if(isset($_SESSION['passwordUpper'])){
                echo $_SESSION['passwordUpper'];
            }
            ?>
        </small>
        <small class="error">
            <?php 
            if(isset($_SESSION['passwordNumber'])){
                echo $_SESSION['passwordNumber'];
            }
            ?>
        </small>
        <button type="submit" name="login">Login</button>
    </form>
</body>

</html>