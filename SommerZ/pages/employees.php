<p>Her kan du se kontaktinformationer til medarbejder</p>
<?php
$employees = getEmployeeInfo();
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Fornavn</th>
            <th scope="col">Efternavn</th>
            <th scope="col">Email</th>
            <th scope="col">Telefon</th>
        </tr>
    </thead>
    <?php
    foreach($employees as $employee){
        ?>
            <tr>
                <th scope="row"><?php echo $employee["medarbejder_id"] ?></th>
                <td><?php echo $employee["fornavn"] ?></td>
                <td><?php echo $employee["efternavn"] ?></td>
                <td><?php echo $employee["email"] ?></td>
                <td><?php echo $employee["tlf"] ?></td>
            </tr>
        <?php
    }
    ?>