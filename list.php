<?php
include_once("classes/Db.php");
include_once("classes/List.php");
include_once("classes/Task.php");

    session_start();
    if(isset($_SESSION["username"])){
        echo "welcome " . $_SESSION["username"];
    }else{
        echo "not logged in";
        header("Location: login.php");
    }

    try{
        if (!empty($_GET)) {
            $id = $_GET['list'];
            $list = TodoList::getListById($id);
        }
    } catch (Throwable $th){
        $error = $th->getMessage();
    }

    $todo = new Task();

    try{
        $todos = $todo->getAllTasks($_GET['list']);
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
    <title>Listpage</title>
</head>
<body>  
    <nav>
        <a href="logout.php">logout</a>
    </nav>

    <?php if(isset($error)): ?>
    <div><?php echo $error ?></div>
    <?php endif; ?>
    
    <?php include_once(__DIR__ . "/nav.inc.php") ?>

    <section>
        <h1>Todo's from <?php echo $list['name'] ?></h1>
        <a href="#" onclick="window.location='newTask.php?list=<?php echo $list['id']?>'"><button>Add new todo</button></a> 

        <?php foreach ($todos as $todo): ?>
        <div>
            <a href="#" onclick="window.location='task.php?task=<?php echo $todo['id']?>'"><div>
                <h4><?php echo $todo['title'] ?></h4>
                <p><?php echo $todo['deadline'] ?><p>
            </div></a>
        </div>
        <?php endforeach ?>
    </section>

    
</body>
</html>