<?php require_once "userDataController.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AssamKart Login Now</title>

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
<h3 class=" display-4">Login Now</h3>
<?php 
if(isset($_SESSION['info'])){
?>
<div class="alert alert-success text-center">
<?php echo $_SESSION['info']; ?>
</div>
<?php
}
?>
<form action="login.php" method="POST">

<button type="submit" class=" btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm " name="loginnow">Login Now</button>

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