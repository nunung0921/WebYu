<?php
    
    error_reporting(E_ALL ^ E_WARNING);
    ini_set('display_errors',0);
    require('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();
    $bmis->validate_admin();
    $bmis->delete_travelpermit();
    $view = $bmis->view_travelpermit();
    $id_resident = $_GET['id_resident'];
    $resident = $residentbmis->get_single_travelpermit($id_resident);
   
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
            <h1> Livestock Travel Permit Requests</h1>
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
                <button class="btn btn-success" name="search_travelpermit" style="width: 90px; font-size: 18px; border-radius:30px; margin-left:41.5%;">Search</button>
                <a href="admn_travelpermit.php" class="btn btn-info" style="width: 90px; font-size: 18px; border-radius:30px;">Reload</a>
            </form>
            <br>
        </div>
    </div>

    <br>
    <button class="btn btn-success" style="width: 100px; height: 40px; font-size: 14px; border-radius:5px; margin-bottom: 5px;" data-toggle="modal" data-target="#exampleModalCenter">
        <i class="fas fa-plus icon" style="padding-left: 0; padding-top: 0; padding-bottom: 0;"></i>Add
    </button>
    <br>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Livestock Travel Permit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- Modal Body -->

                        <div class="modal-body">
                            <form method="post" class="was-validated">

                                <div class="row"> 

                                    <div class="col" colspan="2">
                                        <div class="form-group">
                                            <label for="prev_owner">Previous Owner:</label>
                                            <input name="prev_owner" type="text" class="form-control" 
                                                   placeholder="Enter Full Name (Last Name, First Name)" 
                                                   value="<?= $userdetails['surname'] . ', ' . $userdetails['firstname'] ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="buyers_name">Buyer's Name:</label>
                                            <input name="buyers_name" type="text" class="form-control" 
                                            placeholder="Enter Buyer's Name" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="purpose">Purpose:</label>
                                            <select class="form-control" name="purpose" id="purpose" placeholder="Enter Purpose" required>
                                                <option value="">Choose your Purpose</option>
                                                <option value="Transportation">Transportaion</option>
                                                <option value="Sale">Sale</option>
                                                <option value="Exhibition/Show">Exhibition/Show</option>
                                                <option value="Medical Treatment">Medical Treatment</option>
                                                <option value="Breeding">Breeding</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label> House No: </label>
                                            <input type="text" class="form-control" name="houseno"  
                                            placeholder="Enter House No." value="<?= $userdetails['houseno']?>"  required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label> Street: </label>
                                            <input type="text" class="form-control" name="street"  
                                            placeholder="Enter Purok" value="<?= $userdetails['street']?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label> Barangay: </label>
                                            <input type="text" class="form-control" name="brgy"  value="Yuson"
                                            placeholder="Enter Barangay" value="<?= $userdetails['brgy']?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label> Municipality: </label>
                                            <input type="text" class="form-control" name="municipal" value="Guimba"
                                            placeholder="Enter Municipality" value="<?= $userdetails['municipal']?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="breed">Livestock Breed:</label>
                                            <select class="form-control" name="breed" id="breed" placeholder="Enter Breed" required>
                                                <option value="">Select Breed</option>
                                                <option value="Cattle">Cattle</option>
                                                <option value="Sheep">Sheep</option>
                                                <option value="Goat">Goat</option>
                                                <option value="Pig">Pig</option>
                                                <option value="Horse">Horse</option>
                                                <option value="Chicken">Chicken</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="Duck">Duck</option>
                                                <option value="Goose">Goose</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select class="form-control" name="gender" id="gender" placeholder="Enter Gender" required>
                                                <option value="">Choose your Status</option>
                                                <option value="Female">Female</option>
                                                <option value="Male">Male</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="color">Livestock Color:</label>
                <select class="form-control" name="color" id="color" required>
                    <option value="">Select Color</option>
                    <option value="Black">Black</option>
                    <option value="White">White</option>
                    <option value="Brown">Brown</option>
                    <option value="Gray">Gray</option>
                    <option value="Spotted">Spotted</option>
                    <option value="Red">Red</option>
                    <option value="Tan">Tan</option>
                    <option value="Cream">Cream</option>
                    <option value="Other">Other</option>
                </select>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please select a color.</div>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="destination">Destination:</label>
                <select class="form-control" name="destination" id="destination" required>
                    <option value="">Select Destination</option>
                    <option value="Farm">Farm</option>
                    <option value="Market">Market</option>
                    <option value="Abattoir/Slaughterhouse">Abattoir/Slaughterhouse</option>
                    <option value="Show/Exhibition">Show/Exhibition</option>
                    <option value="Other">Other</option>
                </select>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please select a destination.</div>
            </div>
        </div>
    </div>
</div>
   <!-- Modal Footer -->
            
   <div class="modal-footer" style="justify-content: flex-start; margin-left: 130px; width: 100%; border: none;">
                            <div class="paa">
                                <input name="id_resident" type="hidden" class="form-control" value="<?= $userdetails['id_resident']?>">
                                <button name ="create_bspermit" type="submit" class="btn btn-primary">Submit Request</button>
                                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        </form>
        </div>                               
            </div>
        </div>
    <div class="row"> 
        <div class="col"> 
            <?php 
                include('admn_table_travelpermit.php');
            ?>
        </div>
    </div>
    
</div>
<!-- End of Main Content -->


<?php 
    include('dashboard_sidebar_end.php');
?>