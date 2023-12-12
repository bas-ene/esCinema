<?php
session_start();
if (!isset($_SESSION["idUtente"]))
    header("Location: login.php");
include("connection.php");
$sql = "Select isAdmin from utenti where idUtente = '" . $_SESSION["idUtente"] . "' AND username = '" . $_SESSION["username"] . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row["isAdmin"] != "1") {
    header("Location: cinema.php");
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form enctype="multipart/form-data" action="chckInserisci.php" method="post">
        Titolo: <br>
        <input type="text" name="Titolo" id="">
        <br>
        Anno Produzione: <br>
        <input type="text" name="AnnoProduzione" id="">
        <br>
        Nazionalita: <br>
        <input type="text" name="Nazionalita" id="">
        <br>
        Regista: <br>
        <input type="text" name="Regista" id="">
        <br>
        Genere: <br>
        <input type="text" name="Genere" id="">
        <br>
        Durata (in minuti): <br>
        <input type="text" name="Durata" id="">
        <br>
        Locandina: <br>
        <input type="file" name="image_path" id="">
        <br>
        <input type="submit" value="Inserisci">
    </form>
</body>

</html>
