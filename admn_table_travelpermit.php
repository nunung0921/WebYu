<?php
    // require the database connection
    require 'classes/conn.php';
    if(isset($_POST['search_travelpermit'])){
        $keyword = $_POST['keyword'];
?><table class="table table-hover text-center table-bordered table-responsive" >

    <thead class="alert-info">
        <tr>
            <th> Actions</th>
            <th> Resident ID </th>
            <th> Previous Owner </th>
            <th> Buyer's Name </th>
            <th> Breed </th>
            <th> Gender </th>
            <th> Color </th>
            <th> Destination </th>
            <th> Barangay </th>
            <th> Municipality </th>
            <th> Purpose </th>
            <th> Date </th>
        </tr>
    </thead>

    <tbody>     
        <?php
            
            $stmnt = $conn->prepare("SELECT * FROM `tbl_travelpermit` WHERE `prev_owner` LIKE '%$keyword%' or  `id_resident` LIKE '%$keyword%' or  `buyers_name` LIKE '%$keyword%' or  `breed` LIKE '%$gender%' or `color` LIKE '%$keyword%' or `destination` LIKE '%$keyword%' or `brgy` LIKE '%$keyword%' or `municipal` LIKE '%$keyword%' or `purpose` LIKE '%$keyword%' or `date` LIKE '%$keyword%'");
            $stmnt->execute();
            
            while($view = $stmnt->fetch()){
        ?>
            <tr>
                <td>    
                    <form action="" method="post">
                        <a class="btn btn-success" target="blank" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="travelpermit_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a> 
                        <input type="hidden" name="id_travel" value="<?= $view['id_travel'];?>">
                        <button class="btn btn-danger" style="width: 90px; font-size: 17px; border-radius:30px;" type="submit" name="delete_travelpermit"> Archive </button>
                    </form>
                </td>
                <td> <?= $view['id_resident'];?> </td> 
                <td> <?= $view['prev_owner'];?> </td>
                <td> <?= $view['buyers_name'];?> </td>
                <td> <?= $view['breed'];?> </td>
                <td> <?= $view['gender'];?> </td>
                <td> <?= $view['color'];?> </td>
                <td> <?= $view['destination'];?> </td>
                <td> <?= $view['brgy'];?> </td>
                <td> <?= $view['municipal'];?> </td>
                <td> <?= $view['purpose'];?> </td>
                <td> <?= $view['date'];?> </td>
            </tr>
        <?php
        }
        ?>
        
    </tbody>
</table>

<?php       
    }else{
?>

<table class="table table-hover text-center table-bordered table-responsive">
    <thead class="alert-info">
        <tr>
            <th> Actions</th>
            <th> Resident ID </th>
            <th> Previous Owner </th>
            <th> Buyer's Name </th>
            <th> Breed </th>
            <th> Gender </th>
            <th> Color </th>
            <th> Destination </th>
            <th> Barangay </th>
            <th> Municipality </th>
            <th> Purpose </th>
            <th> Date </th>
        </tr>
    </thead>
    
    <tbody>
        <?php if(is_array($view)) {?>
            <?php foreach($view as $view) {?>
                <tr>
                    <td>    
                        <form action="" method="post">
                            <a class="btn btn-success" target="blank" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="travelpermit_form.php?id_resident=<?= $view['id_resident'];?>">Generate</a> 
                            <input type="hidden" name="id_travel" value="<?= $view['id_travel'];?>">
                            <button class="btn btn-danger" style="width: 90px; font-size: 17px; border-radius:30px;" type="submit" name="delete_travelpermit"> Archive </button>
                        </form>
                    </td>
                    <td> <?= $view['id_resident'];?> </td> 
                <td> <?= $view['prev_owner'];?> </td>
                <td> <?= $view['buyers_name'];?> </td>
                <td> <?= $view['breed'];?> </td>
                <td> <?= $view['gender'];?> </td>
                <td> <?= $view['color'];?> </td>
                <td> <?= $view['destination'];?> </td>
                <td> <?= $view['brgy'];?> </td>
                <td> <?= $view['municipal'];?> </td>
                <td> <?= $view['purpose'];?> </td>
                <td> <?= $view['date'];?> </td>
                </tr>
            
            <?php
                }
            ?>
        <?php
            }
        ?>
    </tbody>
    
</table>

<?php
    }
$con = null;
?>