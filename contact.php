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
    /* Preloader */
 

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
              <a class="nav-link" href="about">ABOUT US</a>
            </li>
            <li class="hover-effect-3 nav-item">
              <a class="nav-link active" href="contact">CONTACT US</a>
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
<section class="py-1 section-1">
<div class="container px-4 py-3">
    <div class="row row-cols-1 row-cols-md-2 align-items-md-center g-5 py-3">
      <div class="d-flex flex-column align-items-start gap-2">
        <h3 class="fw-bold"></h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13394.509037295864!2d37.891289492643246!3d13.121856336136547!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164283e460087f9b%3A0x2f715e8089ac6a1a!2sDebark%20University!5e0!3m2!1sen!2set!4v1685627381919!5m2!1sen!2set" width="500" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>        </div>
      <div class="row row-cols-1 row-cols-sm-2 g-4">
        <div class="d-flex flex-column gap-2">
          <div
            class="feature-icon-small d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-4 rounded-3">
            
          </div>
          <h4 class="fw-semibold mb-0"></h4>
          <p class="text-muted text-center">
          Debark University</br>

            Email: proffice@dku.edu.et/

                                          or dkupublicrelation@gmail.com</br>

            Facebook page: https://www.facebook.com/Debarkuniversityandcollegeofficial/</br>

            Phone Number: +251584176010</br>

            P.O. Box: 90
          </p>
        </div>

        
      </div>
    </div>
  </div>
</section>

    




<footer class="footer">
  <p class="footer-text">© 2023 DKU CS GROUP 2. All rights reserved.</p>
  <p class="footer-text">
    We Strive for Institutional <a class="footer-link" href="#">Quality</a>
  </p>
</footer>

<script src="js/bootstrap.min.js"></script>
