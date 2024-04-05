<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
// Functie: Programma CRUD brouwer
// Auteur: Farai 

// Initialisatie
include 'functions.php';

// Main

// Aanroep functie 
// Controleer eerst of de databaseverbinding succesvol is voordat de functie wordt aangeroepen
$conn = connectDb();
if ($conn) {
    crudBrouwer();
} else {
    echo "Er is een probleem opgetreden bij het maken van verbinding met de database.";
}
?>

</body>
</html>
