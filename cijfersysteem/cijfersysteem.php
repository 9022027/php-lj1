<?php
// Auteur: Farai de Grave
// Functie: Selecteer data

// Inclusie van databaseverbinding
include "connect.php";

try {
    // Query voorbereiden
    $sql = "SELECT * FROM cijfers";
    $stmt = $conn->prepare($sql);
    
    // Query uitvoeren
    $stmt->execute();
    
    // Alle resultaten ophalen
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Print de data rij voor rij
    echo "<br>";
    echo "<table border='1px'>";
    
    // Controleer of er resultaten zijn
    if (!empty($result)) {
        // Eerste rij met koprijen
        echo "<thead>";
        echo "<tr>";
        echo "<th>Leerling</th>";
        echo "<th>Cijfer</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        // Loop door de gegevens en toon elke rij
        foreach ($result as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['leerling']) . "</td> ";
            echo "<td>" . htmlspecialchars($row['cijfer']) . "</td> ";
            echo "</tr>";
        }
        
        echo "</tbody>";
    } else {
        echo "<tr><td colspan='2'>Geen resultaten gevonden</td></tr>";
    }
    
    echo "</table>";
    
    // Sluit de databaseverbinding
    $conn = null;
} catch (PDOException $e) {
    // Foutafhandeling
    echo "Er is een fout opgetreden: " . $e->getMessage();
}
?>
