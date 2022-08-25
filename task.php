<?php
include_once(__DIR__ . "/classes/Db.php");
include_once(__DIR__ . "/classes/List.php");
include_once(__DIR__ . "/classes/Task.php");
include_once(__DIR__ . "/classes/Comment.php");
include_once(__DIR__ . "/classes/Done.php");

$allComments = Comment::getAll($_GET['task']);
$done = Done::getDone($_GET['task']);

    session_start();
    if(isset($_SESSION["username"])){
    }else{
        echo "not logged in";
        header("Location: login.php");
    }

    try{
        if (!empty($_GET)) {
            $id = $_GET['task'];
            $todo = Task::getTaskById($id);
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
    <title>Task detailpage</title>
</head>
<body>
    <?php include_once(__DIR__ . "/nav.inc.php") ?>
    
    <section class="container">
        <div class="mb-3">
            <h4><?php echo htmlspecialchars($todo['title']) ?></h4>
            <p>Description <strong><?php echo htmlspecialchars($todo['description']) ?></strong><p>
            <p>Deadline: <strong><?php echo htmlspecialchars($todo['deadline']) ?></strong><p>
            <p>Hours you need: <strong><?php echo htmlspecialchars($todo['hours_needed']) ?></strong><p>                     
            <?php if($done != false): ?>
            <p>Done: <strong>Yes</strong></p>
            <?php else : ?>
            <p>Done: <strong>No</strong></p>
            <?php endif; ?>

            <div>
                <label class="mb-2" for="done">Mark as done or not done:</label>
                <form action="" method="post">
                    <?php if($done != false): ?>
                    <input type="submit" value="not done" name="done" data-todoid="<?php echo $todo['id'] ?>" id="doneBtn" class="btn btn-success doneBtn_<?php echo $todo['id']; ?>">
                    <?php else : ?>
                    <input type="submit" value="done" name="done" data-todoid="<?php echo $todo['id'] ?>" id="doneBtn" class="btn btn-success doneBtn_<?php echo $todo['id']; ?>">
                    <?php endif; ?>
                </form>
            </div>
        </div>
        <div>
            <div class="mb-2">
                <p>Want to leave a comment?</p>
                <input type="text" placeholder="write a comment..." name="comment" id="commentText">
                <a class="btn btn-primary" href="#" id="commentBtn" data-todoid="<?php echo $todo['id'] ?>">comment</a>
            </div>
            <ul class="commentsOnTodo listgroup">
                <?php foreach($allComments as $comment): ?>
                    <li class="py-2 px-2 rounded-3 bg-light list-group-item">
                        <?php echo htmlspecialchars($comment['text']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

    </section>

    <script src="javascript/comment.js"></script>
    <script src="javascript/done.js"></script>
</body>
</html>