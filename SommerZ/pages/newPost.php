<?php
session_start();
include('../conn.php');
include('../functions.php');
connect();
include("../header.php");


?>
<form method="post">
    <input class="form-control rounded-0" type="text" name="overskrift" placeholder="Overskrift" required></input>
    <textarea class="form-control rounded-0" name="tekst" placeholder="Skriv noget her..." required></textarea>
    <button type="submit" name="newPost">Offentliggør</button>
</form>
<br><br><br><br>
<a href="../index.php" class="btn btn-primary">Gå tilbage</a>

<?php
if(isset($_POST['newPost'])){
    $medarbejderId = $_SESSION['employee']['medarbejder_id'];
    $overskrift = $_POST['overskrift'];
    $tekst = $_POST['tekst'];
    
    $sql = "INSERT INTO opslag (medarbejder_id, overskrift, tekst) VALUES ('$medarbejderId', '$overskrift', '$tekst');";
    $result = mysqli_query($conn, $sql);
    
    echo "Dit opslag er offentliggjort. Du vil blive ført tilbage til opslagstavlen";
    header( "refresh:5;url=../index.php" );
}

?>