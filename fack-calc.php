if (isset($_POST['calculate'])) {

$num1 = $_POST['num1'];
$num2 = $_POST['num2'];
$operator = $_POST['operator'];

switch($operator) {
case "+":
$result = $num1 + $num2;
break;
case "-":
$result = $num1 - $num2;
break;
case "/":
// $result = $num2 == 0 ? "Can not go": $result = $num1 / $num2; // tenary operators
if($num2 == 0){
$result = "Can not go";
}else {
$result = $num1 / $num2;
}
break;
case "*":
$result = $num1 * $num2;
break;
case "sqrt":
$result = $num1 > 0 ? sqrt($num1): "It it can not go";
break;
default:
$result = "Select Operator";
break;


}

$_SESSION['result'] = $result;

header("location: index.php");

}