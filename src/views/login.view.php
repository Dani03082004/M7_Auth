<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>
<body>
    <h1><?= $title ?></h1>
    LOGIN
    <div>
        <form action="auth" method="POST">
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="pasword" id="password" required>
            </div>
            <div>
                <button type="submit">Login</button>
            </div>

        </form>
    </div>
</body>
</html>