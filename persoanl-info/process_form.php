<?php
   
    if(isset($_POST['submit'])){

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }
    
    $fname=test_input($_POST['fname']);
    $lname=test_input($_POST['lname']);
    
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format"; 
      }
         
      
    $address=test_input($_POST['address']);
    $number=test_input($_POST['number']); 
    if (!preg_match("/^[0-9]{10}+$/",$number)) {
        echo "Invalid number passed!";
   
    
    }
    $birthday=test_input($_POST['birthday']); 
    $gender=test_input($_POST['gender']);
    
    

    echo "<p><strong>First Name:</strong> $fname</p>" ; 
    echo "<p><strong>Last Name:</strong> $lname</p>" ;
    echo "<p><strong>Email:</strong> $email</p>" ; 
    echo "<p><strong>Address:</strong> $address</p>";
    echo "<p><strong>Phone Number:</strong> $number</p>";
    echo "<p><strong>Date of Birth:</strong> $birthday</p>";
    echo "<p><strong>Gender:</strong> $gender</p><br>" ; 
        }else {
            echo "No data submitted!" ;
         }




         