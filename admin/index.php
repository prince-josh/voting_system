<?php
include '../connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}else{
?>
<?php
     $u_name = $_SESSION['username'];
     //get admin info
     $sel = "select * from admin where username = '$u_name'";
     $run = mysqli_query($con, $sel);
     if ($row = mysqli_fetch_assoc($run)) {
         $f_name = $row['firstname'];
         $l_name = $row['lastname'];
     }

     //get all voters info
     $sel_all_voters = "select * from voters";
     $run = mysqli_query($con, $sel_all_voters);
     $voter_num = mysqli_num_rows($run);

     //get all voted voters
     $sel_all_v_voters = "select * from voters where voted = 'yes'";
     $run = mysqli_query($con, $sel_all_v_voters);
     $v_voter_num = mysqli_num_rows($run);

     //get all candidates
     $sel_all_candidates = "select * from candidates";
     $run_candidate_sel = mysqli_query($con, $sel_all_candidates);
     $candidates_num = mysqli_num_rows($run_candidate_sel);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap CSS File -->
  <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
<link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="../lib/animate/animate.min.css" rel="stylesheet">
<link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
<link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="../lib/lightbox/css/lightbox.min.css" rel="stylesheet">
     <!--jquery-->
<script src="../js/jquery-3.4.1.js"></script>
<!-- Main Stylesheet File -->
<link href="../css/style.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/main.css"/>
<link rel="stylesheet" href="../assets/css/theme1.css"/>
    <title>admin - page</title>
            <!--chart script-->
<script>
$('document').ready(function(){
     // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = google.visualization.arrayToDataTable([
         ['Canditate', 'Votes'],
         <?php
         while ($result = mysqli_fetch_assoc($run_candidate_sel)) {
             echo "['".$result['firstname']."',".$result['num_of_votes']."],";
         }
         ?>
         ]);

        // Set chart options
        var options = {'title':'Present Voting Statistics',
                       'width':800,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    });
        </script>
</head>
<body class="font-montserrat">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div>
<div id="main_content 1">
    <div id="left-sidebar" class="sidebar ">
    <img src="../images/logo.png" alt="logo">
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul class="metismenu">
                <li class="g_heading">Project</li>
                <li><a href="index.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>                        
                <li><a href="candidates.php"><i class="fa fa-user"></i><span>Candidates</span></a></li>                        
                <li><a href="voters.php"><i class="fa fa-user"></i><span>Voters</span></a></li>
            </ul>
        </nav>        
    </div>
    <div class="page">
        <div id="page_top" class="section-body top_dark">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="left">
                        <a href="javascript:void(0)" class="icon menu_toggle mr-3"><i class="fa  fa-align-left"></i></a>
                        <h1 class="page-title">Dashboard</h1>                        
                    </div>
                    <div class="right">
                        <div class="notification d-flex">
                            
                            <div class="dropdown d-flex">
                                <a href="logout.php" title="logout"><i class="fa fa-sign-out"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body mt-3">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="mb-4">
                            <h4><span id="greeting"></span><?php echo " ". htmlspecialchars($f_name) ." ".htmlspecialchars($l_name). "!";?></h4>  
                        </div>                        
                    </div>
                </div>
                <div class="row clearfix row-deck">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="card-title"><?php echo htmlspecialchars($candidates_num);?></h1>
                                <h3 class="card-subtitle">No. Of Candidates</h3>
                            </div>
                        </div>                
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="card-title"><?php echo htmlspecialchars($voter_num); ?></h1>
                                <h3 class="card-subtitle">Total Voters</h3>
                            </div>
                        </div>                
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="card-title"><?php echo htmlspecialchars($v_voter_num); ?></h1>
                                <h3 class="card-subtitle">Voters Voted</h3>
                            </div>
                        </div>                
                    </div>

                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">Vote Tally</div>
                        <div class="card-body">
                            <div id="chart_div"></div>
                        </div>
                    </div>
                </div>  
    </div>
</div>
    </main>
        <footer>
          <div class="fcontent container">
            <p class="lf">&copy; Copyright 2021</p>
          </div>
        </footer>
    <!-- JavaScript Libraries -->
<script src="../lib/jquery/jquery.min.js"></script>
<script src="../lib/jquery/jquery-migrate.min.js"></script>
<script src="../lib/popper/popper.min.js"></script>
<script src="../lib/bootstrap/js/bootstrap.min.js"></script>
<script src="../lib/easing/easing.min.js"></script>
<script src="../lib/counterup/jquery.waypoints.min.js"></script>
<script src="../lib/counterup/jquery.counterup.js"></script>
<script src="../lib/owlcarousel/owl.carousel.min.js"></script>
<script src="../lib/lightbox/js/lightbox.min.js"></script>
<script src="../lib/typed/typed.min.js"></script>
<!--custom Javascript-->
<script src="../js/script.js"></script>
<script src="../assets/js/core.js"></script>
<!--goodle api-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</body>
</html>
<?php } ?>