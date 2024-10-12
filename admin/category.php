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
    $assteacher=$pdo->prepare("UPDATE course SET assigned_teacher = :asteacher WHERE id=:bcat AND catDepartment=:cdepa");
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
$afetch=$pdo->prepare('SELECT Department FROM account WHERE user_id =:uiid ');
$afetch->bindValue(':uiid',$uid);
$afetch->execute();
$acat=$afetch->fetchAll(PDO::FETCH_ASSOC);
foreach($acat as $aacat){
  $adep=$aacat['Department'];
}


$cifetch=$pdo->prepare('SELECT * FROM course WHERE catDepartment =:deppid ');
$cifetch->bindValue(':deppid',$adep);
$cifetch->execute();
$cicat=$cifetch->fetchAll(PDO::FETCH_ASSOC);







?>
<html lang="en">
  <head>

    <title>Category</title>
  </head>
  <body >
 
    <div class="container big">
        <div class="container view">
                  <div class="mb-3">

                    
                    
                    <!-- Modal -->

           <div class="table table-bordered table-striped container">
           
           <table class="table table-striped table-hover container table-hover">
              <tr class="table-info">
              <th class="table-info">Course </th>
                <th class="table-info">Code</th>
                <th class="table-info">Assigned Department</th>
                <th class="table-info">Program</th>
                <th class="table-info">Group</th>
                <th class="table-info">Year</th>
                <th class="table-info">Teacher</th>
            
              </tr>
             <tbody>
              <?php foreach($cicat as $camn): 
               $trifetch=$pdo->prepare('SELECT dep_name FROM department WHERE dep_id =:deeppid');
               $trifetch->bindValue(':deeppid',$camn['Department']);
               $trifetch->execute();
               $tricat=$trifetch->fetchAll(PDO::FETCH_ASSOC);
               foreach ($tricat as $triname) {
                $depnames = $triname['dep_name'];
              }

              $fetch=$pdo->prepare('SELECT * FROM category WHERE cat_id =:cpppid');
              $fetch->bindValue(':cpppid',$camn['cat_id']);
              $fetch->execute();
              $cat=$fetch->fetchAll(PDO::FETCH_ASSOC); 
              foreach ($cat as $caname) {
                $canames = $caname['cat_name'];
                $cacode = $caname['cat_code'];
                $strcode = $caname['stream'];
              }
                ?>
           

                <tr class="">
                <td class="col-3"><?php echo $canames;?></td>
                <td><?php echo $cacode?></td>
                <td><?php echo $depnames?></td>
                <td><?php echo $strcode?></td>
                <td><?php echo $camn['assigned_group']?></td>
                <td><?php echo $camn['assigned_year']?></td>
                <td class="col-3">
                  <div class="container">
                <?php if( $camn['assigned_teacher'] == 'empty' ) : ?>
                
                  <span class="badge bg-danger col-6 mx-auto ">Not Assigned</span>
                 
                  <div class="d-flex justify-content-end">
                  <button class="btn btn-sm btn-info" type="button" data-id="<?php echo $camn['id'];?>" data-bs-toggle="offcanvas" 
                  data-bs-target="#yu<?php echo $camn['id'];?>" aria-controls="offcanvasRight">Assign</button></div>
                  <div class="offcanvas offcanvas-end" tabindex="-1" id="yu<?php echo $camn['id'];?>" aria-labelledby="offcanvasRightLabel">
                  <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">Select the teacher to be assigned</h5>
                    <button type="button"  class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body">
                    <?php

                  $tteacher=$pdo->prepare('SELECT * FROM account WHERE Department =:deppid AND status=:ststu');
                  $tteacher->bindValue(':deppid',$camn['catDepartment']);
                  $tteacher->bindValue(':ststu','1');
                  $tteacher->execute();
                  $ateacher=$tteacher->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <form id="assignt<?php echo $camn['id'];?>" class="was-validated">
                      <div id="successAssign<?php echo $camn['id'];?>"></div>
                    <div class="mb-2">
                    <label for="teacherlist" class="form-label">Select the Teacher</label>
                    <input type="hidden" id="depaidu<?php echo $camn['id'];?>" name="depaidu" value="<?php echo $camn['catDepartment'];?>">
                    <select id="nteacher<?php echo $camn['id'];?>" name="nteacher<?php echo $camn['id'];?>" class="form-select"  required size="10" aria-label="size 3 select example">
                    <?php foreach ($ateacher as $tech): ?>
                      <option  value="<?php  echo $tech['user_id'];?>"><?php echo $tech['title'].' '.$tech['fname'].' '.$tech['lname'].' '.$tech['gname'];?></option>
                      <?php endforeach;?>
                    </select>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="button" data-id="<?php echo $camn['id'];?>" name="assignate" class="assignate btn btn-sm btn-success justify-content-md-center">Confirm</button>
                  </div>
                    </form>
                  </div>
                

                </div>




                <?php else :
                  $ufetch=$pdo->prepare('SELECT * FROM account WHERE user_id =:uppid');
                  $ufetch->bindValue(':uppid',$camn['assigned_teacher']);
                  $ufetch->execute();
                  $uacat=$ufetch->fetchAll(PDO::FETCH_ASSOC); 
                  foreach ($uacat as $tuname) {
                    $tunames = $tuname['fname'].' '.substr($tuname['lname'], 0, 1).'.';
                  }
                  ?>  
                  
                  
                  <span class="badge bg-success  col-6 mx-auto"> 

                  <?php echo $tunames;?>
                  </span>

                <div class="d-flex justify-content-end">
                  <button class="btn btn-sm btn-info" type="button" data-id="<?php echo $camn['id'];?>" data-bs-toggle="offcanvas" 
                  data-bs-target="#ch<?php echo $camn['id'];?>" aria-controls="offcanvasRight">Change</button></div>

                  <div class="offcanvas offcanvas-end" tabindex="-1" id="ch<?php echo $camn['id'];?>" aria-labelledby="offcanvasRightLabel">
                  <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">Select the teacher to be assigned</h5>
                    <button type="button"  class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <div class="offcanvas-body">
                    <?php

                  $tteacher=$pdo->prepare('SELECT * FROM account WHERE Department =:deppid AND status=:ststu');
                  $tteacher->bindValue(':deppid',$camn['catDepartment']);
                  $tteacher->bindValue(':ststu','1');
                  $tteacher->execute();
                  $ateacher=$tteacher->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <form id="chassignt<?php echo $camn['id'];?>" class="was-validated">
                      <div id="chsuccessAssign<?php echo $camn['id'];?>"></div>
                    <div class="mb-2">
                    <label for="teacherlist" class="form-label">Select the Teacher</label>
                    <input type="hidden" id="chdepaidu<?php echo $camn['id'];?>" name="depaidu" value="<?php echo $camn['catDepartment'];?>">
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
                    <button type="button" data-mid="<?php echo $camn['id'];?>" name="assignate"  class="chassignate btn btn-sm btn-success justify-content-md-center">Change</button>
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
                      <div class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
                  <div id="updatu" class="d-flex">
                    
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
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
var anchor = document.querySelector('.nav-link.caticati');
if (anchor) {
  anchor.classList.add('active');
}

  </script>
    <script type="text/javascript">

          $(document).ready(function () 
          {
            $(document).on('click', '.assignate', function(){

            var sid = $(this).data('id');
            var depart = document.forms["assignt"+sid]["depaidu"+sid].value;
            var teacher = document.forms["assignt"+sid]["nteacher"+sid].value;
              $.ajax({
                    url:"adminmodal.php",
                    method:"POST",
                    data:{
                      page:'category',
                      action:'assign',
                      sid:sid,
                      depart:depart,
                      teacher:teacher
                    },
                    success:function(data)
                    {
                      $('#successAssign'+sid).html(data); 
                    }
                })
            });


          $(document).on('click', '.chassignate', function(){

           var csid = $(this).data('mid');
           console.log(csid);
           var cdepart = document.forms["chassignt"+csid]["chdepaidu"+csid].value;
           var cteacher = document.forms["chassignt"+csid]["chnteacher"+csid].value;
            $.ajax({
                  url:"adminmodal.php",
                  method:"POST",
                  data:{
                    page:'category',
                    action:'chassign',
                    csid:csid,
                    cdepart:cdepart,
                    cteacher:cteacher
                  },
                  success:function(data)
                  {
                    $('#chsuccessAssign'+csid).html(data); 
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



