<!DOCTYPE html>
<html>

<head>
    <title>Registration Page</title>
</head>

<body>
    <h1>Registration</h1>
    <form method="POST" action="chckRegister.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <input type="submit" value="Register">
    </form>
</body>

</html>