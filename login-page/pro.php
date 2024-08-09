<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])) {
    $username = filter_var($_POST['username']);
    $password = $_POST['password'];

    
    $_SESSION['passwordLower'] = '';
    $_SESSION['passwordUpper'] = '';
    $_SESSION['passwordNumber'] = '';
    $_SESSION['username_and_password'] = '';
    $_SESSION['length'] = '';
    validate($username, $password);
    //if(validate($username, $password)){

     if (empty($_SESSION['passwordLower']) && empty($_SESSION['passwordUpper']) && empty($_SESSION['passwordNumber']) &&
        empty($_SESSION['username_and_password']) && empty($_SESSION['length'])) {
        
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header("Location: success.php");
            exit();
        } else {

            // $_SESSION['username_and_password'] = "Invalid username or password";
        //}
    

    header("Location:logins.php");
    exit();
}
}

function validate($username, $password) {
    if (empty($username) || empty($password)) {
        $_SESSION['username_and_password'] = "Username and Password cannot be empty";
    }

    if (strlen($password) < 3 || strlen($username) < 3) {
        $_SESSION['length'] = "Username and Password cannot be less than 3 characters";
    }

    $hasLowerCase = false;
    $hasNumber = false;
    $hasUpperCase = false;

    for ($count = 0; $count < strlen($password); $count++) {
        if (ctype_lower($password[$count])) {
            $hasLowerCase = true;
        }
        if (ctype_upper($password[$count])) {
            $hasUpperCase = true;
        }
        if (ctype_digit($password[$count])) {
            $hasNumber = true;
        }
    }

    if (!$hasLowerCase) {
        $_SESSION['passwordLower'] = "Password must have at least 1 lowercase letter";
    }

    if (!$hasNumber) {
        $_SESSION['passwordNumber'] = "Password must have at least 1 number";
    }

    if (!$hasUpperCase) {
        $_SESSION['passwordUpper'] = "Password must have at least 1 uppercase letter";
    }
}