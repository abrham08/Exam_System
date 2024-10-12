<?php 

session_start();
if (isset($_SESSION['tuid'])) {
    include "dbc.php";
    
    $photo='';
    $tit='';
    $fname='';
    $fetch = $pdo->prepare('SELECT * FROM account WHERE user_id=:depa AND user_type=:teach ');
    $fetch->bindValue(':depa', $_SESSION['tuid']);
    $fetch->bindValue(':teach', 'Teacher');
    $fetch->execute();
    $hprofile = $fetch->fetch(PDO::FETCH_ASSOC);
    $photo=$hprofile['photo'];
    $tit= $hprofile['title'];
    $fname=$hprofile['fname'];
?>


<html lang="en">
  <head>
  <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <title>Teacher</title>


    <link href="css/sidebars.css" rel="stylesheet">
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
      <img src="img/account/<?php echo $photo ?>" alt="" width="40" height="42" class="rounded-circle me-2">
      <strong><?php echo $tit.' '.$fname ?></strong>
      </a>
      <ul class="dropdown-menu text-small shadow ">
      <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change_profile" href="#">
      <span class="d-inline-block bg-success rounded-circle p-1"></span>
  
      Profile</a></li>
      <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change_password" href="#">
                  <span class="d-inline-block bg-warning rounded-circle p-1"></span> Change Password</a></li> 
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
            
            <a class="nav-link active " 
              
               href="t_dashboard" id="dash_b" name="navi"><span class="fa fa-home"></span> Dashboard</a>
            </a>
          </li>
          <li class="nav-item mb-2">
            <a class="nav-link uexam" name="navi" href="tHome" id="dash_b"><span class="fa fa-book"></span> Exam
            </a>
          </li>
          <!-- <li class="nav-item mb-2">
            <a class="nav-link " href="#" ><span class="fa fa-clock"></span>Schedule </a></li>
            </a>
          </li> -->
          <li class="nav-item mb-2">
            <a class="nav-link propro" href="exam_login" ><span class="fa fa-user"></span> Proctor Exam</a></li>
            </a>
          </li>
          <li class="nav-item mb-2">
            <a class="nav-link " href="#" ><span class="fa fa-key"></span> Other</a></li>
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span></span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle" class="align-text-bottom"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text" class="align-text-bottom"></span>
              
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
      <!-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar" class="align-text-bottom"></span>
            This week
          </button>
        </div>
      </div> -->

           
 <!-- Modal -->
 <div class="modal fade" id="change_password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="schange_password" method="post" class="was-validated">
              <div id="response"></div>
              <input type="hidden" value="<?php echo $_SESSION['tuid'] ?>" id="userid">
              <div class="mb-3">
                <label for="old_password" class="form-label">Old Password</label>
                <input name="old_password" class="form-control is-invalid" id="old_password" placeholder="Old Password " required>

              </div>
              <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input name="new_password" class="form-control example4 mb-3" id="new_password" placeholder="New Password " required>
                <div class="form-group mg-b-pass">
                  <span class="font-bold pwstrength_viewport_verdict4"></span>
                  <span class="pwstrength_viewport_progress4"></span>
                </div>
              </div>
              <div class="mb-3">
                <label for="Confirm_password" class="form-label">Confirm New Password</label>
                <input class="form-control is-invalid" name="Confirm_password" id="Confirm_password" placeholder="Confirm New Password " required>

              </div>





          </div>
          <div  class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="change_p btn btn-primary">Change</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <!----Modal_End---->

  <!-- Modal -->
  <div class="modal fade" id="change_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Profile</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="schange_password" action="#" method="post" class="was-validated" enctype="multipart/form-data">
              <div id="response"></div>
              <input type="hidden" value="<?php echo $_SESSION['tuid'] ?>" name="userid" id="userid">
              <input type="hidden" value="<?php echo $hprofile['photo'] ?>" name="userphoto" id="userphoto">
              <div class="mb-3">

              <div class="text-center">
            <div class="d-flex flex-column align-items-center">
              <img src="img/account/<?php echo $hprofile['photo'] ?>" alt="" width="160" height="172" class="rounded-circle me-2">
              <strong class="mt-2"><?php echo $hprofile['title'].' '.$hprofile['fname'].' '.$hprofile['lname']?></strong>
            </div>
          </div>



              </div>
              <div class="mb-3">
                <label for="new_photo" class="fs-4 form-label">New Photo</label>
                <input type="file" name="new_photo" class="form-control example4 mb-3" id="new_photo" placeholder="New Photo ">
          
              </div>
             
          </div>
          <div  class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="changepp" class="change_p btn btn-primary">Change</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <?php
   if (isset($_POST['changepp'])) {
    $photop = $_POST['userphoto'];
    $userid = $_POST['userid'];
    $photo = $_FILES['new_photo'] ?? null;
    $accept = ["jpg", "jpeg", "png", "gif", "webp", null];
    $photo_name = '';

    if ($photo != null) {
        $ext = strtolower(pathinfo($_FILES["new_photo"]["name"], PATHINFO_EXTENSION)) ?? null;
        if (in_array($ext, $accept)) {
            $directory = 'img/account/';
            $filenameWithoutExtension = $photop;
            $files = glob($directory . $filenameWithoutExtension);
            if (!empty($files)) {
                $fileToDelete = $files[0];
                if (is_file($fileToDelete)) {
                    unlink($fileToDelete);
                }
            }
            $photo_name = $userid . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
            // Upload photo to server
            $target_dir = 'img/account/';
            $target_file = $target_dir . $photo_name;
            move_uploaded_file($photo['tmp_name'], $target_file);

            $snewmy = $pdo->prepare("UPDATE account SET photo = :photo WHERE user_id = :uiiid");
            $snewmy->bindValue(':uiiid', $userid);
            $snewmy->bindValue(':photo', $photo_name);
            $snewmy->execute();
        }
    } else {
        $photo_name = $photop;
    }
}

    ?>

    <!----Modal_End---->

    



    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="js/pwstrength-bootstrap.min.js"></script>
    <script src="js/zxcvbn.js"></script>
    <script src="js/password-meter-active.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '.change_p', function() {

        var user_id = document.forms["schange_password"]["userid"].value;
        var old_pass = document.forms["schange_password"]["old_password"].value;
        var new_password = document.forms["schange_password"]["new_password"].value;
        var conf_pass = document.forms["schange_password"]["Confirm_password"].value;

        if (new_password != conf_pass) {
          $('#response').html('<div class="alert alert-danger">Passwords does not match.</div>');
          return;
        }
        if (new_password.length < 10) {
          $('#response').html('<div class="alert alert-danger"> Password must be at least 10 characters long.</div>');
          return;
        }


        var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;
        if (!regex.test(new_password)) {
          $('#response').html('<div class="alert alert-danger">Password must contain at least one uppercase letter, one lowercase letter, and one digit.</div>');
          return;
        }
        $.ajax({
          url: "change_password.php",
          method: "POST",
          data: {
            user_id: user_id,
            old_pass: old_pass,
            new_password: new_password,
            conf_pass: conf_pass,
            page: 'back',
            action: 'head_pass'
          },
          success: function(data) {
            $('#response').html(data);

          }
        })



      });
    });
  </script>








    <script>
    // Set the timer to 3 minutes
    var timer = setTimeout(function() {
      // Redirect to the logout page
      window.location.href = 'session.php';
    }, 45 * 60 * 1000);

    // Reset the timer on any activity
    document.addEventListener('mousemove', function() {
      clearTimeout(timer);
      timer = setTimeout(function() {
        window.location.href = 'session.php';
      }, 45 * 60 * 1000);
    });
    window.onunload = function() {
      window.location.href = 'session.php';
    };
  </script>






<?php
}else{
     header("Location: ../index.php");
     exit();
}
 ?>




