<?php
include_once("classes/Db.php");
include_once("classes/List.php");
include_once("classes/Task.php");

    session_start();
    if(isset($_SESSION["username"])){
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Listpage</title>
</head>
<body>

    <?php if(isset($error)): ?>
    <div><?php echo $error ?></div>
    <?php endif; ?>
    
    <?php include_once(__DIR__ . "/nav.inc.php") ?>

    <section class="container">
        <h1>Todo's from <?php echo htmlspecialchars($list['name']) ?></h1>
        <a class="btn btn-primary right" href="#" onclick="window.location='newTask.php?list=<?php echo $list['id']?>'">Add new todo</a> 

        <?php foreach ($todos as $todo): ?>
        <div class="list-group d-grid gap-2 border-0 py-2">
            <a href="#" class="list-group-item rounded-3 my-1/2 px-3 py-2" onclick="window.location='task.php?task=<?php echo $todo['id']?>'"><div>
                <h4 ><?php echo htmlspecialchars($todo['title']) ?></h4>
                <p class="small"><?php echo htmlspecialchars($todo['deadline']) ?><p>
            </div></a>
        </div>
        <?php endforeach ?>
    </section>

    
</body>
</html>