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
        
        $view = $residentbmis->view_resident();
        $residentbmis->create_resident();
        $residentbmis->update_resident();
        $residentbmis->delete_resident();


    ?>

    <!DOCTYPE html>
    <html lang="en">

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


    .search{
            text-align: center;
        }

    .password-input {
        position: relative;
    }

    .password-input input {
        padding-right: 30px; /* Adjust the padding to accommodate the icon */
    }

    .password-input .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px; /* Adjust the position as needed */
        transform: translateY(-50%);
        cursor: pointer;
        z-index: 1;
    }
    </style>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1 class="mb-4 text-center">Barangay Residents Data</h1>

            <hr>

            <!-- Page Heading -->
                        

            <div class="col-md-12">
                <a href="resident_add.php" class="btn btn-success" style="width: 95px; height: 40px; font-size: 14px;"><i class="fas fa-plus icon" style="padding-left: 0; padding-top: 0; padding-bottom: 0;"></i>Add</a>
                <br />
                <br>
            <table class="table table-hover table-bordered text-center table-responsive">
            <thead class="alert-info">
                <tr>
                    <th> Actions</th>
                    <th> Email </th>
                    <th> Surname </th>
                    <th> First name </th>
                    <th> Middle name </th>
                    <th> Age </th>
                    <th> Sex </th>
                    <th> Status </th>
                    <th> Address</th>
                    <th> Contact # </th>
                    <th> Birth date </th>
                    <th> Birth place </th>
                    <th> Nationality </th>
                    <th> Registered Voter </th>

                </tr>
            </thead>

            <tbody>
                <?php if(is_array($view)) {?>
                                <?php foreach($view as $view) {?>
                                    <tr>
                                        <td>    
                                            <form action="" onsubmit="return confirmAction();" method="post">
                                                <a href="update_resident_form.php?id_resident=<?= $view['id_resident'];?>" style="width:70px; font-size: 14px; border-radius:5px; margin-bottom: 2px;" class="btn btn-success"> Update </a>
                                                <input type="hidden" name="id_resident" value="<?= $view['id_resident'];?>">
                                                <button class="btn btn-danger" type="submit" name="delete_resident"style="width: 70px; font-size: 14px; border-radius:5px;"> Archive </button>
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
                                        <td> <?= $view['status'];?> </td>
                                        <td> <?= $view['houseno'];?>, <?= $view['street'];?>, <?= $view['brgy'];?> </td>
                                        <td> <?= $view['contact'];?> </td>
                                        <td> <?= $view['bdate'];?> </td>
                                        <td> <?= $view['bplace'];?> </td>
                                        <td> <?= $view['nationality'];?> </td>
                                        <td> <?= $view['voter'];?> </td>
                                    </tr>
                                <?php }?>
                            <?php } ?>
                                        </tbody>
        </table>

        <div class="container">
            <h1 class="mb-4 text-center">Import Residents Data</h1>
            <hr>
            <form action="import_residents.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="file">Choose File (CSV, XLS, XLSX)</label>
                    <input type="file" name="file" class="form-control-file" id="file" accept=".csv, .xls, .xlsx" required>
                </div>
                <button type="submit" name="import" class="btn btn-primary">Import</button>
            </form>
        </div>
                                                

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
    <!-- Scripts and styles -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"> 
    <script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"></script>

    <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>


            <script>
            $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
            input.attr("type", "text");
            } else {
            input.attr("type", "password");
            }
            });

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
        </script>

    <?php 
        include('dashboard_sidebar_end.php');
    ?>