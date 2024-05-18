<?php 
    error_reporting(E_ALL ^ E_WARNING);
    require('classes/resident.class.php');

    //$view = $residentbmis->view_single_resident($email);
    $userdetails = $residentbmis->get_userdata();
    $residentbmis->resident_changepass();
    //print_r($userdetails);

    
    
?>


<!DOCTYPE html> 
<html>

    <head> 
    <link rel="shortcut icon" href="icons/yuson1.png" type="">
    <title> Barangay Yuson Information Management System </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
    
        .input-container {
        display: -ms-flexbox; /* IE10 */
        display: flex;
        width: 100%;
        margin-bottom: 10px;
        }

        .icon {
        padding: 15px;
        background: dodgerblue;
        color: white;
        min-width: 50px;
        text-align: center;
        }

        .input-field {
        width: 100%;
        padding: 10px;
        outline: none;
        }

        .input-field:focus {
        border: 2px solid dodgerblue;
        }

        /* Set a style for the submit button */
        .btn2 {
        color: white;
        padding: 10px 15px;
        border: none;
        cursor: pointer;
        width: 35%;
        opacity: 0.9;
        margin-left: 33%;
        border-radius: 15px;
        }

        .btn2:hover {
        opacity: 10;
        }

        .field-icon {
        margin-left: 88%;
        margin-top: 3%;
        position: absolute;
        z-index: 2;
        }

        a{
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
            <a href="#down1" data-toggle="tooltip" title="Change Password" class="btn5 bg-primary"><i class="fa fa-user-lock fa-lg"></i></a>
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

        <div id="down1"></div>

        <br>

        <div class="container" style="margin-top: 3em;">
            <div class="row">
                <div class="col-12">

                    <br>

                    <div class="row margin mtop"> 
                        <div class="col-3"> </div>
                        <div class="col-6">   
                            <div class="card mbottom">
                            <div class="card-header bg-primary text-white text-center" style="font-size:30px"> Change Password </div>
                            <br>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <form method="post">
                                                
                                                <label> Current Password: </label>
                                                <div class="input-container">
                                                    <i class="fa fa-lock icon"></i>
                                                    <input class="input-field" type="password" id="password-field" name="oldpassword password" placeholder="Enter Current Password" require>
                                                    <input class="input-field" type="hidden" id="password-field" name="oldpasswordverify password" value="<?= $userdetails['password']?>">
                                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                </div>

                                                <br>

                                                <label> New Password: </label>
                                                <div class="input-container">
                                                    <i class="fa fa-key icon"></i>
                                                    <input class="input-field" id="password1" type="password" name="password1 newpassword" placeholder="Enter New Password" require>
                                                </div>
                                                
                                                <br>

                                                <label> Verify Password: </label>
                                                <div class="input-container">
                                                    <i class="fa fa-user-lock icon"></i>
                                                    <input class="input-field" id="confirm_password" type="password" name="checkpassword confirm_password" placeholder="Enter Verify Password" require>
                                                </div>

                                                <span id="message"></span>

                                                <br>
                                                <br>

                                                <button class="btn2 btn-primary" type="submit" name="resident_changepass"> Change Password </button>
                                            </form>
                                        </div>  
                                    </div>   
                                </div>
                            </div>
                        </div> 

                        <div class="col-3"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>
        <br>

 <!-- Footer -->

 <footer id="footer" class="bg-primary text-white d-flex-column text-center">
            <hr class="mt-0">

            
                    <!--/.Third column-->

                    <hr class="clearfix w-100 d-md-none mb-0">
 
                    <!--Fourth column-->

                    <div class="col-md-3 mx-auto shfooter" id="down">
                        <div class="d-md-none title" data-target="#Contact-Us" data-toggle="collapse">
                        <div class="mt-3 font-weight-bold">Contact Us:
                            <div class="float-right navbar-toggler">
                            <i class="fas fa-angle-down"></i>
                            <i class="fas fa-angle-up"></i>
                            </div>
                        </div>
                        </div>
                        <ul class="list-unstyled collapse" id="Contact-Us">
                            <li>
                                <div class="zoom">
                                    <div class="chip" style="font-size:10px;">
                                            <img src="icons/yuson1.png" alt="Person" width="96" height="96">
                                        Barangay Yuson | 041-526-7382
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

             <!--/.Footer Links-->

            <hr class="mb-0">

            <!--Copyright-->

            <div class="py-3 text-center">
            Copyright 2023 
            <script>
            document.write(new Date().getFullYear())
            </script> 
              | <a href="dev.html" style="color:white;">WebYu Team</a>
        </div>
            
            <button id="scrollTopBtn" onclick="scrollToTop()">
                <i class="fas fa-angle-up"></i>
    </button>
            </footer>

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