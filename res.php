<?php
include "dbc.php";


$mn=0;
$fetch = $pdo->prepare('SELECT * FROM notice WHERE type=:type ORDER BY date ASC ');
$fetch->bindValue(':type', 0);
$fetch->execute();
$cat = $fetch->fetchAll(PDO::FETCH_ASSOC);
if(count($cat)>0){
  $mn=1;
  $fetch = $pdo->prepare('SELECT * FROM notice WHERE type=:type AND stat=:stat  ORDER BY date ASC LIMIT 2 ');
  $fetch->bindValue(':type', '1');
  $fetch->bindValue(':stat', '1');
  $fetch->execute();
  $catp = $fetch->fetchAll(PDO::FETCH_ASSOC);
}
else{
$fetch = $pdo->prepare('SELECT * FROM notice WHERE type=:type AND stat=:stat  ORDER BY date ASC LIMIT 3 ');
$fetch->bindValue(':type', '1');
$fetch->bindValue(':stat', '1');
$fetch->execute();
$catp = $fetch->fetchAll(PDO::FETCH_ASSOC);
}

?>
<head>
    <link href="navi.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link href="admin/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="admin/css/fontawesome.min.css" rel="stylesheet" type="text/css">
    <style>.minu:hover{transition:0.81s;transform:scale(1.2); z-index: 1;}
    .ccm::-webkit-scrollbar {
        width: 8px;
        height: 0px;
    }

    .ccm::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .ccm::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 5px;
    }

    .ccm::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Adjust the height of the container */
    .ccm {
        height: 410px;
        overflow-y: scroll;
    }
  </style>
    <script src="js/bootstrap.bundle.min.js"></script>

</head>


<body>
<!-- Demo header-->
<section class="py-1 header text-center" >
    <div class="container py-0 text-white" >
        <header class="py-0" >
            <div class=" shadow-lg  bg-body rounded" >

                <div class=" " >
                  <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner ccm"  style="overflow: auto;">

                    <?php if(count($cat)>0 || count($catp)>0):?>
                    <?php if($mn==0):?>


                      <?php foreach ($catp as $cap) : ?>
                        <div class="carousel-item   active <?php echo $cap['nid'] ?>" data-bs-interval="5000">
                          <img src="admin/<?php echo $cap['notice'] ?>" style="width: 703px;height: 410px;" class="d-block w-100 <?php echo $cap['nid'] ?>" alt="...">
                          <div class="carousel-caption d-none d-md-block ">
                            <h5>DKU</h5>
                          </div>
                        </div>
                      <?php endforeach; ?>





                     <?php else:?>
                      <?php foreach ($cat as $capn) : ?>
                        <div class="carousel-item  active <?php echo $capn['nid'] ?>" data-bs-interval="60000">
                        
                        <span style="width: 703px;height: 410px;"  class="text-black  d-block  <?php echo $capn['nid'] ?>">
                        <?php //echo $capn['notice'] ?>
                      </span>
                          
                      <div style="text-align: justify; width: auto; max-height: 410px; " class="carousel-caption d-block pr-3">
                        <span class="mr-3"><?php echo $capn['notice']; ?>.</span>
                    </div>


                        <h5>DKU</h5>
                        </div>
                      <?php endforeach; ?>

                      <?php foreach ($catp as $cap) : ?>
                        <div class="carousel-item   <?php echo $cap['nid'] ?>" data-bs-interval="5000">
                          <img src="admin/<?php echo $cap['notice'] ?>" style="width: 703px;height: 410px;" class="d-block w-100 <?php echo $cap['nid'] ?>" alt="...">
                          <div class="carousel-caption d-none d-md-block ">
                            <h5><?php echo $cap['description'] ?></h5>
                          </div>
                        </div>
                      <?php endforeach; ?>

                    <?php endif;?>
                    <?php endif;?>

                    </div>
                    <button class="carousel-control-prev"  type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button style="margin-right: 10px;" class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
        
                  <!-------------------------------------------
                <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                                  <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                  </div>
                                  <div class="carousel-inner">
                                    <?php //foreach (//$cat as $ca) : ?>
                                    <div class="carousel-item active" >
                                      <video  style="width: 703px;height: 420px;" controls="autoplay" ><source src="admin/<?php echo $ca['notice']; ?>" type="video/mp4"></video>
                                      <div class="carousel-caption d-none d-md-block">
                                        <h5>ASTC</h5>
                                        
                                      </div>
                                    </div>
                                    <?php //endforeach; ?>
                                  </div>
                                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                  </button>
                                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                  </button>
                                </div>--->
                </div>
        
        
        
        
        
              </div>
        </header>
    </div>
</section>


<!-- Sticky navbar-->
<header class="header sticky-top">
    <nav class="navbar navbar-expand-lg" id="ftco-navbar">
      <div class="container d-flex justify-content-between">
        <div class="d-flex align-items-center">

          <a href="/" class="navbar-brand d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <img src="admin/img/logod.png" alt="" width="47" height="44" style="border-radius:55%;" class="d-inline-block align-text-center">
            <span class="text-white fs-3 ms-3">Debark University</span>
          </a>


          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span> Menu
          </button>
        </div>
        <div class="collapse navbar-collapse mx-1" id="ftco-nav">
          <ul class="navbar-nav ml-auto mr-md-3">
            <li class="hover-effect-3  nav-item "><a href="index" class="m fs-4 nav-link active">Home</a></li>
            <li class="hover-effect-3 nav-item"><a href="about" class="m fs-4  nav-link">About</a></li>
            <li class="hover-effect-3 nav-item"><a href="contact" class="m fs-4 nav-link">Contact</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  
  



<!-- Demo content-->
<section class="py-1 section-1">
    <div class="container py-5 text-center">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>Get Started</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            </div>
        </div>
    </div>
</section>

<section class="py-5 section-2">
    <div class="b-example-divider"></div>

    <div class="container px-4 py-5" id="custom-cards">
      <h2 class="pb-2 border-bottom"></h2>
  
      <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
        <div class="col">
          <div class="minu card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('img/d1.jpg');  background-size: cover;
          background-position: center;">
            <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
              <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Top View</h3>
              <ul class="d-flex list-unstyled mt-auto">
                <li class="me-auto">
                  <img src="img/d1.jpg" alt="Bootstrap" width="32" height="32" class="rounded-circle border border-white">
                </li>
                <li class="d-flex align-items-center me-3">
                  <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"/></svg>
                  <small>Debark University</small>
                </li>
                <li class="d-flex align-items-center">
                  <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"/></svg>
                  <small>Top</small>
                </li>
              </ul>
            </div>
          </div>
        </div>
  
        <div class="col">
          <div class="minu card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('img/d2.jpg');background-size: cover;
          background-position: center;">
            <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
              <span class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">We Strive for Institutional Quality</span>
              <ul class="d-flex list-unstyled mt-auto">
                <li class="me-auto">
                  <img src="img/d2.jpg" width="32" height="32" class="rounded-circle border border-white">
                </li>
                <li class="d-flex align-items-center me-3">
                  <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"/></svg>
                  <small>Debark University</small>
                </li>
                <li class="d-flex align-items-center">
                  <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"/></svg>
                  <small></small>
                </li>
              </ul>
            </div>
          </div>
        </div>
  
        <div class="col">
          <div class="minu card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('img/d4.jpg');background-size: cover;
          background-position: center;">
            <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1">
              <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">DKU</h3>
              <ul class="d-flex list-unstyled mt-auto">
                <li class="me-auto">
                  <img src="img/d4.jpg" alt="Bootstrap" width="32" height="32" class="rounded-circle border border-white">
                </li>
                <li class="d-flex align-items-center me-3">
                  <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"/></svg>
                  <small>Debark University</small>
                </li>
                <li class="d-flex align-items-center">
                  <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"/></svg>
                  <small>Library</small>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " style="max-width:400px;">
          <div class="modal-content " style="max-width:400px;">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">DKU OES</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <form id="loglog" class="form- align-baseline" method="POST" action="#">
              <div class="me-2 mb-1 head">
                <h1 style="color: #db14c1;"><span><i class="fa fa-key" ></i></span>LOGIN</h1>
              </div>
              <div id="mresponse" ></div>
              <div class="mb-5 sg input-group">
                <input type="text" name="uname" autocomplete="off" id="effect4" placeholder=" " class="effect-4 fl" required>
                <label for="effect4">Username</label>
              </div>
              <div class="mb-5 fg  input-group">
                <input type="password" name="pass" autocomplete="off" id="effect5" placeholder=" " class="effect-4 fol" required>
                <label for="effect5">Password</label>
                <button class="btn-toggle-password" id="show-password" type="button"><span><i class="fa fa-eye"></i></span></button>
              </div>

              <div class="mb-5">
                <button style="background-color: #db14c1; width: auto;display: block; margin: 0 auto;"  class="loginbtn grd text-white btn btn-succes ">LOGIN</button></div>
            </form>
  
  
  
  
  
            </div>
            
        </div>
      </div>
    </div>
  
      <!----Modal_End---->
  


</body>


    <footer class="text-center text-white p-3 " style="background-color: #0000;">

      <div class="text-center text-white bg-dark p-3" style=" width: 100%;background-color: rgba(0, 0, 0, 0.2);">
        © 2023 Copyright:
        <a class="text-white bg-dark" href="">Debark University</a>
      </div>
      <!-- Copyright -->
    </footer>

<script>
  $(function() {
    $('#show-password').click(function() {
      var passwordInput = $(this).closest('.input-group').find('input[type="password"]');
      var passwordFieldType = passwordInput.attr('type');
      if (passwordFieldType == 'password') {
        passwordInput.attr('type', 'text');
        $(this).html('<i class="bi bi-eye-slash"></i>');
      } else {
        passwordInput.attr('type', 'password');
        $(this).html('<i class="bi bi-eye"></i>');
      }
    });
  });
</script>
 <script type="text/javascript">

                      $(document).ready(function () 
                      {
                        $(document).on('click', '.loginbtn', function(){
                          event.preventDefault();
                          var uname = document.forms["loglog"]["effect4"].value;
                          var pass = document.forms["loglog"]["effect5"].value;


                          $.ajax({
                                url:"validate.php",
                                method:"POST",
                                data:{
                                  uname:uname,
                                  pass:pass,
                                  page:'index',
                                  action:'login'},
                                  dataType: 'json',
                                success:function(response)
                                {
                                  
                                  if (response.success) {
                                  window.location.href = response.redirect;
                                  }
                                  else{
                                 $('#mresponse').html(response.redirects);
                                  }
                                }
                            })
                        });
                      });
</script> 