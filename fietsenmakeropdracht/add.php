<?php
// Auteur: Farai de grave
// Functie: voeg nieuwe fiets toe

// Connectie met de database
include "connect.php";

// Variabelen initialiseren
$merk = $type = $prijs = "";

// Controleren of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gegevens van het formulier ophalen en escapen om veiligheid te garanderen
    $merk = htmlspecialchars($_POST["merk"]);
    $type = htmlspecialchars($_POST["type"]);
    $prijs = htmlspecialchars($_POST["prijs"]);

    // SQL-query voor het toevoegen van een nieuwe fiets
    $sql = "INSERT INTO fietsen (merk, type, prijs) VALUES (?, ?, ?)";
    
    // Voorbereiden van de SQL-query
    $stmt = $conn->prepare($sql);

    // Parameters binden aan de voorbereide statement
    $stmt->bindParam(1, $merk);
    $stmt->bindParam(2, $type);
    $stmt->bindParam(3, $prijs);

    // Uitvoeren van de voorbereide statement en controleren op succes
    if ($stmt->execute()) {
        // Doorsturen naar het overzicht van fietsen na succesvolle toevoeging
        header("Location: crud.php");
        exit();
    } else {
        // Tonen van een foutmelding als er een probleem is bij het toevoegen van de fiets
        echo "Fout bij het toevoegen van de fiets: " . $stmt->error;
    }

    // Statement sluiten om resources vrij te geven
    $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Fiets Toevoegen</title>
</head>
<body>
    <h2>Voeg een nieuwe fiets toe</h2>
    <!-- Formulier voor het toevoegen van een nieuwe fiets -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Merk: <input type="text" name="merk" required><br>
        Type: <input type="text" name="type" required><br>
        Prijs: <input type="text" name="prijs" required><br>
        <input type="submit" value="Toevoegen">
    </form>
</body>
</html>
