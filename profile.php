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
        $fn = $row['first_name'];
        $pvc = $row['voters_id'];
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
    <title>profile</title>
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
              <a class="nav-link js-scroll" href="logout.php"> Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Nav End -->
  </header>
    <main class="container">
    <section class="welcome mt-3">
      <h2><span><span class="style2">
          <?php echo "your PVC is ".$pvc;?>
        <SCRIPT LANGUAGE="JavaScript">
        var d = new Date();
        var h = d.getHours();
        if (h < 2) document.write("Good morning! <?php echo $fn; ?> Yes, it's way past midnight.");
        else if (h < 3) document.write("Good morning! <?php echo $fn; ?> Up early or working late?");
        else if (h < 7) document.write("Good morning! <?php echo $fn; ?> Up bright and early!");
        else if (h < 12) document.write("Good morning! <?php echo $fn; ?>");
        else if (h < 17) document.write("Good afternoon! <?php echo $fn; ?>");
        else if (h < 23) document.write("Good evening! <?php echo $fn; ?>");
        else document.write("A late good evening! <?php echo $fn; ?>, Not much left of it now.");
        //  End -->
        </script>
           | Welcome</span></span></h2>
    </section>
    <section class = "heading">
        <center><h2>Voting Poll</h2></center>
    </section>
    <section class = "main container">
        
    </section>
    </main>

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
<?php } ?> 