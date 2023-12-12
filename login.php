<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['error'])) {
        echo "Username o password errati.";
    }
    else if (isset($_GET['success'])) {
        echo "Registrazione avvenuta con successo.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="chckLogin.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    Non sei registrato? <a href="register.php">Registrati</a>
    
</body>
</html>
