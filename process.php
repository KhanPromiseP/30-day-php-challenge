<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        validate($username, $password);

        // Redirect back to login page after validation
        header("Location: login.php");
        exit();  // Prevent further code execution after redirect
    }
}

function validate(string $username, string $password){
    
    if($password == '' || $username == ''){
        $_SESSION["username_and_password"] = "Username and Password cannot be empty";
        return;
    }

    if(strlen($password) < 3 || strlen($username) < 3){
        $_SESSION["length"] = "Username and Password cannot be less than 3 characters";
        return;
    }

    $hasLowerCase = false;
    $hasNumber = false;
    $hasUpperCase = false;

    for($count = 0; $count < strlen($password); $count++){
        if(ctype_lower($password[$count])){
            $hasLowerCase = true;
        }
        if(ctype_upper($password[$count])){
            $hasUpperCase = true;
        }
        if(ctype_digit($password[$count])){
            $hasNumber = true;
        }
    }

    if(!$hasLowerCase){
        $_SESSION["passwordLower"] = "Password must have at least 1 lowercase";
    }

    if(!$hasNumber){
        $_SESSION["passwordNumber"] = "Password must have at least 1 number";
    }

    if(!$hasUpperCase){
        $_SESSION["passwordUpper"] = "Password must have at least 1 uppercase";
    }
}