<?php require_once "userDataController.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AssamKart</title>

<link rel="stylesheet" href="styles/bootstrap.min.css">
<link rel="stylesheet" href="styles/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
</head>
<body>
<?php include './includes/top_header.php' ?>
<header>

</header>
<div class="container-fluid fadeIn">
<div class="row no-gutters">
    <!-- Left Half -->
    <div class="col-md-6 d-none d-md-flex bg-image"></div>
    <!-- Right Half -->
    <div class="col-md-6 bg-light">
        <div class="logsign d-flex align-items-center py-5">
            <div class="container">
                <div class="row">
                    <div class=" col-lg-10 col-xl-7 mx-auto">
                        <h3 class="display-4">Create a Free</h3>
                        <p class="text-muted mb-4">AssamKart Account</p>
                        
                        <form action="signup.php" method="POST" autocomplete="off">
                        <?php
                if(count($errors) == 1){
                    ?>
                    <div class="alert alert-danger text-center">
                        <?php
                        foreach($errors as $showerror){
                            echo $showerror;
                        }
                        ?>
                    </div>
                    <?php
                }elseif(count($errors) > 1){
                    ?>
                    <div class="alert alert-danger">
                        <?php
                        foreach($errors as $showerror){
                            ?>
                            <li><?php echo $showerror; ?></li>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                        <div class=" form-group mb-3">
                            <input class="form-control rounded-pill border-0 shadow-sm px-4" type="text" name="name" placeholder="Full Name" required value="<?php echo $name?>">
                        </div>
                        <div class=" form-group mb-3">
                            <input class="form-control rounded-pill border-0 shadow-sm px-4" type="email" name="email" placeholder="Email Address" required value="<?php echo $email?>">
                            
                        </div>
                        <div class=" form-group mb-3">
                            <input class="form-control rounded-pill border-0 shadow-sm px-4" type="tel" name="phonenumber" placeholder="Phone Number" required >
                            
                        </div>
                        <div class=" form-group mb-3">
                            <input class="form-control rounded-pill border-0 shadow-sm px-4" type="password" name="password" placeholder="Password" required >
                            
                        </div>
                        <div class=" form-group mb-3">
                            <input class="form-control rounded-pill border-0 shadow-sm px-4" type="password" name="cpassword" placeholder="Confirm Password" required >
                            
                        </div>
                        <button type="submit" class=" btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm btnstyle" name="signup">Sign Up</button>
                            
                        <div class=" d-flex align-items-center mt-2">
                                Already have an account ?&nbsp;<a href="login.php">Log In</a>
                            </div>
                        </form>
                            <div class=" text-center d-flex justify-content-between mt-4">
                        <p>By proceeding to create your account and use AssamKart, you are agreeing to our <a href="https://assamkart.in/tos" class="font-italic text-muted"><u>Terms of Service</u></a>&nbsp;and&nbsp;<a href="https://assamkart.in/privacy" class="font-italic text-muted"><u>Privacy Policy</u></a>.</p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>