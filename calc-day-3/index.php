<?php
if (isset($_POST['answer'])){
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operator = $_POST['operator'];
$result="";
    if (empty($num1) || empty($num2) || !is_numeric($num1) || !is_numeric($num2)) {
      
    }else{
   

switch ($operator) {
  case "+":
    $result = $num1 + $num2;
    break;
  case "-":
    $result = $num1 - $num2;
    break;
  case "*":
    $result = $num1 * $num2;
    break;
  case "%":
    $result = $num1 % $num2;
    break;
  case "^":
    $result = pow($num1, $num2);
    break;
  case "sqrt":
    if ($num1 < 0) {
      die("Cannot take the square root of a negative number.");
    } else {
      $result = sqrt($num1);
    }
    break;
  case "/":
    if ($num2 == 0) {
      $result='echo"can not divide by zero." ';
    } else {
      $result = $num1 / $num2;
    }
    break;
  default:
    echo "Invalid operation.";
}
    }
//echo "Result of {$num1} {$operator} {$num2} equal ". $result;
//echo "<br><br><a href='index.html'>Back to Calculator</a>";
}
?>