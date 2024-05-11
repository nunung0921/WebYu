    <?php
        ini_set('display_errors',0);
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
        
        $view = $residentbmis->view_request();
        $residentbmis->create_resident();
        $upreq = $residentbmis->approve_request();
        $upstaff = $residentbmis->update_resident();
        $residentbmis->delete_resident();
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

            <title>Barangay Yuson Information Management System</title>

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
                <h1 class="mb-1 text-center">Pending Requests to Join</h1>

                <hr>
                <br>

                <!-- Page Heading -->


                <div class="col-md-12">
                    <form method="POST" action="">
                        <div class="input-icons" >
                            <i class="fa fa-search icon"></i>
                            <input type="search" class="form-control search" name="keyword" style="border-radius: 30px;" value="" required=""/>
                        </div>
                            <center><button class="btn btn-success" name="search_resident" style="width: 70px; font-size: 14px; border-radius:5px;">Search</button>
                            <a href="admn_resident_crud.php" class="btn btn-info" style="width: 70px; font-size: 14px; border-radius:5px;">Reload</a></center>
                        
                    </form>
                    </div>
                    <br>
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
                        <th> PWD </th>
                        <th> Indigent </th>
                        <th> Single Parent </th>
                        <th> Malnourished </th>
                        <th> 4Ps </th>
                        <th> Vaccinated </th>
                        <th> Pregnant </th>

                    </tr>
                </thead>

                <tbody>
                    <?php if(is_array($view)) {?>
                                    <?php foreach($view as $view) {?>
                                        <tr>
                                            <td>
                                                <form method="POST" action="">
                                                    <button type="submit" name="approve_request" class="btn btn-primary">Approve</button>
                                                    <!-- Use a hidden input to pass the id_resident -->
                                                    <input type="hidden" name="id_resident" value="<?= $view['id_resident']; ?>">
                                                </form>
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
                                            <td> <?= $view['pwd'];?> </td>
                                            <td> <?= $view['indigent'];?> </td>  
                                            <td> <?= $view['single_parent'];?> </td>
                                            <td> <?= $view['malnourished'];?> </td>
                                            <td> <?= $view['four_ps'];?> </td>    
                                            <td> <?= $view['vaccinated'];?> </td>
                                            <td> <?= $view['pregnancy'];?> </td>  
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