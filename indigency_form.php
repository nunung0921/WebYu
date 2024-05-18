<?php
require('classes/resident.class.php');
$userdetails = $residentbmis->get_userdata();
$id_indigency = $_GET['id_indigency'];
$resident = $residentbmis->get_single_certofindigency($id_indigency);
  ?>
<!DOCTYPE html>
<html id="clearance">
<!-- Add this <img> tag to include the background image -->
<img src="icons/yuson1.png" style="padding-top: 25%; position: fixed; opacity: 0.1; z-index: -1; top: 0; left: 0; display: none; background-size: cover; background-repeat: no-repeat; background-position: center; width: 100%; height: 100%; background-blend-mode: overlay;">


<!-- Modify the CSS to show the background image only when printing -->
<style>
     @media screen {
            p.print-padding {
                font-size: 14px;
                padding-left: 30px;
                padding-right: 30px; /* Add your desired padding here */
            }
    }
    @media print {
        body{
            overflow: hidden;
        }
        img{
            display: block !important;
        }
        .noprint{
            display: none !important;
        }
    }
    @page {
            size: A4;
            margin-top: 0.15in;
            margin-bottom: 0.15in;
            margin-left: 1in;
            margin-right: 1in;
        }
</style>

 <head>
    <meta charset="UTF-8">
    <title>Barangay Yuson Information Management System</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="bootstrap/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/morris-0.4.3.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="bootstrap/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/select2.css" rel="stylesheet" type="text/css" />
    <script src="bootstrap/css/jquery-1.12.3.js" type="text/javascript"></script>  
    
</head>
 <body class="skin-black">
     <!-- header logo: style can be found in header.less -->
    
    
     <?php 
     
     include "classes/conn.php"; 

     ?> 
       
       <div class="col-xs-12 col-sm-6 col-md-8">
       <div style="width: 100%; height:100%; max-height: 550px; background-color: white;">
                    <div style="margin-top:20px; opacity: 0.6; display: flex; justify-content: space-between;">
                        <image src="icons/logong.jpg" style="width:80px;height:80px; margin-top: 10px;"/>
                        <center><p style="margin-top: 20px;">Republic of the Philippines<br>
                        Province of Nueva Ecija<br>
                        Municipality of Guimba<br>
                        <b>BARANGAY YUSON<br><br></b></p></center>
                        <image src="icons/yuson1.png" style="width:90px;height:115px;"/>
                    </div>        
                    <div style="background-image: url('icons/yuson1.png'); background-size: cover;
                background-repeat: no-repeat; background-position: center; background-size: 60%; background-color: rgba(255, 255, 255, 0.7); background-blend-mode: overlay; background-position: center top;">
                        <p class="text-center" style="font-size: 40px; opacity: 0.6; font-weight: bold; font-family: 'Edwardian Script ITC', cursive;">Office of the Barangay Chairman<br></p><br>
                        <p class="text-center" style="font-size: 30px; font-weight: bold; font-family: 'Copperplate Gothic Bold';">BARANGAY INDIGENCY<br></p><br>
                       

                        <p style="text-indent:40px;text-align: justify;">THIS IS TO CERTIFY that Mr./Ms./Mrs. <b><?= $resident['lname'];?>, <?= $resident['fname'];?> <?= $resident['mi'];?></b>,
                          a bona fide resident of<u><b> <?= $resident['street'];?></b></u>  Barangay Yuson, Guimba, Nueva Ecija is known to us personally and belong to one of the <b>Indigent Families</b> in this Barangay</p> 


                        <p style="text-indent:40px;text-align: justify;">The forenamed person needs assistance for the following reasons: </p> 

                        <div style="text-align: center;">
                            <div style="display: inline-block; text-align: justify;">
                                <input type="checkbox" id="option1" name="options[]" value="Presently confined at the hospital" style="transform: scale(1.5);">
                                <label for="option1"><span style="font-weight: normal;">&nbsp;<b>1.</b> Presently confined at the hospital</span></label><br>
                                
                                <input type="checkbox" id="option2" name="options[]" value="Need burial assistance" style="transform: scale(1.5);">
                                <label for="option2"><span style="font-weight: normal;">&nbsp;<b>2.</b> Need burial assistance</span></label><br>

                                <input type="checkbox" id="option3" name="options[]" value="Others" style="transform: scale(1.5);">
                                <label for="option3"><span style="font-weight: normal;">&nbsp;<b>3.</b> Others (Specify): <u><b> <?= $resident['purpose'];?></b></u></span></label> 
                            </div>
                        </div><br>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var purpose = "<?php echo $resident['purpose']; ?>".trim(); // Get the purpose from PHP

                                // Your existing JavaScript code to check the appropriate checkbox based on the purpose
                                var checkboxes = document.querySelectorAll('input[name="options[]"]');
                                var otherCheckbox = document.getElementById('option3'); // Assuming this is the "Others" checkbox

                                // Uncheck all checkboxes except the "Others" checkbox
                                checkboxes.forEach(function(checkbox) {
                                    checkbox.checked = false;
                                });

                                // Check the appropriate checkbox based on the purpose
                                if (purpose === 'Presently confined at the hospital') {
                                    document.getElementById('option1').checked = true;
                                } else if (purpose === 'Need burial assistance') {
                                    document.getElementById('option2').checked = true;
                                } else {
                                    otherCheckbox.checked = true; // Check the "Others" checkbox if purpose does not match any predefined option
                                }
                            });
                        </script>

                        <p style="text-indent:40px;text-align: justify;">Any assistance in favor of the bearer and/or his/her relative/s will be highly appreciated by this office. </p>

                        <?php
                        date_default_timezone_set('Asia/Manila');
                        ?>
                        <p style="text-indent:40px;text-align: justify;">Issued this <ins><?= date('jS');?></ins> day of <ins><?= date('F');?></ins>, 2024, here at Barangay Yuson, Guimba, Nueva Ecija, upon request of a forenamed person for whatever legal purposes it may serve.</p> <br>
                        <p style="text-align: justify;">Prepared & Verified by:</p><br>
                        <div style="display: flex;">
                            <div style="flex: 1;">
                            <image src="icons/signature.png" style="width:100px; margin-left:80px; position: absolute;" /><br>
                                <label style="font-size:14px;margin-left:3em;"><u><b>ROMEO M. CASTRO</b></u></label><br>
                                <label style="font-size:14px;margin-left:3em;">Barangay Secretary</label><br><br>
                                <p style="text-align: justify;">Noted by:</p><br>
                                <label style="font-size:14px;margin-left:1em;"><u><b>RENATO S. CONCEPCION SR.</b></u></label><br>
                                <label style="font-size:14px; margin-left:4em;">Barangay Captain</label>
                            </div>
                            
                        </div>
                </div>
                <div class="col-xs-8 col-md-4" style="margin-top: 2em;">
                    <b style="text-align: center;">Rest. Cert. No. _______</b><br>
                    <b><span style=" text-align: center;">Issued at </b><u>BRGY.YUSON, GUIMBA, N.E</u></span><br>
                    <b><span style=" text-align: center;">Issued on </b>___________</span></br>
                    <b><span style=" text-align: center;">Barangay Official Receipt No.: </b> ___________</span><br><br>
                    <center><p style="font-size: 15px; opacity: 0.6; margin-left: 18rem; font-weight: bold; font-family: 'Baskerville Old Face';">Not Valid Without Dry Seal<br></p></center>
                </div>
                </div>
            </div>
        </div>

    <button class="btn btn-primary noprint" id="printpagebutton" onclick="PrintElem('#clearance')">Print</button>
    </body>
    <?php
    
    ?>


    <script>
         function PrintElem(elem)
    {
        window.print();
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        //mywindow.document.write('<html><head><title>my div</title>');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        //mywindow.document.write('</head><body class="skin-black" >');
         var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        mywindow.document.write(data);
        //mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();

        printButton.style.visibility = 'visible';
        mywindow.close();

        return true;
    }
    </script>
</html>