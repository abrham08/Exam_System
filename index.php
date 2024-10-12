<?php
include "dbc.php";


$mn = 0;
$fetch = $pdo->prepare('SELECT * FROM notice WHERE type=:type ORDER BY date ASC ');
$fetch->bindValue(':type', 0);
$fetch->execute();
$cat = $fetch->fetchAll(PDO::FETCH_ASSOC);
if (count($cat) > 0) {
  $mn = 1;
  $fetch = $pdo->prepare('SELECT * FROM notice WHERE type=:type AND stat=:stat  ORDER BY date ASC LIMIT 2 ');
  $fetch->bindValue(':type', '1');
  $fetch->bindValue(':stat', '1');
  $fetch->execute();
  $catp = $fetch->fetchAll(PDO::FETCH_ASSOC);
} else {
  $fetch = $pdo->prepare('SELECT * FROM notice WHERE type=:type AND stat=:stat  ORDER BY date ASC LIMIT 3 ');
  $fetch->bindValue(':type', '1');
  $fetch->bindValue(':stat', '1');
  $fetch->execute();
  $catp = $fetch->fetchAll(PDO::FETCH_ASSOC);
}
// Check if the user is using a safe exam browser
function isSafeExamBrowser()
{
  // Get the user agent string from the HTTP headers
  $userAgent = $_SERVER['HTTP_USER_AGENT'];

  // Check if the user agent contains a specific identifier for the safe exam browser
  if (strpos($userAgent, 'SafeExamBrowser') !== false) {
    return true; // User is using a safe exam browser
  } else {
    return false; // User is not using a safe exam browser
  }
}
?>

<head>
  <title> DKU &mdash; OES</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/x-icon" href="favicon.ico">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="home/css/bootstrap.min.css">
  <link rel="stylesheet" href="home/css/jquery-ui.css">
  <link rel="stylesheet" href="home/css/owl.carousel.min.css">
  <link rel="stylesheet" href="home/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="home/css/owl.theme.default.min.css">

  <link rel="stylesheet" href="home/css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="home/css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="home/css/aos.css">

  <link rel="stylesheet" href="home/css/style.css?v=<?php echo time(); ?>">
  <style>
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
      height: 600px;
      overflow-y: scroll;
    }

    .input-group {
      position: relative;
      margin: 1.5rem 0;
    }


    #preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: #fff;
      z-index: 9999;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .lds-grid {
      display: inline-block;
      position: relative;
      width: 80px;
      height: 80px;
    }

    .lds-grid div {
      position: absolute;
      width: 16px;
      height: 16px;
      border-radius: 50%;
      background: #8A2BE2;
      animation: lds-grid 1.2s linear infinite;
    }

    .lds-grid div:nth-child(1) {
      top: 8px;
      left: 8px;
      animation-delay: 0s;
    }

    .lds-grid div:nth-child(2) {
      top: 8px;
      left: 32px;
      animation-delay: -0.4s;
    }

    .lds-grid div:nth-child(3) {
      top: 8px;
      left: 56px;
      animation-delay: -0.8s;
    }

    .lds-grid div:nth-child(4) {
      top: 32px;
      left: 8px;
      animation-delay: -0.4s;
    }

    .lds-grid div:nth-child(5) {
      top: 32px;
      left: 32px;
      animation-delay: -0.8s;
    }

    .lds-grid div:nth-child(6) {
      top: 32px;
      left: 56px;
      animation-delay: -1.2s;
    }

    .lds-grid div:nth-child(7) {
      top: 56px;
      left: 8px;
      animation-delay: -0.8s;
    }

    .lds-grid div:nth-child(8) {
      top: 56px;
      left: 32px;
      animation-delay: -1.2s;
    }

    .lds-grid div:nth-child(9) {
      top: 56px;
      left: 56px;
      animation-delay: -1.6s;
    }

    @keyframes lds-grid {

      0%,
      100% {
        opacity: 1;
      }

      50% {
        opacity: 0.5;
      }
    }




    input {
      border: none;
      outline: none;
      padding: 5px;
      font-size: 1rem;
      width: 100%;
    }

    .overflow-hidden {
      overflow: hidden;
    }

    .effect-4 {
      border: 2px solid #3498db;
      border-radius: 10px;

    }

    .effect-4+label {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      left: 0.75rem;
      color: #ccc;
      padding: 0 0.125rem;
      transition: 0.4s;
    }

    .effect-4:focus {
      border-color: #b654a9;
    }

    .effect-4:focus+label,
    .effect-4:not(:placeholder-shown)+label {
      top: 0;
      transition: 0.3s;
      background-color: #fff;
      color: #c907af;
    }

    .btn-toggle-password {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      right: 5px;
      border: none;
      background: transparent;
      cursor: pointer;
    }

    /* Hide the password by default */
    #effect5[type="password"] {
      -webkit-text-security: disc;
      -moz-text-security: disc;
      --text-security: disc;
    }

    /* Show the password when the button is clicked */
    #effect5[type="text"] {
      -webkit-text-security: none;
      -moz-text-security: none;

    }

    @media (max-width: 991.98px) {
      #home-section {
        height: 1300px;


      }


    }
  </style>
</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  <!-- Preloader -->
  <div id="preloader">
    <div class="lds-grid">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>

  </div>
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

      <div class="container-fluid">
        <div class="d-flex align-items-center">
          <div class="site-logo mr-auto w-55"><a href="index.html" style="text-decoration: none;"><img
                src="admin/img/logod.png" alt="" width="65" height="64" style="border-radius:55%;"
                class="d-inline-block align-text-center">
              DEBARK UNIVERSITY</br><span class="mx-5">ደባርቅ ዩኒቨርሲቲ</span></a></div>

          <div class="mx-auto text-center">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                <li><a href="#home-section" class="nav-link">Home</a></li>
                <li><a href="#courses-section" class="nav-link">Features</a></li>
                <li><a href="#programs-section" class="nav-link">About Us</a></li>
                <li><a href="#teachers-section" class="nav-link">Developers</a></li>
                <li><a href="#contact-section" class="nav-link">Contact Us</a></li>

              </ul>
            </nav>
          </div>

          <div class="ml-auto w-25">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                <li class="cta"><a href="help.pdf" target="_blank" class="nav-link"><span>Help</span></a></li>
              </ul>
            </nav>
            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right"><span
                class="icon-menu h3"></span></a>
          </div>
        </div>
      </div>

    </header>
    <div style="background-color: #3498db;"></div>

    <div class="intro-section" id="home-section">
      <div class="row p-5 container-fluid">
        <!-- Login Form -->


        <!-- Carousel -->
        <div style="margin-top: 110px;" class=" rounded col-md-9">
          <!-- Carousel code -->
          <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

          <!-- Your carousel code -->
          <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner ">
              <?php if (count($cat) > 0 || count($catp) > 0): ?>
                <?php if ($mn == 0): ?>
                  <?php foreach ($catp as $index => $cap): ?>
                    <div class="carousel-item rounded  active <?php echo $cap['nid'] ?>"
                      class="d-block w-100 <?php echo $cap['nid'] ?>"
                      style="background-image: url('admin/<?php echo $cap['notice'] ?>'); height: 600px; background-size: cover;"
                      data-stellar-background-ratio="0.5">
                      <div class="container">
                        <div class="row align-items-center">
                          <div class=" col-lg-6 mb-4">
                            <h1 data-aos="fade-up" data-aos-delay="100">We Strive for Educational Quality</h1>

                          </div>
                          <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                          </div>
                        </div>
                      </div>
                      <div class="carousel-caption d-none d-md-block ">

                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php else: ?>
                  <?php foreach ($cat as $index => $capn): ?>
                    <div class="text-dark rounded ccm carousel-item active <?php echo $capn['nid'] ?>" style=""
                      data-bs-interval="30000" style="overflow: auto;">
                      <!-- Slide content -->
                      <p>
                        <span style="color:black;margin-top: 20px; text-align: justify; width: auto; color: black;"
                          class="d-block <?php echo $capn['nid'] ?>">
                          <div class="container">
                            <?php echo '<span style="color:black;"' . $capn['notice'] . '<span>' ?>
                          </div>
                        </span>
                      </p>


                      <div style="text-align: justify; width: auto;  "
                        class=" text-black carousel-caption d-block <?php echo $capn['nid'] ?>">
                        <span style=" background-color:black; margin-top:600px;text-align: justify; width: auto; "
                          class="mr-3"><?php //echo $capn['notice']; ?>.</span>
                      </div>

                    </div>
                  <?php endforeach; ?>

                  <?php foreach ($catp as $index => $cap): ?>
                    <div class="rounded carousel-item  <?php echo $cap['nid'] ?>"
                      class="d-block w-100 <?php echo $cap['nid'] ?>"
                      style="background-image: url('admin/<?php echo $cap['notice'] ?>'); height: 600px; background-size: content;"
                      data-stellar-background-ratio="0.5">
                      <div class="container">
                        <div class="row align-items-center">
                          <div class="col-lg-5 ml-auto" data-aos="fade-up" data-aos-delay="500">
                            <h1 data-aos="fade-up" data-aos-delay="100">Strive for Excellent</h1>

                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              <?php endif; ?>
            </div>

            <!-- Carousel controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>

            <!-- Carousel indicators -->
            <ol class="carousel-indicators">
              <?php for ($i = 0; $i < count($cat) + count($catp); $i++): ?>
                <li data-bs-target="#carouselExample" data-bs-slide-to="<?php echo $i; ?>" <?php if ($i === 0)
                     echo 'class="active"'; ?>></li>
              <?php endfor; ?>
            </ol>
          </div>

          <!-- Include Bootstrap JS -->
          <script
            src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>



        </div>

        <div style="margin-top: 110px;" class="p-3 shadow-lg  mb-1 bg-body rounded col-md-3">
          <!-- Bootstrap login form code -->
          <form id="loglog" class="form- align-baseline " method="POST" action="#" style="margin-top: 50px;">
            <div class="text-center me-2 mb-3 head">
              <h1 style="color: #513ff2;"><span><i class="fa fa-key" style="color:#513ff2;"></i></span>LOGIN</h1>
            </div>
            <div id="mresponse"></div>
            <div class="mb-5 sg input-group">
              <input type="text" name="uname" autocomplete="off" id="effect4" placeholder=" " class="effect-4 fol"
                required>
              <label for="effect4">Username</label>
            </div>
            <div class="mb-5 fg input-group">
              <input type="password" name="pass" autocomplete="off" id="effect5" placeholder=" " class="effect-4 fol"
                required>
              <label for="effect5">Password</label>
              <button class="btn-toggle-password" id="show-passwor" type="button"><span><i
                    class="fa fa-eye"></i></span></button>
            </div>

            <style>
              .btn-toggle-password {
                background-color: #513ff2;
                border: none;
                padding: 8px;
                cursor: pointer;
              }

              .btn-toggle-password:hover {
                background-color: black;
              }

              .btn-toggle-password span {
                color: #513ff2;
              }
            </style>

            <script>
              var showPasswordButton = document.getElementById("show-passwor");
              var passwordInput = document.getElementById("effect5");

              showPasswordButton.addEventListener("click", function () {
                if (passwordInput.type === "password") {
                  passwordInput.type = "text";
                  showPasswordButton.style.backgroundColor = "red";
                } else {
                  passwordInput.type = "password";
                  showPasswordButton.style.backgroundColor = "#513ff2";
                }
              });
            </script>


            <div class="mb-5">


              <button style=" margin: 0 auto;background-color: #513ff2;width: auto;display: block;"
                class="loginbtn grd text-white btn btn-succes">LOGIN</button>
            </div>
          </form>

        </div>







      </div>
    </div>


    <div class="site-section courses-title" id="courses-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">Features</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="site-section courses-entry-wrap" data-aos="fade-up" data-aos-delay="100">
      <div class="container">
        <div class="row">

          <div class="owl-carousel col-12 nonloop-block-14">

            <div class="course bg-white h-70 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="img/d1.jpg" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <div class="meta"><span class="icon-clock-o"></span></div>
                <h3><a href="#">Top View</a></h3>
                <p> </p>
              </div>
              <div class="d-flex border-top stats">
                <div class="py-3 px-4"><span class=""></span></div>
              </div>
            </div>

            <div class="course bg-white h-70 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="img/d2.jpg" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <div class="meta"><span class="icon-clock-o"></span></div>
                <h3><a href="#">Feature</a></h3>
                <p> </p>
              </div>
              <div class="d-flex border-top stats">
                <div class="py-3 px-4"><span class=""></span></div>
              </div>
            </div>
            <div class="course bg-white h-70 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="img/d3.jpg" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <div class="meta"><span class="icon-clock-o"></span></div>
                <h3><a href="#">Feature</a></h3>
                <p> </p>
              </div>
              <div class="d-flex border-top stats">
                <div class="py-3 px-4"><span class=""></span></div>
              </div>
            </div>
            <div class="course bg-white h-70 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="img/d4.jpg" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <div class="meta"><span class="icon-clock-o"></span></div>
                <h3><a href="#">Library</a></h3>
                <p> </p>
              </div>
              <div class="d-flex border-top stats">
                <div class="py-3 px-4"><span class=""></span></div>
              </div>
            </div>
            <div class="course bg-white h-70 align-self-stretch">
              <figure class="m-0">
                <a href="course-single.html"><img src="img/d1.jpg" alt="Image" class="img-fluid"></a>
              </figure>
              <div class="course-inner-text py-4 px-4">
                <div class="meta"><span class="icon-clock-o"></span></div>
                <h3><a href="#">Feature</a></h3>
                <p> </p>
              </div>
              <div class="d-flex border-top stats">
                <div class="py-3 px-4"><span class=""></span></div>
              </div>
            </div>
          </div>



        </div>
        <div class="row justify-content-center">
          <div class="col-7 text-center">
            <button class="customPrevBtn btn btn-primary m-1">Prev</button>
            <button class="customNextBtn btn btn-primary m-1">Next</button>
          </div>
        </div>
      </div>
    </div>




    <div class="site-section" id="programs-section">
      <div class="container">
        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">About Us</h2>
            <p>
              Debark University, which is among the fourth generation universities, was established in 2007 EC.
              It is located at 834 Kms from Addis Ababa, 284 Kms from Bahirdar and 103 Kms from Gondar.
              Debark university is constructed at Debark Town, North Gondar Zone,
              which is frequently visited by many tourists who come to visit Simien Mountain National Park.
              Following its establishment, the university started its teaching activity
              with 1173 students under 4/four colleges and 17/seventeen
              departments
            </p>
          </div>
        </div>
        <div class="container px-4 py-5" id="icon-grid">
          <h2 class="pb-2 border-bottom" style="text-align: left;">Features of DKU OES</h2>


          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
            <div class="col d-flex align-items-start">
              <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                <use xlink:href="#bootstrap" />
              </svg>
              <div>
                <h3 class="fw-bold mb-0 fs-4">Instant Result</h3>
                <p>Upon completion of the exam, the system provides an instant outcome.</p>
              </div>
            </div>
            <div class="col d-flex align-items-start">
              <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                <use xlink:href="#cpu-fill" />
              </svg>
              <div>
                <h3 class="fw-bold mb-0 fs-4">Auto Blocking</h3>
                <p>It restricts the examinee from accessing extra browser tabs or windows.</p>
              </div>
            </div>
            <div class="col d-flex align-items-start">
              <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                <use xlink:href="#calendar3" />
              </svg>
              <div>
                <h3 class="fw-bold mb-0 fs-4">Customable</h3>
                <p style="text-align: justify;">It provides users with the ability to modify their profile.</p>
              </div>
            </div>
            <div class="col d-flex align-items-start">
              <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em">
                <use xlink:href="#calendar3" />
              </svg>
              <div>
                <h3 class="fw-bold mb-0 fs-4">Auto save</h3>
                <p>In case of a power disruption or a network problem, the answers are automatically preserved.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5" data-aos="fade-up" data-aos-delay="100">
            <img src="images/undraw_youtube_tutorial.svg" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 ml-auto" data-aos="fade-up" data-aos-delay="200">
            <h2 class="text-black mb-4">Mission</h2>
            <p class="mb-4">The Mission of Debark University is to accelerate the overall development of the country by
              producing medium and higher professionals who are equipped with knowledge, skill and attitude;
              conducting problem solving researches, and through technology transfer, community service and engagement
              activities.</p>
            <h3 class="fs-2">Core Values</h3>
            <div class="d-flex align-items-center custom-icon-wrap mb-3">
              <span class="custom-icon-inner mr-3"><span class="icon icon-graduation-cap"></span></span>
              <div>
                <h3 class="m-0">Excellence</h3>
              </div>
            </div>

            <div class="d-flex align-items-center custom-icon-wrap">
              <span class="custom-icon-inner mr-3"><span class="icon icon-university"></span></span>
              <div>
                <h3 class="m-0">Honesty</h3>
              </div>
            </div><br>

            <div class="d-flex align-items-center custom-icon-wrap mb-3">
              <span class="custom-icon-inner mr-3"><span class="icon icon-graduation-cap"></span></span>
              <div>
                <h3 class="m-0">Excellence</h3>
              </div>
            </div>

            <div class="d-flex align-items-center custom-icon-wrap">
              <span class="custom-icon-inner mr-3"><span class="icon icon-university"></span></span>
              <div>
                <h3 class="m-0">Team Work</h3>
              </div>
            </div><br>

            <div class="d-flex align-items-center custom-icon-wrap mb-3">
              <span class="custom-icon-inner mr-3"><span class="icon icon-graduation-cap"></span></span>
              <div>
                <h3 class="m-0"> Unity in Diversity</h3>
              </div>
            </div>

            <div class="d-flex align-items-center custom-icon-wrap">
              <span class="custom-icon-inner mr-3"><span class="icon icon-university"></span></span>
              <div>
                <h3 class="m-0"> Honest service</h3>
              </div>
            </div>

          </div>
        </div>

        <div class="row mb-5 align-items-center">
          <div class="col-lg-7 mb-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
            <img src="images/undraw_teaching.svg" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-4 mr-auto order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h2 class="text-black mb-4">We Strive for Educational Quality</h2>
            <p class="mb-4"></p>

            <div class="d-flex align-items-center custom-icon-wrap mb-3">
              <span class="custom-icon-inner mr-3"><span class="icon icon-graduation-cap"></span></span>
              <div>
                <h3 class="m-0"> 1173 students </h3>
              </div>
            </div>

            <div class="d-flex align-items-center custom-icon-wrap">
              <span class="custom-icon-inner mr-3"><span class="icon icon-university"></span></span>
              <div>
                <h3 class="m-0"> 4/four colleges</h3>
              </div>
            </div><br>
            <div class="d-flex align-items-center custom-icon-wrap mb-3">
              <span class="custom-icon-inner mr-3"><span class="icon icon-graduation-cap"></span></span>
              <div>
                <h3 class="m-0"> 2 schools </h3>
              </div>
            </div>
            <div class="d-flex align-items-center custom-icon-wrap">
              <span class="custom-icon-inner mr-3"><span class="icon icon-university"></span></span>
              <div>
                <h3 class="m-0"> 28/twenty-eight
                  departments</h3>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
    <div class="site-section" id="teachers-section">
      <div class="container">

        <div class="row mb-5 justify-content-center">
          <div class="col-lg-7 mb-5 text-center" data-aos="fade-up" data-aos-delay="">
            <h2 class="section-title">Developer</h2>
            <p class="mb-5"></p>
          </div>
        </div>






        <div class="row ">
          <div class="col" data-aos="fade-up" data-aos-delay="100">
            <div class="teacher text-center">
              <img src="img/Abrham_Gelaw_Yetsub_Dku1200467.jpg" alt="Image"
                class="img-fluid rounded-circle mx-auto mb-4" style="width: 250px; height: 250px;">
              <div class="py-2">
                <h3 class="text-black">Abrham Gelaw</h3>
                <p class="position">LinkedIn: <a
                    href="https://www.linkedin.com/in/abrham-gelaw-5a915b263">Abrham_Gelaw</a></p>
                <p class="position">Email: abrhamgelawu@gmail.com</p>

              </div>
            </div>
          </div>


        </div>
      </div>



      <div class="site-section bg-light" id="contact-section">
        <div class="container">
          <div class="row mb-5 justify-content-center">
            <div class="col-lg-7 mb-5 text-center" data-aos="fade-up" data-aos-delay="">
              <h2 class="section-title">Contact Us</h2>
              <p class="mb-5"></p>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-7">

              <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13394.509037295864!2d37.891289492643246!3d13.121856336136547!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164283e460087f9b%3A0x2f715e8089ac6a1a!2sDebark%20University!5e0!3m2!1sen!2set!4v1685627381919!5m2!1sen!2set"
                width="500" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>



            <div class="col-md-5">

              <h5 class="fw-semibold mb-3">Touch With US</h5>
              <p class="text-muted text-center">
                Debark University</br>

                Email: proffice@dku.edu.et/

                or dkupublicrelation@gmail.com</br>

                Facebook page:<a href="https://www.facebook.com/Debarkuniversityandcollegeofficial/" target="_blank"
                  rel="noopener noreferrer">Debark University and College</a>
                </br>

                Phone Number: +251584176010</br>

                P.O. Box: 90
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>



    <footer class="footer-section bg-white">
      <div class="container">


        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <li><a href="help.pdf" target="_blank" class="nav-link">Help</a></li>
            <div class="border-top pt-5">
              <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;
                <script>document.write(new Date().getFullYear());</script> All rights reserved |DKU CS <i
                  class="icon-heart" aria-hidden="true"></i> by Abrham G.</a>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
            </div>
          </div>

        </div>
      </div>
    </footer>
    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Activate the carousel -->
    <script>
      $(document).ready(function () {
        $('#carouselExample').carousel({
          interval: 5000 // Adjust the interval time in milliseconds (default is 5000)
        });
      });
    </script>



    <script src="home/js/jquery-3.3.1.min.js"></script>
    <script src="home/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="home/js/jquery-ui.js"></script>
    <script src="home/js/popper.min.js"></script>
    <script src="home/js/bootstrap.min.js"></script>
    <script src="home/js/owl.carousel.min.js"></script>
    <script src="home/js/jquery.stellar.min.js"></script>
    <script src="home/js/jquery.countdown.min.js"></script>
    <script src="home/js/bootstrap-datepicker.min.js"></script>
    <script src="home/js/jquery.easing.1.3.js"></script>
    <script src="home/js/aos.js"></script>
    <script src="home/js/jquery.fancybox.min.js"></script>
    <script src="home/js/jquery.sticky.js"></script>


    <script src="home/js/main.js"></script>
    <script>
      // Wait for the page to load before displaying the content
      window.addEventListener('load', function () {

        setTimeout(function () {
          var preloader = document.getElementById('preloader');
          preloader.style.display = 'none';
        }, 300);
      });
    </script>
</body>

<script>
  $(function () {
    $('#show-password').click(function () {
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

  $(document).ready(function () {
    $(document).on('click', '.loginbtn', function (event) {
      event.preventDefault();
      var uname = document.forms["loglog"]["effect4"].value;
      var pass = document.forms["loglog"]["effect5"].value;


      $.ajax({
        url: "validate.php",
        method: "POST",
        data: {
          uname: uname,
          pass: pass,
          page: 'index',
          action: 'login'
        },
        dataType: 'json',
        success: function (response) {

          if (response.success) {
            window.location.href = response.redirect;
          }
          else {
            $('#mresponse').html(response.redirects);
          }
        }
      })
    });
  });
</script>