<?php 
session_start();

if (isset($_SESSION['uiid']) && isset($_SESSION['fname'])) {

    include "dbc.php";


    $fetch=$pdo->prepare('SELECT * FROM admn ORDER BY opt ');
    $fetch->execute();
    $cat=$fetch->fetchAll(PDO::FETCH_ASSOC);
    
    ?>
    
    <html lang="en">
      <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
        <link
          rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
          crossorigin="anonymous"
        />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/modal.css">
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style3.css" />
        <title>Menu</title>
      </head>
      <body>
      <header id="header">
          <i class="fas fa-bars" id="nav-toggler"></i>
          <div>
            <span><h2>Amhara science and technology commission</h2></span>
          </div>
        </header>
        <nav id="nav">
          <div>
            <div class="logo">
              <i class="fab fa-gg-circle"></i>
              <span>Hello, <?php echo $_SESSION['fname']; ?></span>
            </div>
            <ul class="nav">
                
              <li class="nav__item">
                <a href="home.php" class="nav__item-link ">
                  <i class="fas fa-home"></i>
                  <span>home</span>
                </a>
              </li>
              <li class="nav__item">
                <a href="#" class="nav__item-link">
                <i class="fas fa-user-alt"></i>
                  <span>EXAMINER <i class="fas fa-angle-down"></i></span>
                </a>
                <ul class="d-none">
                  <li>
                    <a href="viewexaminer.php" class="sub_link">VIEW EXAMINER</a>
                  </li>
                  <li>
                    <a href="addexaminer.php" class="sub_link">ADD EXAMINER</a>
                  </li>
                </ul>
              </li>
              <li class="nav__item">
                <a href="#" class="nav__item-link">
                <i class="fas fa-user-alt"></i>
                  <span>PARTICIPANT <i class="fas fa-angle-down"></i></span>
                </a>
                <ul class="d-none">
                  <li>
                    <a href="participant.php" class="sub_link">VIEW PARTICIPANT</a>
                  </li>
                  <li>
                    <a href="addparticipant.php" class="sub_link">ADD PARTICIPANT</a>
                  </li>
                </ul>
              </li>
              <li class="nav__item">
                <a href="#" class="nav__item-link active">
                <i class="fas fa-user-alt"></i>
                  <span>ADMIN <i class="fas fa-angle-down"></i></span>
                </a>
                <ul class="d-none">
                  <li>
                    <a href="viewadmin.php" class="sub_link">VIEW ADMIN</a>
                  </li>
                  <li>
                    <a href="addadmin.php" class="sub_link">ADD ADMIN</a>
                  </li>
                  <li>
                    <a href="#" class="sub_link">CHANGE PASSWORD</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
    
          <a href="logout.php" class="sign-out">
            <i class="fas fa-sign-out-alt"></i>
            <span>Sign Out</span>
          </a>
        </nav>
        <script src="js/script3.js" defer></script>
        <div class="container big"style="margin-left: 15%;width: 70%;">
    
            <h2 style="margin-left: 45%;">ADD ADMIN</h2>
    
            <div class="col-4" style="margin-left: 45%;">
        <div class="forms ">
                   <div class="form signup">
                                  <form class="was-validated" method="POST" action="adminDB.php" enctype="multipart/form-data" >
                                      <div class=" row g-3">
                                      <div class="col mb-1">
                                          <label >Firstname</label>
                                          <input type="text" class="form-control" name="fname" required placeholder="Enter first name ">
                                          <div class="invalid-feedback">Please, enter name</div>
                                        </div>
                                        <div class="mb-1">
                                          <label >Phone Number</label>
                                          <input type="tel" class="form-control" maximum="10" pattern="[0-9]{10}"  name="phone"  required placeholder="Enter your phone number ">
                                          <div class="invalid-feedback">Please, enter your number</div>
                                        </div>
                                      </div>
                                      <div class=" row g-3">
                                      <div class="col mb-1">
                                            <select name="gender" class="form-select" required aria-label="Gender">
                                              <option value >Gender</option>
                                              <option value="Male">Male</option>
                                              <option value="Female">Female</option>                                         
                                            </select>
                                            <div class="invalid-feedback">Please, select your gender</div>
                                        </div>
                                      </div>
                                      <div class=" row g-3">
                                        <div class="col mb-1">
                                          <label >Email Address</label>
                                          <input type="email" class="form-control" name="email"  required placeholder="Enter Your Email Address">
                                          <div class="invalid-feedback">Please, enter Email Address</div>
                                        </div>
                                        <div class="mb-1">
                                          <label >Password</label>
                                          <input type="password" class="form-control" name="password"  required placeholder="Enter Your Password ">
                                          <div class="invalid-feedback">Please, enter your Password</div>
                                        </div>
                                      </div>
                                        <div class="mb-1">
                                          <input type="file" class="form-control" aria-label="file example" name="photo"   placeholder="profile picture"><br>
                                          <div class="invalid-feedback">Please, enter your photo</div>
                                        </div>
                                        
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                            <label class="form-check-label" for="invalidCheck">
                                              Agree to terms and conditions
                                            </label>
                                            <div class="invalid-feedback">
                                              You must agree before submitting.
                                            </div>
                                          </div>
    
                                        <div class="mb-1">
                                          <button class="btn btn-primary" type="submit" name="enter">Submit form</button>
                                        </div>
                                      </form>
                                      </div>
      </div>    
     </div>
        </div>
        <script src="js/script.js"></script>
        <script src="main.js" defer></script>
      </body>
    </html>
    

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>