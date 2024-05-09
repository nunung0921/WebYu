<?php
// Ensure errors are displayed for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_WARNING);

// Include required classes
include('classes/staff.class.php');
include('classes/resident.class.php');
include('classes/services.class.php');

// Get user data and validate admin status
$userdetails = $bmis->get_userdata();
$bmis->validate_admin();

// Count different types of residents
$rescount = $residentbmis->count_resident();
$rescountm = $residentbmis->count_male_resident();
$rescountf = $residentbmis->count_female_resident();
$rescountfh = $residentbmis->count_head_resident();
$rescountfm = $residentbmis->count_member_resident();
$rescountvoter = $residentbmis->count_voters();
$rescountsenior = $residentbmis->count_resident_senior();

// Count different requests and approvals
$reqscount = $residentbmis->count_approval();
$minorcount = $residentbmis->count_minor();
$pwdcount = $residentbmis->count_pwd();
$spcount = $residentbmis->count_single_parent();
$fourpscount = $residentbmis->count_fourps();
$indigentcount = $residentbmis->count_indigent();
$malcount = $residentbmis->count_malnourished();
$vacxcount = $residentbmis->count_vaccinated();
$pregnancycount = $residentbmis->count_pregnancy();
$residencycount = $residentbmis->count_residency();
$count = $residencycount['count'];
$color = $residencycount['color'];

// Count different types of permits and clearances
$bspermitcount = $residentbmis->count_bspermit();
$countbs = $bspermitcount['count'];
$colorbs = $bspermitcount['color'];

$clearancecount = $residentbmis->count_clearance();
$countbc = $clearancecount['count'];
$colorbc = $clearancecount['color'];

$indigencycount = $residentbmis->count_indigency();
$countindigency = $indigencycount['count'];
$colorindigency = $indigencycount['color'];

$blottercount = $residentbmis->count_blotter();
$countblotter = $blottercount['count'];
$colorblotter = $blottercount['color'];
?>

<style>
 /* Custom styles */
.container-fluid {
    min-height: 100%;
    padding: 0 10px; /* Dagdagan ng padding ang container para sa mas magandang pagkakasunud-sunod */
    overflow-x: auto; /* Gawing scrollable ang container kapag nag-exceed sa viewport width */
}

.chart-container {
    display: flex;
    flex-direction: column; /* Baguhin ang flex direction papunta sa column para sa mas magandang pagkakasunud-sunod */
    align-items: center; /* I-center ang mga graph */
}

.chart-container canvas {
    width: 100%; /* Itakda ang lapad sa 100% para punan ang container */
    height: auto; /* Pahintulutan ang taas na mag-adjust nang automatiko */
    margin-bottom: 20px;
}

.btn {
    margin: 10px auto; /* I-center ang mga button */
}

@media (max-width: 768px) {
    .chart-container canvas {
        max-width: 100%; /* I-set ang maximum width sa 100% */
        margin-bottom: 20px;
    }
}

@media (min-width: 768px) {
    .chart-container canvas {
        max-width: 100%; /* Pahabain ang graph sa malalaking screen */
    }
}

</style>



<?php 
include('dashboard_sidebar_start.php');
?>
<br>
<!-- Begin Page Content -->
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="scrollable"> <!-- Add this container -->
            <canvas id="numberOfRecordsChart" width="1180" height="250"></canvas>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="scrollable"> <!-- Add this container -->
            <canvas id="otherChart" width="1180" height="250"></canvas>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-modal/2.2.6/js/bootstrap-modalmanager.min.js" integrity="sha512-/HL24m2nmyI2+ccX+dSHphAHqLw60Oj5sK8jf59VWtFWZi9vx7jzoxbZmcBeeTeCUc7z1mTs3LfyXGuBU32t+w==" crossorigin="anonymous"></script>
<!-- responsive tags for screen compatibility -->
<meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
<!-- custom css --> 
<link href="customcss/regiformstyle.css" rel="stylesheet" type="text/css">
<!-- bootstrap css --> 
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"> 
<!-- fontawesome icons -->
<script src="https://kit.fontawesome.com/67a9b7069e.js" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.bundle.js" type="text/javascript"> </script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Ensure the chart objects are correctly defined
const ctxNumberOfRecords = document.getElementById('numberOfRecordsChart').getContext('2d');
const ctxOther = document.getElementById('otherChart').getContext('2d');

// Data for the charts (assuming these variables are correctly defined earlier in your code)
const documentData = [
    { documentType: 'Request for Approval', count: <?= $reqscount ?> },
    { documentType: 'Certificate of Residency', count: <?= $count ?> },
    { documentType: 'Business Clearance', count: <?= $countbs ?> },
    { documentType: 'Barangay Clearance', count: <?= $countbc ?> },
    { documentType: 'Certificate of Indigency', count: <?= $countindigency ?> },
    { documentType: 'Blotter Reports', count: <?= $countblotter ?> }
];

// URL mapping for document types
const documentUrlMapping = {
    'Request for Approval': 'admn_resident_request.php',
    'Certificate of Residency': 'admn_certofres.php',
    'Business Clearance': 'admn_bspermit.php',
    'Barangay Clearance': 'admn_brgyclearance.php',
    'Certificate of Indigency': 'admn_certofindigency.php',
    'Blotter Reports': 'admn_blotterreport.php'
};

// Event handler for clicks on the "Number of Records" chart
function handleNumberOfRecordsChartClick(event) {
    // Get the clicked element (data point) on the chart
    const activePoint = numberOfRecordsChart.getElementsAtEventForMode(event, 'nearest', { intersect: true }, false)[0];
    
    if (activePoint) {
        // Get the index of the clicked data point
        const index = activePoint.index;
        
        // Get the label (document type) of the clicked data point
        const clickedLabel = numberOfRecordsChart.data.labels[index];
        
        // Check if the label has a corresponding URL in the mapping
        if (documentUrlMapping[clickedLabel]) {
            // Redirect the user to the corresponding URL
            window.location.href = documentUrlMapping[clickedLabel];
        }
    }
}

// Add click event listener to the "Number of Records" chart
ctxNumberOfRecords.canvas.addEventListener('click', handleNumberOfRecordsChartClick);

    // Function to extract labels and counts from the data
    function extractData(data) {
        var labels = data.map(function(item) {
            return item.documentType;
        });

        var counts = data.map(function(item) {
            return item.count;
        });

        return {
            labels: labels,
            counts: counts
        };
    }

    // Data for the charts
    var chartData = extractData(documentData);

    // Define the options for the number of records chart
    var numberOfRecordsOptions = {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1  // Display only whole numbers on the y-axis
                }
            }
        }
    };

    // Create the number of records chart
    var numberOfRecordsChart = new Chart(ctxNumberOfRecords, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Request',
                data: chartData.counts,
                backgroundColor: [
                    'rgba(255, 99, 132, 1)',
             
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                
                ],
                borderWidth: 1
            }]
        },
        options: numberOfRecordsOptions
    });

    // Other chart data
    var otherChartData = [
        {
            label: 'Barangay Residents',
            value: <?= $rescount ?>
        },
 {
            label: 'Registered Voters',
            value: <?= $rescountvoter ?>
        },
 {
            label: 'Unregistered Voters',
            value: <?= $rescountm ?>
        },
 {
            label: 'Male Residents',
            value: <?= $rescountm ?>
        },
 {
            label: 'Female Residents',
            value: <?= $rescountf ?>
        },
 {
            label: 'Minor Residents',
            value: <?= $minorcount ?>
        },
 {
            label: 'Senior Residents',
            value: <?= $rescountsenior ?>
        },
 {
            label: 'PWD Residents',
            value: <?= $pwdcount ?>
        },
 {
            label: 'Single Parents',
            value: <?= $spcount ?>
        },
 {
            label: '4Ps Members',
            value: <?= $fourpscount ?>
        },
 {
            label: 'Indigent Residents',
            value: <?= $indigentcount ?>
        },
 {
            label: 'Malnourished Residents',
            value: <?= $malcount ?>
        },
 
    ];

    // Define the options for the other chart
    var otherChartOptions = {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1  // Display only whole numbers on the y-axis
                }
            }
        }
    };

    // Extract data for the other chart
    var otherChartLabels = otherChartData.map(item => item.label);
    var otherChartValues = otherChartData.map(item => item.value);

    // Create the other chart
    var otherChart = new Chart(ctxOther, {
        type: 'bar',
        data: {
            labels: otherChartLabels,
            datasets: [{
                label: 'Resident Data',
                data: otherChartValues,
                backgroundColor: [
    'rgba(54, 162, 235, 1)',  // Blue
   
],

                borderColor: [
                    'rgba(54, 162, 235, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: otherChartOptions
    });

    // Define a mapping between the chart labels and the corresponding PHP page URLs
    var chartUrlMapping = {
    'Barangay Residents': 'admn_resident.php',
    'Registered Voters': 'admn_resident_crud.php',
    'Unregistered Voters': 'admn_resident_unregistered.php',
    'Male Residents': 'admn_resident_Male.php',
    'Female Residents': 'admn_resident_female.php',
    'Minor Residents': 'admn_resident_minor.php',
    'Senior Residents': 'admn_resident_senior.php',
    'PWD Residents': 'admn_resident_pwd.php',
    'Single Parents': 'admn_resident_single.php',
    '4Ps Members': 'admn_resident_4ps.php',
    'Indigent Residents': 'admn_resident_indigent.php',
    'Malnourished Residents': 'admn_resident_Mal.php'
};

// Add click event listener to the other chart
ctxOther.canvas.onclick = function(event) {
    var activePoint = otherChart.getElementsAtEventForMode(event, 'nearest', { intersect: true }, false)[0];
    if (activePoint) {
        var index = activePoint.index;
        var clickedLabel = otherChart.data.labels[index];
        
        // Check if the clicked label exists in the URL mapping
        if (chartUrlMapping[clickedLabel]) {
            // Redirect user to the corresponding URL
            window.location.href = chartUrlMapping[clickedLabel];
        }
    }
};

// Add click event listener to the number of records chart
ctxNumberOfRecords.canvas.onclick = function(event) {
    var activePoint = numberOfRecordsChart.getElementsAtEventForMode(event, 'nearest', { intersect: true }, false)[0];
    if (activePoint) {
        var index = activePoint.index;
        var clickedLabel = numberOfRecordsChart.data.labels[index];
        
        // Check if the clicked label exists in the URL mapping
        if (chartUrlMapping[clickedLabel]) {
            // Redirect user to the corresponding URL
            window.location.href = chartUrlMapping[clickedLabel];
        }
    }
};

</script>

<?php 
include('dashboard_sidebar_end.php');
?>
</html>
