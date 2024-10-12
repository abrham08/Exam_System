<?php
include "dbc.php";


?>
<html lang="en">

<head>
  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DKU OES</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <link href="admin/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="navi.css" rel="stylesheet" type="text/css">
    <link href="admin/css/fontawesome.min.css" rel="stylesheet" type="text/css">
  <style>
    /* Hide the default scrollbar */
/* Hide the default scrollbar */
body::-webkit-scrollbar {
  width: 8px;
  background-color: #f5f5f5;
  height: 0px;
}

/* Track */
body::-webkit-scrollbar-track {
  background: #f5f5f5;
}

/* Handle */
body::-webkit-scrollbar-thumb {
  background: linear-gradient(135deg, #8A2BE2, #0000FF);
  border-radius: 10px;
  height: 20px; /* Adjust the height as needed */
}

/* Handle on hover */
body::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(135deg, #9400D3, #4B0082);
}

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

    /* Navbar */
    .navbar {
      background: linear-gradient(to right, #8A2BE2, #B12DFC, #D93FFF);
  /* Use vendor prefixes for better browser compatibility */
  background: -moz-linear-gradient(left, #8A2BE2, #B12DFC, #D93FFF);
  background: -webkit-linear-gradient(left, #8A2BE2, #B12DFC, #D93FFF);
  background: linear-gradient(to right, #8A2BE2, #B12DFC, #D93FFF);}
    .navbar-nav {
      margin-left: auto;
    }

    .nav-link {
      font-family: Arial, sans-serif;
  
  color: #FFFFFF;
      font-size: 18px;
      transition: all 0.3s ease-in-out;
    }
    .navbar-brand {
  font-size: 24px;
  font-weight: bold;
  font-family: 'Montserrat', sans-serif;
  /* Add any other styling properties you want */
}

    .nav-link:hover {
      color: #f0f0f0;
      transform: scale(1.1);
    }

    /* Page Content */
    .container {
      margin-top: 10px;
      text-align: center;
    }

    h1 {
      font-size: 46px;
      margin-bottom: 20px;
    }

    p {
      font-size: 18px;
    }

  .footer {
    background-color: #f8f9fa;
    padding: 20px;
    text-align: center;
  }

  .footer-text {
    color: #6c757d;
    font-size: 14px;
    margin-bottom: 10px;
  }

  .footer-link {
    color: #6c757d;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .footer-link:hover {
    color: #212529;
  }
  </style>
</head>
<body class="bg-light">
  <!-- Preloader -->

  <!-- Navigation Bar -->
  <header class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="#">
        <img src="admin/img/logod.png" alt="" width="65" height="64" style="border-radius:55%;" class="d-inline-block align-text-center">
         DEBARK UNIVERSITY</br>ደባርቅ ዩኒቨርሲቲ


</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="hover-effect-3 nav-item">
              <a class="nav-link " href="index">HOME</a>
            </li>
            <li class="hover-effect-3 nav-item">
              <a class="nav-link active" href="about">ABOUT US</a>
            </li>
            <li class="hover-effect-3 nav-item">
              <a class="nav-link " href="contact">CONTACT US</a>
            </li>
            <li class="hover-effect-3 nav-item">
              <a class="nav-link" href="developer">DEVELOPERS</a>
            </li>
          </ul>
          
        </div>
      </div>
    </nav>
  </header>
  


<!-- Demo content-->
<div class="container px-4 py-5" id="icon-grid">
<h2 class="pb-2 border-bottom" style="text-align: left;">Features of DKU OES</h2>


    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
      <div class="col d-flex align-items-start">
        <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#bootstrap"/></svg>
        <div>
          <h3 class="fw-bold mb-0 fs-4">Instant Result</h3>
          <p>Upon completion of the exam, the system provides an instant outcome.</p>
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#cpu-fill"/></svg>
        <div>
          <h3 class="fw-bold mb-0 fs-4">Auto Blocking</h3>
          <p>It restricts the examinee from accessing extra browser tabs or windows.</p>
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#calendar3"/></svg>
        <div>
          <h3 class="fw-bold mb-0 fs-4">Customable</h3>
          <p style="text-align: justify;">It provides users with the ability to modify their profile.</p>
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <svg class="bi text-muted flex-shrink-0 me-3" width="1.75em" height="1.75em"><use xlink:href="#calendar3"/></svg>
        <div>
          <h3 class="fw-bold mb-0 fs-4">Auto save</h3>
          <p>In case of a power disruption or a network problem, the answers are automatically preserved.</p>
        </div>
      </div>
      </div>
    </div>
  </div>

  <div class="b-example-divider"></div>
<section class="py-1 section-1">
<div class="container px-4 py-5" id="featured-3">
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
      <div class="feature col">
        <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
          <svg class="bi" width="1em" height="1em"><use xlink:href="#collection"/></svg>
        </div>
        <h3 class="fs-2">About Us</h3>
        <p style="text-align: justify;">Debark University, which is among the fourth generation universities, was established in 2007 EC. 
            It is located at 834 Kms from Addis Ababa, 284 Kms from Bahirdar and 103 Kms from Gondar. 
            Debark university is constructed at Debark Town, North Gondar Zone,
             which is frequently visited by many tourists who come to visit Simien Mountain National Park.  
             Following its establishment, the university started its teaching activity 
             with 1173 students under 4/four colleges and 17/seventeen 
             departments.</p>
        <a href="#" class="icon-link d-inline-flex align-items-center">
          
        </a>
      </div>
      <div class="feature col">
        <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
          <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"/></svg>
        </div>
        <h3 class="fs-2" style="text-align: justify;">Mission</h3>
        <p>The Mission of Debark University is to accelerate the overall development of the country by producing medium and higher professionals who are equipped with knowledge, skill and attitude; 
            conducting problem solving researches, and through technology transfer, community service and engagement activities.</p>
         <a href="#" class="icon-link d-inline-flex align-items-center">
         
        </a>
      </div>
      <div class="feature col">
        <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
          <svg class="bi" width="1em" height="1em"><use xlink:href="#toggles2"/></svg>
        </div>
        <h3 class="fs-2">Core Values</h3>
        <p>

                Excellence</br>

                Honesty</br>

                Team work</br>

                Unity in diversity</br>

                Honest service</br>

                Professional </br>

                Optimism</p>
        <a href="#" class="icon-link d-inline-flex align-items-center">
          
        </a>
      </div>
    </div>
  </div>

  <div class="b-example-divider"></div>
</section>

    


</body>
<footer class="footer">
  <p class="footer-text">© 2023 DKU CS GROUP 2. All rights reserved.</p>
  <p class="footer-text">
    We Strive for Institutional <a class="footer-link" href="#">Quality</a>
  </p>
</footer>
<script src="js/bootstrap.min.js"></script>
