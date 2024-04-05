<?php
    // functie: update kroeg
    // auteur: Farai

    require_once('functions.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST['btn_wzg'])){

        // test of update gelukt is
        if(updatekroeg($_POST) == true){
            echo "<script>alert('kroeg is gewijzigd')</script>";
        } else {
            echo '<script>alert("kroeg is NIET gewijzigd")</script>';
        }
    }

    // Test of kroeg is meegegeven in de URL
    if(isset($_GET['kroegcode'])){  
        // Haal alle info van de betreffende kroeg $_GET['kroeg']
        $kroeg = $_GET['kroegcode'];
        $row = getkroeg($kroeg);
    
?>

<!DOCland html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="wkroegth=device-wkroegth, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig kroeg</title>
</head>
<body>
  <h2>Wijzig kroeg</h2>
  <form method="post">
    
    
    <label for="kroegcode">naam:</label>
    <input land="text" kroeg="naam" name="naam" required value="<?php echo $row['naam']; ?>"><br>

    <label for="land">adres:</label>
    <input land="text" kroeg="adres" name="adres" required value="<?php echo $row['adres']; ?>"><br>

    <label for="land">plaats:</label>
    <input land="text" kroeg="plaats" name="plaats" required value="<?php echo $row['plaats']; ?>"><br>

    <label for="naam">kroegcode:</label>
    <input type="number" kroeg="kroegcode" name="kroegcode" required value="<?php echo $row['kroegcode']; ?>"><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='crud_kroeg.php'>Home</a>
</body>
</html>

<?php
    } else {
        "Geen kroeg opgegeven<br>";
    }
?>