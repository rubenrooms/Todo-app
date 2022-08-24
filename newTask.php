<?php
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ . "/classes/List.php");
include_once(__DIR__ . "/classes/Task.php");

session_start();
if(isset($_SESSION["username"])){
}else{
    echo "not logged in";
    header("Location: login.php");
}

$list = new TodoList();

try{
    if (!empty($_GET)) {
        $id = $_GET['list'];
        $list = TodoList::getListById($id);
    }
} catch(\Throwable $th){
    $error = $th->getMessage();
}

try{
    if (!empty($_POST)) {
        $task = new Task();
        $task->setTitle($_POST['todoName']);
        $task->setDescription($_POST['todoDescription']);
        $task->setHoursneeded($_POST['todoHours']);
        $task->setDeadline($_POST['todoDeadline']);
        $task->setUser_id($_SESSION['id']);
        $task->setList_id($list['id']);
        $task->saveTask();
    }
} catch(\Throwable $th){
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
    <title>New Todo</title>
</head>
<body>
    <?php include_once(__DIR__ . "/nav.inc.php") ?>

    <?php if(isset($error)): ?>
    <div><?php echo $error ?></div>
    <?php endif; ?>
    <div class="height-90 flex-cc container my-3">
        <h2 class="h3 mb-3 fw-normal">Add new Todo to <?php echo $list['name'] ?></h2>
        <form action="" method="POST">
            <div class="mb-2">
                <label class="form-label" for="name">Title of the Todo</label>
                <input class="form-control" type="name" placeholder="Title of your new Todo" id="todoName" name="todoName">
            </div>
            <div class="mb-2">
                <label class="form-label" for="text">Description</label>
                <input class="form-control" type="text" placeholder="Description of your Todo" id="todoDescription" name="todoDescription" required>
            </div>
            <div class="mb-2">
                <label class="form-label" for="number">Amount of hours you need to complete the Todo</label>
                <input class="form-control" type="number" placeholder="Amount of hours you will spend" id="todoHours" name="todoHours">
            </div>
            <div class="mb-2">
                <label class="form-label" for="date" >Deadline</label>
                <input class="form-control" type="date" placeholder="deadline" id="todoDeadline" name="todoDeadline">
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Add new Todo</button>
            </div>
        </form>
    </div>    
</body>
</html>