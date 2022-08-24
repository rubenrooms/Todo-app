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

    try {
        if (!empty($_POST)) {
            $list = new TodoList();
            $list->setName($_POST['listname']);
            $list->setUser_id($_SESSION['id']);
            $list->save();
        }
    }catch(\Throwable $th){
       $error = $th->getMessage();
   }


    $list = new TodoList();

    try{
        $lists = $list->getAllLists();
    } catch (Throwable $th){
        $error = $th->getMessage();
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
    <?php if(isset($error)): ?>
    <div><?php echo $error ?></div>
    <?php endif; ?>
    
    <?php include_once(__DIR__ . "/nav.inc.php") ?>
    <div>
        <form action="" method="POST">
            <label for="name" class="">Name of the list</label>
            <input type="name" class="" placeholder="Name of the new list" id="listname" name="listname">
            <br>
            <a href=""><button>add list</button></a>
        </form>
    </div>
    <h1>Lists</h1>
    <?php foreach ($lists as $list): ?>
    <section id="Lists">
            <a href="#" onclick="window.location='list.php?list=<?php echo $list['id']?>'"><div>
                <h4><?php echo $list['name'] ?></h4>
            </div></a>
    </section>
    <?php endforeach; ?>
</body>
</html> 