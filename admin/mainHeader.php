<?php 

session_start();
if (isset( $_SESSION['suid']) ) {
    include "dbc.php";
    $fetch = $pdo->prepare('SELECT * FROM account WHERE user_id=:depa AND user_type=:teach ');
    $fetch->bindValue(':depa',$_SESSION['suid']);
    $fetch->bindValue(':teach', 'Super');
    $fetch->execute();
    $hprofile = $fetch->fetch(PDO::FETCH_ASSOC);
?>


<html lang="en">
  <head>
  <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Super</title>


    <link href="css/sidebars.css?v=<?php echo time(); ?>" rel="stylesheet">
    <link href="css/all.min.css" rel="stylesheet" type="text/css">
        <link href="css/fontawesome.min.css" rel="stylesheet" type="text/css">
        
    <script src="js/jquery.min.js"></script>
    

<link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
      
    </style>

    
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css?v=<?php echo time(); ?>" rel="stylesheet">
  </head>
  <body>
    
  <header class="navbar navbar-dark sticky-top flex-md-nowrap p-2 shadow-lg  mb-3 " style="background: linear-gradient(to right, #8A2BE2, #B12DFC, #D93FFF);
  /* Use vendor prefixes for better browser compatibility */
  background: -moz-linear-gradient(left, #8A2BE2, #B12DFC, #D93FFF);
  background: -webkit-linear-gradient(left, #8A2BE2, #B12DFC, #D93FFF);
  background: linear-gradient(to right, #8A2BE2, #B12DFC, #D93FFF);">
  
  <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
          <img src="img/logod.png" alt="" width="47" height="44" style="border-radius:55%;" class="d-inline-block align-text-center">
          <span class="text-white fs-3 ms-3">Debark University</span>
        </a>
  <button class="text-white navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="text-white navbar-toggler-icon"></span>
  </button>
  
    <div class="dropdown px-5">
      <a href="#" class="d-flex align-items-center  text-white link-info text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="img/account/<?php echo $hprofile['photo'] ?>" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong><?php echo $hprofile['title'].' '.$hprofile['fname'] ?></strong>
      </a>
      <ul class="dropdown-menu text-small shadow ">
      <li><a class="dropdown-item" href="#">
      <span class="d-inline-block bg-success rounded-circle p-1"></span>
  
      Profile</a></li>
        <li><a class="dropdown-item" href="#">
        <span class="d-inline-block bg-warning rounded-circle p-1"></span>
        Change Password</a></li>  
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="session.php">
        <span class="d-inline-block bg-danger rounded-circle p-1"></span>  
        Sign out</a></li>
      </ul>
    </div>
  
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="shadow-lg  rounded col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column pp" >
          <li class="nav-item aa mb-2">
            
            <a class="nav-link mdash active " 
              
               href="mainDashboard.php" id="dash_b" name="navi"><span class="fa fa-home"></span> Dashboard</a>
            </a>
          </li>
          <li class="nav-item mb-2">
            <a class="nav-link dephead " name="navi" href="addHead.php" id="exam_b"><span class="fa fa-book"></span> Department Head
            </a>
          </li>
          <li class="nav-item mb-2">
            <a class="nav-link hrman " href="addHR.php" ><span class="fa fa-user"></span> HR Manager</a></li>
            </a>
          </li>
          <li class="nav-item mb-2">
            <a class="nav-link addRegistrar " href="addRegistrar.php" ><span class="fa fa-user"></span> Registrar</a></li>
            </a>
          </li>
          <li class="nav-item mb-2">
            <a class="nav-link " href="#" ><span class="fa fa-key"></span> Other</a></li>
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle" class="align-text-bottom"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text" class="align-text-bottom"></span>
              Current month
            </a>
          </li>

          <li class="border-top my-3"></li>
          
    
  </div>
        </ul>
        <div class="footer">
              <p>
              
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All Rights Reserved | Group 2
              </p>
              
            </div>
        
      </div>
      

    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-2">


      



    <script src="../js/bootstrap.bundle.min.js"></script>


















<?php
}else{
     header("Location: ../index.php");
     exit();
}
 ?>




