<?php 
session_start();
if (!isset($_SESSION["idUtente"]))
    header("Location: login.php");
?>

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
        echo "Benvenuto " . $_SESSION["username"] . "<br>";
    ?>
    <form action="" method="get">
        <!--from che prende tutti i generi, li mette in un select, e poi fa una query per prendere i film di quel genere-->
        <select name="genere" id="genere">
            <option value="tutti">Tutti</option>
            <?php
            include("connection.php");
            $sql = "SELECT DISTINCT Genere FROM film";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row["Genere"] . "'>" . $row["Genere"] . "</option>";
                }
            }
            ?>
        </select>
        <input type="submit" value="Filtra">

    </form>



    <?php
    include("connection.php");
    if (isset($_GET["genere"])) {
        $genere = $_GET["genere"];
        if ($genere == "tutti") {
            $sql = "SELECT CodFilm, Titolo, Durata, image_path FROM film";
        } else {
            $sql = "SELECT CodFilm, Titolo, Durata, image_path FROM film WHERE Genere = '$genere'";
        }
    } else {
        $sql = "SELECT CodFilm, Titolo, Durata, image_path FROM film";
    }
    // Fetch data from table
    $result = $conn->query($sql);

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<table>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>";
            echo "<img src='images/" . $row["image_path"] . "' alt='Image'>";
            echo "</td>";
            echo "<td>";
            echo "<a href='schedaFilm.php?idFilm=" . $row["CodFilm"] . "'>";
            echo "<p>Titolo: " . $row["Titolo"] . "</p>";
            echo "</a>";
            // Calculate duration in minutes
            // 1:06:00 should be 66 minutes
            $duration = explode(":", $row["Durata"]);
            $duration_minutes = $duration[0] * 60 + $duration[1];
            echo "<p>Durata: " . $duration_minutes . " minuti</p>";
            echo "</td>";
            echo "</tr>";
            echo "<tr><td colspan='2'>------------------------</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No films found.";
    }
    //close connection
    mysqli_close($conn);

    ?>
</body>

</html>