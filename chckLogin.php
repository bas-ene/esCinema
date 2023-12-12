<?php
// FILEPATH: /c:/xampp/htdocs/BasE/Cinema/chckLogin.php
session_start();
// Include the connection.php file
include 'connection.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the username and password from the POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Compute the MD5 hash of the password
    $hashedPassword = md5($password);

    // Prepare the SQL statement to check if the user is present in the utenti table
    $sql = "SELECT * FROM utenti WHERE username = '$username' AND password = '$hashedPassword'";
    $result = $conn->query($sql);

    // Check if a row is returned
    if ($result->num_rows > 0) {
        // User is present in the utenti table
        $_SESSION["idUtente"] = $result->fetch_assoc()['idUtente'];
        $_SESSION["username"] = $username;
        header('Location: cinema.php');
    } else {
        // User is not present in the utenti table
        header('Location: login.php?error=1');
    }
}
?>