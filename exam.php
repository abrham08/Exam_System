<?php

include "dbc.php";
session_start();
$date = date('d-m-y H:i:s');

if (isset($_SESSION['stuid']) && isset($_SESSION['stuid']) ) {

    $cat_id = $_SESSION['cat_id'];
    $exam_id = $_SESSION['exam_id'];
    $user_id = $_SESSION['stuid'];
    $session_id = session_id();

    $ufetch = $pdo->prepare('SELECT * FROM final_result WHERE cat_id=:cid AND exam_id=:examid AND uid=:uiid');
    $ufetch->bindValue(':cid',  $cat_id);
    $ufetch->bindValue(':examid', $exam_id);
    $ufetch->bindValue(':uiid', $_SESSION['stuid']);
    $ufetch->execute();
    $uresult = $ufetch->fetchAll(PDO::FETCH_ASSOC);
    if (count($uresult) > 0) {
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


    if ($_SESSION['etype'] == 'Real') {
        $sesfetch = $pdo->prepare('SELECT * FROM user_sessions WHERE  exam_id=:examid AND user_id=:uiid');
        $sesfetch->bindValue(':examid',  $exam_id);
        $sesfetch->bindValue(':uiid', $_SESSION['stuid']);
        $sesfetch->execute();
        $sesresult = $sesfetch->fetchAll(PDO::FETCH_ASSOC);
        if (count($sesresult) == 0) {
            $currentDateTime = date('H:i:s');
            $insertQuery = $pdo->prepare('INSERT INTO user_sessions (session_id, exam_id, user_id, login_time) VALUES (:scid, :examid, :uiid, :createdAt)');
            $insertQuery->bindValue(':scid', $session_id);
            $insertQuery->bindValue(':examid', $exam_id);
            $insertQuery->bindValue(':uiid', $_SESSION['stuid']);
            $insertQuery->bindValue(':createdAt', $currentDateTime);
            $insertQuery->execute();
        }
    }
    
    if ($_SESSION['etype'] == 'Real') {

        $sfetch = $pdo->prepare('SELECT * FROM examinee WHERE uiid=:uiid');
        $sfetch->bindValue(':uiid', $user_id);
        $sfetch->execute();
        $pro = $sfetch->fetch(PDO::FETCH_ASSOC);
      
        $query = "SELECT  CONCAT(exam_date, ' ', start_time) AS datetime_combined FROM assexam WHERE assigned_Department=:catid AND exam_id=:examid";

        $nstmt = $pdo->prepare($query);
        $nstmt->bindValue(':catid', $pro['Department']);
        $nstmt->bindValue(':examid', $exam_id);
        $nstmt->execute();
        
        $fetch = $pdo->prepare('SELECT exam_time, start_time FROM exam WHERE cat_id=:cid AND exam_id=:exid');
        $fetch->bindValue(':cid', $cat_id);
        $fetch->bindValue(':exid', $exam_id);
        $fetch->execute();
        $result = $fetch->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $duration = $row['exam_time'];
            $stime = $row['start_time'];
        }

        $tpassed = 0;
        
     

        $time_limit =  $duration * 60;

        // Fetch the result
        $nnresult = $nstmt->fetch(PDO::FETCH_ASSOC);

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
        
        // Calculate the remaining time in seconds
        $elapsed_time =   strtotime($currentDateTime) - $target->getTimestamp();
        $endtime =   $time_limit + $target->getTimestamp();












       // $start_time = strtotime($stime);
        $endtime = $target->getTimestamp() + $time_limit;
       // date_default_timezone_set('UTC');
      //  $now = strtotime(gmdate('Y-m-d H:i:s'));
       // $elapsed_time = $now - $start_time;
        $time_remaining = $time_limit - $elapsed_time;
        if (strtotime($currentDateTime) >= $endtime) {
            $time_remaining = 1;
        }

        
        $time_remaining = abs($time_remaining);
   
   $tpassed= $time_limit - $time_remaining;
   
  
   

    } else {

        $fetch = $pdo->prepare('SELECT exam_time, start_time FROM exam WHERE cat_id=:cid AND exam_id=:exid');
        $fetch->bindValue(':cid', $cat_id);
        $fetch->bindValue(':exid', $exam_id);
        $fetch->execute();
        $result = $fetch->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $duration = $row['exam_time'];
        }
        $time_remaining = $duration * 60;
        $tpassed = 1000;
    }

    $stmmtk = $pdo->prepare("SELECT * FROM question WHERE cat_id = :cat_id AND exam_id = :exam_id ");
    $stmmtk->bindValue(':cat_id', $cat_id);
    $stmmtk->bindValue(':exam_id', $exam_id);
    $stmmtk->execute();
    $resu = $stmmtk->fetchAll(PDO::FETCH_ASSOC);

    if (count($resu) > 0) {



        //$stmt = $con->prepare("SELECT * FROM `question` WHERE `cid`=? ORDER BY RAND()");

?>

        <!DOCTYPE html>
        <html lang="en" id="player3">

        <head>
            <link rel="icon" type="image/x-icon" href="favicon.ico">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>DKU OES</title>
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
            <link href="admin/css/all.min.css" rel="stylesheet" type="text/css">
            <link href="admin/css/fontawesome.min.css" rel="stylesheet" type="text/css">
            <link rel="stylesheet" href="css/gh.css" />
            <link rel="stylesheet" href="css/TimeCircles.css" />
            <link rel="stylesheet" href="css/modals.css">
            <script src="js/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>

            <style>
                html {
                    height: 100%;
                }

                body {
                    height: 100%;
                    padding: 0;
                }

                table th div,

                .slider .links>a {
                    background: whitesmoke !important;
                }

                .row-container {
                    display: grid;
                    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                    grid-gap: 3px;

                }
                .enlarged-photo {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background-color: rgba(0, 0, 0, 0.0);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 9999;
                    }

                    .enlarged-photo img {
                    max-height: 80vh;
                    max-width: 80vw;
                    }




                .base-timer {
                    position: relative;
                    width: 200px;
                    height: 200px;
                }

                .base-timer__svg {
                    transform: scaleX(-1);
                }

                .base-timer__circle {
                    fill: none;
                    stroke: none;
                }

                .base-timer__path-elapsed {
                    stroke-width: 7px;
                    stroke: grey;
                }

                .base-timer__path-remaining {
                    stroke-width: 7px;
                    stroke-linecap: round;
                    transform: rotate(90deg);
                    transform-origin: center;
                    transition: 1s linear all;
                    fill-rule: nonzero;
                    stroke: currentColor;
                }

                .base-timer__path-remaining.green {
                    color: rgb(72, 209, 204);
                }

                .base-timer__path-remaining.orange {
                    color: orange;
                }

                .base-timer__path-remaining.red {
                    color: red;
                }

                .base-timer__label {
                    position: absolute;
                    width: 200px;
                    height: 200px;
                    top: 0;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 40px;
                }
            </style>

            <script type="text/javascript">
                function preventBack() {
                    window.history.forward();
                }
                setTimeout("preventBack()", 0);
                window.onunload = function() {
                    null
                };
            </script>
            <script type="text/javascript">
                function disableSelection() {
                    // Prevent text selection
                    document.onselectstart = function() {
                        return false;
                    };
                    // Prevent right-click menu
                    document.oncontextmenu = function() {
                        return false;
                    };
                }
            </script>


        </head>

        <body onload="disableSelection();" class="container-fluid" style="background-color: rgb(218, 226, 237);">
            <nav class="container-fluid navbar-expand  navbar navbar-light shadow-lg p-2 rounded" style="background: linear-gradient(to right, #8A2BE2, #B12DFC, #D93FFF);
  /* Use vendor prefixes for better browser compatibility */
  background: -moz-linear-gradient(left, #8A2BE2, #B12DFC, #D93FFF);
  background: -webkit-linear-gradient(left, #8A2BE2, #B12DFC, #D93FFF);
  background: linear-gradient(to right, #8A2BE2, #B12DFC, #D93FFF);">
                <div class="container-fluid ">
                    <a class="navbar-brand" href="#">
                        <img src="img/logod.png" alt="" width="37" height="34" style="border-radius:55%;" class="d-inline-block  align-text-center">
                        <span class="fs-3 text-white text-center font-monospace"> Debark University</span>
                    </a>
                </div>
            </nav>
            

            <div class=" row ">
                <div class="col-md-2">
                    <div class="col">
                        <div class="row">
                            <!-- <div style="color: green;font-size:large;background-color:#f4f5f7;margin-left:12px;width:771px;">
                            <h5 style="margin-left:10px ;">Remaining Time: <br> <span id="countdown" style="color: red;font-size: 50px;" class="timer"></span id="warn" ><span></span></h5>
                            </div>
                        <div align="center">
			             <div id="exam_timer" data-timer="<?php //echo $duration ; 
                                                            ?>" style="max-width:400px; width: 100%; height: 200px;">Remaining time</div>
                        </div>-->
                            <div id="app"></div>
                            <h5 style="margin-left:20px ;">Remaining Time</h5>
                        </div>
                        <div class="row">
                            <div class="row" id="user_details_area">
                                <?php
                                $fet = $pdo->prepare('SELECT * FROM examinee WHERE uiid=:uiid');
                                $fet->bindValue(':uiid', $user_id);
                                $fet->execute();
                                $prof = $fet->fetchAll(PDO::FETCH_ASSOC);


                                foreach ($prof as $pro) {
                                    $cat = $pro['ex_group'] ?? null;
                                    $uid = $pro['uiid'] ?? null;
                                    $fname = $pro['fname'];
                                    $lname = $pro['lname'];
                                    $gname = $pro['gname'];
                                    $gend = $pro['gender'] ?? null;
                                    $depa = $pro['Department'];
                                    $phone = $pro['phone'] ?? null;
                                    $image = $pro['photo'] ?? null;
                                    $stat = $pro['sttatus'] ?? null;
                                }
                                $nfet = $pdo->prepare('SELECT dep_name FROM department WHERE dep_id=:niid');
                                $nfet->bindValue(':niid', $depa);
                                $nfet->execute();
                                $nprof = $nfet->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($nprof as $npro) {
                                    $ndepa = $npro['dep_name'];
                                }
                                ?>
                                <div class="row g-0 d-flex container">
                                    <div style="margin-top:2%;margin-left:12px;width: 300px;border-radius: 15px;height: 300px; background-color: #f4f5f7;" class="card mb-3  container">
                                        <nav class="navbar navbar-light  container" style="background-color: rgb(72,209,204);">
                                            <div class="container-fluid">
                                                <span class="navbar-brand mb-0 h1 container">Examinee ID</span>
                                            </div>
                                        </nav>
                                        <div class="row md-4">
                                            <div class="" style="margin-top:3px;margin-left:10px;">
                                                <img src="admin/img/examinee/<?php echo $image ?>" class="img-fluid rounded-start" alt="No Image Found!" style="height: 180px; width: 150px;;">
                                            </div>
                                        </div>
                                        <div class="row md-8">
                                            <div class="card mb-4">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <p class=" mb-0" style="text-transform: capitalize ;"><?php echo $fname . ' ' . $lname ?> <?php echo $gname ?></p>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <p class="mb-0" style="text-transform: capitalize ;"><?php echo $ndepa ?></p>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <p class="mb-0" style="text-transform: capitalize ;">Gender: <?php echo $gend ?></p>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <p class="mb-0" style="text-transform: capitalize ;">ID: <?php echo $uid ?></p>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <p class="mb-0" style="text-transform: capitalize ;">Category: <?php echo $cat ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </div------------------------------------------->
                        </div>
                    </div>
                </div>
                <div class="col-md-10  ">
                    <div class="row ">
                        <div class="col-md-9  shadow-lg p-0  bg-body rounded">
                            <div class="card">
                                <div class="card-header">
                                    <?php echo $_SESSION['cname']; ?>
                                    <div id="attempt" class="btn-group float-end" role="group" aria-label="Basic radio toggle button group">
                                        <!-- <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                                    <label class="btn btn-outline-primary" id="nav_choose" for="btnradio1">Choose 1</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                                    <label class="btn btn-outline-primary" id="nav_match" for="btnradio2">Match 2</label>

                                    <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off"> -->
                                        <label>Attempt</label>
                                    </div>
                                    <h1 id="current"></h1>
                                </div>
                                <div class="card-body" style="height: auto;">
                                    <div id="single_question_area"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 ml-0" style="height: auto;">
                            <div id="question_navigation_area"></div>
                        </div>

                    </div>
                    <div class="row" style="text-align:center ; margin-top:2px;">

                        <button data-bs-toggle="modal"  data-bs-target="#InformationproModalalert" id="submitAns" class="btn btn-lg btn-danger" name="btnSubmit" style="width: auto;display: block; margin: 0 auto;" disabled >Finish</button>


                        <div id="InformationproModalalert" class="modal modal-edu-general fullwidth-popup-InformationproModal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-close-area modal-close-df">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <span class="educate-icon educate-info modal-check-pro information-icon-pro"> </span>
                                        <h2>Warning!</h2>
                                        <p class=" fs-4">You still have time to finish the exam, but you can do so by clicking the finish button.</p>
                                    </div>
                                    <div class="modal-footer info-md">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button id="usefinish"  class="btn btn-warning">Finish</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="DangerModalhdbgcl" data-bs-backdrop="static" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header header-color-modal bg-color-4">
                                        <h4 class="modal-title"></h4>
                                        <div class="modal-close-area modal-close-df">

                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <span ><i class="fa fa-timer fa-shake fa-2xl" style="color: #db24a1;"></i></span>
                                        <h2>Time!</h2>
                                        <p>Sorry, the time is up!</p>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <a href="result" class="btn btn-danger">Result ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="fraudModalhdbgcl" data-bs-backdrop="static" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header header-color-modal bg-color-4">
                                        <h4 class="modal-title"></h4>
                                        <div class="modal-close-area modal-close-df">

                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <span class="educate-icon educate-time modal-check-pro information-icon-pro"></span>
                                        <span><i class="fa fa-triangle-exclamation fa-beat fa-2xl" style="color: #ff2424;"></i></span>
                                        <h2>Fraud Detected!</h2>
                                        <p>You switched to another tab or window!</p>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <a href="result" class="btn btn-danger">Result ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <script>
                                function sure(){

                                   var conf = confirm('Please check your status!');
                                        if(conf == true){
                                            window.location='result.php';} 
                                        
                                        else{
                                            window.history.back();}

				}
                                    
                                    </script> -->
                        </form>
                    </div>

                </div>
                <audio id="audioPlayer" src="img/siren.mp3"></audio>
                <div id="warning_area"></div>
            </div>
            <div id="enlargedPhoto" class="enlarged-photo" onclick="closeEnlargedPhoto()">
        <img id="enlargedImg" src="">
       </div>
            <?php
            $arrayu = array('');
            $fetch = $pdo->prepare('SELECT qid FROM temporary WHERE exam_type=:etype AND cat_id=:cid AND exam_id=:exid AND quest_type=:qtype AND uid=:uid');
            $fetch->bindValue(':etype', $_SESSION['etype']);
            $fetch->bindValue(':cid', $cat_id);
            $fetch->bindValue(':exid', $exam_id);
            $fetch->bindValue(':qtype', 'choose');
            $fetch->bindValue(':uid', $user_id);
            $fetch->execute();
            $results = $fetch->fetchAll(PDO::FETCH_ASSOC);
            if (count($results) > 0) {

                foreach ($results as $arow) {
                    array_push($arrayu, $arow['qid']);
                }
            } else {
                $fetch = $pdo->prepare('SELECT quest_id FROM question WHERE  cat_id=:cid AND exam_id=:exid AND quest_type=:qtype ORDER BY RAND()');
                $fetch->bindValue(':cid', $cat_id);
                $fetch->bindValue(':exid', $exam_id);
                $fetch->bindValue(':qtype', 'choose');
                $fetch->execute();
                $resultu = $fetch->fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultu as $row) {

                    array_push($arrayu, $row['quest_id']);
                }
            }
            $mfetch = $pdo->prepare('SELECT qid FROM temporary WHERE  cat_id=:cid AND exam_id=:exid AND quest_type=:qtype AND uid=:uid');
            $mfetch->bindValue(':cid', $cat_id);
            $mfetch->bindValue(':exid', $exam_id);
            $mfetch->bindValue(':qtype', 'match');
            $mfetch->bindValue(':uid', $user_id);
            $mfetch->execute();
            $mresults = $mfetch->fetchAll(PDO::FETCH_ASSOC);
            if (count($results) > 0) {

                foreach ($mresults as $marow) {
                    array_push($arrayu, $marow['qid']);
                }
            } else {
                $mfetch = $pdo->prepare('SELECT quest_id FROM question WHERE cat_id=:cid AND exam_id=:exid AND quest_type=:qtype ORDER BY RAND()');
                $mfetch->bindValue(':cid', $cat_id);
                $mfetch->bindValue(':exid', $exam_id);
                $mfetch->bindValue(':qtype', 'match');
                $mfetch->execute();
                $mresultu = $mfetch->fetchAll(PDO::FETCH_ASSOC);

                foreach ($mresultu as $mrow) {

                    array_push($arrayu, $mrow['quest_id']);
                }
            }


            ?>
           
            <script type="text/javascript">
                function enlargePhoto(img) {
            var enlargedImg = document.getElementById('enlargedImg');
            enlargedImg.src = img.src;

            var enlargedPhoto = document.getElementById('enlargedPhoto');
            enlargedPhoto.style.display = 'flex';
            }

            function closeEnlargedPhoto() {
            var enlargedPhoto = document.getElementById('enlargedPhoto');
            enlargedPhoto.style.display = 'none';
            }
                $(document).ready(function() {

                    var jsArray = [];

                    <?php foreach ($arrayu as $value) { ?>
                        jsArray.push('<?php echo $value; ?>');
                    <?php } ?>
                    var cat_id = "<?php echo $cat_id ?>"
                    var exam_id = "<?php echo $exam_id; ?>";
                    var user = "<?php echo $user_id ?>";
                    var etype = "<?php echo $_SESSION['etype'] ?>";
                    var inc = 0;

                    question_navigation();
                    load_question();
                    attempt();


                    function load_question(qid = '', qtype = '') {
                        $.ajax({
                            url: "core.php",
                            method: "POST",
                            data: {
                                cat_id: cat_id,
                                exam_id: exam_id,
                                jsArray: jsArray,
                                qid: qid,
                                qtype: qtype,
                                user: user,
                                page: 'exam',
                                action: 'load_question'
                            },
                            success: function(data) {
                                $('#single_question_area').html(data);

                            }
                        })
                        
                    }
                    $(document).on('click', '.next', function() {
                        var question_id = $(this).attr('id');
                        load_question(question_id);
                       // attempt();
                    });

                    $(document).on('click', '.previous', function() {
                        var question_id = $(this).attr('id');
                        load_question(question_id);
                       // attempt();
                    });

                    function question_navigation() {

                        $.ajax({
                            url: "core.php",
                            method: "POST",
                            data: {
                                cat_id: cat_id,
                                exam_id: exam_id,
                                jsArray: jsArray,
                                user: user,
                                page: 'exam',
                                action: 'question_navigation'
                            },
                            success: function(data) {
                                $('#question_navigation_area').html(data);
                            }
                        })

                    }

                    $(document).on('click', '#usefinish', function() {

                        uresult();
                    });
                    $(document).on('click', '.question_navigation', function() {
                        var question_id = $(this).data('question_id');
                        load_question(question_id);

                    });

                    $(document).on('click', '.answer_option', function() {

                        //attempt();
                        var answer_option = $(this).data('id');
                        var question_id = $(this).data('qid');
                        
                        var button = document.getElementById('ay' + question_id);

                        // Remove btn-danger class
                        button.classList.remove("btn-danger");

                        // Add btn-success class
                        button.classList.add("btn-success");


                        $.ajax({
                            url: "core.php",
                            method: "POST",
                            data: {
                                cat_id: cat_id,
                                qid: question_id,
                                answer_option: answer_option,
                                exam_id: exam_id,
                                jsArray: jsArray,
                                user: user,
                                page: 'exam',
                                action: 'answer'
                            },
                            success: function(data) {
                                $('#current').html(data);
                                attempt();
                                // question_navigation();

                            }
                        })

                    });

                    $(document).on('change', '#mySelectm', function() {
                        // question_navigation();
                        var answer_option = $(this).val();
                        var question_id = $('option:selected', this).data('qimd');

                        $.ajax({
                            url: "core.php",
                            method: "POST",
                            data: {
                                cat_id: cat_id,
                                qid: question_id,
                                answer_option: answer_option,
                                exam_id: exam_id,
                                jsArray: jsArray,
                                user: user,
                                page: 'exam',
                                action: 'answer'
                            },
                            success: function(data) {
                                $('#current').html(data);
                                //attempt();
                               
                            }
                        })
                       
                    });

                    $(document).on('click', '.okokwawa', function() {

                       
                        var cat_id = $(this).data('cid');
                        var exam_id = $(this).data('eid');
                        var user = $(this).attr('value');
                        $.ajax({
                            url: "core.php",
                            method: "POST",
                            data: {
                                cat_id: cat_id,
                                exam_id: exam_id,
                                user: user,
                                page: 'exam',
                                action: 'accept_warning'
                            },
                            success: function(data) {
                                $('').html(data);
                            }
                        })

                    });












                    function attempt() {

                        $.ajax({
                            url: "core.php",
                            method: "POST",
                            data: {
                                cat_id: cat_id,
                                exam_id: exam_id,
                                user: user,
                                page: 'exam',
                                action: 'attempt'
                            },
                            success: function(data) {
                                $('#attempt').html(data);
                            }
                        })

                    }
                    

                    // Time

                    const TIME_LIMIT = <?php echo $time_remaining; ?>;
                    const FULL_DASH_ARRAY = 283;
                    const WARNING_THRESHOLD = TIME_LIMIT / 2;
                    const ALERT_THRESHOLD = TIME_LIMIT / 4;

                    const COLOR_CODES = {
                        info: {
                            color: "green"
                        },
                        warning: {
                            color: "orange",
                            threshold: WARNING_THRESHOLD
                        },
                        alert: {
                            color: "red",
                            threshold: ALERT_THRESHOLD
                        }
                    };

                    let btnout = <?php echo $tpassed;?>;
                    let timePassed = 0;
                    let timeLeft = TIME_LIMIT;
                    let timerInterval = null;
                    let remainingPathColor = COLOR_CODES.info.color;

                    document.getElementById("app").innerHTML = `
                <div class="base-timer">
                <svg class="base-timer__svg" viewBox="0 0 100 100" >
                    <g class="base-timer__circle">
                    <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
                    <path
                        id="base-timer-path-remaining"
                        stroke-dasharray="283"
                        class="base-timer__path-remaining ${remainingPathColor}"
                        d="
                        M 50, 50
                        m -45, 0
                        a 45,45 0 1,0 90,0
                        a 45,45 0 1,0 -90,0
                        "
                    ></path>
                    </g>
                </svg>
                <span id="base-timer-label" class="base-timer__label">${formatTime(
                    timeLeft
                )}</span>
                </div>
                `;

                    startTimer();

                    function onTimesUp() {
                        clearInterval(timerInterval);
                    }

                    function startTimer() {
                        timerInterval = setInterval(() => {
                            btnout++;
                            timePassed = timePassed += 1;
                            timeLeft = TIME_LIMIT - timePassed;
                            document.getElementById("base-timer-label").innerHTML = formatTime(
                                timeLeft
                            );
                            setCircleDasharray();
                            setRemainingPathColor(timeLeft);

                            if (timeLeft === 0) {

                                onTimesUp();
                                mresult();
                            }
                            if(btnout >= 200){ 
                                document.getElementById('submitAns').disabled = false;
                            }
                        }, 1000); //Minimum 2 Minute waiting time to finish the exam
                    }

                    function formatTime(time) {
                        const hours = Math.floor(time / 3600);
                        const minutes = Math.floor((time % 3600) / 60);
                        let seconds = time % 60;

                        if (seconds < 10) {
                            seconds = `0${seconds}`;
                        }
                        if (minutes < 10) {
                            return `${hours}:0${minutes}:${seconds}`;
                        }
                        if (hours > 0) {
                            return `${hours}:${minutes}:${seconds}`;

                        } else {
                            return `00:${minutes}:${seconds}`;
                        }
                    }


                    function setRemainingPathColor(timeLeft) {
                        const {
                            alert,
                            warning,
                            info
                        } = COLOR_CODES;
                        if (timeLeft <= alert.threshold) {
                            document
                                .getElementById("base-timer-path-remaining")
                                .classList.remove(warning.color);
                            document
                                .getElementById("base-timer-path-remaining")
                                .classList.add(alert.color);
                        } else if (timeLeft <= warning.threshold) {
                            document
                                .getElementById("base-timer-path-remaining")
                                .classList.remove(info.color);
                            document
                                .getElementById("base-timer-path-remaining")
                                .classList.add(warning.color);
                        }
                    }

                    function calculateTimeFraction() {
                        const rawTimeFraction = timeLeft / TIME_LIMIT;
                        return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
                    }

                    function setCircleDasharray() {
                        const circleDasharray = `${(
                    calculateTimeFraction() * FULL_DASH_ARRAY
                ).toFixed(0)} 283`;
                        document
                            .getElementById("base-timer-path-remaining")
                            .setAttribute("stroke-dasharray", circleDasharray);
                    }


                    /////

                    function mresult() {

                        

                        $.ajax({
                            url: "core.php",
                            method: "POST",
                            data: {
                                cat_id: cat_id,
                                exam_id: exam_id,
                                user: user,
                                etype:etype,
                                page: 'exam',
                                action: 'mresult'
                            },
                            success: function(data) {

                                $("#DangerModalhdbgcl").modal("show");
                            }
                        })

                    }
                    function uresult() {

                        

                        $.ajax({
                            url: "core.php",
                            method: "POST",
                            data: {
                                cat_id: cat_id,
                                exam_id: exam_id,
                                user: user,
                                etype:etype,
                                page: 'exam',
                                action: 'mresult'
                            },
                            success: function(data) {

                                window.location.href = "result";  }
                        })

                        }
                //     window.addEventListener('blur', function() {
                //     // Show an alert when the window loses focus
                    
                //     $('#fraudModalhdbgcl').modal('show');
                    
                //   //  document.getElementById('audioPlayer').play();
                //     fraudDetected();
                // });

                // // Detect when a new tab is opened
                // window.addEventListener('focus', function() {
                //     // Show an alert when a new tab is opened
                    
                //     $('#fraudModalhdbgcl').modal('show');
                //    // document.getElementById('audioPlayer').pause();
                //   //  document.getElementById('audioPlayer').currentTime = 0;
                //     fraudDetected();
                // });

                    function fraudDetected() {

                        reason='FraudComplete';

                        $.ajax({
                            url: "core.php",
                            method: "POST",
                            data: {
                                cat_id: cat_id,
                                exam_id: exam_id,
                                user: user,
                                reason:reason,
                                page: 'exam',
                                action: 'mresult'
                            },
                            success: function(data) {

                                $("#DangerModalhdbgcl").modal("show");
                            }
                        })

                    }

                    setInterval(warning, 20000);

                    function warning() {

                   

                    $.ajax({
                        url: "core.php",
                        method: "POST",
                        data: {
                            cat_id: cat_id,
                            exam_id: exam_id,
                            user: user,
                            page: 'exam',
                            action: 'warning'
                        },
                        success: function(data) {
                           if(data == '1'){
                            mresult();
                           }
                           else{
                            $('#warning_area').html(data);
                            $("#warningModalhdbgcl").modal("show");
                           }
                        }
                    })

                    }






                    // End Time


                });
            </script>

        <?php
    } else {
        echo "<script>
                                var conf = confirm('No exam at this time .');
                                if(conf == true){
                            
                                window.location='index';}
                                else{
                                        window.location='index';

                                }
                                
                                </script>";
    }
        ?>







       
        <script>
            document.onkeydown = function(event) {
                if (event.keyCode == 116) {
                    event.preventDefault();
                }

            }
        </script>



        </body>

        </html>

    <?php
    
} else {
    echo "<script>
                var conf = confirm('Access Denied! ');
            if(conf == true){

                window.location='index'; 
              
            }
                    else{
                        window.location='index'; 

              }
          
          </script>";
}
    ?>