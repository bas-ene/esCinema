<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if (isset($_GET["idFilm"])) {
        $idFilm = $_GET["idFilm"];
        include("connection.php");
        $sql = "SELECT Titolo, Genere, Durata, image_path FROM film WHERE CodFilm = '$idFilm'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<img src='images/" . $row["image_path"] . "' alt='Image'>";
            echo "<p>Titolo: " . $row["Titolo"] . "</p>";
            echo "<p>Genere: " . $row["Genere"] . "</p>";
            echo "<p>Durata: " . $row["Durata"] . "</p>";
        }
    } else {
        echo "Seleziona un film prima";
    }
    ?>
    <a href="cinema.php">Torna alla home</a>
</body>

</html>