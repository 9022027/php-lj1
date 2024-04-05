<?php
// auteur: Farai
// functie: verwijder een brouwer op basis van de brouwcode

include './functions.php';

// Haal brouwer uit de database
if(isset($_GET['brouwcode'])){

    // test of verwijderen gelukt is
    if(deleteBrouwer($_GET['brouwcode']) == true){
        echo '<script>alert("Brouwer met brouwcode: ' . $_GET['brouwcode'] . ' is verwijderd")</script>';
        echo "<script> location.replace('crud_brouwer.php'); </script>";
    } else {
        echo '<script>alert("Brouwer is NIET verwijderd")</script>';
    }
}
?>
