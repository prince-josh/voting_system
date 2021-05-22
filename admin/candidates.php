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
    <title>candidate - page</title>
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

     //get all candidates info
     $sel_all_candidates = "select * from candidates";
     $run = mysqli_query($con, $sel_all_candidates);
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
                        <h1 class="page-title">Candidates List</h1>                        
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
                <div class="add-candidate mb-2">
                    <button class="btn btn-primary" data-toggle = "modal" data-target="#addCandidate"><i class="fa fa-plus"> Add</i></button>
                 </div>
                 <!-- Modal -->
<div class="modal fade" id="addCandidate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Candidate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="candidates.php" method="post" enctype = "multipart/form-data">
          <div class="form-group">
            <label for="voterID"> First Name:</label>
            <input type="text" name="fname" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="password"> Last Name:</label>
            <input type="text" name="lname" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="password"> Political Party:</label>
            <input type="text" name="political_party" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="password"> Passport:</label>
            <input type="file" name="passport" class="form-control" required>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" name="add">Submit</button>
      </div>
        </form>
        <?php
          if (isset($_POST['add'])) {
            $f_name = mysqli_real_escape_string($con, $_POST['fname']);
            $l_name = mysqli_real_escape_string($con, $_POST['lname']);
            $pp = mysqli_real_escape_string($con, $_POST['political_party']);
            $c_passport = $_FILES["passport"]["name"];
            $c_tmp_name = $_FILES["passport"]["tmp_name"];

            move_uploaded_file($c_tmp_name, '../candidate_images/'.$c_passport);
    
           $insert_candidate = "insert into candidates (firstname, lastname, passport, party, num_of_votes) values ('$f_name', '$l_name', '$c_passport', '$pp', '0')";
            $run_insert = mysqli_query($con, $insert_candidate);
            if ($run_insert) {
              //$_SESSION['nin'] = $NIN;
              echo "<script> alert('added succesfully') </script>";
                echo "<script> window.open('candidates.php' , '_self') </script>";
            }
        }
            ?>
      </div>
    </div>
  </div>
</div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Candidates</h3>
                            </div>
                            
                            <div class="card-body">
                                <div id="table">
                                  <center><table class = "table table-responsive" border="1">
                                        <tr>
                                            <th>S/N</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Passport</th>
                                            <th>Party</th>
                                            <th>Total Votes</th>
                                        </tr>
                                        <tr>
                                            <?php
                                            
                                            while ($row = mysqli_fetch_assoc($run)) {
                                                $id = $row['id'];
                                                $fn = $row['firstname'];
                                                $ln = $row['lastname'];
                                                $passport = $row['passport'];
                                                $party = $row['party'];
                                                $total_votes = $row['num_of_votes'];
                                                // $num_of_candiates = mysqli_num_rows($run);
                                                // for ($i=0; $i < $num_of_candiates ; $i++) { 
                                                //     # code...
                                                // }
                                            
                                            ?>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $fn; ?></td>
                                            <td><?php echo $ln; ?></td>
                                            <td><img src="../candidate_images/<?php echo $passport; ?>" alt="candidate passport" height='50' width='50'></td>
                                            <td><?php echo $party;?></td>
                                            <td><?php echo $total_votes; ?></td>
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