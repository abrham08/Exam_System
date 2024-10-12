<?php
include "dbc.php";
session_start();

$date = date('d-m-y H:i:s');
$sfinal = '';
$statd = '';
if (isset($_SESSION['stuid'])) {
  $id = $_SESSION['stuid'];
  $cat_id = $_SESSION['cat_id'];
  $exam_id = $_SESSION['exam_id'];
  $etype = $_SESSION['etype'];
  $session_id = session_id();

  $fetch = $pdo->prepare('SELECT * FROM examinee WHERE uiid=:uiid');
  $fetch->bindValue(':uiid', $id);
  $fetch->execute();
  $prof = $fetch->fetch(PDO::FETCH_ASSOC);

  if($_SESSION['etype'] == 'Real'){
  $ufetch = $pdo->prepare('SELECT * FROM final_result WHERE cat_id=:cid AND exam_id=:examid AND uid=:uiid');
  $ufetch->bindValue(':cid',  $cat_id);
  $ufetch->bindValue(':examid', $exam_id);
  $ufetch->bindValue(':uiid', $id);
  $ufetch->execute();
  $uresult = $ufetch->fetchAll(PDO::FETCH_ASSOC);
  if(count($uresult) > 0){
    echo "<script>
            var conf = confirm('Access Denied! ');
        if(conf == true){

            window.location='session'; 
          
        }
                else{
                    window.location='session'; 

          }

        </script>";
  }
  $sesfetch = $pdo->prepare('SELECT * FROM user_sessions WHERE session_id=:scid AND exam_id=:examid AND user_id=:uiid');
  $sesfetch->bindValue(':scid', $session_id);
  $sesfetch->bindValue(':examid',  $exam_id);
  $sesfetch->bindValue(':uiid', $_SESSION['stuid']);
  $sesfetch->execute();
  $sesresult = $sesfetch->fetchAll(PDO::FETCH_ASSOC);
  if(count($sesresult) > 0){
    echo "<script>
            var conf = confirm('Access Denied! ');
        if(conf == true){

            window.location='exam'; 
          
        }
                else{
                    window.location='exam'; 

          }

        </script>";

  }
}

  $fetch = $pdo->prepare('SELECT sttatus FROM examinee WHERE uiid=:uiid');
  $fetch->bindValue(':uiid', $id);
  $fetch->execute();
  $profi = $fetch->fetch(PDO::FETCH_ASSOC);
  $statd = $profi['sttatus'] ?? null;

  if ($statd == 0) {
    echo "<script>
       var conf = confirm('Sorry Your Status is not Active !');
         if(conf == true){
   
       window.history.back();}
       else{
           window.history.back();;

   
       
       }
       
       </script>";
  } else {

  if($_SESSION['etype'] == 'Real'){
    $etch = $pdo->prepare('SELECT im_status FROM assexam WHERE assigned_Department=:cid AND exam_id=:exami ');
    $etch->bindValue(':cid',$prof['Department']);
    $etch->bindValue(':exami', $exam_id);
    $etch->execute();
    $sta = $etch->fetch(PDO::FETCH_ASSOC);
    $sfinal = $sta['im_status'];
  }
  else{
    $sfinal=1;
  }
  }




?>
  <html>

  <head>
  <link rel="icon" type="image/x-icon" href="favicon.ico" />

    <title>Instruction</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <script type="text/javascript">
                function preventBack() {
                    window.history.forward();
                }
                setTimeout("preventBack()", 0);
                window.onunload = function() {
                    null
                };
            </script>
<style>
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

  <body class="">
    <nav class="navbar navbar-light" style="background: linear-gradient(to right, #8A2BE2, #B12DFC, #D93FFF);
  /* Use vendor prefixes for better browser compatibility */
  background: -moz-linear-gradient(left, #8A2BE2, #B12DFC, #D93FFF);
  background: -webkit-linear-gradient(left, #8A2BE2, #B12DFC, #D93FFF);
  background: linear-gradient(to right, #8A2BE2, #B12DFC, #D93FFF);">
      <div class="container-fluid d-flex justify-content-start align-items-center">
        <a class="navbar-brand" href="#">
          <img src="img/logod.png" alt="" width="47" height="44" style="border-radius:55%;" class="d-inline-block align-text-center">
          <span class="navbar-brand text-white fs-3 ms-3">Debark University</span>
        </a>
        <div class="d-flex justify-content-center align-items-center">
          <span class="bg-white p-2 rounded-3 btn-hover me-3">
            <a class="nav-link text-primary" href="session"><i class="fas fa-tachometer-alt"></i>Home</a>
          </span>
          <span class="bg-white p-2 rounded-3 btn-hover">
            <a class="nav-link text-primary" href="main"><i class="fas fa-tachometer-alt"></i>Back</a>
          </span>
        </div>
      </div>
    </nav>


    <?php if ($sfinal == 1) : ?>
      <div class="card">

        <div class="card-body container">
          <h5 class="card-title"><b></b></h5>
          <p class="card-text">
          <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item mb-3">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="bg-light accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                  <b>Exam Description</b>
                </button>
              </h2>
              <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  <div class="p-3 mb-1 bg-light rounded-3 min-height-200px">
                    <?php

                    $qsesfetch = $pdo->prepare('SELECT * FROM exam WHERE cat_id=:catid AND exam_id=:examid');
                    $qsesfetch->bindValue(':catid', $_SESSION['cat_id']);
                    $qsesfetch->bindValue(':examid', $_SESSION['exam_id']);
                    $qsesfetch->execute();
                    $qsesresult = $qsesfetch->fetch(PDO::FETCH_ASSOC);

                    $fetch = $pdo->prepare('SELECT DISTINCT  cat_name FROM category WHERE cat_id=:cid');
                    $fetch->bindValue(':cid', $_SESSION['cat_id']);
                    $fetch->execute();
                    $rresult = $fetch->fetch(PDO::FETCH_ASSOC);



                    $fetch = $pdo->prepare('SELECT dep_name FROM department WHERE dep_id=:cid');
                    $fetch->bindValue(':cid', $prof['Department']);
                    $fetch->execute();
                    $show = $fetch->fetch(PDO::FETCH_ASSOC);

                    $_SESSION['cname'] = $rresult['cat_name'];


                    ?>
                    <div class="container-fluid py-1">

                      <div class="card mb-2">
                        <div class="card-body">
                          <div class="row mb-1">
                            <div class="col">
                              <p class="mb-0">
                              <h5>Name <u class="text-primary"> <?php echo $_SESSION['exaname'] ?></u> Id <u class="text-primary"><?php echo $_SESSION['stuid'] ?></u></h5>
                              </p>
                            </div>
                          </div>
                          <hr>
                          <hr>
                          <div class="row">
                            <div class="col-6">
                              <div class="row">
                                <div class="col-sm-5">
                                  <p class="mb-0">Course</p>
                                </div>
                                <div class="col-sm-7">
                                  <p class="text-muted mb-0" style="text-transform: capitalize ;"><?php echo $rresult['cat_name']; ?></p>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-sm-5">
                                  <p class="mb-0">Given Time</p>
                                </div>
                                <div class="col-sm-7">
                                  <p class="text-muted mb-0" style="text-transform: capitalize ;"><?php echo  $qsesresult['exam_time']; ?> Minutes</p>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-sm-5">
                                  <p class="mb-0">Number of Question</p>
                                </div>
                                <div class="col-sm-7">
                                  <p class="text-muted mb-0" style="text-transform: capitalize ;"><?php echo $qsesresult['exam_nq']; ?></p>
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="row">
                                <div class="col-sm-5">
                                  <p class="mb-0">Type</p>
                                </div>
                                <div class="col-sm-7">
                                  <p class="text-muted mb-0" style="text-transform: capitalize ;"><?php echo  $_SESSION['etype']  ?></p>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-sm-5">
                                  <p class="mb-0">Target</p>
                                </div>
                                <div class="col-sm-7">
                                  <p class="text-muted mb-0" style="text-transform: capitalize ;"><?php echo $prof['ex_group'] . ' ' . $prof['ex_year'] . '<sup>th</sup>' . ' ' . 'Year' . ' ' . $show['dep_name']  ?></p>
                                </div>
                              </div>
                              <hr>
                              <div class="row">
                                <div class="col-sm-5">
                                  <p class="mb-0">Date</p>
                                </div>
                                <div class="col-sm-7">
                                  <p class="text-muted mb-0" style="text-transform: capitalize ;"><?php echo date('d-m-y'); ?></p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>



                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="accordion-item mb-3">
              <h2 class="accordion-header" id="flush-headingTwo">
                <button class="bg-light accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                  <b>Instructions and Guidelines for the Candidates for Online Examination</b>
                </button>
              </h2>
              <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                  => Cheating or any attempt to cheat will result in disqualification of your work.</br>
                  => You must check your name and ID on your profile and exam page.</br>
                  => If you are ready to take the exam click the <b style="color: red;">start</b> button below. </br>
                  => There will be NO NEGATIVE MARKING for the wrong answers.</br>
                  => Each student will get questions and answers in different order selected randomly
                  from a fixed Question Databank.</br>
                  => The students just need to click on the Right Choice / Correct option from the
                  multiple choices /options given with each question.</br>
                </div>
              </div>
            </div>
            <div class="accordion-item mb-3">
              <h2 class="accordion-header" id="flush-headingThree">
                <button class="bg-light accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                  <b>The sequence of steps to be followed by each examinee for appearing in Examination</b>
                </button>
              </h2>
              <div id="flush-collapseThree" class="accordion-collapse collapse " aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">


                  <b>*</b> The Time of the examination begins only when the ‘Start Test’ button is pressed.</br>
                  <b>*</b> You can proceed answering the questions one by one by clicking on the small
                  grey circle next to the chosen answer.</br>
                  <b>*</b>You can move to Previous, Next and unanswered questions by
                  clicking on the buttons with respective labels displayed on screen throughout the
                  test.</br>
                  <b>*</b> The answers can be changed at any time during the test and are saved
                  automatically.</br>
                  <b>*</b> It is possible to Review the answered as well as the unanswered questions.</br>
                  <b>*</b> The Time remaining is shown in the Left Top Corner of the screen.</br>
                  <b>*</b> The system automatically shuts down when the time limit is over OR alternatively if
                  examinee finishes the exam before time he can quit by pressing the <b style="color: red;"> ‘Finish’ </b>
                  button.
                </div>
              </div>
            </div>
          </div>


          <b>Important: Do not click the <b style="color:red ;">"Finish"</b>button unless you want to leave early </b></br>


          </p>


          <a href="exam" name="ask" class="bigo btn btn-primary" value="">Start</a>
          </div>
        </div>
      <?php endif; ?>
      <?php if ($sfinal == 0) : ?>
        <div class="card border-danger ml-auto mt-5" style="max-width: 18rem;">
          <div class="card-header">DKU OES</div>
          <div class="card-body text-danger">
            <h3 class="card-title">Please wait until the examiner activate the exam...!</h3>

          </div>
        </div>
        <script>
          setInterval(function() {
            location.reload();
          }, 5000); // 5000 milliseconds = 5 seconds
        </script>

        <?php endif; ?>
  </body>
  <footer class="footer">
  <p class="footer-text">© 2023 DKU CS GROUP 2. All rights reserved.</p>
  <p class="footer-text">
    We Strive for Institutional <a class="footer-link" href="#">Quality</a>
  </p>
</footer>
  <script>
    // Set the timer to 3 minutes
    var timer = setTimeout(function() {
      // Redirect to the logout page
      window.location.href = 'session.php';
    }, 10 * 60 * 1000);

    // Reset the timer on any activity
    document.addEventListener('mousemove', function() {
      clearTimeout(timer);
      timer = setTimeout(function() {
        window.location.href = 'session';
      }, 10 * 60 * 1000);
    });
    window.onunload = function() {
      window.location.href = 'session';
    };
  </script>

  </html>
<?php } else {
  echo "<script>
                var conf = confirm('Access Denied! ');
            if(conf == true){

                window.location='index.php'; 
              
            }
                    else{
                        window.location='index.php'; 

              }
          
          </script>";
} ?>