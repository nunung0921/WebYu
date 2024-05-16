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
$singlecount = $residentbmis->count_stat_single();
$marriedcount = $residentbmis->count_stat_married();
$widowcount = $residentbmis->count_stat_widow();
$divorcedcount = $residentbmis->count_stat_divorce();
/*$spcount = $residentbmis->count_single_parent();
$fourpscount = $residentbmis->count_fourps();
$indigentcount = $residentbmis->count_indigent();
$malcount = $residentbmis->count_malnourished();
$vacxcount = $residentbmis->count_vaccinated();
$pregnancycount = $residentbmis->count_pregnancy();*/

$p1count = $residentbmis->count_purok1();
$p2count = $residentbmis->count_purok2();
$p3count = $residentbmis->count_purok3();
$p4count = $residentbmis->count_purok4();
$p5count = $residentbmis->count_purok5();
$p6count = $residentbmis->count_purok6();
$p7count = $residentbmis->count_purok7();


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
    <hr>
    <br>
    <div class="row">
        <div class="scrollable"> <!-- Add this container -->
            <canvas id="otherChart" width="1180" height="250"></canvas>
        </div>
    </div>
    <hr>
    <br>
    <div class="row">
        <div class="scrollable"> <!-- Add this container -->
            <canvas id="populationChart" width="1180" height="250"></canvas>
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
const ctxPopulation = document.getElementById('populationChart').getContext('2d');

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
            label: 'Single',
            value: <?= $singlecount ?>
        },
 {
            label: 'Married',
            value: <?= $marriedcount ?>
        },
 {
            label: 'Widowed',
            value: <?= $widowcount ?>
        },
{
            label: 'Divorced',
            value: <?= $divorcedcount ?>
        },
 /* {
            label: 'Malnourished Residents',
            value: <?= $malcount ?>
        },*/
 
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
    'Registered Voters': 'admn_resident_voters.php',
    'Unregistered Voters': 'admn_resident_unregistered.php',
    'Male Residents': 'admn_resident_Male.php',
    'Female Residents': 'admn_resident_female.php',
    'Minor Residents': 'admn_resident_minor.php',
    'Senior Residents': 'admn_resident_senior.php'
    /*'PWD Residents': 'admn_resident_pwd.php',
    'Single Parents': 'admn_resident_single.php',
    '4Ps Members': 'admn_resident_4ps.php',
    'Indigent Residents': 'admn_resident_indigent.php',
    'Malnourished Residents': 'admn_resident_Mal.php'*/
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

document.addEventListener('DOMContentLoaded', function() {
    // Verify if the canvas element exists
    const ctxPopulation = document.getElementById('populationChart')?.getContext('2d');
    
    if (!ctxPopulation) {
        console.error('Canvas element for populationChart not found');
        return;
    }

    // Verify if PHP variables are correctly passed
    const p1count = <?= json_encode($p1count) ?>;
    const p2count = <?= json_encode($p2count) ?>;
    const p3count = <?= json_encode($p3count) ?>;
    const p4count = <?= json_encode($p4count) ?>;
    const p5count = <?= json_encode($p5count) ?>;
    const p6count = <?= json_encode($p6count) ?>;
    const p7count = <?= json_encode($p7count) ?>;
    
    if (
        typeof p1count !== 'number' ||
        typeof p2count !== 'number' ||
        typeof p3count !== 'number' ||
        typeof p4count !== 'number' ||
        typeof p5count !== 'number' ||
        typeof p6count !== 'number' ||
        typeof p7count !== 'number'
    ) {
        console.error('One or more population count variables are not numbers:', { p1count, p2count, p3count, p4count, p5count, p6count, p7count });
        return;
    }

    // Create the population chart
    const populationChart = new Chart(ctxPopulation, {
        type: 'bar',
        data: {
            labels: ['Purok 1', 'Purok 2', 'Purok 3', 'Purok 4', 'Purok 5', 'Purok 6', 'Purok 7'],
            datasets: [{
                label: 'Population',
                data: [p1count, p2count, p3count, p4count, p5count, p6count, p7count],
                backgroundColor: [
                    'rgba(139, 0, 0, 0.8)' // Dark Red
                ],
                borderColor: [
                    'rgba(139, 0, 0, 1)' // Dark Red
                ],

                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});


</script>

<?php 
include('dashboard_sidebar_end.php');
?>
</html>
