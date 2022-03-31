    <?php
	/*require_once('config.php');

    include("connexion.php");
	
	$nbt = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_nom='$pseudo' AND reqst_state='VALIDE' ")->fetch_array(); 
	$nbs = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='VALIDE' ")->fetch_array();
	$nbe = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$pseudo' AND rqeqpmt_state='TRAITE' ")->fetch_array();
	$aprv = $nbt['nb']+$nbs['nbe']+$nbe['nbe'];
	
	$nbt = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_nom='$pseudo' AND (reqst_state='ATTENTE' OR reqst_statoic='ATTENTE') ")->fetch_array(); 
	$nbs = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='ATTENTE' ")->fetch_array(); 
	$nbe = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$pseudo' AND (rqeqpmt_state='ATTENTE' OR rqeqpmt_state LIKE '%APPROUV%')")->fetch_array();
	$att = $nbt['nb']+$nbs['nbe']+$nbe['nbe'];
	
	$nbt = $mysqli->query("SELECT COUNT(*) AS nb FROM wfp_chd_request WHERE reqst_nom='$pseudo' AND (reqst_state='REJET' OR reqst_statoic='REJET') ")->fetch_array(); 
	$nbs = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requestsdr WHERE reqsdr_deman='$pseudo' AND reqsdr_state='REJET' ")->fetch_array(); 
	$nbe = $mysqli->query("SELECT COUNT(*) AS nbe FROM wfp_chd_requesteqpmt WHERE rqeqpmt_demand='$pseudo' AND (rqeqpmt_state='ANNULE' OR rqeqpmt_state LIKE '%REJET%') ")->fetch_array();
	$rej = $nbt['nb']+$nbs['nbe']+$nbe['nbe'];*/
					$aprv = 30;		
					$att = 15;
					$rej = 55;
    $dataPoints = array( 
    	array("label"=>"Approuvées", "y"=>$aprv),
    	array("label"=>"En Attente", "y"=>$att),
    	array("label"=>"Rejetées", "y"=>$rej)
    )
     
    ?>
    <!DOCTYPE HTML>
    <html>
    <head>
    <script>

// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Direct", "Referral", "Social"],
    datasets: [{
      data: [55, 30, 15],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
    </script>
    </head>
    <body>
    <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Referral
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

    </body>
    </html>                              