<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['reset'])) {
        session_unset();
        session_destroy();
        header('Location: numguess.php');
        exit();
    }


    if (isset($_POST['submit'])) {
        $numguess = $_POST['numguess'];


        if (!isset($_SESSION['randnum'])) {
            $_SESSION['randnum'] = rand(1, 100);
        }

        if (validate($numguess)) {
            if ($numguess < $_SESSION['randnum']) {
                $_SESSION['too-low'] = 'Too low! Try again.';
            } else if ($numguess > $_SESSION['randnum']) {
                $_SESSION['too-high'] = 'Too high! Try again.';
            } else if ($numguess == $_SESSION['randnum']) {
                $_SESSION['correct'] = 'Congratulations! You guessed the correct number in' . $_SESSION['attempts'] . 'attempts';
                resetgame();
            }

            $_SESSION['attempts']--;
        }


        if ($_SESSION['attempts'] <= 0) {
            $_SESSION['game-over'] = 'Game over! The correct number was ' . $_SESSION['randnum'] . '. ';
            resetgame();
        } else {
            $currentAttempt = 5 - $_SESSION['attempts'];
            $_SESSION['invalid'] = 'Attempt' . ' ' . $currentAttempt . ' ' . ' failed!';
        }

        header('Location: numguess.php');
        exit();
    }
}

function resetgame()
{
    unset($_SESSION['randnum']);
    $_SESSION['attempts'] = 5;
}

function validate($numguess)
{
    if (!is_numeric($numguess)) {
        $_SESSION['numeric'] = 'Please enter a valid number.';
        return false;
    } else if ($numguess < 1 || $numguess > 100) {
        $_SESSION['outrange'] = 'Please enter a number between 1 and 100.';
        return false;
    } else {
        return true;
    }
}
