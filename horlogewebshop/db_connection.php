<?php
$servername = "localhost";
$username = "root";
$password = ""; // Vul hier je wachtwoord in als je er een hebt ingesteld
$dbname = "horlogewebshop";

// Verbinding maken met de database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
