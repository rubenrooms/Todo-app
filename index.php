<?php

    include_once("classes/Db.php");
    include_once("classes/List.php");

    session_start();
    if(isset($_SESSION["username"])){
        echo "welcome " . $_SESSION["username"];
    }else{
        echo "not logged in";
        header("Location: login.php");
    }

    var_dump($_SESSION['id']);

    if (!empty($_POST)) {
        $list = new TodoList();
        $list->setName($_POST['listname']);
        $list->setUser_id($_SESSION['id']);
        $list->save();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
            <a href="logout.php">Log out</a>
        </nav>
    </header>
    <div>
        <form action="" method="POST">
            <label for="name" class="">Name of the list</label>
            <input type="name" class="" placeholder="Name of the new list" id="listname" name="listname">
            <br>
            <a href=""><button>add list</button></a>
        </form>
    </div>
    <h1>Todo's</h1>
</body>
</html> 