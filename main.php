<?php
include "dbc.php";
session_start();

$date = date('d-m-y H:i:s');


if (isset($_SESSION['stuid'])) {
  $session_id = session_id();
  $id = $_SESSION['stuid'];

  $tfetch = $pdo->prepare('SELECT * FROM temporary WHERE uid=:uiid AND exam_type=:etypie');
  $tfetch->bindValue(':uiid', $id);
  $tfetch->bindValue(':etypie', 'Practise');
  $tfetch->execute();
  $tprof = $tfetch->fetchAll(PDO::FETCH_ASSOC);
  if(count($tprof)>0){

  $query = "DELETE FROM temporary WHERE uid = :uid AND exam_type=:etypie";
  $statement = $pdo->prepare($query);
  $statement->bindValue(':uid', $id);
  $statement->bindValue(':etypie', 'Practise');
  $statement->execute();
  }
  $fetch = $pdo->prepare('SELECT * FROM examinee WHERE uiid=:uiid');
  $fetch->bindValue(':uiid', $id);
  $fetch->execute();
  $prof = $fetch->fetchAll(PDO::FETCH_ASSOC);

  foreach ($prof as $pro) {
    $cat = $pro['Department'] ?? null;
    $uid = $pro['uiid'] ?? null;
    $uname = $pro['user_name'] ?? null;
    $fname = $pro['fname'] ?? null;
    $lname = $pro['lname'] ?? null;
    $gname = $pro['gname'] ?? null;
    $gend = $pro['gender'] ?? null;
    $egroup = $pro['ex_group'] ?? null;
    $eyear = $pro['ex_year'] ?? null;
    $phone = $pro['phone'] ?? null;
    $image = $pro['photo'] ?? null;
    $stat = $pro['sttatus'] ?? null;
  }
  $fetch = $pdo->prepare('SELECT dep_name FROM department WHERE dep_id=:cid');
  $fetch->bindValue(':cid', $cat);
  $fetch->execute();
  $show = $fetch->fetchAll(PDO::FETCH_ASSOC);
  foreach ($show as $sho) {
    $catti = $sho['dep_name'] ?? null;
  }
  $_SESSION['exaname'] = $fname . ' ' . $lname . ' ' . $gname;

?>
  <html lang="en">

  <head>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <style>
      body {
        background-color: rgb(220, 220, 220);
      }

      .preloader {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }
    .table-hover tbody tr:hover {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .ffooter {
    background-color: #f8f9fa;
    padding: 10px;
    text-align: center;
    margin-top: 20px;
  
  }

  .ffooter-text {
    color: #6c757d;
    font-size: 14px;
    margin-bottom: 10px;
  }

  .ffooter-link {
    color: #6c757d;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .ffooter-link:hover {
    color: #212529;
  }

    </style>
        <link rel="icon" type="image/x-icon" href="favicon.ico" />

    <link href="css/preloader.css" rel="stylesheet" type="text/css">
    <title>Menu</title>
    <script type="text/javascript">
      // function preventBack() {
      //   window.history.forward();
      // }
      // setTimeout("preventBack()", 0);
      // window.onunload = function() {
      //   null
      // };
    </script>
  </head>

  <body >
 <div class="preloader">
      <div class="spinner-border text-success" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <div class="spinner-border text-warning" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <div class="spinner-border text-danger" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div> 
    
    <div id="pageContent" class="backback container-fluid " style="background: linear-gradient(to right, #8A2BE2, #B12DFC, #D93FFF);
  /* Use vendor prefixes for better browser compatibility */
  background: -moz-linear-gradient(left, #8A2BE2, #B12DFC, #D93FFF);
  background: -webkit-linear-gradient(left, #8A2BE2, #B12DFC, #D93FFF);
  background: linear-gradient(to right, #8A2BE2, #B12DFC, #D93FFF);
" >
      <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-0 border-bottom">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
          <img src="img/logod.png" alt="" width="47" height="44" style="border-radius:55%;" class="d-inline-block align-text-center">
          <span class="navbar-brand text-white fs-3 ms-3">Debark University</span>
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
          <span class="bg-white p-0 rounded-3 btn-hover">
            <a class="nav-link text-primary ml-5" href="session.php"><i class="fas fa-tachometer-alt"></i>Home</a></span>

        </ul>

        <div class="text-end">
          <div class="dropdown  text-end ">
            <a href="#" class="d-block link-white text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="admin/img/examinee/<?php echo $image ?>" alt="<?php echo $fname; ?>" width="42" height="42" class="rounded-circle">
              <strong><?php echo $_SESSION['exaname'] ?></strong>
            </a>
            <ul class="dropdown-menu   text-small">

              <li><a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#change_profile" href="#">
                  <span class="d-inline-block bg-success rounded-circle p-1"></span> Profile</a></li>
              <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#change_password" href="#">
                  <span class="d-inline-block bg-warning rounded-circle p-1"></span> Change Password</a></li>

              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="session">
                  <span class="d-inline-block bg-danger rounded-circle p-1"></span> Sign out</a></li>
            </ul>
          </div>
        </div>
      </header>
    </div>
   



 <div class="modal fade" id="change_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="schange_password" action="#" method="post" class="was-validated" enctype="multipart/form-data">
              <div id="rresponse"></div>
             
              <div class="mb-3">

              <div class="text-center">
            <div class="d-flex flex-column align-items-center">
              <img src="admin/img/examinee/<?php echo $image?>" alt="" width="160" height="172" class="rounded-circle me-2">
              <strong class="mt-2"><?php echo $_SESSION['exaname'] ?></strong>
            </div>
          </div>
              </div>
              
             
          </div>
          <div  class="modal-footer">
            
          </div>
          </form>
        </div>
      </div>
    </div>







    <div id="pageContent" class=" d-flex align-items-start">
      <div class="my-5 bg-white p-3 h-100  nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <button class="mb-3 nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Exam</button>
        <hr>
        <button class="mb-3 nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>
        <hr>
        <button class="mb-3 nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Result</button>
        <hr>
        <button class="mb-3 nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Other</button>
      </div>
      <div class="tab-content" style="width: 80%;" id="v-pills-tabContent">
        <!-- exam -->
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

          <?php
          $current_date = date('Y-m-d');
          $startTime = date('H:i:s');
          $endTime = date('H:i:s', strtotime('+1 hour'));


          $stmt = $pdo->prepare("SELECT ae.*, e.* 
                              FROM assexam ae 
                              INNER JOIN exam e 
                              ON ae.exam_id = e.exam_id 
                              WHERE 
                              ae.assigned_Department = :tdepartment
                              AND (ae.assigned_group = :assigned_group OR ae.assigned_group = :alternate_assigned_group)
                              AND ae.assigned_year = :assigned_year 
                              AND e.exam_date = :exam_date 
                              AND e.exam_type = :exam_type    
                              ORDER BY e.start_time ASC
                              
                              -- AND e.start_time BETWEEN :start_time AND :end_time
                        ");
          $stmt->bindValue(':tdepartment', $cat);
          $stmt->bindValue(':assigned_group', $egroup);
          $stmt->bindValue(':alternate_assigned_group', 'All');
          $stmt->bindValue(':assigned_year', $eyear);
          $stmt->bindValue(':exam_date', $current_date);
          $stmt->bindValue(':exam_type', 'Real');
          //$stmt->bindValue(':start_time', $startTime);
          // $stmt->bindValue(':end_time', $endTime);

          $stmt->execute();
          $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
          $pstmt = $pdo->prepare("SELECT   ae.*, e.* 
                                FROM assexam ae 
                                INNER JOIN exam e 
                                ON ae.exam_id = e.exam_id 
                                WHERE ae.assigned_Department = :tdepartment 
                                AND (ae.assigned_group = :assigned_group OR ae.assigned_group = :alternate_assigned_group)
                                AND ae.assigned_year = :assigned_year 
                                
                                AND e.exam_type = :exam_type    
                                GROUP BY e.exam_id
                                
                          ");
          $pstmt->bindValue(':tdepartment', $cat);
          $pstmt->bindValue(':assigned_group', $egroup);
          $pstmt->bindValue(':alternate_assigned_group', 'All');
          $pstmt->bindValue(':assigned_year', $eyear);
          $pstmt->bindValue(':exam_type', 'Practise');

          $pstmt->execute();
          $presults = $pstmt->fetchAll(PDO::FETCH_ASSOC);
         






          ?>
          <div class="p-4 mb-1 bg-light rounded-3 min-height-200px">
            <div class="container-fluid py-1">
              <?php if (count($results) > 0 ) : 
                $finish_status=0;?>

                <h4  class="mb-3 d-flex justify-content-center align-items-center text-info "><b>Please Select the Exam</b></h4>

                <?php foreach ($results as $row) : ?>
                  <!-- <div class="btu">
        <form action="aobli.php" method="POST" class="justify-content-center align-items-center">
            <input type="hidden" name="cido" value="<?php //echo $cat ?>">
            <input type="hidden" name="uido" value="<?php //echo $uid ?>">
            <input type="submit" name="ask" class="button" value="Start">
        </form>
    </div> -->
                  <?php
                   
                  $ufetch = $pdo->prepare('SELECT * FROM final_result WHERE cat_id=:cid AND exam_id=:examid AND uid=:uiid');
                  $ufetch->bindValue(':cid', $row['cat_id']);
                  $ufetch->bindValue(':examid', $row['exam_id']);
                  $ufetch->bindValue(':uiid', $id);
                  $ufetch->execute();
                  $uresult = $ufetch->fetchAll(PDO::FETCH_ASSOC);

                  $sesfetch = $pdo->prepare('SELECT * FROM user_sessions WHERE  exam_id=:examid AND user_id=:uiid');
                  
                  $sesfetch->bindValue(':examid', $row['exam_id']);
                  $sesfetch->bindValue(':uiid', $id);
                  $sesfetch->execute();
                  $sesresult = $sesfetch->fetchAll(PDO::FETCH_ASSOC);


                  $mqsesfetch = $pdo->prepare('SELECT start_time FROM assexam WHERE assigned_Department=:catid AND exam_id=:examid');
                  $mqsesfetch->bindValue(':catid', $pro['Department']);
                  $mqsesfetch->bindValue(':examid', $row['exam_id']);
                  $mqsesfetch->execute();
                  $mqsesresult = $mqsesfetch->fetch(PDO::FETCH_ASSOC);

                  $squery = "SELECT exam_time  FROM exam WHERE  exam_id=:examid";

                  $snstmt = $pdo->prepare($squery);
                  
                  $snstmt->bindValue(':examid',$row['exam_id']);
                  $snstmt->execute();
     
                  // Fetch the result
                  $snnresult = $snstmt->fetch(PDO::FETCH_ASSOC);

                  $qsesfetch = $pdo->prepare('SELECT estatus FROM assexam WHERE assigned_Department=:catid AND exam_id=:examid');
                  $qsesfetch->bindValue(':catid', $pro['Department']);
                  $qsesfetch->bindValue(':examid', $row['exam_id']);
                  $qsesfetch->execute();
                  $qsesresult = $qsesfetch->fetch(PDO::FETCH_ASSOC);

                  $query = "SELECT CONCAT(exam_date, ' ', start_time) AS datetime_combined FROM assexam WHERE assigned_Department=:catid AND exam_id=:examid";

                    $nstmt = $pdo->prepare($query);
                    $nstmt->bindValue(':catid', $pro['Department']);
                    $nstmt->bindValue(':examid', $row['exam_id']);
                    $nstmt->execute();

                    // Fetch the result
                    $nnresult = $nstmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve the combined datetime value
                    try {
                      $combinedDateTime = $nnresult['datetime_combined'];
                  
                      $targetDateTime = $combinedDateTime;
                  
                      // Convert the target date and time to GMT+3 with 12-hour format
                      $target = new DateTime($targetDateTime, new DateTimeZone('Etc/GMT+3'));
                      $target->setTimeZone(new DateTimeZone('Etc/GMT+3'));
                      $targetDateTimeFormatted = $target->format('Y-m-d h:i:s A');
                      
                      // Get the current date and time in GMT+3 with 12-hour format
                      date_default_timezone_set('Etc/GMT+3');
                      $currentDateTime = date('Y-m-d h:i:s A');
                      
                      // Calculate the remaining time in seconds
                      $remainingTime = $target->getTimestamp() - strtotime($currentDateTime);
                      
                      // Use the remaining time as needed
                      $minutesToAdd = $snnresult['exam_time']; // Change this value to the desired number of minutes to add
                      $target->add(new DateInterval('PT' . $minutesToAdd . 'M'));
                        
                        // Calculate the remaining time in seconds
                      $finishemainingTime = $target->getTimestamp() - strtotime($currentDateTime);  
                      if ($finishemainingTime < 0) {
                        $finishemainingTime = 0;
                        $finish_status=1;
                        }                      
 





                  } catch (Exception $e) {
                      // Handle the exception/error here
                      echo "Error: " . $e->getMessage();
                  }
                  ?>
                  <?php if (count($uresult) == 0 && count($sesresult) == 0 &&  $qsesresult['estatus'] == '1' &&  $mqsesresult['start_time'] !='' && $finish_status== 0 ) : ?>

                    <?php $fetch = $pdo->prepare('SELECT   cat_name FROM category WHERE cat_id=:cid');
                    $fetch->bindValue(':cid', $row['cat_id']);
                    $fetch->execute();
                    $rresult = $fetch->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($rresult as $rrow) {
                      $catname = $rrow['cat_name'];
                    } ?>

                    <form action="sesstrans.php" method="POST">
                      <div class="list-group  w-auto mb-3">
                        <input type="hidden" name="cido" value="<?php echo $row['cat_id'] ?>">
                        <input type="hidden" name="exido" value="<?php echo $row['exam_id'] ?>">
                        <input type="hidden" name="etype" value="<?php echo $row['exam_type'] ?>">
                              <?php
                              
                              if ($remainingTime < 0) {
                                $remainingTime = 0;
                            }

                            // Echo the button HTML with counter and JavaScript functionality
                            echo '<button onclick="edit(event,'.$row['cat_id'].','.$row['exam_id'].','.$row['exam_type'].')"

                            id="button_' . $row['exam_id'] . '" disabled  name="ask" type="submit" class="list-group-item list-group-item-action d-flex gap-3 py-2" aria-current="true">
                            <img src="img/logod.png" alt="DKU" width="32" height="32" class="rounded-circle flex-shrink-0">

                            <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                              <h6 class="mb-0">
                                <h5>
                                  <span class="text-start">'.$catname.'</span>

                                </h5>

                              </h6>
                            </div>
                            <b id="counter_' . $row['exam_id'] . '" class="fs-5 text-info text-nowrap"></b>
                            <small class=" text-primary text-nowrap">Type: '.$row['exam_type'].'</small>
                          </div>
                            
                            
                            </button>';
                            
                            echo '<script>';
                            echo 'var counter_' . $row['exam_id'] . ' = ' . $remainingTime . ';';
                            echo 'var button_' . $row['exam_id'] . ' = document.getElementById("button_' . $row['exam_id'] . '");';
                            echo 'var counterElement_' . $row['exam_id'] . ' = document.getElementById("counter_' . $row['exam_id'] . '");';
                            echo 'function updateCounter_' . $row['exam_id'] . '() {';
                            echo '  var hours = Math.floor(counter_' . $row['exam_id'] . ' / 3600);';
                            echo '  var minutes = Math.floor((counter_' . $row['exam_id'] . ' % 3600) / 60);';
                            echo '  var seconds = counter_' . $row['exam_id'] . ' % 60;';
                            echo '  counterElement_' . $row['exam_id'] . '.textContent = "Start in: " + hours + "h : " + minutes + "m : " + seconds + "s";';

                            echo '  if (counter_' . $row['exam_id'] . ' <= 0) {';
                            echo '    button_' . $row['exam_id'] . '.removeAttribute("disabled");';
                            echo '    counterElement_' . $row['exam_id'] . '.innerHTML = "<b class=\'text-success fs-5\'>Start!</b>";';
                            echo '    clearInterval(interval_' . $row['exam_id'] . ');';
                            echo '  } else {';
                            echo '    counter_' . $row['exam_id'] . '--;';
                            echo '  }';
                            echo '}';
                            echo 'var interval_' . $row['exam_id'] . ' = setInterval(updateCounter_' . $row['exam_id'] . ', 1000);';
                            echo '</script>';
    
    
    
                      ?>
                        <!-- <button  onclick="edit(event,'<?php //echo $row['cat_id'] ?>','<?php //echo $row['exam_id'] ?>','<?php //echo $row['exam_type'] ?>')" 
                        name="ask" type="submit" class="list-group-item list-group-item-action d-flex gap-3 py-2" aria-current="true">
                          <img src="img/logod.png" alt="DKU" width="32" height="32" class="rounded-circle flex-shrink-0">
                          <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                              <h6 class="mb-0">
                                <h5>
                                  <span class="text-start"><?php //echo $catname ?></span>

                                </h5>
                                <span id="contdown"></span>

                              </h6>
                            </div>
                            <b class="fs-5 text-info text-nowrap" id="countdown"></b>

                            <small class=" text-primary text-nowrap">Type: <?php //echo $row['exam_type'] ?></small>
                          </div>
                        </button> -->

                      </div>
                    </form>
                    <div class="b-example-divider"></div>

                  <?php endif;?>
                  <?php endforeach; ?>


                    <?php foreach ($presults as $row) : ?>

                      <?php $fetch = $pdo->prepare('SELECT   cat_name FROM category WHERE cat_id=:cid');
                      $fetch->bindValue(':cid', $row['cat_id']);
                      $fetch->execute();
                      $rresult = $fetch->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($rresult as $rrow) {
                        $catname = $rrow['cat_name'];
                      } ?>

                      <form action="sesstrans" method="POST">
                        <div class="list-group  w-auto mb-3">
                          <input type="hidden" name="cido" value="<?php echo $row['cat_id'] ?>">
                          <input type="hidden" name="exido" value="<?php echo $row['exam_id'] ?>">
                          <input type="hidden" name="etype" value="<?php echo $row['exam_type'] ?>">

                          <button onclick="edit(event,'<?php echo $row['cat_id'] ?>','<?php echo $row['exam_id'] ?>','<?php echo $row['exam_type'] ?>')" name="ask" type="submit" class="list-group-item list-group-item-action d-flex gap-3 py-2" aria-current="true">
                            <img src="img/logod.png" alt="DKU" width="32" height="32" class="rounded-circle flex-shrink-0">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                              <div>
                                <h6 class="mb-0">
                                  <h5>
                                    <span class="text-start"><?php echo $catname ?></span>

                                  </h5>
                                </h6>

                              </div>
                              <small class="text-primary text-nowrap">Type: <?php echo $row['exam_type'] ?></small>
                            </div>
                          </button>

                        </div>
                      </form>
                      <div class="b-example-divider"></div>

                    <?php endforeach; ?>


               

                <!----practise Exam--->
              <?php elseif (count($presults) > 0) : ?>

                <h4 class="mb-3 d-flex justify-content-center align-items-center text-info "><b>Please Select the Exam</b></h4>

                <?php foreach ($presults as $row) : ?>

                  <?php $fetch = $pdo->prepare('SELECT DISTINCT  cat_name FROM category WHERE cat_id=:cid');
                  $fetch->bindValue(':cid', $row['cat_id']);
                  $fetch->execute();
                  $rresult = $fetch->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($rresult as $rrow) {
                    $catname = $rrow['cat_name'];
                  } ?>

                  <form action="sesstrans" method="POST">
                    <div class="list-group  w-auto mb-3">
                      <input type="hidden" name="cido" value="<?php echo $row['cat_id'] ?>">
                      <input type="hidden" name="exido" value="<?php echo $row['exam_id'] ?>">
                      <input type="hidden" name="etype" value="<?php echo $row['exam_type'] ?>">

                      <button onclick="edit(event,'<?php echo $row['cat_id'] ?>','<?php echo $row['exam_id'] ?>','<?php echo $row['exam_type'] ?>')" name="ask" type="submit" class="list-group-item list-group-item-action d-flex gap-3 py-2" aria-current="true">
                        <img src="img/logod.png" alt="DKU" width="32" height="32" class="rounded-circle flex-shrink-0">
                        <div class="d-flex gap-2 w-100 justify-content-between">
                          <div>
                            <h6 class="mb-0">
                              <h5>
                                <span class="text-start"><?php echo $catname ?? null; ?></span>

                              </h5>
                            </h6>

                          </div>
                          <small class=" text-primary text-nowrap">Type: <?php echo $row['exam_type'] ?></small>
                        </div>
                      </button>

                    </div>
                  </form>
                  <div class="b-example-divider"></div>

                <?php endforeach; ?>

              <?php else : ?>
                <div class="list-group   w-auto mb-3">
                  <div class="list-group-item list-group-item-action   w-auto py-2" aria-current="true">
                    <h5 class="alert alert-danger  w-auto">NO Available Exam!</h5>
                  </div>
                </div>


              <?php endif; ?>

            </div>
          </div>


         

        </div>
        <!-- Profile -->
        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
          <div class="p-3 mb-1 bg-light rounded-3 h-100">
            <div class="container-fluid py-1">
              <div style="max-width: 550px;border-radius: 15px;height: 550px; background-color: #f4f5f7;" class="card mb-3  container">
                <nav class="navbar navbar-light  container" style="background-color: rgb(72,209,204);">
                  <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1 container">DKU OES Entrance profile</span>
                  </div>
                </nav>
                <div class="row g-0 d-flex">
                  <div class="col-md-4">
                    <div class="row mb-4" style="margin-top:3px;">
                      <img src="admin/img/examinee/<?php echo $image ?>" class="img-fluid rounded-start" alt="No Image Found!" style="height: 168px;">
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="card mb-4">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-sm-5">
                            <p class="mb-0">Full Name</p>
                          </div>
                          <div class="col-sm-7">
                            <p class="text-muted mb-0" style="text-transform: capitalize ;"><?php echo $fname . ' ' . $lname . ' ' . $gname; ?></p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-5">
                            <p class="mb-0">Gender</p>
                          </div>
                          <div class="col-sm-7">
                            <p class="text-muted mb-0" style="text-transform: capitalize ;"><?php echo $gend ?></p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-5">
                            <p class="mb-0">Department</p>
                          </div>
                          <div class="col-sm-7">
                            <p class="text-muted mb-0" style="text-transform: capitalize ;"><?php echo $catti ?></p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-5">
                            <p class="mb-0">Username</p>
                          </div>
                          <div class="col-sm-7">
                            <p class="text-muted mb-0" style="text-transform: capitalize ;"><?php echo $uname ?></p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-5">
                            <p class="mb-0">Password</p>
                          </div>
                          <div class="col-sm-7">
                            <p class="text-muted mb-0" style="text-transform: capitalize ;">*************</p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-5">
                            <p class="mb-0">User ID </p>
                          </div>
                          <div class="col-sm-7">
                            <p class="text-muted mb-0" style="text-transform: capitalize ;"><?php echo $uid ?></p>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-sm-5">
                            <p class="mb-0">Phone</p>
                          </div>
                          <div class="col-sm-7">
                            <p class="text-muted mb-0"><?php echo $phone ?></p>
                          </div>
                        </div>
                        <hr>

                        <div class="row">
                          <div class="col-sm-5">
                            <p class="mb-0">Status</p>
                          </div>
                          <div class="col-sm-7">

                            <?php if ($stat == 2) : ?>
                              <h4><span class="mb-0 badge bg-warning">Pending...</span></h4>
                            <?php endif; ?>
                            <?php if ($stat == 1) : ?>
                              <h4><span class="mb-0 badge bg-success">Active</span></h4>
                            <?php endif; ?>
                            <?php if ($stat == 0) : ?>
                              <h4><span class="mb-0 badge bg-danger">Banned</span></h4>
                            <?php endif; ?>

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

        <!-- Result -->

        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
          <div class="p-4 mb-1 bg-light rounded-3 h-100">
            <div class="container-fluid py-1">
              <div id="result_section">
            <?php
              $dstmt = $pdo->prepare("SELECT * FROM final_result WHERE uid = :uidd ORDER BY date DESC  ");
              $dstmt->bindValue(':uidd', $_SESSION['stuid']);
              $dstmt->execute();
              $wpr=$dstmt->fetchALL(PDO::FETCH_ASSOC);

            ?>
                  <?php if(count($wpr)>0):?>
                    <div class="table table-responsive table-bordered table-striped container">
                    <table class="table table-striped table-hover container table-hover">
                    <tr class="table-info">
                      <th id="tempo" class="table-info">Course</th>
                      <th class="table-info">Exam</th>
                      <th class="table-info">Result</th>
                      <th class="table-info">Status</th>
                      <th class="table-info">Action</th>

                    </tr>
                    <tbody>
                        
                      <?php foreach($wpr as $wp):
                        $nfetch=$pdo->prepare('SELECT * FROM category WHERE cat_id = :uid');
                        $nfetch->bindValue(':uid',$wp['cat_id']);
                        $nfetch->execute();
                        $nshow=$nfetch->fetch(PDO::FETCH_ASSOC);

                        $fetn=$pdo->prepare('SELECT * FROM exam WHERE exam_id=:cid');
                        $fetn->bindValue(':cid',$wp['exam_id']);
                        $fetn->execute();
                        $prn=$fetn->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <tr>
                          <td>
                            <?php echo $nshow['cat_name'];?>
                          </td>
                          <td>
                          <?php echo $prn['exam_name'];?>
                          </td>
                          <td>
                          <b><?php 

                          $query = "SELECT CONCAT(exam_date, ' ', start_time) AS datetime_combined  FROM assexam WHERE assigned_Department=:catid AND exam_id=:examid";

                          $nstmt = $pdo->prepare($query);
                          $nstmt->bindValue(':catid', $cat);
                          $nstmt->bindValue(':examid',$wp['exam_id']);
                          $nstmt->execute();

                          // Fetch the result
                          $nnresult = $nstmt->fetch(PDO::FETCH_ASSOC);



                          // Fetch the result

                          // Retrieve the combined datetime value
                          $combinedDateTime = $nnresult['datetime_combined'];

                          $targetDateTime = $combinedDateTime;

                          // Convert the target date and time to GMT+3 with 12-hour format
                          $target = new DateTime($targetDateTime, new DateTimeZone('Etc/GMT+3'));
                          $target->setTimeZone(new DateTimeZone('Etc/GMT+3'));
                          $targetDateTimeFormatted = $target->format('Y-m-d h:i:s A');

                          // Get the current date and time in GMT+3 with 12-hour format
                          date_default_timezone_set('Etc/GMT+3');
                          $currentDateTime = date('Y-m-d h:i:s A');

                          $minutesToAdd = $prn['exam_time']; // Change this value to the desired number of minutes to add
                          $target->add(new DateInterval('PT' . $minutesToAdd . 'M'));
                          $ffinish_status = 0;
                          // Calculate the remaining time in seconds
                          $rremainingTime = $target->getTimestamp() - strtotime($currentDateTime);  
                                          if ($rremainingTime < 0) {
                                            $rremainingTime = 0;
                                            $ffinish_status=1;
                                        }                      






                          if($ffinish_status == 1 ){
                          echo $wp['result'].'%';
                          }
                          
                          ?></b>
                          </td>
                           <td>
                           <?php if($ffinish_status == 1 ):?>
                           <?php if($nshow['cat_type'] == 'COC'):?>
                            <?php if($wp['stat'] == '1'):?>
                              <span class="mb-0 badge bg-success">Pass</span>
                              <?php else: ?>
                                <span class="mb-0 badge bg-danger">Failled</span>
                                <?php endif;?>  
                            <?php else: ?>

                            <?php endif;?> 
                            <?php endif;?> 

                           </td>
                           <td>
                            <form action="result" method="post">
                              <input type="hidden" value="<?php echo $wp['cat_id']?>" name="cat_id">
                              <input type="hidden" value="<?php echo $wp['exam_id'];?>" name="exam_id">
                              <input type="hidden" value="<?php echo $wp['etype'];?>" name="etype">
                              <button type="submit" class="btn btn-info" name="view_detail">Detail</button>
                            </form> 
                          </td>

                        </tr>
                        <?php endforeach;?>
                    </tbody>
                    </table>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-danger">There is no any available result!  </div>
                  
                  <?php endif;?>  
            </div>

              
            </div>

          </div>
 
        </div>
        <!-- Other -->

        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">


        </div>
      </div>

    </div>

    <!----Modal_Start---->
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="change_password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="sschange_password" method="post" class="was-validated">
              <div id="response"></div>
              <input type="hidden" value="<?php echo $_SESSION['stuid'] ?>" id="userid">
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

    <script src="js/bootstrap.bundle.min.js"></script>

    <script src="js/pwstrength-bootstrap.min.js"></script>
    <script src="js/zxcvbn.js"></script>
    <script src="js/password-meter-active.js"></script>
    <script src="js/preloader.js"></script>
    <span class="ffooter">
  <p class="ffooter-text">© 2023 DKU CS GROUP 2. All rights reserved.</p>
  <p class="ffooter-text">
    We Strive for Institutional <a class="ffooter-link" href="#">Quality</a>
  </p>
                    </span>
  </body>


  




  <script>
    // Set the timer to 3 minutes
    var timer = setTimeout(function() {
      // Redirect to the logout page
      window.location.href = 'session.php';
    }, 25 * 60 * 1000);

    // Reset the timer on any activity
    document.addEventListener('mousemove', function() {
      clearTimeout(timer);
      timer = setTimeout(function() {
        window.location.href = 'session.php';
      }, 25 * 60 * 1000);
    });
    window.onunload = function() {
      window.location.href = 'session.php';
    };
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '.change_p', function() {

        var user_id = document.forms["sschange_password"]["userid"].value;
        var old_pass = document.forms["sschange_password"]["old_password"].value;
        var new_password = document.forms["sschange_password"]["new_password"].value;
        var conf_pass = document.forms["sschange_password"]["Confirm_password"].value;

        if (new_password != conf_pass) {
          $('#response').html('<div class="alert alert-danger">Passwords does not match.</div>');
          return;
        }
        if (new_password.length < 8) {
          $('#response').html('<div class="alert alert-danger"> Password must be at least 8 characters long.</div>');
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
            page: 'main',
            action: 'stu_pass'
          },
          success: function(data) {
            $('#response').html(data);

          }
        })



      });
    });
  </script>
<?php } else {
  echo "<script>
                var conf = confirm('Access Denied! ');
            if(conf == true){

                window.location='index'; 
              
            }
                    else{
                        window.location='index'; 

              }
          
          </script>";
} ?>