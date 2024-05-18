<?php
        ini_set('display_errors',1);
        error_reporting(E_ALL ^ E_WARNING);
        include('classes/staff.class.php');
        include('classes/resident.class.php');

        $userdetails = $bmis->get_userdata();
        $bmis->validate_admin();
        $rescount = $residentbmis->count_resident();
        $rescountm = $residentbmis->count_male_resident();
        $rescountf = $residentbmis->count_female_resident();
        $rescountfh = $residentbmis->count_head_resident();
        $rescountfm = $residentbmis->count_member_resident();
        $rescountvoter = $residentbmis->count_voters();
        $rescountsenior = $residentbmis->count_resident_senior();

        $staffcount = $staffbmis->count_staff();
        $staffcountm = $staffbmis->count_mstaff();
        $staffcountf = $staffbmis->count_fstaff();
        
        $view = $residentbmis->view_archive();

        $view_bspermit = $bmis->view_bspermit_archive();
        $bmis->archive_bspermit();
        $bmis->approve_bspermit();
        $bmis->delete_bspermit();

        $view_rescert = $bmis->view_rescert_archive();
        $bmis->archive_rescert();
        $bmis->approve_rescert();
        $bmis->delete_certofres();

        $view_clearance = $bmis->view_clearance_archive();
        $bmis->archive_clearance();
        $bmis->approve_clearance();
        $bmis->delete_clearance();

        $view_indigency = $bmis->view_certofindigency_archive();
        $bmis->archive_indigency();
        $bmis->approve_indigency();
        $bmis->delete_certofindigency();

        $view_blotter = $bmis->view_blotter_archive();
        $bmis->archive_blotter();
        $bmis->approve_blotter();
        $bmis->delete_blotter();

        $residentbmis->create_resident();
        $upreq = $residentbmis->approve_request();
        $upstaff = $residentbmis->update_resident();
        $residentbmis->reject_request();
        $id_resident = $_GET['id_resident'];
    ?>

<!DOCTYPE html>
<html lang="en">
<!-- Remaining HTML code goes here -->

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Barangay Yuson Information Management qSystem</title>

            <!-- Custom fonts for this template-->
            <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
            <link
                href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
                rel="stylesheet">
            
            <!-- Custom styles for this template-->
            <link href="css/sb-admin-2.min.css" rel="stylesheet">
            <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
        </head>

        <body id="page-top">

            <!-- Page Wrapper -->
            <?php
                include('dashboard_sidebar_start.php');
                ?>
                <!-- End of Sidebar -->
        <style>
            .input-icons i {
                position: absolute;
            }
                
            .input-icons {
                width: 30%;
                margin-bottom: 20px;
                margin-left: 34%;
            }
                
            .icon {
                padding: 10px;
                min-width: 40px;
            }

            .search{
                text-align: center;
            }
        </style>

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <h1 class="mb-1 text-center">Archive Residents</h1>

                <hr>
                <br>

                <!-- Page Heading -->


                <div class="col-md-12">
                    <!--<form method="POST" action="">
                        <div class="input-icons" >
                            <i class="fa fa-search icon"></i>
                            <input type="search" class="form-control search" name="keyword" style="border-radius: 30px;" value="" required=""/>
                        </div>
                            <center><button class="btn btn-success" name="search_resident" style="width: 70px; font-size: 14px; border-radius:5px;">Search</button>
                            <a href="admn_resident_crud.php" class="btn btn-info" style="width: 70px; font-size: 14px; border-radius:5px;">Reload</a></center>
                        
                    </form>-->
                    </div>
                <table class="table table-hover table-bordered text-center table-responsive">
                <thead class="alert-info">
                    <tr>
                        <th> Action </th>
                        <th> Email </th>
                        <th> Surname </th>
                        <th> First name </th>
                        <th> Middle name </th>
                        <th> Age </th>
                        <th> Sex </th>
                        <th> Address</th>
                        <th> Contact # </th>
                        <th> Birth date </th>
                        <th> Birth place </th>
                        <th> Nationality </th>
                        <th> Family Head </th>
                        <th> Registered Voter </th>

                    </tr>
                </thead>

                <tbody>
                    <?php if(is_array($view)) {?>
                                    <?php foreach($view as $view) {?>
                                        <tr>
                                            <td>
                                                <form method="POST" action="" onsubmit="return confirmAction();">
                                                    <input type="hidden" name="id_resident" value="<?= $view['id_resident']; ?>">
                                                    <button type="submit" name="approve_request" class="btn btn-success" style="margin-bottom: 10px;">Restore</button>
                                                    <button type="submit" name="reject_request" class="btn btn-danger" style="width: 85px;">Delete</button>
                                                    <!-- Use a hidden input to pass the id_resident -->
                                                    
                                                </form>
                                                <script>
                                                    function confirmAction() {
                                                        // Display a confirmation dialog
                                                        var confirmation = confirm("Are you sure you want to proceed?");

                                                        // If the user confirms, return true to submit the form
                                                        if (confirmation) {
                                                            return true;
                                                        } else {
                                                            // If the user cancels, return false to prevent form submission
                                                            return false;
                                                        }
                                                    }
                                                </script>
                                            </td>
                                            <td> <?= $view['email'];?> </td>
                                            <td> <?= $view['lname'];?> </td>
                                            <td> <?= $view['fname'];?> </td>
                                            <td> <?= $view['mi'];?> </td>
                                            <td> <?= $view['age'];?> </td>
                                            <td> <?= $view['sex'];?> </td>
                                            <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?> </td>
                                            <td> <?= $view['contact'];?> </td>
                                            <td> <?= $view['bdate'];?> </td>
                                            <td> <?= $view['bplace'];?> </td>
                                            <td> <?= $view['nationality'];?> </td>
                                            <td> <?= $view['family_role'];?> </td>
                                            <td> <?= $view['voter'];?> </td>
                                        </tr>
                                    <?php }?>
                                <?php } ?>
                                            </tbody>
            </table>

            <hr>

            <h1 class="mb-1 text-center">Archive Certifates of Residency</h1>

                <hr>
                <br>

                <!-- Page Heading -->

                <table class="table table-hover table-bordered text-center table-responsive">
                <thead class="alert-info">
                    <tr>
                        <th> Action </th>
                        <th> Resident ID </th>
                        <th> Surname </th>
                        <th> First name </th>
                        <th> Middle name </th>
                        <th> Age </th>
                        <th> Nationality </th>
                        <th> House No. </th>
                        <th> Street</th>
                        <th> Barangay </th>
                        <th> Municipality </th>

                    </tr>
                </thead>

                <tbody>
                    <?php if(is_array($view_rescert)) {?>
                                    <?php foreach($view_rescert as $view) {?>
                                        <tr>
                                            <td>
                                                <form method="POST" action="" onsubmit="return confirmAction();">
                                                    <input type="hidden" name="id_rescert" value="<?= $view['id_rescert']; ?>">
                                                    <button type="submit" name="approve_rescert" class="btn btn-success" style="margin-bottom: 10px;">Restore</button>
                                                    <button type="submit" name="delete_certofres" class="btn btn-danger" style="width: 85px;">Delete</button>
                                                    <!-- Use a hidden input to pass the id_resident -->
                                                    
                                                </form>
                                                <script>
                                                    function confirmAction() {
                                                        // Display a confirmation dialog
                                                        var confirmation = confirm("Are you sure you want to proceed?");

                                                        // If the user confirms, return true to submit the form
                                                        if (confirmation) {
                                                            return true;
                                                        } else {
                                                            // If the user cancels, return false to prevent form submission
                                                            return false;
                                                        }
                                                    }
                                                </script>
                                            </td>
                                            <td> <?= $view['id_rescert'];?> </td>
                                            <td> <?= $view['lname'];?> </td>
                                            <td> <?= $view['fname'];?> </td>
                                            <td> <?= $view['mi'];?> </td>
                                            <td> <?= $view['age'];?> </td>
                                            <td> <?= $view['nationality'];?> </td>
                                            <td> <?= $view['houseno'];?>
                                            <td> <?= $view['street'];?> </td>
                                            <td> <?= $view['brgy'];?> </td>
                                            <td> <?= $view['municipal'];?> </td>
                                        </tr>
                                    <?php }?>
                                <?php } ?>
                                            </tbody>
            </table>

            <hr>

            <h1 class="mb-1 text-center">Archive Business Permit</h1>

                <hr>
                <br>

                <!-- Page Heading -->

                <table class="table table-hover table-bordered text-center table-responsive">
                <thead class="alert-info">
                    <tr>
                        <th> Action </th>
                        <th> Resident ID </th>
                        <th> Surname </th>
                        <th> First name </th>
                        <th> Middle name </th>
                        <th> Business Name </th>
                        <th> House No. </th>
                        <th> Street</th>
                        <th> Barangay </th>
                        <th> Municipality </th>
                        <th> Business Industry </th>
                        <th> Area of Establishment </th>

                    </tr>
                </thead>

                <tbody>
                    <?php if(is_array($view_bspermit)) {?>
                                    <?php foreach($view_bspermit as $view) {?>
                                        <tr>
                                            <td>
                                                <form method="POST" action="" onsubmit="return confirmAction();">
                                                    <input type="hidden" name="id_bspermit" value="<?= $view['id_bspermit']; ?>">
                                                    <button type="submit" name="approve_bspermit" class="btn btn-success" style="margin-bottom: 10px;">Restore</button>
                                                    <button type="submit" name="delete_bspermit" class="btn btn-danger" style="width: 85px;">Delete</button>
                                                    <!-- Use a hidden input to pass the id_resident -->
                                                    
                                                </form>
                                                <script>
                                                    function confirmAction() {
                                                        // Display a confirmation dialog
                                                        var confirmation = confirm("Are you sure you want to proceed?");

                                                        // If the user confirms, return true to submit the form
                                                        if (confirmation) {
                                                            return true;
                                                        } else {
                                                            // If the user cancels, return false to prevent form submission
                                                            return false;
                                                        }
                                                    }
                                                </script>
                                            </td>
                                            <td> <?= $view['id_bspermit'];?> </td>
                                            <td> <?= $view['lname'];?> </td>
                                            <td> <?= $view['fname'];?> </td>
                                            <td> <?= $view['mi'];?> </td>
                                            <td> <?= $view['bsname'];?> </td>
                                            <td> <?= $view['houseno'];?>
                                            <td> <?= $view['street'];?> </td>
                                            <td> <?= $view['brgy'];?> </td>
                                            <td> <?= $view['municipal'];?> </td>
                                            <td> <?= $view['bsindustry'];?> </td>
                                            <td> <?= $view['aoe'];?> </td>
                                        </tr>
                                    <?php }?>
                                <?php } ?>
                                            </tbody>
            </table>

            <hr>

            <h1 class="mb-1 text-center">Archive Barangay Clearance</h1>

                <hr>
                <br>

                <!-- Page Heading -->

                <table class="table table-hover table-bordered text-center table-responsive">
                <thead class="alert-info">
                    <tr>
                        <th> Action </th>
                        <th> Resident ID </th>
                        <th> Surname </th>
                        <th> First name </th>
                        <th> Middle name </th>
                        <th> Purpose </th>
                        <th> Business Name </th>
                        <th> House No. </th>
                        <th> Street</th>
                        <th> Barangay </th>
                        <th> Municipality </th>
                        <th> Status </th>
                        <th> Age </th>

                    </tr>
                </thead>

                <tbody>
                    <?php if(is_array($view_clearance)) {?>
                                    <?php foreach($view_clearance as $view) {?>
                                        <tr>
                                            <td>
                                                <form method="POST" action="" onsubmit="return confirmAction();">
                                                    <input type="hidden" name="id_clearance" value="<?= $view['id_clearance']; ?>">
                                                    <button type="submit" name="approve_clearance" class="btn btn-success" style="margin-bottom: 10px;">Restore</button>
                                                    <button type="submit" name="delete_clearance" class="btn btn-danger" style="width: 85px;">Delete</button>
                                                    <!-- Use a hidden input to pass the id_resident -->
                                                    
                                                </form>
                                                <script>
                                                    function confirmAction() {
                                                        // Display a confirmation dialog
                                                        var confirmation = confirm("Are you sure you want to proceed?");

                                                        // If the user confirms, return true to submit the form
                                                        if (confirmation) {
                                                            return true;
                                                        } else {
                                                            // If the user cancels, return false to prevent form submission
                                                            return false;
                                                        }
                                                    }
                                                </script>
                                            </td>
                                            <td> <?= $view['id_rescert'];?> </td>
                                            <td> <?= $view['lname'];?> </td>
                                            <td> <?= $view['fname'];?> </td>
                                            <td> <?= $view['mi'];?> </td>
                                            <td> <?= $view['purpose'];?> </td>
                                            <td> <?= $view['houseno'];?>
                                            <td> <?= $view['street'];?> </td>
                                            <td> <?= $view['brgy'];?> </td>
                                            <td> <?= $view['municipal'];?> </td>
                                            <td> <?= $view['status'];?> </td>
                                            <td> <?= $view['age'];?> </td>
                                        </tr>
                                    <?php }?>
                                <?php } ?>
                                            </tbody>
            </table>

            <hr>

            <h1 class="mb-1 text-center">Archive Certificate of Indigency</h1>

                <hr>
                <br>

                <!-- Page Heading -->

                <table class="table table-hover table-bordered text-center table-responsive">
                <thead class="alert-info">
                    <tr>
                        <th> Action </th>
                        <th> Resident ID </th>
                        <th> Surname </th>
                        <th> First name </th>
                        <th> Middle name </th>
                        
                        <th> House No. </th>
                        <th> Street</th>
                        <th> Barangay </th>
                        <th> Municipality </th>
                        <th> Purpose </th>
                        <th> Date </th>

                    </tr>
                </thead>

                <tbody>
                    <?php if(is_array($view_indigency)) {?>
                                    <?php foreach($view_indigency as $view) {?>
                                        <tr>
                                            <td>
                                                <form method="POST" action="" onsubmit="return confirmAction();">
                                                    <input type="hidden" name="id_indigency" value="<?= $view['id_indigency']; ?>">
                                                    <button type="submit" name="approve_indigency" class="btn btn-success" style="margin-bottom: 10px;">Restore</button>
                                                    <button type="submit" name="delete_certofindigency" class="btn btn-danger" style="width: 85px;">Delete</button>
                                                    <!-- Use a hidden input to pass the id_resident -->
                                                    
                                                </form>
                                                <script>
                                                    function confirmAction() {
                                                        // Display a confirmation dialog
                                                        var confirmation = confirm("Are you sure you want to proceed?");

                                                        // If the user confirms, return true to submit the form
                                                        if (confirmation) {
                                                            return true;
                                                        } else {
                                                            // If the user cancels, return false to prevent form submission
                                                            return false;
                                                        }
                                                    }
                                                </script>
                                            </td>
                                            <td> <?= $view['id_indigency'];?> </td>
                                            <td> <?= $view['lname'];?> </td>
                                            <td> <?= $view['fname'];?> </td>
                                            <td> <?= $view['mi'];?> </td>
                                            
                                            <td> <?= $view['houseno'];?>
                                            <td> <?= $view['street'];?> </td>
                                            <td> <?= $view['brgy'];?> </td>
                                            <td> <?= $view['municipal'];?> </td>
                                            <td> <?= $view['purpose'];?> </td>
                                            <td> <?= $view['date'];?> </td>
                                        </tr>
                                    <?php }?>
                                <?php } ?>
                                            </tbody>
            </table>

            <hr>

            <h1 class="mb-1 text-center">Archive Blotter Reports</h1>

                <hr>
                <br>

                <!-- Page Heading -->

                <table class="table table-hover table-bordered text-center table-responsive">
                <thead class="alert-info">
                    <tr>
                        <th> Action </th>
                        <th> Surname </th>
                        <th> First name </th>
                        <th> Middle name </th>
                        <th> House No. </th>
                        <th> Street</th>
                        <th> Barangay </th>
                        <th> Municipality </th>
                        <th> Blotter Image </th>
                        <th> Contact </th>
                        <th> Narrative Report </th>
                        <th> Date & Time applied </th>

                    </tr>
                </thead>

                <tbody>
                    <?php if(is_array($view_blotter)) {?>
                                    <?php foreach($view_vlotter as $view) {?>
                                        <tr>
                                            <td>
                                                <form method="POST" action="" onsubmit="return confirmAction();">
                                                    <input type="hidden" name="id_blotter" value="<?= $view['id_blotter']; ?>">
                                                    <button type="submit" name="approve_blotter" class="btn btn-success" style="margin-bottom: 10px;">Restore</button>
                                                    <button type="submit" name="delete_blotter" class="btn btn-danger" style="width: 85px;">Delete</button>
                                                    <!-- Use a hidden input to pass the id_resident -->
                                                    
                                                </form>
                                                <script>
                                                    function confirmAction() {
                                                        // Display a confirmation dialog
                                                        var confirmation = confirm("Are you sure you want to proceed?");

                                                        // If the user confirms, return true to submit the form
                                                        if (confirmation) {
                                                            return true;
                                                        } else {
                                                            // If the user cancels, return false to prevent form submission
                                                            return false;
                                                        }
                                                    }
                                                </script>
                                            </td>
                                            <td> <?= $view['lname'];?> </td>
                                            <td> <?= $view['fname'];?> </td>
                                            <td> <?= $view['mi'];?> </td>
                                            <td> <?= $view['houseno'];?>
                                            <td> <?= $view['street'];?> </td>
                                            <td> <?= $view['brgy'];?> </td>
                                            <td> <?= $view['municipal'];?> </td>
                                            <td> <?= $view['blot_photo'];?> </td>
                                            <td> <?= $view['contact'];?> </td>
                                            <td> <?= $view['narrative'];?> </td>
                                            <td> <?= $view['timeapplied'];?> </td>
                                        </tr>
                                    <?php }?>
                                <?php } ?>
                                            </tbody>
            </table>
            </div>


            
            <!-- /.container-fluid -->
            
        </div>
        <!-- End of Main Content -->

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


        <script>
            function calculateAge() {
                var birthdate = document.getElementById('birthdate').value;
                var today = new Date();
                var birthdateObj = new Date(birthdate);
                var age = today.getFullYear() - birthdateObj.getFullYear();

                // Check if the birthday has occurred this year
                if (today.getMonth() < birthdateObj.getMonth() || (today.getMonth() === birthdateObj.getMonth() && today.getDate() < birthdateObj.getDate())) {
                    age--;
                }

                // Update the "Age" input field
                document.getElementById('age').value = age;
            }
        <script>
            function updateNationality(value) {
                document.getElementById("customNationality").value = value;
            }
        </script>
        </script>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
            <!-- responsive tags for screen compatibility -->
            <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
            <!-- bootstrap css --> 
            <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"> 
            <!-- fontawesome icons -->
            <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
            <script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>

        <?php 
            include('dashboard_sidebar_end.php');
        ?>