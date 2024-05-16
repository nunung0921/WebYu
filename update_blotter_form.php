<?php
        ini_set('display_errors',1);
   error_reporting(E_ALL ^ E_WARNING);
   require('classes/resident.class.php');
   $userdetails = $bmis->get_userdata();
   $bmis->validate_admin();
   $id_blotter = $_GET['id_blotter'];
   $residentbmis->update_blotter();
   $view = $residentbmis->get_single_blotter($id_blotter);
   

?>

<?php 
    include('dashboard_sidebar_start.php');
?>

<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->
                
    <div class="row"> 
        <div class="col-md-2"> </div> 
        <div class="col-md-8"> 
            <div class="card">
                <div class="card-header bg-primary text-white"> Update Peace and Order Data</div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data"> 
                            <div class="row"> 
                                <div class="col">
                                    <div class="form-group">
                                        <label for="lname">Last Name:</label>
                                        <input name="lname" type="text" class="form-control" value="<?= $view['lname']?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="fname">First Name:</label>
                                        <input name="fname" type="text" class="form-control" value="<?= $view['fname']?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="mname">Middle Name:</label>
                                        <input name="mi" type="text" class="form-control" value="<?= $view['mi']?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">            
                                        <label for="contact">Contact Number:</label>
                                        <input name="contact" type="text" maxlength="11" pattern="[0-9]{11}" class="form-control" value="<?= $view ['contact']?>" >
                                    </div>
                                </div>
                            </div>            

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label> House No: </label>
                                        <input type="text" class="form-control" name="houseno"  
                                        placeholder="Enter House No." value="<?= $view['houseno']?>">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label> Street: </label>
                                        <input type="text" class="form-control" name="street"  
                                        placeholder="Enter Street" value="<?= $view['street']?>">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label> Barangay: </label>
                                        <input type="text" class="form-control" name="brgy"  
                                        placeholder="Enter Barangay" value="<?= $view['brgy']?>">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label> Municipality: </label>
                                        <input type="text" class="form-control" name="municipal" 
                                        placeholder="Enter Municipality" value="<?= $view['municipal']?>">
                                    </div>
                                </div>
                            </div>

                            <hr>


                            <hr>


                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="report">Narrative Report:</label>
                                        <?php
                                            $narrative = $view['narrative'];
                                            $maxLength = 100; // Maximum length of the text to display
                                            
                                            // Check if the text exceeds the maximum length
                                            if (strlen($narrative) > $maxLength) {
                                                // Truncate the text and add "..."
                                                $truncatedText = substr($narrative, 0, $maxLength) . '...';
                                                echo '<textarea class="form-control" rows="5" id="report" name="narrative">' . $truncatedText . '</textarea>';
                                            } else {
                                                // Display the full text
                                                echo '<textarea class="form-control" rows="5" id="report" name="narrative">' . $narrative . '</textarea>';
                                            }
                                            ?>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <input name="id_blotter" type="hidden" value="<?= $view['id_blotter']?>">
                                <a type="button" href="admn_blotterreport.php" class="btn btn-danger" 
                                style="width: 135px;
                                border-radius: 30px;
                                font-size: 18px;
                                color:white;" >Close</a>
                                <button type="submit" name="update_blotter" 
                                style="width: 135px;
                                border-radius: 30px;
                                font-size: 18px;" class="btn btn-success">Save changes</button>
                            </div>   
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"> </div>
    </div>
</div>

<!-- /.container-fluid -->

<!-- End of Main Content -->

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(470)
                    .height(350);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
        <!-- responsive tags for screen compatibility -->
        <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
        <!-- custom css --> 
        <link href="customcss/regiformstyle.css" rel="stylesheet" type="text/css">
        <!-- bootstrap css --> 
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"> 
        <!-- fontawesome icons -->
        <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
        <script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>


<?php 
    include('dashboard_sidebar_end.php');
?>