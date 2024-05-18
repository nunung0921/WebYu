<?php
    
    error_reporting(E_ALL ^ E_WARNING);
    ini_set('display_errors',1);
    require('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    $bmis->create_certofindigency_walkin();
    $bmis->delete_certofindigency();
    $bmis->archive_indigency();
    $view = $bmis->view_certofindigency();
    $id_indigency = $_GET['id_indigency'];
    $resident = $residentbmis->get_single_certofindigency($id_indigency);
   
?>

<?php 
    include('dashboard_sidebar_start.php');
?>
<style>
    .input-icons i {
        position: absolute;
    }
        
    .input-icons {
        width: 30%;
        margin-bottom: 10px;
        margin-left: 34%;
    }
        
    .icon {
        padding: 10px;
        min-width: 40px;
    }
    .form-control{
        text-align: center;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="row"> 
        <div class="col text-center"> 
            <h1> Certificate of Indigency Requests</h1>
        </div>
    </div>

    <hr>
    <br><br>

    <div class="row"> 
        <div class="col">
            <form method="POST">
                <div class="input-icons" >
                    <i class="fa fa-search icon"></i>
                    <input type="search" class="form-control" name="keyword" style="border-radius: 30px;" value="" required=""/>
                </div>
                <button class="btn btn-success" name="search_certofindigency" style="width: 90px; font-size: 18px; border-radius:30px; margin-left:41.5%;">Search</button>
                <a href="admn_certofindigency.php" class="btn btn-info" style="width: 90px; font-size: 18px; border-radius:30px;">Reload</a>
            </form>
            <br>
        </div>
    </div>

    <br>
    <button class="btn btn-success" style="width: 95px; height: 40px; font-size: 14px; border-radius:5px; margin-bottom: 5px;" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus icon" style="padding-left: 0; padding-top: 0; padding-bottom: 0;"></i>Add</button>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Certificate of Indigency Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                        <!-- Modal Body -->

                        <div class="modal-body">
                            <form method="post">

                                <div class="row"> 

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="fname">First Name:</label>
                                            <input name="fname" style="text-align:left;" type="text" class="form-control" 
                                            placeholder="Enter First Name" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="mi" class="mtop">Middle Name: </label>
                                            <input name="mi" style="text-align:left;" type="text" class="form-control" 
                                            placeholder="Enter Middle Name">
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="lname">Last Name:</label>
                                            <input name="lname" style="text-align:left;" type="text" class="form-control" 
                                            placeholder="Enter Last Name"  required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                            <!--<label class="mtop">Nationality: </label>-->
                                            <input type="hidden" class="form-control" name="nationality"   
                                            placeholder="Enter Nationality" value="Filipino" required>

                                </div>

                                <div class="row">

                                <div class="col">
                                        <div class="form-group">
                                            <label> Purok: </label>
                                            <select class="form-control" name="street" placeholder="Enter Purok" required>
                                            <option value="">Select Purok</option>
                                                <option value="Purok 1">Purok 1</option>
                                                <option value="Purok 2">Purok 2</option>
                                                <option value="Purok 3">Purok 3</option>
                                                <option value="Purok 4">Purok 4</option>
                                                <option value="Purok 5">Purok 5</option>
                                                <option value="Purok 6">Purok 6</option>
                                                <option value="Purok 7">Purok 7</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="purposes">Purposes:</label>
                                            <select class="form-control" style="text-align:left;" name="purpose" id="purposes" required>
                                                <option value="">Choose your Purposes</option>
                                                <option value="Job/Employment">Job/Employment</option>
                                                <option value="Business Establishment">Business Requirement</option>
                                                <option value="Financial Transaction">Financial Transaction</option>
                                                <option value="Scholarship">Scholarship</option>
                                                <option value="Other important transactions.">Other important transactions.</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>  

                                            <!--<label> Barangay: </label>-->
                                            <input type="hidden" class="form-control" name="brgy"  
                                            value="Yuson" required readonly>

                                            <!--<label> Municipality: </label>-->
                                            <input type="hidden" class="form-control" name="municipal" 
                                            value="Guimba" required readonly>

                                </div>

                
                        </div>
                        <!-- Modal Footer -->
                        
                        <div class="modal-footer" style="justify-content: flex-start;">
                            <div class="paa">
                                <input name="id_resident" type="hidden" class="form-control" value="<?= $userdetails['id_resident']?>">
                                <button name="create_certofindigency_walkin" type="submit" class="btn btn-primary">Submit Request</button>
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
    <div class="row"> 
        <div class="col"> 
            <?php 
                include('admn_table_certofindigency_search.php');
            ?>
        </div>
    </div>
    </div>
</div>
<!-- End of Main Content -->


<?php 
    include('dashboard_sidebar_end.php');
?>