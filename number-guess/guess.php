<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $timelimit = 5;
        $randnum = rand(0, 100);
        $_SESSION['count'] = 0;
        $randnum = $_SESSION['randnum'];
        $_POST['numguess'] = $_SESSION['numguess'];
        $timelimit = $_SESSION['timelimit'];

        if (validate($numguess)) {

            for ($count = 0; $count <= $_SESSION['timelimit']; $count++) {
                if ($_POST['numguess'] < $_SESSION['randnum']) {
                    $_SESSION['too-low'] = 'Too low! Try again.';
                } else if ($_POST['numguess'] > $_SESSION['randnum']) {
                    $_SESSION['too-high'] = 'Too high! Try again.';
                } else if ($_POST['numguess'] == $_SESSION['randnum']) {
                    $_SESSION['correct'] = 'Congratulations! You guessed the correct number.';
                } else {
                    $_SESSION['invalid'] = 'Invalid input. Please enter a number.';
                }
            }

            header('Location: guess.html.php');
            exit();
        } else {
            echo 'Invalid form submission.';
        }


        function validate($numguess)
        {
            if (!is_numeric($numguess)) {
                $_SESSION['numeric'] = 'Please enter a valid number.';
                return false;
            } else if ($numguess < 0 || $numguess > 100) {
                $_SESSION['outrange'] = 'Please enter a number between 0 and 100.';
                return false;
            } else {
                return true;
            }
        }
    }
}
