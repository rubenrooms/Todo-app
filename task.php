<?php
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ . "/classes/List.php");
include_once(__DIR__ . "/classes/Task.php");
include_once(__DIR__ . "/classes/Comment.php");
include_once(__DIR__ . "/classes/Done.php");

$allComments = Comment::getAll($_GET['task']);

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

    $done = new Done();

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
            <p>Finished: 0<p>
            <div>
                <label for="done">Mark as done:</label>
                <form action="" method="post">
                    <input type="submit" value="done" name="done" data-todoid="<?php echo $todo['id'] ?>" id="doneBtn" class="doneBtn_<?php echo $todo['id']; ?>">
                </form>
            </div>
        </div>
        <div>
            <div>
                <p>Want to leave a comment?</p>
                <input type="text" placeholder="write a comment..." name="comment" id="commentText">
                <a href="#" id="commentBtn" data-todoid="<?php echo $todo['id'] ?>">comment</a>
            </div>
            <ul class="commentsOnTodo">
                <?php foreach($allComments as $comment): ?>
                    <li><?php echo $comment['text']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

    </section>

    <script src="javascript/comment.js"></script>
    <script src="javascript/done.js"></script>
</body>
</html>