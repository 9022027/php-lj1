<?php
// Auteur: Farai
// Functie: Selecteer data

// Connect database
include "connect.php";

// Maak een query
$sql = "SELECT * FROM fietsen";
// Prepare
$stmt = $conn->prepare($sql);
// Uitvoeren
$stmt->execute();
// Ophalen alle data
$result = $stmt->fetchALL(PDO::FETCH_ASSOC);

//var_dump($result);

// Print de data rij voor rij
echo "<br>"; 
echo "<table border=1px>";
foreach ($result as $row) {
    echo "<tr>";
    echo "<td>" .  $row['merk'] . "</td>";
    echo "<td>" .  $row['type'] . "</td>";
    echo "<td>" .  $row['prijs'] . "</td>";
    echo "<td><img src='img/" . $row['foto'] . "' alt='Fietsfoto'></td>";

    echo "<tr>";
}
echo "</tr>";

?>