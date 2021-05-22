<?php
  include '../connection.php';
  session_start()
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
<link href="../css/login.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/main.css"/>
<link rel="stylesheet" href="../assets/css/theme1.css"/>
    <title>admin - login</title>
</head>
<body class="font-montserrat">
  <!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div>
<header id="page-top">
    <nav class="navbar navbar-b navbar-trans navbar-expand-md " id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll" href="index.html" id="logo">
          <img src="../images/logo.png" alt="logo">
        </a>
      </div>
    </nav>
    <!-- Nav End -->
  </header>
  <main>
      <div class="title">
          <h2>Admin Login</h2>
      </div>
      <div class="form">
          <form action="login.php" method="post">
              <div class="form-group">
                  <label for="username">Username:</label>
                  <input type="text" required name="uname" class="form-control">
              </div>

              <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" required name="pass" class="form-control">
              </div>
              <div class="form-group">
                <input type="submit" value="Submit" class="btn btn-primary" name="submit">
              </div>
          </form>
          <?php
            if (isset($_POST['submit'])) {
              $u_name = mysqli_real_escape_string($con, $_POST['uname']);
              $pass = mysqli_real_escape_string($con, $_POST['pass']);

              $sel = "select * from admin";
              $run = mysqli_query($con, $sel) or die('could not connect to DB');
              $row = mysqli_fetch_assoc($run);
              $u = $row['username'];
              $p = $row['password'];

              if ($u_name !== $u) {
                echo "<div class='alert alert-danger'>
                <p> invalid username </p>
                </div>";
              }

              if ($pass !== $p) {
                echo "<div class='alert alert-danger'>
                <p> Password not correct </p>
                </div>";
              }

              if ($pass === $p && $u_name === $u) {
                $_SESSION['username'] = $u_name;
                echo "<script> alert('login successful') </script>";
                echo "<script> window.open('index.php', '_self') </script>";
              }

            }
          ?>
      </div>
  </main>

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