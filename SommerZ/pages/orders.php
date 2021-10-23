<a href="pages/newOrder.php">Opret en ny bestilling</a>
<br>
<a href="pages/changeOrderStatus.php">Rediger pakkestatus</a>

<?php
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
            </tr>
            <?php
    }
    ?>