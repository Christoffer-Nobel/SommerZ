<?php
session_start();
include('../conn.php');
include('../functions.php');
connect();
include("../header.php");

$nyesteBestillingslisteId = getOrderid();
$nyesteBestillingsliste = getRecentOrder($nyesteBestillingslisteId);
?>



<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Produkt Navn</th>
            <th scope="col">Antal</th>
            <th scope="col">Enhed</th>
            <th scope="col">Pakkestatus</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <?php
foreach($nyesteBestillingsliste as $produkt){
    ?>
            <tr>
                <td><?php echo $produkt["produkt_navn"] ?></td>
                <td><?php echo $produkt["antal"] ?></td>
                <td><?php echo $produkt["enhed"] ?></td>
                <td><?php if($produkt["lagerstatus"] == 1){echo "Pakket";}else{echo "Afventer";} ?></td>
                <td>
                    <form method="post">
                        <button type="submit" name="edit" value="<?php echo $produkt['bestillings_id']; ?>"> Ændre pakkestatus</button>
                    </form>
                </td>
            </tr>
            <?php
}
if(isset($_POST['edit'])) {
    $produktId = $_POST['edit'];
    $orderStatus = getOrderStatus($produktId);
    if($orderStatus ==  1){ 
        $sql = 'UPDATE bestillinger SET lagerstatus = 0 WHERE bestillings_id =' . "$produktId" . ';';
        $result = mysqli_query($conn, $sql);
        unset($_POST['edit']);
        header('Refresh:0');
    }elseif($orderStatus == 0){
        $sql = 'UPDATE bestillinger SET lagerstatus = 1 WHERE bestillings_id =' . "$produktId" . ';';
        $result = mysqli_query($conn, $sql);
        unset($_POST['edit']);
        header('Refresh:0');
    }
}
?>
<a href="../index.php" class="btn btn-primary">Gå tilbage</a>
