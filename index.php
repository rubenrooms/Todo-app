<?php

    include_once("classes/Db.php");
    include_once("classes/List.php");

    session_start();
    if(isset($_SESSION["username"])){
    }else{
        echo "not logged in";
        header("Location: login.php");
    }

    var_dump($_SESSION['id']);

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php if(isset($error)): ?>
    <div><?php echo $error ?></div>
    <?php endif; ?>
    
    <?php include_once(__DIR__ . "/nav.inc.php") ?>
    <div class="container p-3">
        <div class="pb-3">
            <form action="" method="POST">
                <label for="name" class="mx-1/2">Name of the list</label>
                <div>
                    <input type="name" class="mx-1/2" placeholder="Name of the new list" id="listname" name="listname">
                    <a class="mx-1/2" href=""><button class="btn btn-primary">add list</button></a>
                </div>
            </form>
        </div>
        <h1 class="">Lists</h1>
        <?php foreach ($lists as $list): ?>
        <div class="list-group d-grid gap-2 border-0 py-2" id="Lists">
                <a class="list-group-item rounded-3 my-1/2 py-2" href="#" onclick="window.location='list.php?list=<?php echo $list['id']?>'"><div>
                    <h4><?php echo $list['name'] ?></h4>
                </div></a>
        </div>
        <?php endforeach; ?>
    </div>

</body>
</html> 