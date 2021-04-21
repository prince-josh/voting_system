<?php
include "connection.php";
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
    
    $passport = $_FILES['passport']['name'];
    $tmp_name = $_FILES['passport']['tmp_name'];
    

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
    if(!empty($passport) && strlen($pass) >= 8 && $pass === $comfirm_pass){
        $pass_hash = password_hash($pass, PASSWORD_BCRYPT);
        move_uploaded_file($tmp_name, 'voters_images/'.$passport);
        //generate voters id
		$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$voterID = substr(str_shuffle($set), 0, 15);

        $insert = "insert into voters(voters_id, first_name, middle_name, last_name, age, password, address, state_of_residence, LGA_of_residence, state_of_origin, LGA_of_origin, passport, date_registerd) values ('$voterID', '$firstname', '$middlename', '$lastname', '$age', '$pass_hash', '$address', '$state_of_residence', '$LGA_of_residence', '$state_of_origin', '$LGA_of_origin' '$passport', NOW())";
        $run = mysqli_query($con, $insert);
        if ($run) {
            header("location: profile.php");
        }else{
            echo"didnt work";
        }
    }
}
?>