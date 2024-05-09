<?php 
    ini_set('display_errors', 1);
    error_reporting(E_ALL ^ E_WARNING);
    
    session_start();

    if(!isset($_SESSION)) {
        $showdate = date("Y-m-d");
        date_default_timezone_set('Asia/Manila');
        $showtime = date("h:i:a");
        $_SESSION['storedate'] = $showdate;
        $_SESSION['storetime'] = $showtime;
    }

    //include('autoloader.php');
    require('classes/main.class.php');
    $bmis->login();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Barangay Yuson Information Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index1.css" type="text/css">
    <script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
    <script src="customjs/main.js" type="text/javascript"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<style>
    *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

body{
    font-family: 'Poppins', sans-serif;
    overflow: hidden;
}

.wave{
    position: fixed;
    bottom: 0;
    left: 0;
    height: 100%;
    z-index: -1;
    width: 100%;
    object-fit: cover; /* Ito ang idinagdag na propesyonal upang mapanatili ang aspeto ng background image */
    object-position: center; /* Ito ang idinagdag na propesyonal upang mapanatili ang aspeto ng background image */
}


.container{
    width: 100vw;
    height: 100vh;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap :7rem;
    padding: 0 2rem;
}

.img{
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.login-content{
    display: flex;
    justify-content: flex-start;
    align-items: center;
    text-align: center;
}

.img img{
    width: 500px;
}

/* Initial styling for the form */
form {
    width: 450px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.9);
    border-radius: 20px;
    padding: 20px;
    background-color: #fff;
}

/* Adjustments for smaller screens */
@media screen and (max-width: 768px) {
    form {
        width: 80%; /* Set width to a percentage for responsiveness */
        max-width: 450px; /* Set a maximum width if needed */
    }
}

@media screen and (max-width: 576px) {
    form {
        width: 90%; /* Further adjust width for smaller screens */
    }
}


.login-content img{
    height: 100px;
}

.login-content h2{
    margin: 15px 0;
    color: #333;
    text-transform: uppercase;
    font-size: 2rem;
}

.login-content .input-div{
    position: relative;
    display: grid;
    grid-template-columns: 7% 93%;
    margin: 25px 0;
    padding: 5px 0;
    border-bottom: 2px solid #d9d9d9;
}

.login-content .input-div.one{
    margin-top: 0;
}

.i{
    color: #d9d9d9;
    display: flex;
    justify-content: center;
    align-items: center;
}

.i i{
    transition: .3s;
}

.input-div > div{
    position: relative;
    height: 45px;
}

.input-div > div > h5{
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
    font-size: 18px;
    transition: .3s;
}

.input-div:before, .input-div:after{
    content: '';
    position: absolute;
    bottom: -2px;
    width: 0%;
    height: 2px;
    background-color: #007bff;
    transition: .4s;
}

.input-div:before{
    right: 50%;
}

.input-div:after{
    left: 50%;
}

.input-div.focus:before, .input-div.focus:after{
    width: 50%;
}

.input-div.focus > div > h5{
    top: -5px;
    font-size: 15px;
}

.input-div.focus > .i > i{
    color: #007bff;
}

.input-div > div > input{
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    border: none;
    outline: none;
    background: none;
    padding: 0.5rem 0.7rem;
    font-size: 1rem;
    color: #555;
    font-family: 'poppins', sans-serif;
}

.input-div.pass{
    margin-bottom: 4px;
}

a{
    display: block;
    text-align: right;
    text-decoration: none;
    color: #999;
    font-size: 0.9rem;
    transition: .3s;
}

a:hover{
    color: #007bff;
}

.btn{
    display: block;
    width: 100%;
    height: 40px;
    border-radius: 5px;
    outline: none;
    border: none;
    background-image: linear-gradient(to right, #007bff, #007bff, #007bff);
    background-size: 200%;
    font-size: 1rem;
    color: #fff;
    font-family: 'Poppins', sans-serif;
    text-transform: uppercase;
    margin: 1rem 0;
    cursor: pointer;
    transition: .5s;
}
.btn:hover{
    background-position: right;
}
.btn1{
    display: block;
    width: 100%;
    height: 40px;
    border-radius: 5px;
    outline: none;
    border: none;
    background-image: linear-gradient(to right, #0B5345, #0B5345, #0B5345);
    background-size: 200%;
    font-size: 1rem;
    color: #fff;
    font-family: 'Poppins', sans-serif;
    text-transform: uppercase;
    margin: 1rem 0;
    cursor: pointer;
    transition: .5s;
    text-align: center; /* Center the text horizontally */
    line-height: 40px; /* Vertically center the text */
}
.btn1:hover{
    background-position: right;
    color: #fff;
}
.btn2{
    display: block;
    width: 100%;
    height: 40px;
    border-radius: 5px;
    outline: none;
    border: none;
    background-image: linear-gradient(to right, #28a745, #28a745, #28a745);
    background-size: 200%;
    font-size: 1rem;
    color: #fff;
    font-family: 'Poppins', sans-serif;
    text-transform: uppercase;
    margin: 1rem 0;
    cursor: pointer;
    transition: .5s;
    text-align: center; /* Center the text horizontally */
    line-height: 40px; /* Vertically center the text */
}
.btn2:hover{
    background-position: right;
    color: #fff;
}


@media screen and (max-width: 1050px){
    .container{
        grid-gap: 5rem;
    }
}

@media screen and (max-width: 1000px){
    form{
        width: 290px;
    }

    .login-content h2{
        font-size: 2.4rem;
        margin: 8px 0;
    }

    .img img{
        width: 400px;
    }
}

@media screen and (max-width: 900px){
    .container{
        grid-template-columns: 1fr;
    }

    .img{
        display: none;
    }

    .login-content{
        justify-content: center;
    }
}

.div .g-recaptcha {
    transform: scale(0.8);
    transform-origin: 0;
    -webkit-transform: scale(0.8);
    transform: scale(0.8);
    border: none; /* Initially set border to none */
    transition: border-color 0.3s ease; /* Add transition for border change */
}

/* Responsive adjustments */
@media screen and (max-width: 768px) {
    .div .g-recaptcha {
        transform: scale(0.6);
        border-top: 2px solid red; /* Adjust the border width according to the scale */
        border-bottom: 2px solid red; /* Adjust the border width according to the scale */
        width: calc(100% - 4px); /* Calculate the width based on the border width */
        border:none;
    }
}

@media screen and (max-width: 576px) {
    .div .g-recaptcha {
        transform: scale(0.5);
        border-top: 1.5px solid red; /* Adjust the border width according to the scale */
        border-bottom: 1.5px solid red; /* Adjust the border width according to the scale */
        width: calc(100% - 6px); /* Calculate the width based on the border width */
        border:none;
    }
}





.input-container {
        position: relative;
    }

    .eye-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }

    
    </style>
<body>
    <img class="wave" src="icons/bgg.jpg">
    <div class="container">
        <div class="img">
            <img src="icons/yuson1.png">
        </div>
        <div class="login-content">
        <form method="post" class="input-container">
                <!--<img src="assets/goloo.png">-->
                <h2 class="title">Biclatan InfoSystem</h2>
                <div class="input-div one">
                   <div class="i">
                        <i class="fas fa-user"></i>
                   </div>
                   <div class="div">
                        <h5>Email Address</h5>
                        <input type="text" class="input" id="email" name="email" >
                   </div>
                </div>
                <div class="input-div pass">
                   <div class="i"> 
                        <i class="fas fa-lock"></i>
                   </div>
                   <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input" id="password" name="password">
                        <span class="eye-icon" onclick="togglePasswordVisibility()">👁️</span>
                   </div>
                </div>
                <div class="div">
                    <div class="g-recaptcha" data-sitekey="6LfHLcApAAAAAKyOyOJFNkXUBEuFLxx6qn8DbnHT" style="transform:scale(0.8);transform-origin:0;-webkit-transform:scale(0.8);transform:scale(0.8); width:307px;">
                    </div>
                </div>
                <button class="btn btn-primary login-button" type="submit" name="login">Log-in</button>
                <a href="index.php" class="btn1" type="submit" name="login"  style="background-color: #0B5345;">Back to homepage</a>
                <hr><br>
                <h4 style="font-size: 18px;"><b>Haven't registered yet?</b></h4>
                <h5 style="font-weight: lighter; font-size: 15px;">Hindi ka pa rehistrado?</h5>
                <a href="resident_registration.php" class="btn2">Create Account</a>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var eyeIcon = document.querySelector(".eye-icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.textContent = "👁️"; // I-update ang teksto ng icon para maging nakamulat
        } else {
            passwordInput.type = "password";
            eyeIcon.textContent = "👁️‍🗨️"; // I-update ang teksto ng icon para maging nakapikit
        }
    }
</script>

<script>
    const inputs = document.querySelectorAll(".input");


function addcl(){
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}

function remcl(){
    let parent = this.parentNode.parentNode;
    if(this.value == ""){
        parent.classList.remove("focus");
    }
}

inputs.forEach(input => {
    input.addEventListener("focus", addcl);
    input.addEventListener("blur", remcl);
});
</script>
<script>
// Function upang suriin ang CAPTCHA at baguhin ang kulay kung hindi pa ito na-click
function validateCaptcha(event) {
    // Get the reCAPTCHA response token
    var recaptchaResponse = grecaptcha.getResponse();

    // Find the CAPTCHA container element
    var captchaContainer = document.querySelector('.g-recaptcha');

    // Check if the reCAPTCHA response is valid
    if (recaptchaResponse.length === 0) {
        // Change the border color of the CAPTCHA container to red
        captchaContainer.style.border = '3px solid red';

        // Stop the form submission
        event.preventDefault();
    } else {
        // If the response is valid, remove the border color
        captchaContainer.style.border = '';
    }
}

// Idagdag ang validateCaptcha function bilang onsubmit event handler ng form
document.querySelector('form').addEventListener('submit', validateCaptcha);
</script>
</html>