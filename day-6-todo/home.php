<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do-App</title>
</head>

<body>
    <div class="header">
        <h2>Hello <?php $_SESSION['username'] ?></h2><br>
        <h4>You have 1 uncomplete task!</h4>
    </div>
    <input type="text" name="searchbar" value="search" placeholder="search task..."></input>
    <input type="button" name="seachbtn">Search</input>
</body>

</html>