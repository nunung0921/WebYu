<?php
    
    error_reporting(E_ALL ^ E_WARNING);
    ini_set('display_errors',1);
    require('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    $bmis->create_brgyclearance_walkin();
    $bmis->delete_clearance();
    $bmis->archive_clearance();
    $view = $bmis->view_clearance();
    $id_resident = $_GET['id_resident'];
    $resident = $residentbmis->get_single_clearance($id_resident);
   
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
            <h1> Barangay Clearance Requests</h1>
        </div>
    </div>

    <hr>
    <br>
    <br>

    <div class="row"> 
        <div class="col">
            <form method="POST">
            <div class="input-icons" >
                <i class="fa fa-search icon"></i>
                <input type="search" class="form-control" style="border-radius: 30px;" name="keyword" value="" required=""/>
            </div>
                <button class="btn btn-success" name="search_clearance" style="width: 90px; font-size: 18px; border-radius:30px; margin-left:41.5%;">Search</button>
                <a href="admn_brgyclearance.php" class="btn btn-info" style="width: 90px; font-size: 18px; border-radius:30px;">Reload</a>
            
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
                            <h5 class="modal-title" id="exampleModalCenterTitle">Barangay Clearance Form</h5>
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
                                            <label for="lname">Last Name:</label>
                                            <input name="lname" style="text-align:left;" type="text" class="form-control" 
                                            placeholder="Enter Last Name" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="mi" class="mtop">Middle Name </label>
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
                                            <label for="fname">First Name:</label>
                                            <input name="fname" style="text-align:left;" type="text" class="form-control" 
                                            placeholder="Enter First Name" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <!--<div class="col">
                                        <div class="form-group">
                                            <label for="purposes">Purposes:</label>
                                            <select class="form-control" style="text-align:left;" name="purpose" id="purposes" placeholder="Enter Status" required>
                                                <option value="">Choose your Purpose</option>
                                                <option value="Local Employment">Local Employment</option>
                                                <option value="Loan">Loan</option>
                                                <option value="School/S.S.S Requirements">School/S.S.S Requirements</option>
                                                <option value="NBI/Police Clearance">NBI/Police Clearance</option>
                                                <option value="Postal ID Application">Postal ID</option>
                                                <option value="Bank Requirements">Bank Requirements</option>
                                                <option value="Water/Electric service Connection">Water/Electric service Connection</option>
                                                <option value="Legal Purpose">Legal Purpose</option>
                                                <option value="Others">Others</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>-->
                                </div>
                                    
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label> House No: </label>
                                            <input type="text" style="text-align:left;" class="form-control" name="houseno"  
                                            placeholder="Enter House No." value="<?= $userdetails['houseno']?>"  required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label> Street: </label>
                                            <input type="text" style="text-align:left;" class="form-control" name="street"  
                                            placeholder="Enter Purok" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                            <!--<label> Barangay: </label>-->
                                            <input type="hidden" class="form-control" name="brgy"  value="Biclatan"
                                            placeholder="Enter Barangay" required readonly>
                                            <!--<label> Municipality: </label>-->
                                            <input type="hidden" class="form-control" name="municipal" value="General Trias"
                                            placeholder="Enter Municipality" required readonly>
                                </div>
                                
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="status">Status:</label>
                                            <select class="form-control" style="text-align:left;" name="status" id="status" placeholder="Enter Status" value="<?= $userdetails['status']?>" required>
                                            <option value="">Choose your Status</option>
                                            <option value="Single">Single</option>
                                                <option value="In a relationship">In a relationship</option>
                                                <option value="Engaged">Engaged</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Divorces">Divorced</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="Age" class="mtop">Age: </label>
                                            <input type="number" style="text-align:left;" name="age" id="age" class="form-control" placeholder="Enter your Age" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field with a valid age.</div>

                                                <script>
                                                    // Get the input element
                                                    var ageInput = document.getElementById("age");

                                                    // Add an event listener for input changes
                                                    ageInput.addEventListener("input", function() {
                                                        // Get the entered value
                                                        var age = parseInt(ageInput.value);

                                                        // Check if the value is a number and within the valid range
                                                        if (isNaN(age) || age < 0 || age > 100) {
                                                            // If not valid, set the input as invalid
                                                            ageInput.setCustomValidity("Please enter a valid age between 0 and 150 years.");
                                                        } else {
                                                            // If valid, clear any previous validation message
                                                            ageInput.setCustomValidity("");
                                                        }
                                                    });
                                                </script>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>

                        <!-- Modal Footer -->
            
                        <div class="modal-footer" style="justify-content: flex-start;">
                            <div class="paa">
                                <input name="id_resident" type="hidden" class="form-control" value="<?= $userdetails['id_resident']?>">
                                <input name="addedby" type="hidden" class="form-control" value="<?= $userdetails['surname']?> <?= $userdetails['firstname']?> <?= $userdetails['mname']?>">
                                <button name ="create_brgyclearance_walkin" type="submit" class="btn btn-primary">Submit Request</button>
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                
                            </div>
                        </div> 
                    </div>
            </div>
        </div>
    <div class="row"> 
        <div class="col"> 
            <?php 
                include('admn_brgyclearance_search.php');
            ?>
        </div>
    </div>
    
   <?php 
    include('dashboard_sidebar_end.php');
?>