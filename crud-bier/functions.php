<?php
// auteur: Wigmans
// functie: algemene functies tbv hergebruik

include_once __DIR__ . "/../config/config.php"; // Adjusted relative path

function connectDb(){
    $servername = SERVERNAME;
    $username = USERNAME;
    $password = PASSWORD;
    $dbname = "brouwerenmaker";
   
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
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

function insertbier($post){
    $conn = connectDb();
    if (!$conn) {
        return false;
    }

    // Controleer of de biercode al bestaat voordat je probeert in te voegen
    $existingBier = getbier($_POST['biercode']);
    if ($existingBier) {
        echo "Bier met dezelfde biercode bestaat al.";
        return false;
    }

    $sql = "
        INSERT INTO " . CRUD_TABLE . " (naam, stijl, biercode)
        VALUES (:naam, :stijl, :biercode) 
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':naam' => $_POST['naam'],
        ':stijl' => $_POST['stijl'],
        ':biercode' => $_POST['biercode'],
    ]);

    return $stmt->rowCount() == 1;
}

function deletebier($biercode){

    // Connect database
    $conn = connectDb();
    
    try {
        // Maak een query 
        $sql = "
        DELETE FROM " . CRUD_TABLE . 
        " WHERE biercode = :biercode";

        // Prepare query
        $stmt = $conn->prepare($sql);

        // Uitvoeren
        $stmt->execute([
            ':biercode' => $biercode
        ]);

        // test of database actie is gelukt
        $retVal = ($stmt->rowCount() == 1) ? true : false ;
        return $retVal;
    } catch(PDOException $e) {
        // Check if the error is due to foreign key constraint violation
        if ($e->getCode() == '23000') {
            echo "Kan het bier niet verwijderen omdat het nog wordt gebruikt in andere tabellen.";
            return false;
        } else {
            // For other errors, rethrow the exception
            throw $e;
        }
    }
}
?>
