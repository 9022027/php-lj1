
<?php
include 'db_connection.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Producten Bekijken</title>
</head>
<body>
    <h2>Producten Bekijken</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Product Naam</th>
            <th>Prijs</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["productcode"] . "</td>"; // Kolomnaam "id" in plaats van "ID"
                echo "<td>" . $row["naam"] . "</td>";
                echo "<td>" . $row["prijs"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Geen producten gevonden.</td></tr>";
        }
        ?>
    </table>
    <a class=verwijder href="delete_product.php">verwijder</a> 
    <a class=edit href="edit_product.php">edit</a>
    <a class=toevoegen href="add_product.php">toevoegen</a>  
</body>
</html>
