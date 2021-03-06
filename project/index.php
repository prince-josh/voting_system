<?php
include "connection.php";
session_start();
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
    <title>home page</title>
</head>
<body>
  <header id="page-top">
    <nav class="navbar navbar-b navbar-trans navbar-expand-md " id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll" href="index.html" id="logo">
          <img src="images/logo.png" alt="logo">
        </a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
          aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span><i class="fa fa-bars"></i></span>
        </button>
        <div class="navbar-collapse collapse justify-content-end" id="navbarDefault">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link js-scroll active" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll" data-toggle="modal" data-target="#loginModal">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll" data-toggle="modal" data-target="#registerModal">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll" href="#about-project">About Project</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Nav End -->
  </header>
  <main>
    <div class="banner">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="images/inecnigeria_123823277_835538700612169_8534466556559201133_n.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="images/gettyimages-1126895664-612x612.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="images/electoral-commission-officers-count-votes-at-shagari-health-unit-in-picture-id1126895045.jpg" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div><!--banner end-->

<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Voter Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="bg-danger">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="index.php" method="post">
          <div class="form-group">
            <label for="voterID"> PVC:</label>
            <input type="text" name="pvc" class="form-control" required placeholder="enter your personal voting code">
          </div>

          <div class="form-group">
            <label for="password"> Password:</label>
            <input type="password" name="password" class="form-control" required placeholder="enter your password">
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" name="login">Submit</button>
      </div>
        </form>
        <?php
          if (isset($_POST['login'])) {
            $pvc = mysqli_real_escape_string($con, $_POST['pvc']);
            $pass = mysqli_real_escape_string($con, $_POST['password']);
            $select = "select * from voters where voters_id = '$pvc'";
            $run = mysqli_query($con, $select);
            $row = mysqli_fetch_assoc($run);
            $p = $row['password'];
            $NIN = $row['NIN'];

            if (mysqli_num_rows($run) === 0) {
              echo "<script> alert(' This PVC not registered to any user')</script>";
            }
            
             if (!password_verify($pass, $p)) {
               echo "<script> alert('incorrect password')</script>";
             }
             if (mysqli_num_rows($run) !== 0 && password_verify($pass, $p)) {
              $_SESSION['nin'] = $NIN;
              echo "<script> alert('login succesful') </script>";
              echo "<script> window.open('profile.php', '_self') </script>";
             }
          }
        ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Voter Registration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="index.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="firstname"> First name:</label>
            <input type="text" name="firstname" class="form-control" required placeholder="enter your first name">
          </div>

          <div class="form-group">
            <label for="middle-name"> Middle Name:</label>
            <input type="text" name="middlename" class="form-control" required placeholder="enter your middle name">
          </div>

            <div class="form-group">
              <label for="last-name"> Lastname:</label>
              <input type="text" name="lastname" class="form-control" required placeholder="enter your last name">
            </div>

            <div class="form-group">
              <label for="age"> Age:</label>
              <input type="date" name="age" class="form-control" required placeholder="enter your age as at last birthday">
            </div>

            <div class="form-group">
              <label for="Passport"> Password:</label>
              <input type="password" name="pass" class="form-control" required placeholder="enter password">
            </div>

            <div class="form-group">
              <label for="comfirm password"> Comfirm Password:</label>
              <input type="password" name="comfirm-pass" class="form-control" required placeholder="comfirm password">
            </div>

            <div class="form-group">
              <label for="address"> Address:</label>
              <textarea name="address" id="" cols="30" rows="10" required class="form-control" placeholder="enter home address"></textarea>
            </div>

            <div class="form-group">
              <label for="surname"> State Of Residence:</label>
              <select name="state-of-residence" id="" class="form-control" required>
                <option value="">select state</option>
                <option value="Abia">Abia</option>
                <option value="Adamawa">Adamawa</option>
                <option value="Akwa Ibom">Akwa Ibom</option>
                <option value="Anambra">Anambra</option>
                <option value="Bauchi">Bauchi</option>
                <option value="Bayesa">Bayesa</option>
                <option value="Cross River"> Cross River</option>
                <option value="Delta">Delta</option>
                <option value="Ebonyi">Ebonyi</option>
                <option value="Edo">Edo</option>
              </select>
            </div>

            <div class="form-group">
              <label for="LGA Of Residence"> Local Government Area of Residence:</label>
              <input type="text" name="LGA-of-residence" class="form-control" required placeholder="enter your LGA of Residence">
            </div>

            <div class="form-group">
              <label for="state of origin"> State Of origin:</label>
              <select name="state-of-origin" id="" class="form-control" required>
                <option value="">select state</option>
                <option value="Abia">Abia</option>
                <option value="Adamawa">Adamawa</option>
                <option value="Akwa Ibom">Akwa Ibom</option>
                <option value="Anambra">Anambra</option>
                <option value="Bauchi">Bauchi</option>
                <option value="Bayesa">Bayesa</option>
                <option value="Cross River"> Cross River</option>
                <option value="Delta">Delta</option>
                <option value="Ebonyi">Ebonyi</option>
                <option value="Edo">Edo</option>
              </select>
            </div>

            <div class="form-group">
              <label for="LGA of origin"> Local Government Area of origin:</label>
              <input type="text" name="LGA-of-origin" class="form-control" required placeholder="enter your LGA of origin">
            </div>

            <div class="form-group">
              <label for="NIN"> NIN:</label>
              <input type="number" name="nin" class="form-control" required placeholder="enter your NIN">
            </div>

            <div class="form-group">
              <label for="Passport"> Passport:</label>
              <input type="file" name="passport" class="form-control" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="register">Submit</button>
            </div>
        </form>
      </div>
      <?php
if (isset($_POST['register'])) {
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($con, $_POST['middlename']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $comfirm_pass = mysqli_real_escape_string($con, $_POST['comfirm-pass']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $state_of_residence = mysqli_real_escape_string($con, $_POST['state-of-residence']);
    $LGA_of_residence = mysqli_real_escape_string($con, $_POST['LGA-of-residence']);
    $state_of_origin = mysqli_real_escape_string($con, $_POST['state-of-origin']);
    $LGA_of_origin = mysqli_real_escape_string($con, $_POST['LGA-of-origin']);
   $NIN = mysqli_real_escape_string($con, $_POST['nin']);
   $passport = $_FILES["passport"]["name"];
   $tmp_name = $_FILES["passport"]["tmp_name"];
    

    if ($pass !== $comfirm_pass ) {
        echo "
        <div class='alert alert-danger'>
        passwords dont match
        </div>
        ";
    }
    if (strlen($pass) < 8) {
        echo "
        <div class='alert alert-danger'>
        passwords must be eight characters or longer
        </div>
        ";
    }
   /* $select = "select * from voters";
    $runSelect = mysqli_query($con, $select);
    if (mysqli_num_rows($select) > 1) {
      echo "
      <div class='alert alert-danger'>
      NIN already exist
      </div>
      ";
    }*/
    if(strlen($pass) >= 8 && $pass === $comfirm_pass){
        $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
       move_uploaded_file($tmp_name, 'voters_images/'.$passport);
        //generate voters id
		$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$voterID = substr(str_shuffle($set), 0, 15);

       $insert = "insert into voters (voters_id, first_name, middle_name, last_name, age, password, address, state_of_residence, LGA_of_residence, state_of_origin, LGA_of_origin, NIN, passport, date_registerd) values ('$voterID', '$firstname', '$middlename', '$lastname', '$age', '$pass_hash', '$address', '$state_of_residence', '$LGA_of_residence', '$state_of_origin', '$LGA_of_origin', '$NIN', '$passport', NOW())";
        $run = mysqli_query($con, $insert);
        if ($run) {
          $_SESSION['nin'] = $NIN;
          echo "<script> alert('registration succesful') </script>";
            echo "<script> window.open('profile.php' , '_self') </script>";
            
        }else{
            echo"didnt work";
        }
    }
}
?>
    </div>
  </div>
</div>
    <section class="welcome container mt-3">
      <h2><span><span class="style2"><SCRIPT LANGUAGE="JavaScript">
        var d = new Date();
        var h = d.getHours();
        if (h < 2) document.write("Good morning! Yes, it's way past midnight.");
        else if (h < 3) document.write("Good morning! Up early or working late?");
        else if (h < 7) document.write("Good morning! Up bright and early!");
        else if (h < 12) document.write("Good morning!");
        else if (h < 17) document.write("Good afternoon!");
        else if (h < 23) document.write("Good evening!");
        else document.write("A late good evening! Not much left of it now.");
        //  End -->
        </script>
           | Welcome</span></span></h2>
    </section>
    <div class="content container">
    <section class="about-inec container">
                <p>The Independent National Electoral Commission (INEC) was established by the 1999 Constitution of the Federal Republic of Nigeria to among other things organize elections into various political offices in the country.</p>
                <p>The functions of INEC as contained in Section 15, Part 1 of the Third Schedule of the 1999 Constitution (As Amended) and Section 2 of the Electoral Act 2010 (As Amended) include the following:</p>
                <p>??</p>
                <ol>
                  <li>??Organise, undertake and supervise all elections to the offices of the President and Vice-President, the Governor and Deputy Governor of a State, and to the membership of the Senate, the House of Representatives and the House of Assembly of each state of the federation;</li>
                  <li>Register political parties?? in accordance with the provisions of the constitution and Act of the National Assembly;</li>
                  <li>Monitor the organization and operation of the political parties, including their finances; conventions, congresses and party primaries.</li>
                  <li>Arrange for the annual examination and auditing of the funds and accounts of political parties, and publish a report on such examination and audit for public information;</li>
                  <li>Arrange and conduct the registration of persons qualified to vote and prepare, maintain and revise the register of voters for the purpose of any election under this constitution;</li>
                  <li>Monitor political campaigns and provide rules and regulations which shall govern the political parties;</li>
                  <li>Conduct voter and civic education;</li>
                  <li>Promote knowledge of sound democratic election processes; and</li>
                  <li>Conduct any referendum required to be conducted pursuant to the provision of the 1999 Constitution or any other law or Act of the National Assembly.</li>
                </ol>
                <p><strong>MISSION STATEMENT</strong></p>
                <p>The mission of INEC is to serve as an independent and effective EMB committed to the conduct of free, fair and credible elections for sustainable democracy in Nigeria.</p>
                <p><strong>VISION STATEMENT</strong></p>
                <p>The vision of INEC is to be one of the best Election Management Bodies (EMB) in the world that meets the aspirations of the Nigerian people.</p>
                <p><strong></strong><strong>VALUES</strong></p>
                <p>INEC shall be guided by the following values in the performance of its duties:</p>
                <ol>
                  <li>??<strong>Autonomy:</strong>??INEC shall carry out all its functions independently, free from external control and influence.</li>
                  <li><strong>Transparency:</strong>??INEC shall display openness and transparency in all its activities and in its relationship with all stakeholders.</li>
                  <li><strong>Integrity:??</strong>INEC shall maintain truthfulness and honesty in all its dealings at all times</li>
                  <li><strong>Credibility:??</strong>INEC shall ensure that no action or activity is taken in support of any candidate or political party.</li>
                  <li><strong>Impartiality:</strong>??INEC shall ensure the creation of a level playing field for all political actors.</li>
                  <li><strong>Dedication:??</strong>INEC shall be committed to providing quality electoral services efficiently and effectively, guided by best international practice and standards</li>
                  <li><strong>Equity:??</strong>INEC shall ensure fairness and justice in dealing with all stakeholders.</li>
                  <li><strong>Excellence:??</strong>INEC shall be committed to the promotion of merit and professionalism as the basis for all its actions.</li>
                  <li><strong>Team work</strong><strong>:</strong>??INEC shall create a conducive environment that promotes teamwork among its staff at all levels.        </li>
                </ol>
          </section>
          <aside class="sideber">
              <div class="gadget">
                <h2 class="star"><span>Sidebar</span> Menu</h2>
                <ul class="sb_menu">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="register.php">Register Voter</a></li>
               
                  <li><a href="admin/index.php">Administrator</a></li>
                </ul>
                </div>
              <div class="gadget">
                <h2 class="star"><span>News Update</span></h2>
                <ul class="ex_menu">
                  <li><a href="http://www.dreamtemplate.com" title="Website Templates">Voter's Registration</a><br />
                  The Registers of Voters are now on the website, for intending voters to check their status before Election Day. The registers will be updated after the Continuous Voter Registration (CVR) .</li>
                  <li><a href="http://www.templatesold.com" title="WordPress Themes">The Electoral Institute (TEI)</a><br />
                  The Electoral Institute (TEI) is an organ of the Independent National Electoral Commission responsible for training and electoral research</li>
                  <li><a href="http://www.imhosted.com" title="Affordable Hosting">eTRAC </a><br />
                  eTRAC is an INEC Transparency Project, building trust through Transperency by making signed Polling Unit Result Sheets as pasted at the Polling Unit available.</li>
                  <li></li>
                </ul>
              </div>
      </aside>
      </div><!--content end-->
          <section id="about-project" style="background-image: url('images/nigerian-flag-picture-id182790719.jpg');">
            <div class="about-project-content container">
            <div>
              <h2>About The Project</h2>
              <p>The Registers of Voters are now on the website, 
                for intending voters to check their status before Election Day. 
                The registers will be updated after the Continuous Voter Registration (CVR). 
                The main aim of this project is to develop an online voters registration and voting platform.</p>
            </div>
            <center>We currently have <span id="num-of-voters">500</span> voters registered on this platform</center>
          </div>
            </section>
        </main>
        <footer>
          <div class="fcontent container">
            <p class="lf">&copy; Copyright 2021</p>
            <ul class="fmenu">
              <li><a href=""> Home</a></li>
              <li><a href="">Register</a></li>
              <li><a href="">Login</a></li>
            </ul>
          </div>
        </footer>
      </div>
      
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
</body>
</html>