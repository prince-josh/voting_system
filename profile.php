<?php
include 'connection.php';
session_start();
if (!isset($_SESSION['nin'])) {
    header("location: index.php");
}else{
?>
<?php
    $nin = $_SESSION['nin'];
    $sel = "select * from voters where nin = '$nin'";
    $run = mysqli_query($con, $sel);
    if ($row = mysqli_fetch_assoc($run)) {
        $pvc = $row['voters_id'];
        $fn = $row['first_name'];
        $mn = $row['middle_name'];
        $ln = $row['last_name'];
        $dob = $row['age'];
        $address = $row['address'];
        $sor = $row['state_of_residence'];
        $lor = $row['LGA_of_residence'];
        $soo = $row['state_of_origin'];
        $loo = $row['LGA_of_origin'];
        $nin = $row['NIN'];
        $passport = $row['passport'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- Libraries CSS Files -->
<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="lib/animate/animate.min.css" rel="stylesheet">
<link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

   <!--jquery-->
<script src="js/jquery-3.4.1.js"></script>
<!-- Main Stylesheet File -->
<link href="css/style.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/main.css"/>
<link rel="stylesheet" href="assets/css/theme1.css"/>
    <title><?php echo $fn. " ". $ln ." - profile";?> </title>
</head>
  <body class="font-montserrat">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div>

<div id="main_content 1">
    <div id="left-sidebar" class="sidebar ">
    <img src="images/logo.png" alt="logo">
        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul class="metismenu">
                <li class="g_heading">Project</li>
                <li><a href="profile.php"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>                        
                <li><a href="cast-vote.php"><i class="fa fa-list-ol"></i><span>Cast vote</span></a></li>
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
                            <h4><?php echo "Welcome ". $fn ." ". $mn. " ". $ln. "!";?></h4>
                            <span id="greeting"></span> <span>| <?php echo "Your Personal Voting Code (PVC) is ". $pvc ; ?></span>
                        </div>                        
                    </div>
                </div>
                <div class="row clearfix row-deck">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Your Bio</h3>
                            </div>
                            <div class="card-body">
                                <div id="table">
                                  <center><table class = "table table-responsive" border="1">
                                        <tr>
                                            <td>First Name:</td>
                                            <th> <?php echo $fn ; ?></th>
                                            <td>edit</td>
                                        </tr>
                                        <tr>
                                            <td>Middle Name:</td>
                                            <td> <?php echo $mn ; ?></td>
                                            <td>edit</td>
                                        </tr>
                                        <tr>
                                            <td>Last Name:</td>
                                            <td> <?php echo $ln ; ?></td>
                                            <td>edit</td>
                                        </tr>
                                        <tr>
                                            <td>Date Of Birth:</td>
                                            <td> <?php echo $dob ; ?></td>
                                            <td>edit</td>
                                        </tr>
                                        <tr>
                                            <td>Address:</td>
                                            <td> <?php echo $address ; ?></td>
                                            <td>edit</td>
                                        </tr>
                                        <tr>
                                            <td>State Of Residence:</td>
                                            <td> <?php echo $sor ; ?></td>
                                            <td>edit</td>
                                        </tr>
                                        <tr>
                                            <td>Local Government Of Residence:</td>
                                            <td> <?php echo $lor ; ?></td>
                                            <td>edit</td>
                                        </tr>
                                        <tr>
                                            <td>State Of Origin:</td>
                                            <td> <?php echo $soo ; ?></td>
                                            <td>edit</td>
                                        </tr>
                                        <tr>
                                            <td>Local Government Of Origin:</td>
                                            <td> <?php echo $loo ; ?></td>
                                            <td>edit</td>
                                        </tr>
                                        <tr>
                                            <td>NIN:</td>
                                            <td> <?php echo $nin ; ?></td>
                                            <td>edit</td>
                                        </tr>
                                        <tr>
                                            <td>Passport:</td>
                                            <td> <?php echo "<img src='voters_images/$passport' alt = 'passport' height='50' width='50'>" ; ?></td>
                                            <td>edit</td>
                                        </tr>
                                    </table>
                                    </center>
                                </div>
                            </div>
                        </div>                
                    </div>
                </div> 
    </div>
<!--voting page-->
</div>
    </main>
        <footer>
          <div class="fcontent container">
            <p class="lf">&copy; Copyright 2021</p>
          </div>
        </footer>

      <!-- JavaScript Libraries -->
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/jquery/jquery-migrate.min.js"></script>
<script src="lib/popper/popper.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/counterup/jquery.waypoints.min.js"></script>
<script src="lib/counterup/jquery.counterup.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>
<script src="lib/typed/typed.min.js"></script>
<!--custom Javascript-->
<script src="js/script.js"></script>
<script src="assets/js/core.js"></script>
</body>
</html>
<?php } ?> 