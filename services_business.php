<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_WARNING);
    require('classes/main.class.php');
    require('classes/resident.class.php');
    
    $userdetails = $bmis->get_userdata();
    $bmis->create_bspermit();

?>

<!DOCTYPE html>

<html>
  <head> 
    <title> Barangay Biclatan Information System </title>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
      <!-- responsive tags for screen compatibility -->
      <meta name="viewport" content="width=device-width, initial-scale=1"><!-- bootstrap css --> 
      <link href="bootstrap.css" rel="stylesheet" type="text/css">
      <!-- fontawesome icons --> 
      <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
  
      <style>
        /* Navbar Buttons */

        .btn1,
        .btn2,
        .btn3,
        .btn4,
        .btn5 {
            border-radius: 20px;
            border: none; /* Remove borders */
            color: white; /* White text */
            font-size: 16px; /* Set a font size */
            cursor: pointer; /* Mouse pointer on hover */
            padding: 8px 22px;
            margin-left: 15%;
        }

        .btn2,
        .btn3,
        .btn4,
        .btn5 {
            margin-left: 0.1%;
        }

        /* Darker background on mouse-over */
        .btn1:hover,
        .btn2:hover,
        .btn3:hover,
        .btn4:hover,
        .btn5:hover {
            background-color: RoyalBlue;
            color: black;
        }

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

        .container1 {
            background-color: #3498DB;
            height: 342px;
            color: black;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }

        .applybutton {
            width: 100% !important;
            height: 50px !important;
            border-radius: 20px;
            margin-top: 5%;
            margin-bottom: 8%;
            font-size: 25px;
            letter-spacing: 3px;
        }

        .paa {
            margin-top: 10px;
            position: relative;
            left: -28%;
        }

        .text1 {
            margin-top: 30px;
            font-size: 50px;
        }

        .picture {
            height: 120px;
            width: 120px;
        }

        /* width */
        ::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .card5,
        .card4,
        .card3,
        .card2,
        .card1 {
            width: 195px;
            height: 210px;
            overflow: auto;
            margin: auto;
            color: white;
        }

        a {
            color: white;
        }

        .shfooter .collapse {
            display: inherit;
        }

        @media (max-width: 767px) {
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

            .btn1,
            .btn2,
            .btn3,
            .btn4,
            .btn5 {
                margin-left: 0;
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
  </head>

    <body>

        <!-- Back-to-Top and Back Button -->

        <a data-toggle="tooltip" title="Back-To-Top" class="top-link hide" href="" id="js-top">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 6"><path d="M12 6H0l6-6z"/></svg>
            <span class="screen-reader-text">Back to top</span>
        </a>

        <!-- Eto yung navbar -->

        <style>

.text1 {
    font-size: 2.5rem;
}

.text2 {
    font-size: 1.1rem;
}

.picture {
    width: 100px;
    height: auto;
}

</style>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="logo">
        <a href="#"><img src="assets/goloo.png" alt="logo" height="60px" /></a>
    </div>
    <a class="navbar-brand" href="resident_homepage.php"><b>Biclatan InfoSystem</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="resident_homepage.php" class="nav-link">HOME</a>
            </li>
            <li class="nav-item">
                <a href="#down3" class="nav-link">PROCEDURE</a>
            </li>
            <li class="nav-item">
                <a href="#down1" class="nav-link">REGISTRATION</a>
            </li>
        </ul>
    </div>

    <div class="dropdown ml-auto">
        <button title="Your Account" class="btn btn-primary dropdown-toggle" style="margin-right: 2px;" type="button" data-toggle="dropdown"><?= $userdetails['surname'];?>, <?= $userdetails['firstname'];?>
            <span class="caret" style="margin-left: 2px;"></span>
        </button>
        <ul class="dropdown-menu" style="width: 175px;">
            <li><a class="dropdown-item" href="resident_profile.php?id_resident=<?= $userdetails['id_resident'];?>"> <i class="fas fa-user"></i> &nbsp; Personal Profile</a></li>
            <!--<li><a class="dropdown-item" href="resident_changepass.php?id_resident=<?= $userdetails['id_resident'];?>"> <i class="fas fa-lock"></i>&nbsp; Change Password</a></li>-->
            <li><a class="dropdown-item" href="logout.php"> <i class="fas fa-sign-out-alt"></i>&nbsp; Logout</a></li>
        </ul>
    </div>
</nav>



<div class="container-fluid container1"style="height:450px; background-color: #ececec;"> 
            <div class="row"> 
                <div class="col" style="background-color: #ececec;"> 
                    <div class="header">
                        <h1 class="text1">Business Permit (Mayor's Permit) </h1>
                        <h5> Before you can start operating your business in the Philippines, you need to secure 
                        <br> a Mayor’s Permit or Business Permit from the Local Government Unit (LGU) where your 
                        <br> company office is located. </h5>
                    </div>

                    <br>

                    <div class="d-flex justify-content-center">
                <img class="picture" src="icons/Documents/docu1.png" alt="Document 1">&nbsp;
                <img class="picture" src="icons/Documents/docu3.png" alt="Document 3">&nbsp;
                <img class="picture" src="icons/Documents/docu2.png" alt="Document 2">&nbsp;
            </div>
                </div>
            </div>
        </div>
        <div id="down3"></div>

        <br>
        <br>
        

        <div class="container text-center">
            <div class="row">
                <div class="col">
                    
                    <h1>Procedure</h1>
                    <hr style="background-color: black;">
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col">
                    <br>
                    <i class="fas fa-id-card fa-4x"></i>

                    <br>
                    <br>

                    <h3>Step 1: Prepare</h3>
                    <p style="text-align:justify;">Prepare all of the information that will be needed
                    in acquiring a certificate of residency.</p>
                </div>

                <div class="col">
                    <i class="fas fa-laptop fa-4x"></i>

                    <br>
                    <br>

                    <h3>Step 2: Fill-Up</h3>
                    <p style="text-align:justify;">Fill-Up the entire form in our system.</p>
                </div>

                <div class="col">
                    <br>
                    <br>
                    <i class="fas fa-user-check fa-4x"></i>

                    <br>
                    <br>

                    <h3>Step 3: Assessment</h3>
                    <p style="text-align:justify;">Verify all of the information you've been given
                    in our system that we can use to make the information of your document
                    accurately.</p>
                </div>

                <div class="col">
                    <i class="fas fa-file fa-4x"></i>

                    <br>
                    <br>

                    <h3>Step 4: Release</h3>
                    <p style="text-align:justify;">Releasing of your Business/Mayor's Permit. Please bring any valid ID. </p>
                  
                </div>
            </div>

            <div id="down2"></div>

            <br>
            <br>
            <br>

            
            </div>
        </div>

        <div id="down1"></div>

    

        <!-- Button trigger modal -->

        <div class="container">

            <h1 class="text-center">Registration</h1>
            <hr style="background-color:black;">

            <div class="col">   
                <button type="button" class="btn btn-primary applybutton" data-toggle="modal" data-target="#exampleModalCenter">
                    Request Form
                </button>
            </div>


            <!-- Modal -->

            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Business Permit Form</h5>
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
                                            <input name="lname" type="text" class="form-control" value="<?= $userdetails['surname'];?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="fname">First Name:</label>
                                            <input name="fname" type="text" class="form-control" value="<?= $userdetails['firstname'];?>" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="mi" class="mtop">Middle Name </label>
                                            <input name="mi" type="text" class="form-control" value="<?= $userdetails['mname'];?>" >
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="bsname">Business Name:</label>
                                            <input name="bsname" type="text" class="form-control" placeholder="Enter Business Name" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>
                                    
                                <br>

                                <h6>Business Address:</h6>

                                <hr>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label> House No: </label>
                                            <input type="text" class="form-control" name="houseno"  placeholder="Enter House No." value="<?= $userdetails['houseno'];?>"  required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label> Street: </label>
                                            <input type="text" class="form-control" name="street"  placeholder="Enter Street" value="<?= $userdetails['street'];?>"  required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                            <!--<label> Barangay: </label>-->
                                            <input type="hidden" class="form-control" name="brgy"  placeholder="Enter Barangay" value="<?= $userdetails['brgy'];?>"  required>

                                            <!--<label> Municipality: </label>-->
                                            <input type="hidden" class="form-control" name="municipal" placeholder="Enter Municipality" value="<?= $userdetails['municipal'];?>"  required>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="status">Business Industry:</label>
                                            <select class="form-control" name="bsindustry" id="status" placeholder="Enter Status" required>
                                            <option value="">Choose your Business Industry</option>
                                                <option value="Computer">Computer</option>
                                                <option value="Telecommunication">Telecommunication</option>
                                                <option value="Agriculture">Agriculture</option>
                                                <option value="Construction">Construction</option>
                                                <option value="Education">Education</option>
                                                <option value="Pharmaceutical">Pharmaceutical</option>
                                                <option value="Food">Food</option>
                                                <option value="HealthCare">HealthCare</option>
                                                <option value="Hospitality">Hospitality</option>
                                                <option value="Entertainment">Entertainment</option>
                                                <option value="News Media">News Media</option>
                                                <option value="Energy">Energy</option>
                                                <option value="Manufacturing">Manufacturing</option>
                                                <option value="Music">Music</option>
                                                <option value="Mining">Mining</option>
                                                <option value="WorldWide Web">WorldWide Web</option>
                                                <option value="Electronics">Electronics</option>
                                                <option value="Transport">Pharmaceutical</option>
                                                <option value="Transport">Aerospace</option>
                                            </select>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="aoe" class="mtop">Area of Establishment (SqM): </label>
                                            <input type="number" name="aoe" class="form-control" placeholder="Enter your AOE" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
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

        <br>
        <br>
        <br>

        
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