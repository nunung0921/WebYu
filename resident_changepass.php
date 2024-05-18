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
            .btn3, .btn4, .btn5 {
                border-radius: 20px;
                border: none; /* Remove borders */
                color: white; /* White text */
                font-size: 16px; /* Set a font size */
                cursor: pointer; /* Mouse pointer on hover */
                padding: 8px 22px;
                margin-left: .1%;
            }
            .btn3:hover, .btn4:hover, .btn5:hover {
                background-color: RoyalBlue;
                color: black;
            }
            .input-container {
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
                width: 100%;
                opacity: 0.9;
                border-radius: 15px;
            }
            .btn2:hover {
                opacity: 1;
            }
            .field-icon {
                position: absolute;
                right: 10px;
                top: 10px;
                cursor: pointer;
                z-index: 2;
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

    </head>

    <body> 

        <!-- Back-to-Top and Back Button -->
        <a data-toggle="tooltip" title="Back-To-Top" class="top-link hide" href="" id="js-top">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 6"><path d="M12 6H0l6-6z"/></svg>
            <span class="screen-reader-text">Back to top</span>
        </a>

        <!-- Eto yung navbar -->
        <nav class="navbar navbar-dark bg-primary sticky-top">
            <img src="images/yuson1.png" alt="Yuson Logo" class="logo">
            <a class="navbar-brand" href="resident_homepage.php">Barangay Yuson Information Management System</a>
            <div class="ml-auto">
                <a href="resident_homepage.php" data-toggle="tooltip" title="Home" class="btn3 bg-primary"><i class="fa fa-home fa-lg"></i></a>
                <a href="#down1" data-toggle="tooltip" title="Change Password" class="btn5 bg-primary"><i class="fa fa-user-lock fa-lg"></i></a>
                <a href="#down" data-toggle="tooltip" title="Contact" class="btn4 bg-primary"><i class="fa fa-phone fa-lg"></i></a>
            </div>
            <div class="dropdown ml-auto">
                <button title="My Profile" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                    <i class="fa fa-user-circle fa-lg"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="resident_homepage.php">Home</a></li>
                    <li><a href="resident_profile.php">My Profile</a></li>
                    <li><a href="resident_updateprofile.php">Update Profile</a></li>
                    <li><a href="resident_changepass.php">Change Password</a></li>
                    <li class="divider"></li>
                    <li><a href="logout.php"><i class="fa fa-sign-out fa-lg"></i> Sign out</a></li>
                </ul>
            </div>
        </nav>

        <!-- Eto yung content --> 
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-4"></div> 
                <div class="col-md-4">
                    <form action="resident_changepass.php" method="post">
                        <div class="input-container">
                            <i class="fa fa-lock icon"></i>
                            <input type="password" class="input-field" name="currentpassword" placeholder="Current Password" id="currentpassword" required>
                            <span toggle="#currentpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="input-container">
                            <i class="fa fa-lock icon"></i>
                            <input type="password" class="input-field" name="newpassword" placeholder="New Password" id="newpassword" required>
                            <span toggle="#newpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div class="input-container">
                            <i class="fa fa-lock icon"></i>
                            <input type="password" class="input-field" name="confirmpassword" placeholder="Confirm New Password" id="confirmpassword" required>
                            <span toggle="#confirmpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                        <div>
                            <button type="submit" class="btn2 bg-primary text-light"><i class="fa fa-paper-plane"></i> Submit </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>

        <footer class="footer_section bg-primary mt-5" id="down">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 footer-col">
                        <div class="footer_contact">
                            <h4>Reach at..</h4>
                            <div class="contact_link_box">
                                <a href="https://www.google.com/maps" target="_blank">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span>Brgy. Yuson Poblacion, Urbiztondo Pangasinan</span>
                                </a>
                                <a href="https://www.facebook.com" target="_blank">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                    <span>Facebook</span>
                                </a>
                                <a href="mailto:youremail@example.com">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <span>barangayyuson@gmail.com</span>
                                </a>
                                <a href="tel:+0123456789">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <span>(+01) 123456789</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 footer-col">
                        <div class="footer_detail">
                            <a href="resident_homepage.php" class="footer-logo">
                                BYIS
                            </a>
                            <p>Barangay Yuson Information System is a modern, computerized information system designed to enhance the efficiency and effectiveness of the barangay's administrative functions.</p>
                        </div>
                    </div>
                    <div class="col-md-4 footer-col">
                        <div class="footer_news">
                            <div class="footer_contact">
                                <h4>Developer</h4>
                                <div class="contact_link_box">
                                    <div class="chip">
                                        <img src="images/man.png" alt="Person">
                                        Developer Name
                                    </div>
                                </div>
                            </div>
                            <div class="footer_social mt-3">
                                <a href="">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                                <a href="">
                                    <i class="fa fa-pinterest" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-info">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7 mx-auto">
                                <p class="text-center">&copy; <span id="displayYear"></span> All Rights Reserved By Barangay Yuson<br>
                                Distributed By <a href="https://example.com/">Example</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- JS for Password Visibility Toggle -->
        <script>
            $(".toggle-password").click(function() {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        </script>

        <!-- JS for Back-to-Top Button -->
        <script>
            var btn = $('#js-top');
            $(window).scroll(function() {
                if ($(window).scrollTop() > 300) {
                    btn.addClass('show');
                } else {
                    btn.removeClass('show');
                }
            });
            btn.on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({scrollTop: 0}, '300');
            });
        </script>

    </body>
</html>
