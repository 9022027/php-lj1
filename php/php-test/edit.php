<?php
    if(isset($_get['id'])) {
        
        //echo "mijn id = " . $GET['id'];

        //haal de rij-info op van de fiets met bijbehorende id
        //select * FROM fietsen WHERE id = 1


        //connect database
        include "connect.php"


        //maak een query
        $sql = "SELECT * FROM fietsen WHERE id = :id";

        //prepare query
        $stmt = $conn->prepare($sql);
        //uitvoeren
        $stmt->execute(
            [':id'=>$_GET['id']]
        );
        //ophalen all data
        $result = $stmt->fetch(PDO::)
    }   