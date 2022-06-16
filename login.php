<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loginpage</title>
</head>
<body>
    <div>
        <div>
            <form method="POST">
                <h1>Please login</h1>
                <div>
                    <label for="username">Username</label>
                    <input type="username" placeholder="username" id="username" name="username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" placeholder="password" id="password" name="password">
                    <small>already have an account? <a href="signup.php">Sign up</a></small>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html> 