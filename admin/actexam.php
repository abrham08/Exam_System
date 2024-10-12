<?php 
// session_start();
include "dbc.php";
include "header.php";

// if (isset($_SESSION['huid']) && isset($_SESSION['hdepid'])) {
  $uid=$_SESSION['huid'];
  if($_SERVER['REQUEST_METHOD']=='POST'){

  if(isset($_POST['assign'])){
    $idis = $_POST['idu'];
    $depaidu = $_POST['depaidu'];
    $teachu = $_POST['nteacher'];
    $assteacher=$pdo->prepare("UPDATE assexam SET examiner = :asteacher WHERE id=:bcat AND catDepartment=:cdepa");
    $assteacher->bindValue(':asteacher',$teachu);
    $assteacher->bindValue(':bcat',$idis);
    $assteacher->bindValue(':cdepa',$depaidu);
    $assteacher->execute();
  }


  $date=date('d-m-y H:i:s');
  if(isset($_POST['cupdate'])){
    $cid=$_POST['cid'];
    $cname=$_POST['cname'];
    $cnq=$_POST['cnq'];
    $cnc=$_POST['cnc'];
    $id=$_POST['uid'];
    $ctime=$_POST['ctime'];
$cmy=$pdo->prepare("UPDATE category SET cid=:cid,cname=:cname,cnq=:cnq,cnc=:cnc,ctime=:ctime,cdate=:cdate WHERE uid=:uid");
    $cmy->bindValue(':cid',$cid);
    $cmy->bindValue(':cname',$cname);
    $cmy->bindValue(':cnq',$cnq);
    $cmy->bindValue(':cnc',$cnc);
    $cmy->bindValue(':ctime',$ctime);
    $cmy->bindValue(':cdate',$date);
    $cmy->bindValue(':uid',$id);
    $cmy->execute();
    echo"<script>$('#ictmodal').modal('show')</script>";
    //echo "<script>window.location.reload();</script>";
   // header('location: admin.php');


}
  
 
}

  $adep=$_SESSION['hdepid'] ;



$cifetch=$pdo->prepare('SELECT * FROM assexam WHERE assigned_by =:deppid AND exam_category=:ecat ');
$cifetch->bindValue(':deppid',$adep);
$cifetch->bindValue(':ecat',"Regular");
$cifetch->execute();
$cicat=$cifetch->fetchAll(PDO::FETCH_ASSOC);









?>
<html lang="en">
  <head>

    <title>Category</title>
  </head>
  <body >
 
    <div class=" big">
        <div class=" view">
                  <div class="mb-3">

                    
                    
                    <!-- Modal -->

           <div class="table table-bordered table-striped container">
           
           <table class="table table-striped table-hover container table-hover">
              <tr class="table-info">
              <th class="table-info">Exam </th>
              <th class="table-info">Exam Name</th>
              <th class="table-info">Teacher </th>
              <th class="table-info">Target Department</th>
              <th class="table-info">Stream</th>
              <th class="table-info">Date</th>
              <th class="table-info">Time</th>
                <th class="table-info">Status</th>
                <th class="table-info">Examiner</th>

              </tr>
             <tbody>
              <?php foreach($cicat as $camn): 

              $ncifetch=$pdo->prepare('SELECT * FROM exam WHERE exam_id =:deppid ');
              $ncifetch->bindValue(':deppid',$camn['exam_id']);
              $ncifetch->execute();
              $ncicat=$ncifetch->fetch(PDO::FETCH_ASSOC);

              $atrifetch=$pdo->prepare("SELECT CONCAT(fname, ' ', lname) AS full_name  FROM account WHERE user_id =:adeeppid");
              $atrifetch->bindValue(':adeeppid',$ncicat['exam_creator']);
              $atrifetch->execute();

              $aatricat=$atrifetch->fetch(PDO::FETCH_ASSOC);
              
              $pnames = $aatricat['full_name'];

              $atrifetch=$pdo->prepare('SELECT dep_name FROM department WHERE dep_id =:deeppid');
               $atrifetch->bindValue(':deeppid',$camn['assigned_Department']);
               $atrifetch->execute();
               $atricat=$atrifetch->fetch(PDO::FETCH_ASSOC);

               $trifetch=$pdo->prepare('SELECT cat_name FROM category WHERE cat_id =:deeppid');
               $trifetch->bindValue(':deeppid',$ncicat['cat_id']);
               $trifetch->execute();

               $tricat=$trifetch->fetch(PDO::FETCH_ASSOC);
               
                $depnames = $tricat['cat_name'];
              
              
                ?>
           

                <tr class="">
                <td class="col-3"><?php echo $depnames?></td>
                <td><?php echo $ncicat['exam_name']?></td>
                <td>
                <?php
                      echo $pnames;
                  ?>
                
                </td>
                <td class="col-3"><?php echo $atricat['dep_name']?></td>
                <td class="col-3"><?php echo $camn['assigned_group']?></td>

                <td>
                <input type="date" value="<?php echo  $camn['exam_date']  ?>" data-eid="<?php echo $camn['exam_id'] ?>" class="form-control edate" id="edate" name="edate" required placeholder="Enter exam date">
                <script>
                $(document).ready(function() {
                  $(document).on('change', '.edate', function() {
                    var selectedDate = $(this).val();
                    $(this).attr('value', selectedDate);
                  });
                });
              </script>
              </td>
                <td><input type="time" value="<?php echo $camn['start_time'] ?>" data-eid="<?php echo $camn['exam_id']?>"  class="form-control etime" id="etime" name="stime" required placeholder="Enter start time">
                <script>
                $(document).ready(function() {
                  $(document).on('change', '.etime', function() {
                    var selectedDate = $(this).val();
                    $(this).attr('value', selectedDate);
                  });
                });
              </script>
              
              </td>
                <?php if ($camn['estatus'] == 1) :  ?>
                <td>


                  <div class="dropdown">
                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="<?php echo $camn['exam_id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                         Active
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="<?php echo $camn['exam_id'];?>">
                      <li>
                        <button class="dropdown-item bg-danger text-white btn btn-sm btn-danger" data-target="<?php echo $camn['assigned_Department'];?>" id="ban" value="<?php echo $camn['exam_id'];?>"> Reject</button>
                      </li>
                    </ul>
                  </div>
                </td>
                <?php elseif($camn['estatus'] == 3) : ?>
                  <td>
                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="<?php echo $camn['exam_id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                         Rejected
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="<?php echo $camn['exam_id']; ?>">
                      <li>
                        <button class="dropdown-item bg-success text-white btn btn-sm btn-success" id="activ" data-target="<?php echo $camn['assigned_Department'];?>" value="<?php echo $camn['exam_id'];?>"> Activate</button>
                      </li>
                    </ul>
                  </div>
                </td>
              <?php else : ?>
                <td>
                <button class="btn btn-warning btn-sm dropdown-toggle" type="button" id="<?php echo $camn['exam_id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                         Pending
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="<?php echo $camn['exam_id']; ?>">
                      <li>
                        <button class="mb-1 dropdown-item bg-success text-white btn btn-sm btn-success" id="activ" data-target="<?php echo $camn['assigned_Department'];?>" value="<?php echo $camn['exam_id'];?>"> Activate</button>
                        <button class="dropdown-item bg-danger text-white btn btn-sm btn-danger" data-target="<?php echo $camn['assigned_Department'];?>" id="ban" value="<?php echo $camn['exam_id'];?>"> Reject</button>
                      </li>
                    </ul>
                  </div>
                </td>
              <?php endif; ?>










                <td class="col-3">
                  <div class="container">
                <?php if( $camn['examiner'] == '' ) : ?>
                
                  <span class="badge bg-danger col-6 mx-auto ">Not Assigned</span>
                 
                  <div class="d-flex justify-content-end">
                  <button class="btn btn-sm btn-info" type="button" data-id="<?php echo $camn['exam_id'];?>" data-bs-toggle="offcanvas" 

                  data-bs-target="#yu<?php echo $camn['exam_id'];?>" aria-controls="offcanvasRight"><i class="fa fa-edit" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Assign"></i></button></div>

                  <div class="offcanvas offcanvas-end" tabindex="-1" id="yu<?php echo $camn['exam_id'];?>" aria-labelledby="offcanvasRightLabel">
                  <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">Select the teacher to be assigned</h5>
                    <button type="button"  class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body">
                    <?php

                  $tteacher=$pdo->prepare('SELECT * FROM account WHERE Department =:deppid AND status=:ststu');
                  $tteacher->bindValue(':deppid',$camn['assigned_by']);
                  $tteacher->bindValue(':ststu','1');
                  $tteacher->execute();
                  $ateacher=$tteacher->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <form id="assignt<?php echo $camn['id'];?>" class="was-validated">
                      <div id="successAssign<?php echo $camn['id'];?>"></div>
                    <div class="mb-2">
                    <label for="teacherlist" class="form-label">Select the Teacher</label>
                    <input type="hidden" id="edepaidu<?php echo $camn['id'];?>" name="depaidu" value="<?php echo $camn['exam_id'];?>">
                    <input type="hidden" id="chdepaidu<?php echo $camn['id'];?>" name="depaidu" value="<?php echo $camn['assigned_Department'];?>">

                    <select id="nteacher<?php echo $camn['id'];?>" name="nteacher<?php echo $camn['id'];?>" class="form-select"  required size="10" aria-label="size 3 select example">
                    <?php foreach ($ateacher as $tech): ?>
                      <option  value="<?php  echo $tech['user_id'];?>"><?php echo $tech['title'].' '.$tech['fname'].' '.$tech['lname'].' '.$tech['gname'];?></option>
                      <?php endforeach;?>
                    </select>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                    <button id="iassignate" type="button" data-id="<?php echo $camn['id'];?>" name="assignate" class="assignate btn btn-sm btn-success justify-content-md-center">Confirm</button>
                  </div>
                    </form>
                  </div>
                

                </div>




                <?php else :
                  $ufetch=$pdo->prepare('SELECT * FROM account WHERE user_id =:uppid');
                  $ufetch->bindValue(':uppid',$camn['examiner']);
                  $ufetch->execute();
                  $uacat=$ufetch->fetchAll(PDO::FETCH_ASSOC); 
                  foreach ($uacat as $tuname) {
                    $tunames = $tuname['fname'].' '.substr($tuname['lname'], 0, 1).'.';
                  }
                  ?>  
                  
                  
                  <span class="badge bg-success  col-6 mx-auto"> 

                  <?php echo $tunames ?? null;?>
                  </span>

                <div class="d-flex justify-content-end">
                  <button class="btn btn-sm btn-info" type="button" data-id="<?php echo $camn['id'];?>" data-bs-toggle="offcanvas" 
                  data-bs-target="#ch<?php echo $camn['id'];?>" aria-controls="offcanvasRight"><i class="fa fa-edit" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Change"></i></button></div>

                  <div class="offcanvas offcanvas-end" tabindex="-1" id="ch<?php echo $camn['id'];?>" aria-labelledby="offcanvasRightLabel">
                  <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">Select the teacher to be assigned</h5>
                    <button type="button"  class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body">
                    <?php

                  $tteacher=$pdo->prepare('SELECT * FROM account WHERE Department =:deppid AND status=:ststu');
                  $tteacher->bindValue(':deppid',$camn['assigned_by']);
                  $tteacher->bindValue(':ststu','1');
                  $tteacher->execute();
                  $ateacher=$tteacher->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <form id="chassignt<?php echo $camn['id'];?>" class="was-validated">
                      <div id="chsuccessAssign<?php echo $camn['id'];?>"></div>
                    <div class="mb-2">
                    <label for="teacherlist" class="form-label">Select the Teacher</label>

                    <input type="hidden" id="chdepaidu<?php echo $camn['id'];?>" name="depaidu" value="<?php echo $camn['assigned_Department'];?>">
                    <input type="hidden" id="echdepaidu<?php echo $camn['id'];?>" name="depaidu" value="<?php echo $camn['exam_id'];?>">

                    <select id="chnteacher<?php echo $camn['id'];?>" name="nteacher<?php echo $camn['id'];?>" class="form-select"  required size="10" aria-label="size 3 select example">
                    <option value="empty">Unassign</option>   
                    <?php foreach ($ateacher as $tech): ?>
                             <?php if($tech['user_id'] == $camn['assigned_teacher']): ?>
                              <option  value="<?php  echo $tech['user_id'];?>" selected><?php echo $tech['title'].' '.$tech['fname'].' '.$tech['lname'].' '.$tech['gname'];?></option>
                             
                             <?php else: ?>
                              <option  value="<?php  echo $tech['user_id'];?>"><?php echo $tech['title'].' '.$tech['fname'].' '.$tech['lname'].' '.$tech['gname'];?></option>
                              <?php endif; ?>

                      <?php endforeach;?>
                    </select>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                    <button id="ichassignate" type="button" data-mid="<?php echo $camn['id'];?>" name="assignate"  class="chassignate btn btn-sm btn-success justify-content-md-center">Change</button>
                  </div>
                    </form>
                  </div>
                

                </div>

                <?php endif; ?>   

                </div>
                  </td>
                </tr>
              <?php endforeach; ?>
             </tbody>
            </table>
          
           </div>
                      <!-- <div class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
                  <div id="updatu" class="d-flex">
                    
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
            </div> -->
          
      
      </div>
     
    </div>
     <!------>
     <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
      <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <button type="button"  class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">

        </div>
      </div>
    </div>
    <script>
    var elements = document.getElementsByClassName('active');
      for (var i = 0; i < elements.length; i++) {
      var parentElement = elements[i].closest('.nav-link');
      if (parentElement) {
        parentElement.classList.remove('active');
    }}
    var anchor = document.querySelector('a.nav-link.actexam');
    if (anchor) {
      anchor.classList.add('active');
    }

  </script>
    <script type="text/javascript">

          $(document).ready(function () 
          {


            $(document).on('click', '#activ', function() {
            var uid =  $(this).attr('value');
            var target = $(this).data('target');
          $.ajax({
            url: "adminmodal.php",
            method: "POST",
            data: {
              uid: uid,
              target: target,
              page: 'actexam',
              action: 'activ'
            },
            success: function(data) {
              $('#activ').html(data);
            }
          })
          });

          $(document).on('change', '.edate', function() {
            var date =  $(this).attr('value');
            var target = $(this).data('eid');
          $.ajax({
            url: "adminmodal.php",
            method: "POST",
            data: {
              date: date,
              target: target,
              page: 'actexam',
              action: 'date_ch'
            },
            success: function(data) {
              $('.toast-body').html(data);
              $('.toast').addClass('toast-success').toast('show');
            }
          })
          });

          $(document).on('change', '.etime', function() {
            var date =  $(this).attr('value');
            var target = $(this).data('eid');
          $.ajax({
            url: "adminmodal.php",
            method: "POST",
            data: {
              date: date,
              target: target,
              page: 'actexam',
              action: 'time_ch'
            },
            success: function(data) {
              $('.toast-body').html(data);
              $('.toast').addClass('toast-success').toast('show');
            }
          })
          });

          

          $(document).on('click', '#ban', function() {
            var uid =  $(this).attr('value');
            var target = $(this).data('target');

          $.ajax({
            url: "adminmodal.php",
            method: "POST",
            data: {
              uid:uid,
              target:target,
              page: 'actexam',
              action: 'ban'
            },
            success: function(data) {
              $('#ban').html(data);
            }
          })
          });


            $(document).on('click', '.assignate', function(){

            var sid = $(this).data('id');
            var examid = document.forms["assignt"+sid]["edepaidu"+sid].value;
            var teacher = document.forms["assignt"+sid]["nteacher"+sid].value;
            var tdepa = document.forms["assignt"+sid]["chdepaidu"+sid].value;

            var button = document.getElementById("iassignate");
                button.disabled = true;
              $.ajax({
                    url:"adminmodal.php",
                    method:"POST",
                    data:{
                      page:'actexam',
                      action:'assign',
                      sid:sid,
                      examid:examid,
                      teacher:teacher,
                      tdepa:tdepa
                    },
                    success:function(data)
                    {
                      $('#successAssign'+sid).html(data); 
                      button.disabled = false;
                    }
                })
            });


          $(document).on('click', '.chassignate', function(){

           var csid = $(this).data('mid');
           var cdepart = document.forms["chassignt"+csid]["chdepaidu"+csid].value;
           var cteacher = document.forms["chassignt"+csid]["chnteacher"+csid].value;
           var echdepaidu = document.forms["chassignt"+csid]["echdepaidu"+csid].value;

           var button = document.getElementById("ichassignate");
           button.disabled = true;

            $.ajax({
                  url:"adminmodal.php",
                  method:"POST",
                  data:{
                    page:'actexam',
                    action:'chassign',
                    csid:csid,
                    cdepart:cdepart,
                    cteacher:cteacher,
                    echdepaidu:echdepaidu
                  },
                  success:function(data)
                  {
                    $('#chsuccessAssign'+csid).html(data); 
                    button.disabled = false;
                  }
              })
          })

     
});
</script> 

  </body>
</html>
<?php 
// }else{
//   header("Location: ../index.php");
//      exit();
// }
 ?>



