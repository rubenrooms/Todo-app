<?php
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ . "/classes/List.php");
include_once(__DIR__ . "/classes/Task.php");

session_start();
if(isset($_SESSION["username"])){
    echo "welcome " . $_SESSION["username"];
}else{
    echo "not logged in";
    header("Location: login.php");
}

$list = new TodoList();

if (!empty($_GET)) {
    $id = $_GET['list'];
    $list = TodoList::getListById($id);
}

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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Todo</title>
</head>
<body>
    <nav>
        <a href="logout.php">logout</a>
    </nav>
    
    <h2>Add new Todo to <?php echo $list['name'] ?></h2>
    <form action="" method="POST">
        <div>
            <label for="name">Title of the Todo</label>
            <input type="name" placeholder="Title of the new Todo" id="todoName" name="todoName">
        </div>
        <div>
            <label for="text">Description</label>
            <input type="text" placeholder="Description of the Todo" id="todoDescription" name="todoDescription">
        </div>
        <div>
            <label for="number">Amount of hours you need to complete the Todo</label>
            <input type="number" placeholder="Amount of hours you will spend" id="todoHours" name="todoHours">
        </div>
        <div>
            <label for="date" >Deadline</label>
            <input type="date" placeholder="deadline" id="todoDeadline" name="todoDeadline">
        </div>
        <div>
            <button type="submit">Add new Todo</button>
        </div>
    </form>
</body>
</html>