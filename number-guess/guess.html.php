<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nmber Guessing Game</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <form method="post" action="guess.php">

        <h3>Number Guesing Game</h3>
        <h4>Wellcme to Number Guesing Game</h4>
        <p>Guess a number between 1 and 100.</p>

        <label for="numguess">Guess Number</label><br>
        <input type="number" name="numguess" placeholder="guess number">
        <button type="submit" name="submit">Submit</button>
        <button type="button" name="reset">Reset</button>

        <?php
        if (isset($_SESSION['too-low'])) {
            echo '<p>' . $_SESSION['too-low'] . '</p>';
            unset($_SESSION['too-low']);
        }
        if (isset($_SESSION['too-high'])) {
            echo '<p>' . $_SESSION['too-high'] . '</p>';
        }
        if (isset($_SESSION['correct'])) {
            echo '<p>' . $_SESSION['correct'] . '</p>';
        }
        if (isset($_SESSION['invalid'])) {
            echo '<p>' . $_SESSION['invalid'] . '</p>';
        }
        if (isset($_SESSION['numeric'])) {
            echo '<p>' . $_SESSION['numeric'] . '</p>';
        }
        if (isset($_SESSION['outrange'])) {
            echo '<p>' . $_SESSION['outrange'] . '</p>';
        }

        ?>
    </form>

</body>

</html>