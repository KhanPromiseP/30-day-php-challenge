<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form {
            background-color: purple;
            color: white;
            padding: 2%;
            margin: 0 auto;
            box-shadow: 3px solid gray;
            width: 50%;
            border-radius: 4%;
        }

        input, select {
            width: 100%;
            margin: 5px;
        }
        button {
            width: 40%;
            margin: 5px;
            background-color: gray;
            color: white;

        }
    </style>
</head>
<body>

<?php 

session_start();
$result = '';
if(isset($_SESSION['result'])){
    $result = $_SESSION['result'];
}

?>
    <form action="process.php" method="post">
        <input type="number" name="num1">
        <input type="number" name="num2">
        <select name="operator">
            <option value="">select Operator</option>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="/">/</option>
            <option value="*">*</option>
            <option value="sqrt">Sqrt</option>
        </select>
        <button type="submit" name="calculate">Submit</button>



        <input type="text" value="<?php echo $result ?>" readonly>
        <?php 

        if(isset($_SESSION['result'])){
            unset($_SESSION['result']);
        }
        ?>
    </form>
</body>
</html>