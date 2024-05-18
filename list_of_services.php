<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_WARNING);
    require 'classes/services.class.php';
    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    $servicesbmis->create_service();
    $view = $servicesbmis->view_service();
    $servicesbmis->update_service();
    $servicesbmis->delete_service();
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
    <h1 class="mb-4 text-center">Barangay Services Data</h1>
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
                    <h5 class="modal-title" id="exampleModalCenterTitle">Add Barangay Service</h5>
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
                                    <label for="title">Title:</label>
                                    <input name="title" type="text" class="form-control" placeholder="Enter Barangay Service Name" required pattern="[A-Za-z0-9\s'-]+" minlength="2" maxlength="100" title="Please enter a valid title using letters, numbers, spaces, hyphens, and apostrophes only.">
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="requires">Requirements:</label>
                                    <input name="requires" type="text" class="form-control" placeholder="Enter Requirements" required pattern=".*" minlength="2" maxlength="200" title="Please enter valid requirements.">
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="fees">Fees:</label>
                                    <input name="fees" type="text" class="form-control" placeholder="Enter Fees" required pattern="^\d+(\.\d{1,2})?$" title="Please enter a valid amount with up to two decimal places.">
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="image_service">Choose Image:</label>
                                    <input type="file" class="form-control-file" id="image_service" name="image_service" accept="image/*" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <input name="description" type="text" class="form-control" placeholder="Enter description" required maxlength="255" title="Please enter a description (maximum 255 characters).">
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                            </div>
                        </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer" style="justify-content: flex-start;">
                    <div class="paa">
                        <input name="id_resident" type="hidden" class="form-control" value="<?= $userdetails['id_resident'] ?>">
                        <button name="add_service" type="submit" class="btn btn-primary">Add Service</button>
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
                    <th style="width: 20%;"> Requirements </th>
                    <th style="width: 10%;"> Fees </th>
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
                            <td> <?= $view['title']; ?> </td>
                            <td> <?= $view['requires']; ?> </td>
                            <td> <?= $view['fees']; ?> </td>
                            <td>
                                <img src="<?= $view['image_service']; ?>" alt="Service Image" style="width: 180px; height: 100px;">
                            </td>
                            <td>
                                <form action="" onsubmit="return confirmAction();" method="post">
                                    <a href="update_services_form.php?id_services=<?= $view['id_services']; ?>" class="btn btn-success" style="width: 100px; font-size: 15px; border-radius:5px; margin-bottom: 2px;"> Update </a>
                                    <input type="hidden" name="id_services" value="<?= $view['id_services']; ?>">
                                    <button class="btn btn-danger" type="submit" name="delete_services" style="width: 100px; font-size: 15px; border-radius:5px;"> Delete </button>
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
