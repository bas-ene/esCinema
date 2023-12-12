<?php
session_start();
include("connection.php");
if ($_SESSION["idUtente"]) //controllo se è loggato
{
    $sql = "Select isAdmin from utenti where idUtente = '" . $_SESSION["idUtente"] . "' AND username = '" . $_SESSION["username"] . "'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row["isAdmin"] != "1") {
        header("Location: cinema.php");
    }
} else {
    header("login.php");
} //non è loggato
//controlla che tutto e' settato, se no ritorna errore
if (
    isset($_POST["Titolo"]) && isset($_POST["AnnoProduzione"]) && isset($_POST["Nazionalita"]) && isset($_POST["Durata"])
    && isset($_POST["Regista"]) && isset($_FILES["image_path"]) && isset($_POST["Genere"])
) {
    $fileName = basename($_FILES["image_path"]["name"]);
    $uploadPath = "images/" . $fileName;
    move_uploaded_file($_FILES["image_path"]["tmp_name"], $uploadPath);
    $timeValue = $conn->query("SELECT SEC_TO_TIME(" . $_POST['Durata'] . " * 60) AS formatted_time")->fetch_assoc()['formatted_time'];
    $insert_query = "INSERT INTO film (Titolo, AnnoProduzione, Nazionalita, Regista, Genere, Durata, image_path) VALUES ('
    " . $_POST['Titolo'] . "','" . $_POST['AnnoProduzione'] . "','" . $_POST['Nazionalita'] . "','" . $_POST['Regista'] . "','" . $_POST['Genere'] . "', \"
    " . $timeValue . "\",\"" . $fileName . "\" )";
    echo $insert_query;
    $result = $conn->query($insert_query);
}