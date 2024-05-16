<?php
// require the database connection
require 'classes/conn.php';

function debug_base64_encode($data) {
    $encoded = base64_encode($data);
    if (!$encoded) {
        return 'No valid image data';
    }
    return $encoded;
}
	if(isset($_POST['search_bspermit'])){
		$keyword = $_POST['keyword'];
?>
	<table class="table table-hover text-center table-bordered table-responsive" >
		<thead class="alert-info">
            
			<tr>
                <th> Actions</th>
                <th> Resident ID </th>
                <th> Surname </th>
                <th> First Name </th>
                <th> Middle Name </th>
                <th> House No. </th>
                <th> Street </th>
                <th> Barangay </th>
                <th> Municipality </th>
                <th> Blotter Image </th>
                <th> Contact # </th>
                <th> Narrative Report </th>
                <th> Date & Time Applied</th> 
			</tr>
		</thead>
		<tbody>
		
                    
        <?php
            $stmnt = $conn->prepare("SELECT * FROM `tbl_bspermit` WHERE `lname` LIKE :keyword OR `mi` LIKE :keyword OR `fname` LIKE :keyword OR `bsname` LIKE :keyword OR `id_resident` LIKE :keyword OR `houseno` LIKE :keyword OR `street` LIKE :keyword OR `brgy` LIKE :keyword OR `municipal` LIKE :keyword OR `bsindustry` LIKE :keyword OR `aoe` LIKE :keyword");
            $search_term = '%' . $keyword . '%';
            $stmnt->bindParam(':keyword', $search_term);
            $stmnt->execute();

            while ($view = $stmnt->fetch(PDO::FETCH_ASSOC)) {
                $blot_photo_data = $view['blot_photo'];
                $encoded_image = debug_base64_encode($blot_photo_data);

                // Debugging statements
                echo 'Image Data Length: ' . strlen($blot_photo_data) . '<br>';
                echo 'Raw Data: ' . substr(bin2hex($blot_photo_data), 0, 50) . '...<br>';
                ?>
			<tr>
            <td>    
                <form action="" method="post">
                    <a class="btn btn-success" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="update_blotter_form.php?id_blotter=<?= $view['id_blotter'];?>">Update</a> 
                    <input type="hidden" name="id_blotter" value="<?= $view['id_blotter'];?>">
                    <button class="btn btn-danger" style="width: 90px; font-size: 17px; border-radius:30px;" type="submit" name="delete_blotter"> Archive </button>
                </form>
                </td>
                <td> <?= $view['id_resident'];?> </td> 
                <td> <?= $view['lname'];?> </td>
                <td> <?= $view['fname'];?> </td>
                <td> <?= $view['mi'];?> </td>
                <td> <?= $view['houseno'];?> </td>
                <td> <?= $view['street'];?> </td>
                <td> <?= $view['brgy'];?> </td>
                <td> <?= $view['municipal'];?> </td>
                <td>
                        <?php
                        if (!empty($blot_photo_data)) {
                            if ($encoded_image != 'No valid image data') {
                                echo '<img src="data:image/jpeg;base64,' . $encoded_image . '" alt="Blotter Photo" style="width: 100px; height:100px;">';
                            } else {
                                echo 'No image available';
                            }
                        } else {
                            echo 'No image available';
                        }
                        ?>
                    </td>

                <td> <?= $view['contact'];?> </td>
                <td> <?= $view['narrative'];?> </td>
                <td> <?= $view['timeapplied'];?> </td>
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
                <th> Surname </th>
                <th> First Name </th>
                <th> Middle Name </th>
                <th> House No. </th>
                <th> Street </th>
                <th> Barangay </th>
                <th> Municipality </th>
                <th> Blotter Image </th>
                <th> Contact # </th>
                <th> Narrative Report </th>
                <th> Date & Time Applied</th> 
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($view)) {?>
                    <?php foreach($view as $view) {?>
			<tr>
            <td>    
                        <form action="" method="post">
                        <a class="btn btn-success" style="width: 90px; font-size: 17px; border-radius:30px; margin-bottom: 2px;" href="update_blotter_form.php?id_blotter=<?= $view['id_blotter'];?>">Update</a> 
                            <input type="hidden" name="id_blotter" value="<?= $view['id_blotter'];?>">
                            <button class="btn btn-danger" style="width: 90px; font-size: 17px; border-radius:30px;" type="submit" name="delete_blotter"> Archive </button>
                        </form>
                        </td>

                        <td> <?= $view['id_resident'];?> </td> 
                        <td> <?= $view['lname'];?> </td>
                        <td> <?= $view['fname'];?> </td>
                        <td> <?= $view['mi'];?> </td>
                        <td> <?= $view['houseno'];?> </td>
                        <td> <?= $view['street'];?> </td>
                        <td> <?= $view['brgy'];?> </td>
                        <td> <?= $view['municipal'];?> </td>
                        <td>
                        <?php
                        if (!empty($view['blot_photo'])) {
                            $encoded_image = debug_base64_encode($view['blot_photo']);

                            // Debugging statements
                            echo 'Image Data Length: ' . strlen($view['blot_photo']) . '<br>';
                            echo 'Raw Data: ' . substr(bin2hex($view['blot_photo']), 0, 50) . '...<br>';

                            if ($encoded_image != 'No valid image data') {
                                echo '<img src="data:image/jpeg;base64,' . $encoded_image . '" alt="Blotter Photo" style="width: 100px; height:100px;">';
                            } else {
                                echo 'No image available';
                            }
                        } else {
                            echo 'No image available';
                        }
                        ?>
                        <a class="btn btn-success" href="admn_blotter_download.php?blot_photo=<?= urlencode($view['blot_photo']); ?>">Download</a>
                    </td>
                        <td> <?= $view['contact'];?> </td>
                        <td> <?= $view['narrative'];?> </td>
                        <td> <?= $view['timeapplied'];?> </td>
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