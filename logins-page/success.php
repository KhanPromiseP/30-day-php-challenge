<?php
session_start();

// if (!isset($_GET['username'])) {
//     header("Location: logins.php");
//     exit();
// }

//$username = htmlspecialchars($_GET['username']);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="css.css">
</head>

<body>
    <div class="success-container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>Your login was successful. You can now access the application.</p>
        <a href="logins.php" class="button">Back to Login</a>
    </div>
</body>

</html>