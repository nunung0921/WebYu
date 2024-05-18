<?php
require('classes/resident.class.php');
$userdetails = $residentbmis->get_userdata();
$id_travel = $_GET['id_travel'];
$resident = $residentbmis->get_single_travelpermit($id_travel);
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
            <div style="background: white;">
                <div style="width: 100%; height:100%; max-height: 550px;">
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
                        <p class="text-center" style="font-size: 30px; font-weight: bold; font-family: 'Copperplate Gothic Bold';">LIVESTOCK TRAVEL PERMIT<br></p><br>
                       

                        <p style="text-align: justify;"><b>Livestock Travel Permit No.:</b> <u><b><?= $resident['id_travel'];?></b></u><br><br>
                        <p style="text-align: justify;"><b>Name of Previous Owner:</b> <u><?= $resident['prev_owner'];?></u></p>
                        <p style="text-align: justify;"><b>Address:</b> <u>Brgy. <?= $resident['brgy'];?>, <?= $resident['municipal'];?></u></p>
                        <p style="text-align: justify;"><b>Breed:</b> <u><?= $resident['breed'];?></u></p>
                        <p style="text-align: justify;"><b>Gender:</b> <u><?= $resident['gender'];?></u></p>
                        <p style="text-align: justify;"><b>Color:</b> <u><?= $resident['color'];?></u></p>
                        <p style="text-align: justify;"><b>Travelling to:</b> <u><?= $resident['destination'];?></u></p>
						<?php
                        	date_default_timezone_set('Asia/Manila');
                        ?>

                        <p style="text-indent:40px;text-align: justify;">This travel permit is issued this, <ins><?= date('jS');?></ins> day of <ins><?= date('F');?></ins>, 2024, here at Barangay Yuson, Guimba, Nueva Ecija, upon request of the buyer of the <u><b><?= $resident['breed'];?></b></u>, Mr./Mrs. <u><b><?= $resident['buyers_name'];?></b></u> to be transported from this barangay to another place locally and for whatever personal/legal purpose it may serve.</p><br>
                        <p style="text-align: justify;">Prepared & Verified by:</p><br>
                        <div style="display: flex;">
                            <div style="flex: 1;">
                            <image src="icons/signature.png" style="width:100px; margin-left:70px; position: absolute;" /><br>
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