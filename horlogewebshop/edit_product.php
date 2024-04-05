<?php
include 'db_connection.php';

// Check of productcode is opgegeven in de URL
if (!isset($_GET['product_code'])) {
    echo "Productcode ontbreekt.";
    exit; // Stop verdere uitvoering
}

$product_code = $_GET['product_code'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];

    // Update het product in de database
    $sql = "UPDATE products SET product_name='$product_name', price='$price' WHERE code='$product_code'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Product succesvol bijgewerkt.";
    } else {
        echo "Fout: " . $sql . "<br>" . $conn->error;
    }
}

// Haal de productgegevens op uit de database
$sql = "SELECT * FROM products WHERE code='$product_code'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Product niet gevonden.";
    exit; // Stop verdere uitvoering
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Bijwerken</title>
</head>
<body>
    <h2>Product Bijwerken</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?product_code=' . $product_code; ?>">
        <input type="hidden" name="product_code" value="<?php echo $product_code; ?>">
        <label for="product_name">Product Naam:</label><br>
        <input type="text" name="product_name" value="<?php echo $row['product_name']; ?>" required><br>
        <label for="price">Prijs:</label><br>
        <input type="number" name="price" step="0.01" min="0" value="<?php echo $row['price']; ?>" required><br>
        <button type="submit">Bijwerken</button>
    </form>
</body>
</html>
