<?php
    ini_set('display_errors', 0);
    error_reporting(E_ALL ^ E_WARNING);
    require 'classes/info.class.php';
    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    $infobmis->create_activity();
    $view = $infobmis->view_activity();
    $upservices = $infobmis->update_activity();
    $infobmis->delete_activity();
?>

<?php include 'dashboard_sidebar_start.php'; ?>
<!-- Begin Page Content -->
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

    .search {
        text-align: center;
    }

    .btn-danger {
        background-color: red;
    }
</style>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="mb-4 text-center">Barangay Activities</h1>
    <hr>
    <br>
    <div class="col-md-12">
    </div>
    <button class="btn btn-success" style="width: 100px; height: 40px; font-size: 14px; border-radius:5px; margin-bottom: 5px;" data-toggle="modal" data-target="#modalServices">
        <i class="fas fa-plus icon" style="padding-left: 0; padding-top: 0; padding-bottom: 0;"></i>Add
    </button>
    <br>
    <div class="modal fade" id="modalServices" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Barangay Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Title:</label>
                                    <input name="name" type="text" class="form-control" placeholder="Enter Barangay Service Name" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                            <label class="mtop">Date: </label>
                                            <input type="date" class="form-control" name="date" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="image">Choose Image:</label>
                                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                        </div>
                        <br>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <div class="paa">
                        <button name="add_activity" type="submit" class="btn btn-primary">Add Activity</button>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-hover text-center table-bordered table-responsive" id="dataTable" width="100%" cellspacing="0">
        <form action="" method="post">
            <thead class="alert-info">
                <tr>
                    <th style="width: 5%;"> No. </th>
                    <th style="width: 20%;"> Title </th>
                    <th style="width: 20%;"> Date </th>
                    <th style="width: 10%;"> Image </th>
                    <th style="width: 20%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1;
                    if (is_array($view)) : ?>
                    <?php foreach ($view as $view) : ?>
                        <tr>
                            <td> <?= $counter++; ?> </td>
                            <td> <?= $view['name']; ?> </td>
                            <td> <?= $view['date']; ?> </td>
                            <td>
                                <img src="<?= $view['image']; ?>" alt="Image" style="width: 180px; height: 100px;">
                            </td>
                            <td>
                                <form action="" onsubmit="return confirmAction();" method="post">
                                    <a href="update_activity_form.php" class="btn btn-success" style="width: 100px; font-size: 15px; border-radius:5px; margin-bottom: 2px;"> Update </a>
                                    <!--<input type="hidden" name="id_activity" value="<?= $view['id_activity']; ?>">-->
                                    <button class="btn btn-danger" type="submit" name="delete_activity" style="width: 100px; font-size: 15px; border-radius:5px;"> Delete </button>
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
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </form>
    </table>
</div>
</div>
<br><br>
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

<?php include 'dashboard_sidebar_end.php'; ?>
</body>
