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
    <link rel="shortcut icon" href="icons/yuson1.png" type="">
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

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="css/responsive.css" rel="stylesheet" />


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
        margin-left: 23%;
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
.info_section .info_col {
  height: 200px; /* Set a fixed height for each row */
  overflow-y: auto; /* Add vertical scrollbars if content exceeds the height */
}
.dropdown-menu {
    min-width: 15rem;
}
   .logo {
    max-height: 70px;
    margin-right: 5px;
    .element.style {
    margin-left: 37%;
    width: 143px;
}
    </style>
    <body> 

        <!-- Back-to-Top and Back Button -->

        <a data-toggle="tooltip" title="Back-To-Top" class="top-link hide" href="" id="js-top">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 6"><path d="M12 6H0l6-6z"/></svg>
            <span class="screen-reader-text">Back to top</span>
        </a>

        <!-- Eto yung navbar -->

        <nav class="navbar navbar-dark bg-primary sticky-top">
             <img src="images/yuson1.png" alt="Yuson Logo" class="logo"  style="background-size: cover; background-repeat: no-repeat;">
            <a class="navbar-brand" href="resident_homepage.php">Barangay Yuson Information Management System</a>
            <a href="resident_homepage.php" data-toggle="tooltip" title="Home" class="btn3 bg-primary"><i class="fa fa-home fa-lg"></i></a>
            <a href="#down2" data-toggle="tooltip" title="View Information" class="btn6 bg-primary"><i class="fa fa-user-circle fa-lg"></i></a>
            <a href="#down1" data-toggle="tooltip" title="Update Information" class="btn5 bg-primary"><i class="fa fa-user-edit fa-lg"></i></a>
            <a href="#down" data-toggle="tooltip" title="Contact" class="btn4 bg-primary"><i class="fa fa-phone fa-lg"></i></a>
           
            <div class="dropdown ml-auto">
                <button title="Your Account" class="btn btn-primary dropdown-toggle" style="margin-right: 2px;" type="button" data-toggle="dropdown"><?= $userdetails['surname'];?>, <?= $userdetails['firstname'];?>
                    <span class="caret" style="margin-left: 2px;"></span>
                </button>
                <ul class="dropdown-menu" style="width: 175px;" >
                    <a class="btn" href="resident_profile.php?id_resident=<?= $userdetails['id_resident'];?>"> <i class="fas fa-user"> &nbsp; </i>Personal Profile  </a>
                    <a class="btn" href="resident_changepass.php?id_resident=<?= $userdetails['id_resident'];?>"> <i class="fas fa-lock" >&nbsp;</i> Change Password  </a>
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
<footer>
       <section class="info_section layout_padding2">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-lg-3 info_col">
        <div class="info_contact">
          <h4>
            Contact Us
          </h4>
          <div class="contact_link_box">
            <a href="https://www.google.com/maps/place/Yuson,+Nueva+Ecija/@15.6957075,120.7008206,15z/data=!3m1!4b1!4m6!3m5!1s0x3391327d2c1823c3:0x638916b810c7aaf!8m2!3d15.6957143!4d120.703379!16s%2Fg%2F11gbfbpd45?entry=ttu">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <span>
                Yuson, Nueva Ejica
              </span>
            </a>
            <a href="https://web.facebook.com/profile.php?id=61553042492757" target="_blank"><i class="fab fa-facebook-f"></i> Sanguniang Kabataan Ng Yuson</a>
            <a href="mailto:skyuson01@gmail.com"><i class="far fa-envelope"></i> skyuson01@gmail.com</a>
          </div>
        </div>
        
      </div>
      <div class="col-md-6 col-lg-3 info_col">
        <div class="info_detail">
          <h4>
            Info
          </h4>
          <p>
            Yuson is a barangay in the municipality of Guimba, in the province of Nueva Ecija. Its population as determined by the 2020 Census was 987.
          </p>
        </div>
      </div>
      <div class="col-md-6 col-lg-2 mx-auto info_col">
        <div class="info_link_box">
          <h4>
            Services
          </h4>
          <div class="info_links">
            <a class="active" href="services_business.php">
              
              Business Permit
            </a>
            <a class="" href="services_travelpermit.php">
              
              Travel Permit
            </a>
            <a class="" href="services_certofindigency.php">
             
              Indigency
            </a>

            <a class="" href="services_certofres.php">
              
              Residency
            </a>
             <a class="" href="services_brgyclearance.php">
              
              Barangay Clearance
            </a>
             <a class="" href="services_blotter.php">
              
              Peace and Order
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 info_col">
        <div class="info_contact">
          <h4>
            Developer
          </h4>
          <div class="contact_link_box">
    
            <a href="https://www.facebook.com/rafaeltosper21" target="_blank"><i class="fab fa-facebook-f"></i> Rafael M. Tosper Jr.</a>
            <a href="https://www.facebook.com/katrina.t.obena" target="_blank"><i class="fab fa-facebook-f"></i> Katrina T. Obena</a>
            <a href="https://www.facebook.com/profile.php?id=100007062167999&_rdc=1&_rdr" target="_blank"><i class="fab fa-facebook-f"></i> Marian C. Simon</a>
            <a href="https://www.facebook.com/kristinejoy.villano.9" target="_blank"><i class="fab fa-facebook-f"></i> Kristine Joy G. Villano</a>
            <a href="https://www.facebook.com/jayvee.mangalino.1" target="_blank"><i class="fab fa-facebook-f"></i> Jayvee T. Mangalino</a>
            <a href="https://www.facebook.com/Marjuntayag11?_rdc=1&_rdr" target="_blank"><i class="fab fa-facebook-f"></i> Marjun A. Tayag</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end info section -->

<!-- footer section -->
<section class="footer_section">
  <div class="container">
    <p>
      &copy; <span id="displayYear"></span> All Rights Reserved By
      <a href="https://html.design/">Barangay Yuson Information Management System</a>
    </p>
  </div>
</section>
        </footer>

        <script>
            // Set a variable for our button element.
            const scrollToTopButton = document.getElementById('js-top');

            // Let's set up a function that shows our scroll-to-top button if we scroll beyond the height of the initial window.
            const scrollFunc = () => {
            // Get the current scroll value
            let y = window.scrollY;
            
            // If the scroll value is greater than the window height, let's add a class to the scroll-to-top button to show it!
            if (y > 0) {
                scrollToTopButton.className = "top-link show";
            } else {
                scrollToTopButton.className = "top-link hide";
            }
            };

            window.addEventListener("scroll", scrollFunc);

            const scrollToTop = () => {
            // Let's set a variable for the number of pixels we are from the top of the document.
            const c = document.documentElement.scrollTop || document.body.scrollTop;
            
            // If that number is greater than 0, we'll scroll back to 0, or the top of the document.
            // We'll also animate that scroll with requestAnimationFrame:
            // https://developer.mozilla.org/en-US/docs/Web/API/window/requestAnimationFrame
            if (c > 0) {
                window.requestAnimationFrame(scrollToTop);
                // ScrollTo takes an x and a y coordinate.
                // Increase the '10' value to get a smoother/slower scroll!
                window.scrollTo(0, c - c / 10);
            }
            };

            // When the button is clicked, run our ScrolltoTop function above!
            scrollToTopButton.onclick = function(e) {
            e.preventDefault();
            scrollToTop();
            }
        </script>

        <script>
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
            });
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
</html>
