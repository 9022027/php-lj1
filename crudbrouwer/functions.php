<?php
// auteur: Farai
// functie: algemene functies tbv hergebruik

include_once "config.php";

function connectDb(){
    $servername = SERVERNAME;
    $username = USERNAME;
    $password = PASSWORD;
    $dbname = DATABASE;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } 
    catch(PDOException $e) {
        error_log("Connection failed: " . $e->getMessage(), 0);
        return null;
    }
}

function getData($table){
    $conn = connectDb();
    if (!$conn) {
        return null;
    }

    $sql = "SELECT * FROM $table";
    $query = $conn->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();

    return $result;
}

function getBrouwer($brouwcode){
    $conn = connectDb();
    if (!$conn) {
        return null;
    }

    $sql = "SELECT * FROM " . CRUD_TABLE . " WHERE brouwcode = :brouwcode";
    $query = $conn->prepare($sql);
    $query->execute([':brouwcode' => $brouwcode]);
    $result = $query->fetch();

    return $result;
}

function ovzBrouwer(){
    $result = getData(CRUD_TABLE);
    printTable($result);
}

function printTable($result){
    if (empty($result)) {
        echo "Geen resultaten gevonden";
        return;
    }

    $table = "<table>";
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";   
    }
    $table .= "<th colspan='2'>Actie</th></tr>";

    foreach ($result as $row) {
        $table .= "<tr>";
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";  
        }
        $table .= "<td><a href='update_brouwer.php?brouwcode={$row['brouwcode']}'>Wzg</a></td>";
        $table .= "<td><a href='delete_brouwer.php?brouwcode={$row['brouwcode']}'>Verwijder</a></td>";
        $table .= "</tr>";
    }
    $table .= "</table>";
    echo $table;
}

function crudBrouwer(){
    $txt = "<h1>Crud brouwer</h1><nav><a href='insert_brouwer.php'>Toevoegen nieuwe brouwer</a></nav><br>";
    echo $txt;

    $result = getData(CRUD_TABLE);
    printCrudBrouwer($result);
}

function printCrudBrouwer($result){
    if (empty($result)) {
        echo "Geen resultaten gevonden";
        return;
    }

    $table = "<table>";
    $headers = array_keys($result[0]);
    $table .= "<tr>";
    foreach($headers as $header){
        $table .= "<th>" . $header . "</th>";   
    }
    $table .= "<th colspan='2'>Actie</th></tr>";

    foreach ($result as $row) {
        $table .= "<tr>";
        foreach ($row as $cell) {
            $table .= "<td>" . $cell . "</td>";  
        }
        $table .= "<td><a href='update_brouwer.php?brouwcode={$row['brouwcode']}'>Wzg</a></td>";
        $table .= "<td><a href='delete_brouwer.php?brouwcode={$row['brouwcode']}'>Verwijder</a></td>";
        $table .= "</tr>";
    }
    $table .= "</table>";
    echo $table;
}

function updateBrouwer($row){
    $conn = connectDb();
    if (!$conn) {
        return false;
    }

    $sql = "UPDATE " . CRUD_TABLE . " SET naam = :naam, land = :land WHERE brouwcode = :brouwcode";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':naam' => $row['naam'],
        ':land' => $row['land'],
        ':brouwcode' => $row['brouwcode']
    ]);

    return $stmt->rowCount() == 1;
}

function insertBrouwer($post){
    $conn = connectDb();
    if (!$conn) {
        return false;
    }

    // Controleren of de brouwcode al bestaat
    $existingBrouwer = getBrouwer($_POST['brouwcode']);
    if ($existingBrouwer) {
        // Als de brouwcode al bestaat, retourneer false om aan te geven dat de invoeging mislukt is
        return false;
    }

    // Als de brouwcode niet bestaat, voeg deze dan toe aan de database
    $sql = "
        INSERT INTO " . CRUD_TABLE . " (naam, land, brouwcode)
        VALUES (:naam, :land, :brouwcode) 
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':naam' => $_POST['naam'],
        ':land' => $_POST['land'],
        ':brouwcode' => $_POST['brouwcode'],
    ]);

    return $stmt->rowCount() == 1;
}
