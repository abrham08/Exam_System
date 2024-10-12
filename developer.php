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
  body {
      background-color: #f8f9fa;
    }

    .developer-cards {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 30px;
      gap: 20px;
      transition: transform 0.3s;
    }

    .developer-card {
      background-color: #ffffff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      padding: 20px;
      text-align: center;
      transition: transform 0.3s;
    }

    .developer-card img {
      width: 203px;
      height: 230px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .developer-card h5 {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .developer-card p {
      margin-bottom: 10px;
    }

    .developer-card:hover {
      transform: scale(1.05);
    }

    .developer-card {
      background-color: #ff7675;
      color: #ffffff;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .developer-card {
      transform: scale(1.1) rotate(-5deg);
      box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
    }

    .welcome-message {
      text-align: center;
      margin-top: 50px;
      font-size: 24px;
      color: #ffffff;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
      animation: welcomeAnimation 1s ease-in-out infinite alternate;
    }

    @keyframes welcomeAnimation {
      0% {
        transform: translateY(0);
      }
      100% {
        transform: translateY(10px);
      }
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
              <a class="nav-link " href="contact">CONTACT US</a>
            </li>
            <li class="hover-effect-3 nav-item">
              <a class="nav-link active" href="developer">DEVELOPERS</a>
            </li>
          </ul>
          
        </div>
      </div>
    </nav>
  </header>
<!-- Demo content-->
<div class="container">
    <h2 class="welcome-message">Welcome to Our Developers Page!</h2>
    <div class="developer-cards">
      <div class="developer-card">
        <img src="" class="card-img-top" alt="Abrham Gelaw">
        <div class="card-body">
          <h5 class="card-title">Abrham Gelaw</h5>
          
          <p class="card-text">abrhamgelawu@gmail.com</p>
        </div>
      </div>
      <div class="developer-card">
        <img src="" class="card-img-top" alt="Belaynesh Weldu">
        <div class="card-body">
          <h5 class="card-title">Belaynesh Weldu</h5>
          
          <p class="card-text">belayneshweldu23@gamil.com</p>
        </div>
      </div>
      <div class="developer-card">
        <img src="" class="card-img-top" alt="Melesse Genene">
        <div class="card-body">
          <h5 class="card-title">Melesse Genene</h5>
          
          <p class="card-text">melesegenene6@gmail.com</p>
        </div>
      </div>
      <div class="developer-card">
        <img src="" class="card-img-top" alt="Tesfanesh Kebede">
        <div class="card-body">
          <h5 class="card-title">Tesfanesh Kebede</h5>
         
          <p class="card-text">tesfakebede07@gmail.com</p>
        </div>
      </div>
      <div class="developer-card">
        <img src="path_to_photo5.jpg" class="card-img-top" alt="Tizita Legesse">
        <div class="card-body">
          <h5 class="card-title">Tizita Legesse</h5>

          <p class="card-text">tizitalegessed8@gmail.com</p>
        </div>
      </div>
    </div>
  </div>




<footer class="footer">
  <p class="footer-text">© 2023 DKU CS GROUP 2. All rights reserved.</p>
  <p class="footer-text">
    We Strive for Institutional <a class="footer-link" href="#">Quality</a>
  </p>
</footer>

<script src="js/bootstrap.min.js"></script>
