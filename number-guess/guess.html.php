<?php
$session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nmber Guessing Game</title>
</head>

<body>

    <form method="post" action="guess.php">

        <h2>Number Guesing Game</h2><br>
        <h2>Wellcme to Number Guesing Game</h2><br>
        <p>Guess a number between 1 and 5.</p><br>

        <label for="number">Guess Number</label><br>
        <input type="number" name="number" placeholder="guess number">
        <button type="button" name="submit">Submit</button>
        <button type="button" name="reset">Reset</button>
    </form>

</body>

</html>