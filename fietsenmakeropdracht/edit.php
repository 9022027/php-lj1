<?php
// Auteur: Farai de grave
// Functie: bewerk fietsinformatie

// Controleren of de id-parameter is meegegeven in de URL
if(isset($_GET['id'])){

    // Verbinding maken met de database
    Include "connect.php";

    // Query om fietsinformatie op te halen op basis van de meegegeven id
    $sql = "SELECT * FROM fietsen WHERE id = :id";

    // Voorbereiden van de query
    $stmt = $conn->prepare($sql);

    // Uitvoeren van de query met de meegegeven id als parameter
    $stmt->execute(
        [':id'=>$_GET['id']] 
     );

    // Ophalen van de eerste rij met fietsinformatie
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Controleren of er resultaten zijn en deze weergeven
    print_r($result);

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
<h2>Wijzig een fiets</h2>

<!-- Formulier voor het wijzigen van fietsinformatie -->
<form action="edit_db.php" method="post">

    <!-- Verborgen veld voor de id van de fiets -->
    <input type="hidden" id="id" name="id" required value="<?php echo $result['id']; ?>"><br>

    <!-- Veld voor het merk van de fiets -->
    <label for="merk">Merk:</label>
    <input type="text" name="merk" required value="<?php echo $result['merk']; ?>"><br>

    <!-- Veld voor het type van de fiets -->
    <label for="type">Type:</label>
    <input type="text" name="type" required value="<?=$result['type'] ?>"><br>

    <!-- Veld voor de prijs van de fiets -->
    <label for="prijs">Prijs:</label>
    <input type="number" name="prijs" required value="<?=$result['prijs'] ?>"><br>
 
    <!-- Knop om de wijzigingen op te slaan -->
    <input type="submit" value="Wijzig Fiets">
</form>
</body>
</html>
