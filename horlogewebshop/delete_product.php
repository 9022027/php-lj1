<?php
include 'db_connection.php';

// Controleer of de 'id' parameter is ingesteld en geldig is
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $product_id = $_GET['id'];

    // Verwijder het product uit de database
    $sql = "DELETE FROM products WHERE productcode='$product_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Product succesvol verwijderd.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Ongeldige product-ID.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Verwijderen</title>
</head>
<body>
    <p><a href="view_products.php">Terug naar producten</a></p>
</body>
</html>
