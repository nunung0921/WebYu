<?php 
    error_reporting(E_ALL ^ E_WARNING);
    include('classes/resident.class.php');
    $userdetails = $bmis->get_userdata();

    $dt = new DateTime("now", new DateTimeZone('Asia/Manila'));
    $tm = new DateTime("now", new DateTimeZone('Asia/Manila'));
    $cdate = $dt->format('Y/m/d');
    $ctime = $tm->format('H');
?>

<script> 
    function logout() {
    window.location.href = "logout.php";
    }
    function profile() {
    window.location.href = "resident_profile.php";
    }
</script>

<!DOCTYPE html> 
<html>

<head> 
    <title>Barangay Yuson Information Management System</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- responsive tags for screen compatibility -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- custom css --> 
    <link href="customcss/pagestyle.css" rel="stylesheet" type="text/css">
    <!-- bootstrap css --> 
    <link href="bootstrap.css" rel="stylesheet" type="text/css">
    <!-- fontawesome icons --> 
    <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
    <style>

        /* Navbar Buttons */

        .btn1 {
            border-radius: 20px;
            color: white; /* White text */
            font-size: 17px; /* Set a font size */
            cursor: pointer; /* Mouse pointer on hover */
            margin-left: 10%;
            padding: 12px 22px;
            font-weight: bold;
        }

        .btn2 {
            border-radius: 20px;
            color: white; /* White text */
            font-size: 17px; /* Set a font size */
            cursor: pointer; /* Mouse pointer on hover */
            margin-left: 1%;
            padding: 12px 22px;
            font-weight: bold;
        }

        .btn3 {
            border-radius: 20px;
            color: white; /* White text */
            font-size: 17px; /* Set a font size */
            cursor: pointer; /* Mouse pointer on hover */
            margin-left: 1%;
            padding: 12px 22px;
            font-weight: bold;
        }

        /* Darker background on mouse-over */
        .btn1:hover {
            background-color: RoyalBlue;
            color: black;
        }

        .btn2:hover {
            background-color: RoyalBlue;
            color: black;
        }

        .btn3:hover {
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

        /* E-Services Zoom */

        .zoom1 {
            transition: transform .3s;
        }

        .zoom1:hover {
            -ms-transform: scale(1.1); /* IE 9 */
            -webkit-transform: scale(1.1); /* Safari 3-8 */
            transform: scale(1.1); 
        }

        /* Footer Style */

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
</head>
<body> 
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <!-- Back-to-Top and Back Button -->

   

    <!-- Eto yung navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
        <div class="logo">
            <a href="#"><img src="icons/yuson1.png" alt="logo" height="60px" /></a>
        </div>
        <a class="navbar-brand" href="resident_homepage.php" style="margin-left: 5px;"><b>Webyu</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#down2">Announcement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#down1">E-Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#down">Contact</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $userdetails['surname'];?>, <?= $userdetails['firstname'];?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"
                            href="resident_profile.php?id_resident=<?= $userdetails ['id_resident'];?>"><i
                                class="fas fa-user"></i> Personal Profile</a>
                        <!--<a class="dropdown-item"
                            href="resident_changepass.php?id_resident=<?= $userdetails['id_resident'];?>"><i
                                class="fas fa-lock"></i> Change Password</a>-->
                        <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="header"> 
        <br><center><h2 style="font-size: 50px;"> Welcome to <br><b>Barangay Biclatan Information System</b></h2><bR></center>
    </div>
    <div id="down2"></div>

    <?php 
        $view = $bmis->view_announcement();

        if($view > 0 ) { ?>
        <table class="table table-dark table-responsive">
            <thead style="display:none"> 
                <tr>
                    <th> Announcement </th>
                </tr>
            </thead>
            <tbody style="display:none"> 
            <?php if(is_array($view)) {?>
                <?php foreach($view as $view) {?>
                    <tr>
                        <td> <?= $view['event'];?> </td>             
                    </tr>
                <?php }?>
            <?php } ?>
            </tbody>
        </table>

        <div class="alert alert-info alert-dismissible fade show" role="alert"
            style="margin-top: 4%; 
                    margin-left: 17.5%;
                    margin-bottom: 1.5%;
                    border-radius:30px; 
                    width:65%;
                    height:30%;
                    color: white;
                    background-color:#3498DB;">
            <strong><h4>ANNOUNCEMENT!<h4></strong> 
            <hr> 
            <br> 
            <p> 
                <?= $view['event'];?> 
            </p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <style>
            /* Default font size */
            .alert p {
                font-size: 18px;
            }

            /* Responsive font size */
            @media (max-width: 768px) {
                .alert p {
                    font-size: 18px;
                }
            }

            @media (max-width: 576px) {
                .alert p {
                    font-size: 18px;
                }
            }
        </style>

    <?php 
        } else {
        
        }
    ?>

    <div id="down1"></div>

    <br>

    <section class="heading-section"> 
        <div class="container text-center"> 
            <div class="row"> 
                <div class="col"> 
                    
                    <br>
                    
                    <div class="header"> 
                        <h3> You may select the following services offered below: </h3>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <br>

        <div class="container"> 
            <div class="row title-spacing">
                <div class="col"> 
                    <h2 class="text-center"><b>E-Services</b></h2>
                    <hr>
                </div> 
            </div>
            
            <div class="row card-spacing">
                <div class="col"> 
                    <a href="services_business.php?id_resident=<?= $userdetails['id_resident'];?>">
                        <div class="zoom1"> 
                            <div class="card"> 
                                <div class="card-body text-center"> 
                                    <img src="icons/ResidentHomepage/busper.png">
                                    <h4> Business Permit </h4> 
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col"> 
                    <a href="services_travelpermit.php?id_resident=<?= $userdetails['id_resident'];?>">
                        <div class="zoom1"> 
                            <div class="card"> 
                                <div class="card-body text-center"> 
                                    <img src="icons/ResidentHomepage/brgyid.png">
                                    <h4> Travel Permit </h4> 
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col"> 
                    <a href="services_certofindigency.php?id_resident=<?= $userdetails['id_resident'];?>">
                        <div class="zoom1">
                            <div class="card"> 
                                <div class="card-body text-center"> 
                                    <img src="icons/ResidentHomepage/indigency.png">
                                    <h4> Certificate of Indigency </h4>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <br>
            <div class="row card-spacing"> 
                <div class="col">
                    <a href="services_certofres.php?id_resident=<?= $userdetails['id_resident'];?>"> 
                    <div class="zoom1">    
                        <div class="card"> 
                            <div class="card-body text-center"> 
                            <img src="icons/ResidentHomepage/residency.png">
                                <h4> Certificate of Residency </h4>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col">
                    <a href="services_brgyclearance.php?id_resident=<?= $userdetails['id_resident'];?>"> 
                    <div class="zoom1">    
                        <div class="card"> 
                            <div class="card-body text-center">
                            <img src="icons/ResidentHomepage/clearance.png"> 
                                <h4> Barangay Clearance </h4>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col">
                    <a href="services_blotter.php?id_resident=<?= $userdetails['id_resident'];?>"> 
                    <div class="zoom1">    
                        <div class="card"> 
                            <div class="card-body text-center">
                                <img src="icons/ResidentHomepage/complain.png"> 
                                <h4> Peace and Order</h4> 
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <br>
    <br>
    <br>

    <!-- Footer -->

    <footer id="footer" class="bg-primary text-white d-flex-column text-center">
        <hr class="mt-0">

        

       

                <hr class="clearfix w-100 d-md-none mb-0">
 
                <!--Fourth column-->

                <div class="col-md-3 mx-auto shfooter" id="down">
                <div class="chip" style="font-size:10px;">
                                        <img src="icons/yuson1.png" alt="Person" width="96" height="96">
                                    Barangay Yuson | 041-526-7382
                                </div>
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

                <button id="scrollTopBtn" onclick="scrollToTop()">
                <i class="fas fa-angle-up"></i>
    </button>

        <!--/.Footer Links-->

        <hr class="mb-0">

        <!--Copyright-->

        <div class="py-3 text-center">
            Copyright 2023 -
            <script>
            document.write(new Date().getFullYear())
            </script> 
              | Barangay Yuson Information Management System
        </div>

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
