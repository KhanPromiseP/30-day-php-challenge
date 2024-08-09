<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $paassword = $_POST['paassword'];
        
    }else{
        echo "No data available!";
    }
}