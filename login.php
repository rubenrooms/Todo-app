<?php

    include_once("classes/Db.php");
    include_once("classes/User.php");


        if (!empty($_POST)) {
            $user = new User();
            $user->setUsername($_POST['username']);
            $user->setPassword($_POST['password']);

        try{
            if($user->canLogin()){
                session_start();
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['id'] = $user->getId();
                header("Location: index.php");
            }  
        } catch (\Throwable $th) {
            $error = $th->getMessage();
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Loginpage</title>
</head>
<body>
    <?php if(isset($error)): ?>
    <div><?php echo $error ?></div>
    <?php endif; ?>
    <div class="height-90 flex-cc container my-3">
        <div class="">
            <form method="POST">
                <h1 class="h3 mb-3 fw-normal">Login</h1>
                <div class="mb-3">
                    <label for="username"  class="form-label">Username</label>
                    <input type="username" class="form-control" placeholder="username" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="password" id="password" name="password">
                    <small>already have an account? <a href="signup.php">Sign up</a></small>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</body>
</html> 