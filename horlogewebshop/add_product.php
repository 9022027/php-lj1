<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];

    // Voeg het product toe aan de database
    $sql = "INSERT INTO products (product_name, price) VALUES ('$product_name', '$price')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Product succesvol toegevoegd.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Toevoegen</title>
</head>
<body>
    <h2>Product Toevoegen</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="product_name">Product Naam:</label><br>
        <input type="text" name="product_name" required><br>
        <label for="price">Prijs:</label><br>
        <input type="number" name="price" step="0.01" min="0" required><br>
        <button type="submit">Toevoegen</button>
    </form>
</body>
</html>
