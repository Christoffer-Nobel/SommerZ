<?php
session_start();
include('../conn.php');
include('../functions.php');
connect();
include("../header.php");
    ?>


<form method="post">
    <input class="form-control rounded-0" type="text" name="produktNavn" placeholder="Produkt Navn" required></input>
    <input class="form-control rounded-0" name="antal" placeholder="Antal" required></input>
    <input class="form-control rounded-0" name="enhed" placeholder="Enhed" required></input>
    <button type="submit" name="newOrder">Tilføj et til</button>
    <button type="submit" name="endOrder">Afslut bestilling</button>
</form>
<br><br><br><br>
<a href="../index.php" class="btn btn-primary">Gå tilbage</a>
<?php

if(!isset($_SESSION['bestillingslisteId'])){
    $_SESSION['bestillingslisteId'] = getOrderId() + 1;
}
    if(isset($_POST['newOrder'])){
        $bestillingslisteId = $_SESSION['bestillingslisteId'];
        $produktNavn = $_POST['produktNavn'];
        $antal = $_POST['antal'];
        $enhed = $_POST['enhed'];
        
        $sql = "INSERT INTO bestillinger (produkt_navn, antal, enhed, bestillingsliste_id) VALUES ('$produktNavn', '$antal', '$enhed', '$bestillingslisteId');";
        $result = mysqli_query($conn, $sql);
        
        
        header( "refresh:0" );
    }elseif(isset($_POST['endOrder'])){
            $bestillingslisteId = $_SESSION['bestillingslisteId'];
            $produktNavn = $_POST['produktNavn'];
            $antal = $_POST['antal'];
            $enhed = $_POST['enhed'];
            
            $sql = "INSERT INTO bestillinger (produkt_navn, antal, enhed, bestillingsliste_id) VALUES ('$produktNavn', '$antal', '$enhed', '$bestillingslisteId');";
            $result = mysqli_query($conn, $sql);
            
            unset($_SESSION['bestillingslisteId']);
            echo "Bestillingen er oprettet. Du vil blive sendt tilbage";
            header( "refresh:5;url=../index.php" );
    }


?>