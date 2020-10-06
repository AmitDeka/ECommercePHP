<?php require_once "userDataController.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AK | Forgot Password</title>

<link rel="stylesheet" href="styles/bootstrap.min.css">
<link rel="stylesheet" href="styles/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
</head>
<body>
<?php include './includes/top_header.php' ?>
<header>

</header>
<div class="container-fluid">
<div class="row no-gutters">
    <!-- Left Half -->
    <div class="col-md-6 d-none d-md-flex bg-image"></div>
    <!-- Right Half -->
    <div class="col-md-6 bg-light">
        <div class="logsign d-flex align-items-center py-5">
            <div class="container">
                <div class="row">
                    <div class=" col-lg-10 col-xl-7 mx-auto">
                        <h3 class=" display-4">Forgot Password</h3>
                        <p class=" text-muted mb-4">Enter your Email Address.</p>
                        
                        <form action="" method="POST" autocomplete="">
                        <?php
                            if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                        <?php
                        foreach($errors as $showerror){
                            echo $showerror;
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                        <div class=" form-group mb-3">
                            <input class="form-control rounded-pill border-0 shadow-sm px-4" type="email" name="email" placeholder="Enter Email Address" required value="<?php echo $email?>">
                            
                        </div>
                        
                        <button type="submit" class=" btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm " name="check-email">Continue</button>
                            <div class=" d-flex align-items-center mt-2">
                                Don't have an account ?&nbsp;<a href="signup.php">Sign Up</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>