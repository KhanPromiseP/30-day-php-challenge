<?php
session_start();

$randnum = $_SESSION['randnum'];
$num = $_SESSION ['num'];

if($_SERVER['REQUEST_METHOD'] == 'post'){
    if(isset($_POST['submit'])){


        $num = $_POST['number'];

        
        if($num < $randnum){
echo('Too low! Try again.');
        }else if($num > $randnum){
            echo('Too high! Try again.');
        } else {
            echo('Congratulations! You guessed the correct number.');
    
    }
}
}