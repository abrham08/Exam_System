<?php
include "dbc.php";
session_start();

$date = date('d-m-y H:i:s');

if (isset($_SESSION['stuid'])) {

    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <title>Result</title>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/preloader.css" rel="stylesheet" type="text/css">

        <style>
            .preloader {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
        </style>
        <script type="text/javascript">
            window.history.forward();

            function preventBack() {
                window.history.forward();
            };
        </script>
        <script type="text/javascript">
            function preventBack() {
                window.history.forward();
            }
            setTimeout("preventBack()", 0);
            window.unload = function () {
                null
            };
            /* window.addEventListener('beforeunload', ()=>{
                 event.preventDefault();
                 evrnt.returnValue = "";
             })*/
        </script>
        <script src="js/jquery.min.js"></script>
    </head>
    <div class="preloader">
        <div class="spinner-grow text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="fs-1 ">Calculating...</div>
        <div class="spinner-grow text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <body id="pageContent" style="background-color: rgb(176,196,222);">
        <nav class="navbar navbar-light" style="background: linear-gradient(to right, #8A2BE2, #B12DFC, #D93FFF);
  /* Use vendor prefixes for better browser compatibility */
  background: -moz-linear-gradient(left, #8A2BE2, #B12DFC, #D93FFF);
  background: -webkit-linear-gradient(left, #8A2BE2, #B12DFC, #D93FFF);
  background: linear-gradient(to right, #8A2BE2, #B12DFC, #D93FFF);">
            <div class="container-fluid d-flex justify-content-start align-items-center">
                <a class="navbar-brand" href="#">
                    <img src="img/logod.png" alt="" width="47" height="44" style="border-radius:55%;"
                        class="d-inline-block align-text-center">
                    <span class="navbar-brand text-white fs-3 ms-3">Debark University</span>
                </a>
                <div class="d-flex justify-content-center align-items-cent ml-5">
                    <span class="bg-white p-2 rounded-3 btn-hover"> <a class="nav-link text-primary ml-5" href="main"><i
                                class="fas fa-tachometer-alt"></i>Home</a></span>
                </div>
            </div>
        </nav>

        <!------------------------------------->
    <div class="d-flex align-items-start">
        <div class="bg-white p-3 h-100 nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
            aria-orientation="vertical">
            <div class="my-3 nav flex-column nav-pills">
                <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                    aria-selected="true">Result</button>
                <hr>
                <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                    aria-selected="false"> Review Answer's</button>
                <hr>

            </div>
        </div>
        <div class="tab-content" style="width: 80%;" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="p-4 shadow-lg mb-0 bg-light rounded-3 min-height-200px">
                    <div class="container-fluid py-1">

                        <div class="row g-0 d-flex" style="align-items:center ;border-radius: 15px; ">
                            <nav class="navbar navbar-light  container" style="background-color: rgb(72,209,204);">
                                <div class="container-fluid">
                                    <span class="navbar-brand mb-0 h5 container"> Exam Result</span>
                                </div>
                            </nav>
                            <!-- <?php

                            $attempt = '';
                            $correct = '';
                            $incorrect = '';
                            $total = '';
                            $result = '';
                            $finalD = '';
                            $wrong = '';
                            $fraud = 0;
                            $result_status = 0;

                            if (isset($_POST['view_detail'])) {
                                $_SESSION['cat_id'] = $_POST['cat_id'];
                                $_SESSION['exam_id'] = $_POST['exam_id'];
                                $_SESSION['etype'] = $_POST['etype'];
                            }

                            $qsesfetch = $pdo->prepare('SELECT * FROM exam WHERE cat_id=:catid AND exam_id=:examid');
                            $qsesfetch->bindValue(':catid', $_SESSION['cat_id']);
                            $qsesfetch->bindValue(':examid', $_SESSION['exam_id']);
                            $qsesfetch->execute();
                            $qsesresult = $qsesfetch->fetch(PDO::FETCH_ASSOC);

                            $fetch = $pdo->prepare('SELECT DISTINCT  cat_name,cat_type FROM category WHERE cat_id=:cid');
                            $fetch->bindValue(':cid', $_SESSION['cat_id']);
                            $fetch->execute();
                            $rresult = $fetch->fetch(PDO::FETCH_ASSOC);

                            $fetch = $pdo->prepare('SELECT * FROM examinee WHERE uiid=:uiid');
                            $fetch->bindValue(':uiid', $_SESSION['stuid']);
                            $fetch->execute();
                            $prof = $fetch->fetch(PDO::FETCH_ASSOC);

                            $fetch = $pdo->prepare('SELECT dep_name FROM department WHERE dep_id=:cid');
                            $fetch->bindValue(':cid', $prof['Department']);
                            $fetch->execute();
                            $show = $fetch->fetch(PDO::FETCH_ASSOC);
                            if ($_SESSION['etype'] == 'Real') {
                                $fresult = $pdo->prepare('SELECT * FROM final_result WHERE uid=:uidd AND cat_id=:catid AND exam_id=:examid');
                                $fresult->bindValue(':uidd', $_SESSION['stuid']);
                                $fresult->bindValue(':catid', $_SESSION['cat_id']);
                                $fresult->bindValue(':examid', $_SESSION['exam_id']);
                                $fresult->execute();
                                $finresult = $fresult->fetch(PDO::FETCH_ASSOC);
                                $total = $finresult['total'];
                                $attempt = $finresult['attempt'];
                                $correct = $finresult['correct'];
                                $wrong = $finresult['wrong'];
                                $result = $finresult['result'];
                                $finalD = $finresult['stat'];

                                $query = "SELECT CONCAT(exam_date, ' ', start_time) AS datetime_combined  FROM assexam WHERE assigned_Department=:catid AND exam_id=:examid";

                                $nstmt = $pdo->prepare($query);
                                $nstmt->bindValue(':catid', $prof['Department']);
                                $nstmt->bindValue(':examid', $_SESSION['exam_id']);
                                $nstmt->execute();

                                // Fetch the result
                                $nnresult = $nstmt->fetch(PDO::FETCH_ASSOC);


                                $squery = "SELECT exam_time  FROM exam WHERE cat_id=:catid AND exam_id=:examid";

                                $snstmt = $pdo->prepare($squery);
                                $snstmt->bindValue(':catid', $_SESSION['cat_id']);
                                $snstmt->bindValue(':examid', $_SESSION['exam_id']);
                                $snstmt->execute();

                                // Fetch the result
                                $snnresult = $snstmt->fetch(PDO::FETCH_ASSOC);

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

                                $minutesToAdd = $snnresult['exam_time']; // Change this value to the desired number of minutes to add
                                $target->add(new DateInterval('PT' . $minutesToAdd . 'M'));

                                // Calculate the remaining time in seconds
                                $remainingTime = $target->getTimestamp() - strtotime($currentDateTime);
                                if ($remainingTime < 0) {
                                    $remainingTime = 0;
                                    $result_status = 1;
                                }

                            } else {
                                $result_status = 1;
                                $qa = $_SESSION['cat_id'] ?? null;
                                $examid = $_SESSION['exam_id'] ?? null;
                                $pers = $_SESSION['stuid'] ?? null;

                                $stmtb = $pdo->prepare("SELECT * FROM temporary WHERE uid = :uid AND cat_id = :cat AND exam_id = :eid AND exam_type=:etype");
                                $stmtb->bindValue(':uid', $pers);
                                $stmtb->bindValue(':cat', $qa);
                                $stmtb->bindValue(':eid', $examid);
                                $stmtb->bindValue(':etype', 'Practise');
                                $stmtb->execute();
                                $rasmark = $stmtb->fetchAll(PDO::FETCH_ASSOC);
                                if (count($rasmark) > 0) {

                                    $fed = $pdo->prepare("SELECT SUM(right_ans) as total_mark FROM question WHERE cat_id=:cid AND exam_id=:eid ");
                                    $fed->bindValue(':cid', $qa);
                                    $fed->bindValue(':eid', $examid);
                                    $fed->execute();
                                    $rmark = $fed->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($rmark as $rrow) {
                                        $sum = $rrow["total_mark"];
                                    }
                                    $tfed = $pdo->prepare("SELECT exam_type FROM exam WHERE cat_id=:cid AND exam_id=:eid ");
                                    $tfed->bindValue(':cid', $qa);
                                    $tfed->bindValue(':eid', $examid);
                                    $tfed->execute();
                                    $trmark = $tfed->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($trmark as $trrow) {
                                        $eetype = $trrow["exam_type"];
                                    }
                                    $fet = $pdo->prepare("SELECT SUM(total) as total_mark FROM temporary WHERE
                                                uid=:uid AND cat_id=:cat AND  exam_id=:eid ");
                                    $fet->bindValue(':uid', $pers);
                                    $fet->bindValue(':cat', $qa);
                                    $fet->bindValue(':eid', $examid);
                                    $fet->execute();
                                    $marks_result = $fet->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($marks_result as $row) {
                                        $user_sum = $row["total_mark"];
                                    }


                                    $stmt = $pdo->prepare("SELECT * FROM question WHERE cat_id = :cat AND exam_id = :eid");
                                    $stmt->bindValue(':cat', $qa);
                                    $stmt->bindValue(':eid', $examid);
                                    $stmt->execute();
                                    $num = $stmt->rowCount();

                                    // Prepare the third query
                        
                                    $stmt = $pdo->prepare("SELECT * FROM temporary WHERE uid = :uid AND cat_id = :cat AND exam_id = :eid AND uans !=:uan");
                                    $stmt->bindValue(':uid', $pers);
                                    $stmt->bindValue(':cat', $qa);
                                    $stmt->bindValue(':eid', $examid);
                                    $stmt->bindValue(':uan', '');
                                    $stmt->execute();
                                    $at = $stmt->rowCount();

                                    // Prepare the fourth query
                        
                                    $stmt = $pdo->prepare("SELECT * FROM temporary WHERE uid = :uid AND cat_id = :cat AND exam_id = :eid AND stat = 1");
                                    $stmt->bindValue(':uid', $pers);
                                    $stmt->bindValue(':cat', $qa);
                                    $stmt->bindValue(':eid', $examid);
                                    $stmt->execute();
                                    $cor = $stmt->rowCount();

                                    $stat = '';
                                    $total = $num;
                                    $attempt = $at;
                                    $correct = $cor;
                                    $wrong = $attempt - $cor;
                                    $ts = $user_sum;
                                    $result = ($user_sum / $sum * 100);
                                    $result = round(($user_sum / $sum * 100), 3);

                                    $date = date('d-m-y H:i:s');
                                    if ($result >= 50) {
                                        $finalD = 1;
                                    } else {
                                        $finalD = 0;
                                    }
                                } else {
                                    $fraud = 1;
                                    echo '<div class="alert alert danger">No Result Found</div>';
                                }
                            }



                            ?>  -->



                                <?php if ($result_status == 1): ?>
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="mb-3 row">
                                                <div class="col-6">

                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p class="mb-0">Name : </p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p class="text-muted mb-0" style="text-transform: capitalize ;">
                                                                <?php echo $_SESSION['exaname'] ?? null; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p class="mb-0">Gender</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p class="text-muted mb-0" style="text-transform: capitalize ;">
                                                                <?php echo $prof['gender'] ?? null ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p class="mb-0">ID</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p class="text-muted mb-0" style="text-transform: capitalize ;">
                                                                <?php echo $_SESSION['stuid'] ?? null ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p class="mb-0">Course</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p class="text-muted mb-0" style="text-transform: capitalize ;">
                                                                <?php echo $rresult['cat_name'] ?? null; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p class="mb-0">Decision</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p class="text-muted mb-0" style="text-transform: capitalize ;">
                                                                <?php if ($rresult['cat_name'] == 'COC'): ?>

                                                                    <?php if ($finalD == 1): ?>
                                                                        <span
                                                                            class="badge rounded-pill bg-success badge-sm">Passed</span>
                                                                    <?php else: ?>
                                                                        <span
                                                                            class="badge rounded-pill bg-danger badge-sm">Failled</span>
                                                                    <?php endif; ?>

                                                                <?php else: ?>
                                                                    <span class="badge rounded-pill bg-light badge-sm"></span>
                                                                <?php endif; ?>





                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">

                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p class="mb-0">Total Question</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p class="text-muted mb-0" style="text-transform: capitalize ;">
                                                                <?php echo $total; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p class="mb-0">Attempt</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p class="text-muted mb-0" style="text-transform: capitalize ;">
                                                                <?php echo $attempt; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p class="mb-0">Correct</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p class="text-muted mb-0" style="text-transform: capitalize ;">
                                                                <?php echo $correct; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p class="mb-0">Wrong</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p class="text-muted mb-0" style="text-transform: capitalize ;">
                                                                <?php echo $wrong; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row ">
                                                        <div class="col-sm-5">
                                                            <p class="mb-0">Total Score</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p class="text-muted mb-0" style="text-transform: capitalize ;">
                                                                <?php echo $correct . '/' . $total; ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <p class="mb-0">Result</p>
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p class="text-muted mb-0" style="text-transform: capitalize ;">
                                                                <?php echo $result . '%'; ?>
                                                            </p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <button style="width: auto;display: block; margin: 0 auto;" class="mb-3 btn btn-danger"
                                            onclick="printr()">Print</button>
                                    </div><!---->

                                </div>

                                <script>
                                    function printr() {
                                        window.print();
                                    }
                                </script>
                            </div>
                        </div>


                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <div class="p-4 shadow-lg mb-0 bg-light rounded-3 min-height-200px">
                            <div class="container-fluid py-1 mb-3">
                                <?php if ($qsesresult['download'] == 1): ?>

                                    <form id="pagination-form">
                                        <label for="page-limit">Question per page:</label>
                                        <select name="page-limit" id="page-limit">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option selected value="50">50</option>
                                            <option value="50">100</option>
                                        </select>
                                    </form>
                                </div>
                                <script>
                                    $(document).ready(function () {
                                        $('#page-limit').on('change', function () {
                                            $('#pagination-form').submit();
                                        });
                                    });
                                </script>
                                <?php
                                $cat_id = $_SESSION['cat_id'];
                                $exam_id = $_SESSION['exam_id'];
                                $limit = isset($_GET['page-limit']) ? $_GET['page-limit'] : 50;
                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $start = ($page - 1) * $limit;
                                $prof = getArticles($pdo, $start, $limit, $cat_id, $exam_id);
                                $total_pages = getTotalPages($pdo, $limit, $cat_id, $exam_id);

                                ?>
                                <?php
                                if (count($prof) > 0 && $fraud == 0):
                                    foreach ($prof as $i => $pro):
                                        $cs = ($page - 1) * $limit + $i + 1;

                                        $coptf = $pdo->prepare('SELECT * FROM exam  WHERE exam_id=:eid   ');

                                        $coptf->bindValue(':eid', $exam_id);

                                        $coptf->execute();
                                        $Exam_Type = $coptf->fetch(PDO::FETCH_ASSOC);

                                        if ($Exam_Type['exam_type'] == 'Real') {

                                            $copt = $pdo->prepare('SELECT * FROM history  WHERE uid=:uiid AND exam_id=:cid  AND qid=:qid  ');
                                            $copt->bindValue(':uiid', $_SESSION['stuid']);
                                            $copt->bindValue(':cid', $exam_id);
                                            $copt->bindValue(':qid', $pro['quest_id']);
                                            $copt->execute();
                                            $cstat = $copt->fetch(PDO::FETCH_ASSOC);
                                        } else {
                                            $coptr = $pdo->prepare('SELECT * FROM temporary  WHERE uid=:uiid AND exam_id=:cid  AND qid=:qid  ');
                                            $coptr->bindValue(':uiid', $_SESSION['stuid']);
                                            $coptr->bindValue(':cid', $exam_id);
                                            $coptr->bindValue(':qid', $pro['quest_id']);
                                            $coptr->execute();
                                            $cstat = $coptr->fetch(PDO::FETCH_ASSOC);
                                        }


                                        $opt = $pdo->prepare('SELECT * FROM option_list  WHERE exam_id=:cid  AND quest_id=:qid ORDER BY opt_no ASC ');
                                        $opt->bindValue(':cid', $exam_id);
                                        $opt->bindValue(':qid', $pro['quest_id']);
                                        $opt->execute();
                                        $opti = $opt->fetchAll(PDO::FETCH_ASSOC);
                                        $dquestion = decryptText($pro['question']);



                                        ?>

                                        <div class="mb-2 panel panel-understanding-check">
                                            <?php if ($cstat['stat'] == '1'): ?>
                                                <h5 for="radio" class="d-flex align-items-center justify-content-between">
                                                    <?php echo $cs . ") " . $dquestion; ?>(<?php echo $pro['right_ans'] ?>Pt.)
                                                    <span class="" style="font-size: 15px; opacity: 0.8;">
                                                        <span class="text-primary">Remark:</span>
                                                        <span class="badge rounded-pill bg-success badge-sm">Correct</span>
                                                    </span>
                                                </h5>
                                            <?php else: ?>
                                                <h5 for="radio" class="d-flex align-items-center justify-content-between">
                                                    <?php echo $cs . ") " . $dquestion; ?>(<?php echo $pro['right_ans'] ?>Pt.)
                                                    <span class="" style="font-size: 15px; opacity: 0.8;">
                                                        <span class="text-primary">Remark:</span>
                                                        <span class="badge badge-sm rounded-pill bg-danger">Incorrect</span>
                                                    </span>
                                                </h5>

                                            <?php endif; ?>
                                            <hr>
                                            <?php $a = "A";
                                            $no = 1; ?>

                                            <?php foreach ($opti as $opo):



                                                ?>
                                                <?php if (!empty($opo['ot'])): ?>
                                                    <div class="radio mb-4">

                                                        <?php if (password_verify($opo['opt_no'], $pro['quest_ans'])): ?>

                                                            <?php if ($opo['opt_no'] == $cstat['uans']): ?>
                                                                <strong class="mb-1 text-success "><?php echo $a . ') ' . trim(strip_tags($opo['ot'])); ?>
                                                                    <span class="badge bg-warning text-dark">Y</span> </strong>
                                                            <?php else: ?>
                                                                <strong class="mb-1 text-success "><?php echo $a . ') ' . trim(strip_tags($opo['ot'])); ?>
                                                                </strong>

                                                            <?php endif; ?>

                                                        <?php else: ?>

                                                            <?php if ($opo['opt_no'] == $cstat['uans']): ?>

                                                                <label class="mb-1"><?php echo $a . ') ' . trim(strip_tags($opo['ot'])); ?> <span
                                                                        class="badge bg-warning text-dark">Y</span></label>
                                                            <?php else: ?>
                                                                <label class="mb-1"><?php echo $a . ') ' . trim(strip_tags($opo['ot'])); ?> </label>

                                                            <?php endif; ?>

                                                        <?php endif; ?>


                                                    <?php else: ?>
                                                        <span class="alert alert-danger">No Choice Available!</span>

                                                    <?php endif; ?>


                                                    <?php $a++;
                                                    $no++;
                                            endforeach; ?>
                                            </div>
                                        <?php endforeach; ?>



                                    </div>
                                    <?php
                                    echo "<ul class='pagination justify-content-center'>";
                                    if ($page > 1) {
                                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">&laquo;</a></li>';
                                    } else {
                                        echo '<li class="page-item disabled"><a class="page-link" disabled>&laquo;</a></li>';
                                    }
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        $active_class = ($i == $page) ? 'active' : '';
                                        echo "<li class='page-item " . $active_class . "' ><a class='page-link' href='?page=$i'>$i</a></li>";
                                    }
                                    if ($page < $total_pages) {
                                        echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">&raquo;</a></li>';
                                    } else {
                                        echo '<li class="page-item disabled"><a class="page-link" disabled>&raquo;</a></li>';
                                    }
                                    echo "</ul>";
                                    ?>
                                <?php else: ?>
                                    <div class="container alert alert-danger" role="alert mb-5 mt-2">
                                        <h3 class="text-center">No question!</h3>
                                    </div>
                                <?php endif; ?>

                                <button style="width: auto;display: block; margin: 0 auto;" class="btn btn-danger"
                                    onclick="printu()">Print</button>
                                <script>
                                    function printu() {
                                        window.print();
                                    }
                                </script>
                            <?php else: ?>
                                <div class="alert alert-danger">Sorry, there is no question available to be displayed!</div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">



                </div>
            <?php else: ?>
                <div class="text-center alert alert-info fs-3 p-5" id="counter"></div>
                <script>
                    // Set the countdown time to 60 minutes (in milliseconds)
                    var countdownTime = <?php echo $remainingTime ?>;

                    // Update the timer every second
                    var timerInterval = setInterval(updateTimer, 1000);

                    // Function to update the timer
                    function updateTimer() {
                        var hours = Math.floor(countdownTime / 3600);
                        var minutes = Math.floor((countdownTime % 3600) / 60);
                        var seconds = countdownTime % 60;

                        // Display the remaining time in the counter div
                        document.getElementById("counter").innerHTML = "The result will be displayed in " + "<b class=\'text-primary fs-1\'>" + hours + "h " + minutes + "m " + seconds + "s" + "</b>";

                        // Decrease the remaining time by one second
                        countdownTime -= 1;

                        // If the countdown reaches zero, display a message or take appropriate action
                        if (countdownTime < 0) {
                            clearInterval(timerInterval);
                            location.reload();
                        }
                    }
                </script>
            <?php endif; ?>

        </div>
        </div>

        <!-------------------------------------------->


    </body>
    <script>
        // Set the timer to 30 minutes
        var timer = setTimeout(function () {
            // Redirect to the logout page
            window.location.href = 'session.php';
        }, 30 * 60 * 1000);

        // Reset the timer on any activity
        document.addEventListener('mousemove', function () {
            clearTimeout(timer);
            timer = setTimeout(function () {
                window.location.href = 'session.php';
            }, 30 * 60 * 1000);
        });
        window.onunload = function () {
            window.location.href = 'session.php';
        };
    </script>
    <script src="js/preloader.js"></script>

    </html>
    <?php
} else {
    echo "<script>
                var conf = confirm('Access Denied! ');
            if(conf == true){

                window.location='index.php'; 
              
            }
                    else{
                        window.location='index.php'; 

              }
          
          </script>";
}
?>
<?php
function decryptText($encryptedText)
{
    $key = 'zewerha megabit maeltu welelitu asirte we kliete';
    $encryptedText = base64_decode($encryptedText);
    $ivlen = openssl_cipher_iv_length($cipher = "AES-256-CBC");
    $iv = substr($encryptedText, 0, $ivlen);
    $cipherText = substr($encryptedText, $ivlen);
    return openssl_decrypt($cipherText, $cipher, $key, $options = 0, $iv);
}
function getArticles($db, $start, $limit, $cat_id, $exam_id)
{

    $fet = $db->prepare("SELECT * FROM question  WHERE cat_id=:cid AND exam_id=:eid  LIMIT $start, $limit");
    $fet->bindValue(':cid', $cat_id);
    $fet->bindValue(':eid', $exam_id);
    $fet->execute();
    $articles = $fet->fetchAll(PDO::FETCH_ASSOC);
    return $articles;
}

function getTotalPages($db, $limit, $cat_id, $exam_id)
{
    $stmt = $db->prepare("SELECT COUNT(*) FROM question WHERE cat_id=:cid AND exam_id=:eid ");
    $stmt->bindValue(':cid', $cat_id);
    $stmt->bindValue(':eid', $exam_id);
    $stmt->execute();
    $total_records = $stmt->fetchColumn();
    $total_pages = ceil($total_records / $limit);
    return $total_pages;
}
?>