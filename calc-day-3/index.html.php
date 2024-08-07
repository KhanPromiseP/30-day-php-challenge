<?php 
include 'index.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>

    <style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        border: 2px solid black;
        box-sizing: border-box;
        width: 30%;
        height: 320px;
        position: absolute;
        align-items: center;
        margin: auto;
        background-color: whitesmoke;
        border: 2px solid black;
        border-radius: 10px;
        box-shadow: 10px 10px 30px;
        top: 120px;
        right: 350px;

    }





    button:hover {
        background-color: darkgray;
        color: white;
    }


    button {
        padding: 10px;
        font-size: 18px;
        margin: 10px;
        border: none;
        cursor: pointer;
        background-color: slategray;
        color: white;
        border-radius: 5px;
    }

    input[type=answer] {
        width: 50%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: none;
        background-color: lightgray;
        color: black;
        border-radius: 5px;
        text-align: center;
        border: 1px solid black;
        ;

    }

    input[type=text] {
        border: 2px solid black;
        border-radius: 3px;
    }
    </style>

</head>

<body>
    <h1>Calculator</h1>
    <form method="post" action="">
        <label for="num1">Enter num1:</label><br>
        <input type="text" id="num1" name="num1"><br>
        <label for="operator">Choose operator:</label><br>
        <select id="operator" name="operator">
            <option value="+" selected>+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
            <option value="^">^</option>
            <option value="%">%</option>
            <option value="sqrt">sqrt</option>
        </select><br><label for="num2">Enter num2:</label><br>
        <input type="text" id="num2" name="num2"><br>
        <button type="submit" name="answer" id="answer" value="answer">Calculate</button>
        <div class="result">
            <input type="answer" id="result" disabled value="<?php echo $result;?>" placeholder="answer">
        </div>
    </form>


</html>