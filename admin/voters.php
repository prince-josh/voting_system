<?php
include '../connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}else{
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
</head>
<body class="font-montserrat">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div>
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
    ?>
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
                        <h1 class="page-title">Voters List</h1>                        
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
                            <h4><span id="greeting"></span><?php echo " ". $f_name ." ". $l_name. "!";?></h4>  
                        </div>                        
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Voters</h3>
                            </div>
                            <div class="card-body">
                                <div id="table">
                                  <center><table class = "table table-responsive" border="1">
                                        <tr>
                                            <th>Id</th>
                                            <th>Voter Id</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Date of Birth</th>
                                            <th>Address</th>
                                            <th>State of Residence</th>
                                            <th>LGA of Residence</th>
                                            <th>State of Origin</th>
                                            <th>LGA of Origin</th>
                                            <th>NIN</th>
                                            <th>Passport</th>
                                            <th>Voted</th>
                                            <th>Date Registered</th>
                                        </tr>
                                        <tr>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($run)) {
                                                $id = $row['id'];
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
                                                $voted = $row['voted'];
                                                $reg_date = $row['date_registerd'];
                                            
                                            ?>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $pvc; ?></td>
                                            <td><?php echo $fn; ?></td>
                                            <td><?php echo $mn; ?></td>
                                            <td><?php echo $ln; ?></td>
                                            <td><?php echo $dob; ?></td>
                                            <td><?php echo $address; ?></td>
                                            <td><?php echo $sor; ?></td>
                                            <td><?php echo $lor; ?></td>
                                            <td><?php echo $soo; ?></td>
                                            <td><?php echo $loo; ?></td>
                                            <td><?php echo $nin; ?></td>
                                            <td><img src="../voters_images/<?php echo $passport; ?>" alt=""></td>
                                            <td><?php echo $voted;?></td>
                                            <td><?php echo $reg_date; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </table>
                                    </center>
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