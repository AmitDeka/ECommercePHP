<?php
session_start();
require "./includes/config.php";
$email = "";
$name = "";
$errors = array();

// Press signup
if(isset($_POST['signup'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phoneno = mysqli_real_escape_string($con, $_POST['phonenumber']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password !== $cpassword){
        $errors['password'] = "Confirm password doesn't matched!";
    }
    $email_check = "SELECT * FROM akuser WHERE email ='$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "NotVerified";
        $insert_data = " INSERT INTO akuser(name, email, phone, password, code, status) 
                        values('$name','$email','$phoneno','$encpass','$code','$status')";
        $data_check = mysqli_query($con, $insert_data);
        if($data_check){
            $subject ="Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: assamkart20@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: email-verification.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code !";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database !";
        }               
    }
}
// when user click verification code submit
if(isset($_POST['check'])){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM akuser WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $code = 0 ;
        $status = 'verified';
        $update_otp = "UPDATE akuser SET code = $code, status = '$status' WHERE code= $fetch_code";
        $update_res = mysqli_query($con, $update_otp);
        if($update_res){
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header('location: index.php');
            exit();
        }else{
            $errors['otp-error'] = "Failed while updating code !";
        }
    }else{
        $errors['otp-error'] = "You've entered an incorrect code !";
    }
}

// when click login button
if(isset($_POST['login'])){
    $email = mysqli_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $check_email = "SELECT * FROM akuser WHERE email ='$email'";
    $res = mysqli_query($con, $check_email);
    if(mysqli_num_rows($res) > 0){
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['password'];
        if(password_verify($password, $fetch_pass)){
            $_SESSION['email'] = $email;
            $status = $fetch['status'];
            if($status== 'verified'){
                $_SESSION['email'] = $email;
                header('location: index.php');
            }else{
                $info = "It's looks like you still haven't still verify your email - $email";
                $_SESSION['info'] = $info;
                header('location: email-verification.php');
            }
        }else{
            $errors['email'] = "Incorrect Email or Password !";
        }
    }else{
        $errors['email'] = "It's look like you're not yet a member ! Click on the bottom link to Sign Up.";
    }
}

// when user click continue in forgot password
if(isset($_POST['check-email'])){
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $check_email = "SELECT * FROM akuser WHERE email='$email'";
    $run_sql = mysqli_query($con, $check_email);
    if(mysqli_num_rows($run_sql) > 0){
        $code = rand(999999,111111);
        $insert_code = "UPDATE akuser SET code = $code where email = '$email'";
        $run_query = mysqli_query($con, $insert_code);
        if($run_query){
            $subject = "Password Reset Code";
            $message = "Your Password reset code is $code";
            $sender = "From: assamkart20@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a password reset otp to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: resetpassword.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending the code !";
            }
        }else{
            $errors['db-error'] = "Something went wrong !";
        }
    }else{
        $errors['email'] = "This email doesn't exist in our Database !";
    }
}
// when user click submit on change pass otp
if(isset($_POST['check-pass-reset-otp'])){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = " SELECT * FROM akuser WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $fetch_code = $fetch_data['code'];
        $email = $fetch_data['email'];
        $code = 0;
        $status = 'verified';
        $update_otp = "UPDATE akuser SET code = $code, status = '$status' WHERE code = $fetch_code";
        $update_res = mysqli_query($con, $update_otp);
        if($update_res){
            $_SESSION['email'] = $email;
            $info = " Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: update-password.php');
            exit();
        }else{
            $errors['otp-error'] = "Failed while updating code !";
        }
    }else{
        $errors['otp-error'] = "You've entered an incorrect code !";
    }
}
if(isset($_POST['change-password'])){
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched !";
    }else{
        $code = 0;
        $email = $_SESSION['email'];
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE akuser SET code = $code, password = '$encpass' WHERE email ='$email'";
        $run_query = mysqli_query($con, $update_pass);
        if($run_query){
            $info = "Your password has been changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('location: loginnow.php');
        }else{
            $errors['db-error'] = "Failed to change password !";
        }
    }
}
 if(isset($_POST['loginnow'])){
     header('location: login.php');
 }
?> 