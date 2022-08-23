<?php
    include_once(__DIR__ . "/../classes/Comment.php");
    include_once(__DIR__ . "/../classes/Db.php");
    include_once(__DIR__ . "/../classes/User.php");

    session_start();
    if(isset($_SESSION["username"])){
    }else{
        echo "not logged in";
        header("Location: login.php");
    }

    if(!empty($_POST)) {
        $c = new Comment();
        $c->setTodo_id($_POST['todoId']);
        $c->setText($_POST['text']);
        $c->setUser_id($_SESSION['id']);

        $c->saveComment();

        $response = [
            'status' => 'succes',
            'body' => htmlspecialchars($c->getText()),
            'message' => 'Comment saved!'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }

?>

