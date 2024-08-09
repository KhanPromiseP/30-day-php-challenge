<?php
session_start();

if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 5;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number Guessing Game</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <form method="post" action="guessing.php">

        <h3>Number Guessing Game</h3>
        <h4>Welcome to the Number Guessing Game</h4>
        <h4>Guess a number between 1 and 100.</h4>
        <h5>You have <?php echo $_SESSION['attempts']; ?> attempt(s) left</h5>

        <label for="numguess">Guess Number</label><br>
        <input type="number" name="numguess" placeholder="Guess a number....">
        <button type="submit" name="submit">Submit</button>
        <button type="submit" name="reset">Restart</button>
        <!-- <button type="button" onclick="window.location.href='reset.php';">Reset</button> -->

        <?php
        if (isset($_SESSION['too-low'])) {
            echo '<p>' . $_SESSION['too-low'] . '</p>';
            unset($_SESSION['too-low']);
        }
        if (isset($_SESSION['too-high'])) {
            echo '<p>' . $_SESSION['too-high'] . '</p>';
            unset($_SESSION['too-high']);
        }
        if (isset($_SESSION['correct'])) {
            echo '<p>' . $_SESSION['correct'] . '</p>';
            unset($_SESSION['correct']);
        }
        if (isset($_SESSION['invalid'])) {
            echo '<p>' . $_SESSION['invalid'] . '</p>';
            unset($_SESSION['invalid']);
        }
        if (isset($_SESSION['numeric'])) {
            echo '<p>' . $_SESSION['numeric'] . '</p>';
            unset($_SESSION['numeric']);
        }
        if (isset($_SESSION['outrange'])) {
            echo '<p>' . $_SESSION['outrange'] . '</p>';
            unset($_SESSION['outrange']);
        }
        if (isset($_SESSION['game-over'])) {
            echo '<p>' . $_SESSION['game-over'] . '</p>';
            unset($_SESSION['game-over']);
        }

        ?>
    </form>

</body>

</html>