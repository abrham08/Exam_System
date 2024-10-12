<?php
include "teacher_header.php";
if (isset($_SESSION['tuid'])) {
if(isset($_POST['cati'])){

   $selectedOption =$_POST['cat'];
    $variables = explode('_', $selectedOption);
    $examId = $variables[0];
    $tdepartment = $variables[1];

    $_SESSION['exam_id'] = $examId;
    $_SESSION['tdepar'] =$tdepartment;
    //echo  $_SESSION['exam_id'];
}
if(isset($_SESSION['exam_id'])   && $_SESSION['tdepar'] ){

  $tdepartment =$_SESSION['tdepar'];
if(isset($_POST['sesreset'])){
  $eeid=$_POST['sesreset'];
  $sql = "DELETE FROM user_sessions WHERE exam_id=:idat";
    $ustmt = $pdo->prepare($sql);
    $ustmt->bindValue(':idat', $eeid);
    $ustmt->execute();
}
$gc=$_GET['m'] ?? null;
$cid=$cd ?? $gc;


    
    
$fetn=$pdo->prepare('SELECT * FROM exam WHERE exam_id=:cid');
     $fetn->bindValue(':cid',$_SESSION['exam_id']);
     $fetn->execute();
     $prn=$fetn->fetch(PDO::FETCH_ASSOC);
     $cname=$prn['exam_name'];
        $cname=$prn['exam_name'];

        $mfetn=$pdo->prepare('SELECT * FROM assexam WHERE exam_id=:cid AND assigned_Department=:assd');
        $mfetn->bindValue(':cid',$_SESSION['exam_id']);
        $mfetn->bindValue(':assd',$tdepartment);
        $mfetn->execute();
        $kprn=$mfetn->fetch(PDO::FETCH_ASSOC);
        $stat = $kprn['im_status'];

 

        $dnfetch=$pdo->prepare('SELECT dep_name FROM department WHERE dep_id = :duid');
        $dnfetch->bindValue(':duid',$tdepartment);
        $dnfetch->execute();
        $dnshow=$dnfetch->fetch(PDO::FETCH_ASSOC);

        $arrayu = array('');

        $nfetch=$pdo->prepare('SELECT cat_name FROM category WHERE cat_id = :uid');
        $nfetch->bindValue(':uid',$prn['cat_id']);
        $nfetch->execute();
        $nshow=$nfetch->fetch(PDO::FETCH_ASSOC);

                
?>

<head>
<style>
    /* CSS styles for the table and enlarged photo */
    table {
      border-collapse: collapse;
    }


    .enlarged-photo {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.8);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
    }

    .enlarged-photo img {
      max-height: 80vh;
      max-width: 80vw;
    }
  </style>
</head>
<body>


<a href="exam_login" class="btn btn-primary">Back</a>


    <div class="container">
<div class="container table table-bordered table-striped">
<div class="card">
<div class="container card-body" id="mini">

    
  <div class="container-fluid py-1">

   <div class="fs-5">
    <div class="row mb-1">
      <div class="col">
        <p class="mb-0">
        <div class="d-flex justify-content-between">
          <div>
            <h6>Category <u class="text-primary"><?php echo $cname; ?></u></h6>
          </div>
          <div>
            <form action="#" method="post">
              
            <button type="submit" onclick="return confirm('Are you sure you want to reset?')" value="<?php echo $_SESSION['exam_id'];?>"  name="sesreset" class="btn btn-sm btn-danger">Reset Session</button>
            </form>
          </div>
        </div>

        </p>
      </div>
    </div>
    <hr>
    <hr>
    <div class="row">
      <div class="col-6">
        <div class="row">
          <div class="col-sm-5">
            <p class="mb-0">Active Examinee</p>
          </div>
          <div class="col-sm-7">
          <p class=" mb-0" style="text-transform: capitalize ;"><span id="activee"></span></p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-5">
            <p class="mb-0">
              
            Remaining Time</p>
          </div>
          <div class="col-sm-7">
            <p class="mb-0" style="text-transform: capitalize ;">
          
            <?php
              

            
              $query = "SELECT  CONCAT(exam_date, ' ', start_time) AS datetime_combined FROM assexam WHERE assigned_Department=:catid AND exam_id=:examid";
      
              $nstmt = $pdo->prepare($query);
              $nstmt->bindValue(':catid', $tdepartment);
              $nstmt->bindValue(':examid', $_SESSION['exam_id']);
              $nstmt->execute();
              
              $fetch = $pdo->prepare('SELECT exam_time, start_time FROM exam WHERE cat_id=:cid AND exam_id=:exid');
              $fetch->bindValue(':cid', $prn['cat_id']);
              $fetch->bindValue(':exid', $_SESSION['exam_id']);
              $fetch->execute();
              $result = $fetch->fetchAll(PDO::FETCH_ASSOC);
              foreach ($result as $row) {
                  $duration = $row['exam_time'];
                  $stime = $row['start_time'];
              }
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

              
              echo '<div class="fs-5 text-primary" id="counter"></div>';

              echo '<script>';
              echo 'var remainingTime = ' . $time_remaining . ';';
              echo 'var counterElement = document.getElementById("counter");';

              echo 'function updateCounter() {';
              echo '  var hours = Math.floor(remainingTime / 3600);';
              echo '  var minutes = Math.floor((remainingTime % 3600) / 60);';
              echo '  var seconds = remainingTime % 60;';

              echo '  counterElement.textContent = hours + "h : " + minutes + "m : " + seconds + "s";';

              echo '  if (remainingTime <= 0) {';
              echo '    clearInterval(interval);';
              echo '    counterElement.textContent = "Exam has been finished!";';
              echo '  } else {';
              echo '    remainingTime--;';
              echo '  }';
              echo '}';

              echo 'var interval = setInterval(updateCounter, 1000);';
              echo '</script>';
              
              ?>
          
          
          
          
          
          
          
          </p>
          </div>
        </div>
        <hr>
      </div>
      <div class="col-6">
        <div class="row">
          <div class="col-sm-5">
            <p class="mb-0">Target Departmet</p>
          </div>
          <div class="col-sm-7">
            <p class=" mb-0" style="text-transform: capitalize ;">
            
        
              <?php echo  $dnshow['dep_name']; ?>
        </p>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-5">
            <p class="mb-0">Status</p>
          </div>
          <div class="col-sm-7">
            <p class=" mb-0" style="text-transform: capitalize ;">
            <?php if( $stat == 1 ): ?>
            Status: <span class="badge bg-success">Started</span>
            <div class="form-check form-switch">
              <input class="doc form-check-input" name="check" value="0" data-id="<?php echo $sta['cid']?>" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
                </div>
        <?php endif; ?>
        <?php if( $stat == 0 ): ?>
            Status: <span class="badge bg-danger">Stopped</span>
            <div class="form-check form-switch">
             <input class="doc form-check-input" name="check"  value="1" data-id="<?php echo $sta['cid']?>" type="checkbox" role="switch" id="flexSwitchCheckDefault"> </div>
        <?php endif; ?>
        </p>
          </div>
        </div>
        
      </div>
    </div>

   </div>
</div>







    </span></h5>
    
    
<div id="dynamic">

</div>
<div id="enlargedPhoto" class="enlarged-photo" onclick="closeEnlargedPhoto()">
    <img id="enlargedImg" src="">
  </div>

</div>
</div>
</div>
</div>
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="oliveToast"  class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <button type="button" class="btn-close" onclick="window.location.reload()" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="outertoast-body">

                </div>
            </div>
        </div>
<script>
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



    
        var elements = document.getElementsByClassName('active');
        for (var i = 0; i < elements.length; i++) {
        var parentElement = elements[i].closest('.nav-link');
        if (parentElement) {
            parentElement.classList.remove('active');
        }}
        var anchor = document.querySelector('a.nav-link.propro');
        if (anchor) {
        anchor.classList.add('active');
        }
           

        
  </script>
  
<script type="text/javascript">

    $(document).ready(function () 
    {


        var cat_id = "<?php echo $prn['cat_id']; ?>"
        var exam_id = "<?php echo $_SESSION['exam_id']; ?>";
        var tdepart= "<?php echo $tdepartment;?>";
        var etype = "Real";
        load_question();
        active_examinee();
        setInterval(load_question, 25000);
        
        setInterval(active_examinee, 50000);

        function active_examinee() {
                        $.ajax({
                            url: "proctorModal.php",
                            method: "POST",
                            data: {
                                cat_id: cat_id,
                                exam_id: exam_id,
                               
                                
                                etype: etype,
                               
                                page: 'proctorPage',
                                action: 'active_exmainee'
                            },
                            success: function(data) {
                                $('#activee').html(data);

                            }
                        })
                        
                    }




        function load_question() {
                        $.ajax({
                            url: "proctorModal.php",
                            method: "POST",
                            data: {
                                cat_id: cat_id,
                                exam_id: exam_id,
                                tdepart:tdepart,
                                
                                etype: etype,
                               
                                page: 'proctorPage',
                                action: 'load_exmainee'
                            },
                            success: function(data) {
                                $('#dynamic').html(data);

                            }
                        })
                        
                    }







    $(document).on('click', '.doc', function(){
        var onie = $(this).val();
        
        $.ajax({
            url:"proctorModal.php",
            method:"POST",
            data:{tdepart:tdepart,
                  onie:onie,
                  exam_id:exam_id,
                page:'proctorPage',
                action:'onoff'},
                success:function(data)
            {
                $('#mini').html(data); 
            }
        })
    })






    $(document).on('click', '.btnwarnag', function(event) {
                    event.preventDefault();

                    var cat_id = $(this).data('cid');
                    var exam_id = $(this).data('eid');
                    var uid = $(this).attr('value');

                    var reason = document.forms["wwreason"+uid]["wreason"+uid].value;
                    


                 

                        $.ajax({
                            url: "proctorModal.php",
                            method: "POST",
                            data: {
                                page: 'proctorPage',
                                action: 'warning',
                                cat_id: cat_id,
                                exam_id: exam_id,
                                uid:uid,
                                reason: reason
                            },
                            success: function(data) {
                                $('#outertoast-body').html(data);
                                $('#oliveToast').addClass('toast-success').toast('show');
                            }
                        })

                });
                $(document).on('click', '.btnblockag', function(event) {
                    event.preventDefault();

                    var cat_id = $(this).data('cid');
                    var exam_id = $(this).data('eid');
                    var uid = $(this).attr('value');

                    var reason = document.forms["bbreason"+uid]["breason"+uid].value;
                    


                 

                        $.ajax({
                            url: "proctorModal.php",
                            method: "POST",
                            data: {
                                page: 'proctorPage',
                                action: 'block',
                                cat_id: cat_id,
                                exam_id: exam_id,
                                uid:uid,
                                reason: reason
                            },
                            success: function(data) {
                                $('#outertoast-body').html(data);
                                $('#oliveToast').addClass('toast-success').toast('show');
                            }
                        })

                });












    });
</script> 

</body>



</html>
<?php 
}}else{
     header("Location: ../index.php");
     exit();
}
 ?>