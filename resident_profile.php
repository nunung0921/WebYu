<?php 
    error_reporting(E_ALL ^ E_WARNING);
    require('classes/resident.class.php');
    ini_set('display_errors',0);
    $userdetails = $residentbmis->get_userdata();
    $id_resident = $_GET['id_resident'];
    $resident = $residentbmis->get_single_resident($id_resident);
    

    $residentbmis->profile_update();

?>

<!DOCTYPE html> 
<html>

    <head> 
    <title> Barangay Yuson Information Management System </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <!-- responsive tags for screen compatibility -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- custom css --> 
        <link href="customcss/pagestyle.css" rel="stylesheet" type="text/css">
        <!-- bootstrap css --> 
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
        <!-- fontawesome icons --> 
        <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>



    <style>

        /* Back-to-Top */

        .top-link {
        transition: all 0.25s ease-in-out;
        position: fixed;
        bottom: 0;
        right: 0;
        display: inline-flex;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        margin: 0 3em 3em 0;
        border-radius: 50%;
        padding: 0.25em;
        width: 80px;
        height: 80px;
        background-color: #3661D5;
        }
        .top-link.show {
        visibility: visible;
        opacity: 1;
        }
        .top-link.hide {
        visibility: hidden;
        opacity: 0;
        }
        .top-link svg {
        fill: white;
        width: 24px;
        height: 12px;
        }
        .top-link:hover {
        background-color: #3498DB;
        }
        .top-link:hover svg {
        fill: #000000;
        }

        .screen-reader-text {
        position: absolute;
        clip-path: inset(50%);
        margin: -1px;
        border: 0;
        padding: 0;
        width: 1px;
        height: 1px;
        overflow: hidden;
        word-wrap: normal !important;
        clip: rect(1px, 1px, 1px, 1px);
        }
        .screen-reader-text:focus {
        display: block;
        top: 5px;
        left: 5px;
        z-index: 100000;
        clip-path: none;
        background-color: #eee;
        padding: 15px 23px 14px;
        width: auto;
        height: auto;
        text-decoration: none;
        line-height: normal;
        color: #444;
        font-size: 1em;
        clip: auto !important;
        }

        /* Navbar Buttons */

        .btn3 {
        border-radius: 20px;
        border: none; /* Remove borders */
        color: white; /* White text */
        font-size: 16px; /* Set a font size */
        cursor: pointer; /* Mouse pointer on hover */
        margin-left: 15%;
        padding: 8px 22px;
        }

        .btn4 {
        border-radius: 20px;
        border: none; /* Remove borders */
        color: white; /* White text */
        font-size: 16px; /* Set a font size */
        cursor: pointer; /* Mouse pointer on hover */
        padding: 8px 22px;
        margin-left: .1%;
        }

        .btn5 {
        border-radius: 20px;
        border: none; /* Remove borders */
        color: white; /* White text */
        font-size: 16px; /* Set a font size */
        cursor: pointer; /* Mouse pointer on hover */
        margin-left: .1%;
        padding: 8px 22px;
        }

        .btn6 {
        border-radius: 20px;
        border: none; /* Remove borders */
        color: white; /* White text */
        font-size: 16px; /* Set a font size */
        cursor: pointer; /* Mouse pointer on hover */
        padding: 8px 22px;
        margin-left: .1%;
        }


        /* Darker background on mouse-over */

        .btn3:hover {
        background-color: RoyalBlue;
        color: black;
        }

        .btn4:hover {
        background-color: RoyalBlue;
        color: black;
        }

        .btn5:hover {
        background-color: RoyalBlue;
        color: black;
        }

        .btn6:hover {
        background-color: RoyalBlue;
        color: black;
        }

        .footerlinks{
        color:white;
        }
        .shfooter .collapse {
            display: inherit;
        }
            @media (max-width:767px) {
        .shfooter ul {
                margin-bottom: 0;
        }

        .shfooter .collapse {
                display: none;
        }

        .shfooter .collapse.show {
                display: block;
        }

        .shfooter .title .fa-angle-up,
        .shfooter .title[aria-expanded=true] .fa-angle-down {
                display: none;
        }

        .shfooter .title[aria-expanded=true] .fa-angle-up {
                display: block;
        }

        .shfooter .navbar-toggler {
                display: inline-block;
                padding: 0;
        }

        }

        .resize {
            text-align: center;
        }
        .resize {
            margin-top: 3rem;
            font-size: 1.25rem;
        }
        /*RESIZESCREEN ANIMATION*/
        .fa-angle-double-right {
            animation: rightanime 1s linear infinite;
        }

        .fa-angle-double-left {
            animation: leftanime 1s linear infinite;
        }
        @keyframes rightanime {
            50% {
                transform: translateX(10px);
                opacity: 0.5;
        }
            100% {
                transform: translateX(10px);
                opacity: 0;
        }
        }
        @keyframes leftanime {
            50% {
                transform: translateX(-10px);
                opacity: 0.5;
        }
            100% {
                transform: translateX(-10px);
                opacity: 0;
        }
        }

        /* Contact Chip */

        .chip {
        display: inline-block;
        padding: 0 25px;
        height: 50px;
        line-height: 50px;
        border-radius: 25px;
        background-color: #2C54C1;
        margin-top: 5px;
        }

        .chip img {
        float: left;
        margin: 0 10px 0 -25px;
        height: 50px;
        width: 50px;
        border-radius: 50%;
        }

        .zoom {
        transition: transform .3s;
        }

        .zoom:hover {
        -ms-transform: scale(1.4); /* IE 9 */
        -webkit-transform: scale(1.4); /* Safari 3-8 */
        transform: scale(1.4); 
        }
        /* Scroll to top button styles */
#scrollTopBtn {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 50px;
    z-index: 99;
    border: none;
    outline: none;
    background-color: rgba(17, 43, 90, 0.7);
    color: white;
    cursor: pointer;
    padding: 15px;
    border-radius: 100%;
    transition: background-color 0.3s ease;
    font-size: 30px; /* Adjust the size as needed */
}

#scrollTopBtn:hover {
    background-color: rgba(17, 43, 90, 0.9);
}

/* Responsive adjustments */
@media screen and (max-width: 768px) {
    #scrollTopBtn {
        bottom: 20px;
        right: 60px;
        padding: 10px; /* Adjust padding for smaller screens */
        font-size: 30px; /* Adjust font size for smaller screens */
    }
}



/* Responsive Styles */
@media screen and (max-width: 768px) {
    #scrollTopBtn {
        font-size: 30px;
        bottom: 10px;
        right: 10px;
        padding: 10px;
    }
}

    </style>
    <body> 

        <!-- Back-to-Top and Back Button -->

     

        <!-- Eto yung navbar -->

        <nav class="navbar navbar-dark bg-primary sticky-top">
            <div class="logo">
            <a href="#"><img src="icons/yuson1.png" alt="logo" height="60px" /></a>
          </div>
            <a class="navbar-brand" href="resident_homepage.php" style="margin-left:10px;"><b>WebYu</b></a>
            <a href="resident_homepage.php" title="Home" class="btn3 bg-primary" style="color: white; margin-left:130px;"><b>HOME</b></a>
            <a href="#down2" class="btn3 bg-primary" style="color: white; margin-left: 10px;"><b>VIEW INFO</b></a>
            <a href="#down1"  class="btn3 bg-primary" style="color: white; margin-left: 25px;"><b>UPDATE INFO</b></a>
           
            <div class="dropdown ml-auto">
                <button title="Your Account" class="btn btn-primary dropdown-toggle" style="margin-right: 2px;" type="button" data-toggle="dropdown"><?= $userdetails['surname'];?>, <?= $userdetails['firstname'];?>
                    <span class="caret" style="margin-left: 2px;"></span>
                </button>
                <ul class="dropdown-menu" style="width: 175px;" >
                    <a class="btn" href="resident_profile.php?id_resident=<?= $userdetails['id_resident'];?>"> <i class="fas fa-user"> &nbsp; </i>Personal Profile  </a>
                    <!--<a class="btn" href="resident_changepass.php?id_resident=<?= $userdetails['id_resident'];?>"> <i class="fas fa-lock" >&nbsp;</i> Change Password  </a>-->
                    <a class="btn" href="logout.php"> <i class="fas fa-sign-out-alt">&nbsp;</i> Logout  </a>
                </ul>
            </div>
        </nav>

        <div id="down2"></div>

        <br>

        <div class="container"> 
            <div class="card" style="margin-top: 2em;">  
                    <div class="card-header bg-primary text-white" style="font-size:20px"> Personal Information </div>
                <div class="card-body"> 
                    <form method="post">

                        <h6>
                            <i class="fas fa-user-circle"></i>
                            View Information
                        </h6>

                        <hr>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Last Name:</label>
                                    <input class="form-control" value="<?= $resident['lname'];?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>First Name:</label>
                                    <input class="form-control" value="<?= $resident['fname'];?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Middle Name:</label>
                                    <input class="form-control" value="<?= $resident['mi'];?>" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input class="form-control" value="<?= $resident['email'];?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Sex:</label>
                                    <input class="form-control" value="<?= $resident['sex'];?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Nationality:</label>
                                    <input  class="form-control" value="<?= $resident['nationality'];?>" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Birth Date:</label>
                                    <input class="form-control" value="<?= $resident['bdate'];?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group" id="down1">
                                    <label>Birth Place:</label>
                                    <input class="form-control" value="<?= $resident['bplace'];?>" disabled>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h6>
                            <i class="fas fa-user-edit"></i>
                            Update Information
                        </h6>

                        <hr>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Age:</label>
                                    <input class="form-control" type="number" name="age" value="<?= $resident['age'];?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Status:</label>
                                    <input class="form-control" type="text" name="status" value="<?= $resident['status'];?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Contact:</label>
                                    <input class="form-control" type="tel" name="contact" maxlength="11" pattern="[0-9]{11}" value="<?= $resident['contact'];?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>House No:</label>
                                    <input class="form-control" type="text" name="houseno" value="<?= $resident['houseno'];?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Street:</label>
                                    <input class="form-control" type="text" name="street" value="<?= $resident['street'];?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Barangay:</label>
                                    <input class="form-control" type="text" name="brgy" value="<?= $resident['brgy'];?>">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row" style="margin-bottom: 5px;"> 
                            <div class="col-xl-12">
                                <div class="form-inline">
                                    <input class="form-control" name="lname" type="hidden" value="<?= $resident['lname'];?>"/>
                                    <input class="form-control" name="mi" type="hidden" value="<?= $resident['mi'];?>" />
                                    <button type="submit button" class="btn btn-info" style="margin-left: 37%; width:143px;"  name="search_household">View Household</button>
                                    <button class="btn btn-primary" style="margin-left: .2%; width:143px;" type="submit" name="profile_update"> Update </button>
                                    <a href="resident_profile.php?id_resident=<?= $userdetails['id_resident'];?>"></a>   
                                    <div>
                                        <br><br>
                                        <?php include'testingsearch.php'?>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>                               
            </div>
        </div>

        <br>
        <br>
        <br>
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


        
        <button id="scrollTopBtn" onclick="scrollToTop()">
                <i class="fas fa-angle-up"></i>
    </button>
<style>
 #footer {
        width: 100%;
        bottom: 0;
        position: relative;
    }

    @media (max-width: 768px) {
        #footer {
            position: absolute;
        }
    }
</style>

        <!-- Footer -->

      
        <script>
      // Function to scroll to the top of the page
      function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }

      // Show or hide the scroll to top button based on scroll position
      window.onscroll = function () {
        var scrollTopBtn = document.getElementById("scrollTopBtn");
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          scrollTopBtn.style.display = "block";
        } else {
          scrollTopBtn.style.display = "none";
        }
      };
    </script>

        <script>
            $(document).ready(function(){
            // Add smooth scrolling to all links
            $("a").on('click', function(event) {

                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function(){

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
                } // End if
            });
            });
        </script>

        <script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>

    </body>
</html><br><br><br><br>
<?php include('footer.php'); ?>
    </body>
</html>

