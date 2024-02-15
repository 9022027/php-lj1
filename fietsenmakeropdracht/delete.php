<?php
    echo "<h1>Delete fiets</h1>";

    try{
        // Connect database
        include "connect.php";

        // Delete row from table using prepared statement
        $sql = "DELETE FROM fietsen WHERE id = ?";
        $query = $conn->prepare($sql);
        $query->execute(["id"]);
    }
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    
?>
<form action="" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="submit" name="btn_verw" value="Verwijder">
</form>
