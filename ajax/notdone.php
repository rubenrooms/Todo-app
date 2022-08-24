<?php
include_once(__DIR__ . "/../classes/Done.php");

    if(!empty($_POST)) {
        session_start();
        $done = new Done();
        $done->setTodo_id($_POST['todoId']);
        $done->setUser_id($_SESSION['id']);
        $done->notDone();

        $response = [
            "status" => "success",
            "message" => "Todo marked as not done"
        ];

        header("Content-Type: application/json");
        echo json_encode($response);
    }
?>