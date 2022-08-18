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

    if (!empty($_GET)) {
        $id = $_GET['list'];
        $list = TodoList::getListById($id);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listpage</title>
</head>
<body>  
    <nav>
        <a href="logout.php">logout</a>
    </nav>
    <section>
        <h1>Todo's from <?php echo $list['name'] ?></h1>
    </section>

    
</body>
</html>