<?php
// FILEPATH: /c:/xampp/htdocs/BasE/Cinema/register.php
// Assuming you have a database connection established
include "connection.php";
// Retrieve the user input from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Perform any necessary validation on the input
if(strlen($username) < 1) {
    echo "Username must be at least 1 characters long";
    die("username troppo corto");
}
if(strlen($password) < 1) {
    echo "Password must be at least 1 characters long";
    die("passw troppo corto");
}
$passHash = md5($password);
//if the user is not already present in the database

$sql_check = "SELECT * FROM utenti WHERE username = '$username'";
$result_check = $conn->query($sql_check);
if ($result_check->num_rows > 0) {
    // User is present in the utenti table
    header('Location: login.php?error=1');
    die("utente gia presente");
}

// Insert the new user into the database
$sql = "INSERT INTO utenti (username, password) VALUES ('$username', '$passHash')";
$result = $conn->query($sql);

if ($result) {
    // User inserted successfully
} else {
    // Error occurred while inserting user
    die("passw troppo corto");
}
header('Location: login.php?success=1');
// Close the database connection
$conn->close();
?>
