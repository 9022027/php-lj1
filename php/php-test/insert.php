<?php
//auteur: Farai
//functie: toevoegen van 1 fiets
    // Test of toevoeg knop is ingedrukt
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "Er is gepost<br>";
        print_r($_POST);
    

    // Connect database
    include "connect.php";

    // Maak een query
    $sql = "INSERT INTO `fietsen` (id, merk, type, prijs, foto) 
            VALUES (:merk, :type, :prijs, :foto);";
    // Prepare
    $query = $conn->prepare($sql);
    // Uitvoeren
    $status = $query->execute(
        [
            ':merk'=>$_POST['merk'],
            ':type'=>$_POST['type'],
            ':prijs'=>$_POST['prijs'],
            ':foto'=>$_POST['foto'],
        ]
        );
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fietsen Formulier</title>
</head>
<body>

  <h2>Voeg Fiets Toe</h2>

  <form action="" method="POST">
    <label for="merk">Merk:</label>
    <input type="text" id="merk" name="merk" required><br>

    <label for="type">Type:</label>
    <input type="text" id="type" name="type" required><br>

    <label for="prijs">Prijs:</label>
    <input type="number" id="prijs" name="prijs" required><br>

    <label for="foto">Foto bestandnaam</label>
    <input type="text" id="foto" name="foto" required><br>

    <input type="submit" value="Voeg Toe">
  </form>

</body>
</html>