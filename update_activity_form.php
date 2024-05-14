<?php
    // Ensure error reporting is set
ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_WARNING);
    
    // Include necessary files and classes
    require('classes/info.class.php');
    
    // Get user details
    $userdetails = $bmis->get_userdata();
    
    // Call view_service method
    $view = $infobmis->view_activity();
    
    // Call update_service method
    $infobmis->update_activity();
    
    // Call delete_service method
    $infobmis->delete_activity();
    
    // Get the ID of the service from the URL
    $id_activity = $_GET['id_activity'];
    
    // Get the details of the service with the provided ID
    $info = $infobmis->get_single_activity($id_activity);
?>

<?php 
    include('dashboard_sidebar_start.php');
?>

<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->

    <h1 class="mb-4 text-center">List of Activities</h1>

    <hr>
    <br>

    <div class="row">
        <div class="col-md-2"> </div>
        <div class="col-md-8">
            <div class="card"> 
                <div class="card-header bg-primary text-white"> Update Activity </div>
                <div class="card-body"> 
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col">
                                <label class="form-group">Title:</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter title" value="<?= $info['name'];?>">
                            </div>
                            <div class="col">
                                <label class="mtop">Date: </label>
                                            <input type="date" class="form-control" name="date" value="<?= $info['date'];?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                        </div>
                        
                        <div class="row" style="margin-top: 1.1em;">
                            <div class="col">
                                <div class="form-group">
                                    <label for="image" style="margin-bottom: 20px">Image:</label><br>
                                    <input type="file" name="image" id="image" value="<?= $info['image'];?>" accept="image/*">
                                </div>
                            </div>


                        </div>
                        <br>
                        <hr>
                        
                        <center><button class="btn btn-primary" type="submit" name="update_activity" style="width: 120px; font-size: 18px; border-radius:5px;"> 
                            Update 
                        </button>
                        <a href="activities.php" class="btn btn-danger" style="width: 120px; font-size: 18px; border-radius:5px;"> Back </a></center>
                    </form>         
                </div>
            </div>
        </div>
        <div class="col-md-2"> </div>
    </div>
    
    <br>
</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->

<!-- Footer -->
        <!-- Footer -->

        <footer id="footer" class="d-flex-column text-center">

            <!--Copyright-->

            <div class="py-3 text-center">
                2023 -
                <script>
                document.write(new Date().getFullYear())
                </script> 
                | Barangay Yuson Information Management System
            </div>

        </footer>

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Bootstrap Datepicker CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

        <!-- Bootstrap Datepicker JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>



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


</body>



</html>
