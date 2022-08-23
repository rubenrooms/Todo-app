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

    if (!empty($_GET)) {
        $id = $_GET['task'];
        $todo = Task::getTaskById($id);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task detailpage</title>
</head>
<body>
    <section>
        <div>
            <h4><?php echo $todo['title'] ?></h4>
            <p>Description: <?php echo $todo['description'] ?><p>
            <p>Deadline: <?php echo $todo['deadline'] ?><p>
            <p>Hours you need: <?php echo $todo['hours_needed'] ?><p>
            <p>Finished: <?php echo $todo['done'] ?><p>
        </div>
        <div>
            <div>
                <p>Want to leave a comment?</p>
                <input type="text" placeholder="write a comment..." name="comment" id="commentText">
                <a href="#" id="commentBtn" data-todoid="<?php echo $todo['id'] ?>">comment</a>
            </div>
            <ul class="commentsOnTodo">
                
            </ul>
        </div>

    </section>

    <script src="javascript/comment.js"></script>
</body>
</html>