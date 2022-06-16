<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signuppage</title>
</head>
<body>
    <div>
        <div>
            <form method="POST">
                <h1>Please sign in</h1>
                <div>
                    <div>
                        <label for="firstname">First Name</label>
                        <input type="text" placeholder="First name" id="firstname" name="firstname">
                    </div>
                    <div class="col">
                        <label for="lastname">Last Name</label>
                        <input type="text" placeholder="Last name" id="lastname" name="lastname">
                    </div>
                </div>
                <div>
                    <label for="username">Username</label>
                    <input type="text" placeholder="username" id="username" name="username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" placeholder="password" id="password" name="password">
                    <small>already have an account? <a href="login.php">Login</a></small>
                </div>
                <button type="submit">Sign up</button>
            </form>
        </div>
    </div>
</body>
</html> 