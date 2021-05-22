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

        //get all candidates info
     $sel_all_candidates = "select * from candidates";
     $run = mysqli_query($con, $sel_all_candidates);
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
<!-- Page Loader
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div> -->

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
                        <h1 class="page-title">Cast Vote</h1>                        
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
                                <h3 class="card-title">Vote for your prefered candidate</h3>
                            </div>
                            <div class="card-body">
                                <div id="table">
                                  <center>
                                      
                                  <table class = "table table-responsive" border="1">
                                  <tr>
                                          
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Passport</th>
                                            <th>Party</th>
                                            <th>Vote</th>
                                        </tr>
                                        <tr>
                                            <?php
                                            
                                            while ($row = mysqli_fetch_assoc($run)) {
                                                $id = $row['id'];
                                                $fn = $row['firstname'];
                                                $ln = $row['lastname'];
                                                $passport = $row['passport'];
                                                $party = $row['party'];
                                                // $num_of_candiates = mysqli_num_rows($run);
                                                // for ($i=0; $i < $num_of_candiates ; $i++) { 
                                                //     # code...
                                                // }
                                            
                                            ?>
                                            <td><?php echo $fn; ?></td>
                                            <td><?php echo $ln; ?></td>
                                            <td><img src="candidate_images/<?php echo $passport; ?>" alt="candidate passport" height='50' width='50'></td>
                                            <td><?php echo $party;?></td>
                                            <td><a href="cast-vote.php?id=<?php echo $id ;?>"><input type="submit" class = "btn btn-primary" value = "Vote" name ="vote"></a></td>
                                            
                                        </tr>
                                        <?php } ?>
                                    </table>
                                
                                    <?php
                                        if (isset($_GET['id'])) {
                                            $id = $_GET['id'];
                                            $update_candidate_votes = "update candidates set num_of_votes = num_of_votes + 1 where id = $id";
                                            $update_voter_status = "update voters set voted = 'yes' where nin= $nin";
                                            $run_update_candidate_votes = mysqli_query($con, $update_candidate_votes);
                                            $run_update_voter_status = mysqli_query($con, $update_voter_status);
                                            if ($run_update_candidate_votes) {
                                                echo "<script> alert('vote successfull') </script>";
                                                echo "<script> window.open('cast-vote.php', '_self') </script>";
                                                
                                            }
                                        }
                                    
                                    ?>
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