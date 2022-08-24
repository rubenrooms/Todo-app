<?php 

include_once("classes/Db.php");
include_once("classes/User.php");

    if (!empty($_POST)) {
        try {
            session_start();
            $user = new User();

            $user-> setFirstname($_POST["firstname"]);
            $user-> setLastname($_POST["lastname"]);
            $user-> setUsername($_POST["username"]);
            $user-> setPassword($_POST["password"]);
            $user-> hashPassword();

            $user->save();
            $_SESSION['username'] = $_POST["username"];
            $_SESSION['id'] = $user->getSessionId($_POST['username']);
            header("Location: index.php");

        }catch(\Throwable $th){
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
    <title>Signuppage</title>
</head>
<body>
    <?php if(isset($error)): ?>
    <div><?php echo $error ?></div>
    <?php endif; ?>
    
    <div class="height-90 flex-cc container my-3">
        <div>
            <form method="POST">
                <h1 class="h3 mb-3 fw-normal">Sign in</h1>
                <div class="mb-3">
                    <div class="mb-2">
                        <label class="form-label" for="firstname">First Name</label>
                        <input class="form-control" type="text" placeholder="First name" id="firstname" name="firstname">
                    </div>
                    <div class="col">
                        <label class="form-label" for="lastname">Last Name</label>
                        <input class="form-control" type="text" placeholder="Last name" id="lastname" name="lastname">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="username">Username</label>
                    <input class="form-control" type="text" placeholder="username" id="username" name="username">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-control" type="password" placeholder="password" id="password" name="password">
                    <small>already have an account? <a href="login.php">Login</a></small>
                </div>
                <button type="submit" class="btn btn-primary">Sign up</button>
            </form>
        </div>
    </div>
</body>
</html> 