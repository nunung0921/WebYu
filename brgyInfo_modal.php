<?php
    ini_set('display_errors',0);
    error_reporting(E_ALL ^ E_WARNING);
    require('classes/info.class.php');
    $userdetails = $bmis->get_userdata();
    //$bmis->validate_admin();
    $view = $infobmis->view_brgy_info();
    $infobmis->create_brgy_info();
    $upinfo = $infobmis->update_brgy_info();
    $infobmis->delete_brgy_info();
    $id_brgy_info = $_GET['id_brgy_info'];
    $info = $infobmis->get_brgy_info($id_brgy_info);
?>

<?php 
    include('dashboard_sidebar_start.php');
?>
<!-- Include Dropify CSS -->
<link href="path/to/dropify.min.css" rel="stylesheet">

<!-- Include jQuery (required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Dropify JavaScript -->
<script src="path/to/dropify.min.js"></script>

<!-- Initialize Dropify -->
<script>
    $(document).ready(function() {
        // Initialize Dropify
        $('.dropify').dropify();
    });
</script>


<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- Page Heading -->

    <h1 class="mb-4 text-center">Barangay Information</h1>

    <hr>
    <br>

    <div class="row">
        <div class="col-md-2"> </div>
        <div class="col-md-8">
            <div class="card"> 
                <div class="card-header bg-primary text-white"> Update Barangay Information </div>
                <div class="card-body"> 
                    <form method="post">
                        <div class="row">
                            <div class="col">
                                <label class="form-group"> <b>Barangay:</b> </label>
                                <input type="text" class="form-control" name="brgy" placeholder="Enter Barangay" value="<?= $info['brgy'];?>">
                            </div>
                            <div class="col">
                                <label class="form-group"><b>Town Name:</b> </label>
                                <input type="text" class="form-control" name="municipal" placeholder="Enter Town" value="<?= $info['municipal'];?>">
                            </div>
                            <div class="col">
                                <label class="form-group"><b>Province Name:</b></label>
                                <input type="text" class="form-control" name="province" placeholder="Enter Province Name" value="<?= $info['province'];?>">
                            </div>
                        </div>
                        
                        <div class="row" style="margin-top: 1.1em;">
                            <div class="col">
                                <label class="form-group"><b>Contact Number:</b></label>
                                <input type="tel" class="form-control" name="contact" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Enter Contact Number" value="<?= $info['contact'];?>">
                            </div>
                            <div class="col">
                                <label class="form-group"><b>Email Address:</b></label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email Address" value="<?= $info['email'];?>">
                            </div>
                        </div>

                        <div class="row" style="margin-top: 1.1em;">
                            <div class="col">
                                <div class="form-group">
                                    <label><b>Open Hours:</b></label>
                                    <textarea class="form-control" type="text" name="openhours" placeholder="Enter Open Hours" ><?= $info['openhours'];?></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: .5em;">
                            <div class="col">
                                <div class="form-group">
                                    <label><b>Barangay Background: </b></label>
                                    <textarea type="form-control" class="form-control" name="background" placeholder="Enter Barangay Background"><?= $info['background'];?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: .5em;">
                            <div class="col">
                                <div class="form-group">
                                    <label><b>Barangay Vision</b> </label>
                                    <textarea type="form-control" class="form-control" name="vision" placeholder="Enter Vision"><?= $info['vision'];?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top: .5em;">
                            <div class="col">
                                <div class="form-group">
                                    <label><b>Barangay Mission</b> </label>
                                    <textarea type="form-control" class="form-control" name="mission" placeholder="Enter Mission"><?= $info['mission'];?></textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <input type="hidden" name="id_brgy_info" value="1">
                        <center><button class="btn btn-primary" type="submit" name="update_brgy_info" style="width: 120px; font-size: 18px; border-radius:30px;"> 
                            Update 
                        </button></center>
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

        <footer id="footer" style="background-color: #007bff; color: white;" class="d-flex-column text-center">

            <!--Copyright-->

            <div class="py-3 text-center">
                2023 -
                <script>
                document.write(new Date().getFullYear())
                </script> 
                | Barangay Biclatan Information System
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
