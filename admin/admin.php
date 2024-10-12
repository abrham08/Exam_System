<?php 
session_start();
include "dbc.php";

if (isset($_SESSION['uid']) && isset($_SESSION['fn'])) {
if($_SERVER['REQUEST_METHOD']=='POST'){
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
  
  if(isset($_POST['csent'])){
    $cname=$_POST['cname'];
    $cid=$_POST['cid'];
    $cnq=$_POST['cnq'];
    $cnc=$_POST['cnc'];
    $ctime=$_POST['ctime'];
   
   
  $cmy=$pdo->prepare("INSERT INTO category(cid,cname,cnq,cnc,ctime,ccreated,opt,cdate)
  VALUES (:cid,:cname,:cnq,:cnc,:ctime,:ccreated,:opt,:cdate)");

  $cmy->bindValue(':cid',$cid);
  
  $cmy->bindValue(':cname',$cname);
  $cmy->bindValue(':cnq',$cnq);
  $cmy->bindValue(':cnc',$cnc);
  $cmy->bindValue(':ctime',$ctime);
  $cmy->bindValue(':ccreated','');
  $cmy->bindValue(':opt','');
  $cmy->bindValue(':cdate',$date);
  $cmy->execute();
  echo"<script>$('#ictmodal').modal('show')</script>";
 
}
}
$fetch=$pdo->prepare('SELECT * FROM category ORDER BY cdate DESC');
$fetch->execute();
$cat=$fetch->fetchAll(PDO::FETCH_ASSOC);

?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<script src="js/bootstrap.min.js"></script>
  
    <script src="js/jquery.min.js"></script>  
    <link href="css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/fontawesome.min.css" rel="stylesheet" type="text/css">
    <title>ASTC ADMIN</title>
  </head>
  <body >
  <nav class="navbar navbar-expand-lg navbar-light  bg-info">
              <div class="container-fluid">
    
                <h1 class="text-black h4 navi bg-info"><img src="img/logo.png" height="60px" width="70px"    >Amhara Science and Technology Commission </h1>
    
                
                    <a style="color: yellow;margin-left:30%;" class=" float-end" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <span class="fa fa-xl fa-gear float-end"></span>
                    </a>
                  
                  <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                    <a href="alogout.php" class="sign-out ">
                      <i class="fas fa-sign-out-alt"></i>
                      <span style="color:black ;">Sign Out</span>
                    </a></br>
                    <a href="achangepassword.php" class="sign-out ">
                      <i class="fas fa-sign-out-alt"></i>
                      <span style="color:black ;">Change Password</span>
                    </a>
                    </div>
                  </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <!--------nav-->
                  
                  
                </div>
              

              </div>
            </nav>
    <div class="container big">
        <div class="container view">
                  <div class="mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exammodal">
                    Add Exam
                    </button></div>
                    
                    
                    <!-- exam_Modal -->
                    <div class="modal fade" id="exammodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Exam</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                            <div class="modal-body">
                              
                              <form class="form-group was-validated" method="POST" action="#" >
                                  <div class="mb-1">
                                  <label>Name</label>
                                  <input type="text" class="form-control" name="cname" required placeholder="Enter category name"></div>
                                  <div class="mb-1">
                                  <label>ID</label>
                                  <input type="text" class="form-control" name="cid" required placeholder="Enter category ID" ></div>
                                  <div class="mb-1">
                                  <label>Number of Questions</label>
                                  <input type="number" class="form-control" name="cnq" required placeholder="Enter number of question"></div>
                                  <div class="mb-1">
                                  <label>Number of codes</label>
                                  <input type="number" class="form-control" name="cnc" required placeholder="Enter number of codes"></div>
                                  <div class="mb-1">
                                  <label>Time</label>
                                  <input type="number" class="form-control" name="ctime" required placeholder="Enter the time given in minute"></div>
                                  <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                              <input type="submit" name="csent" class="btn btn-primary" value="ADD"> </div>
                              </form>
                            </div>
                            
                     
                 </div>
             </div>
          </div>
          <!--  -->
           <div class="table table-bordered table-striped container">
           
            <table class="table container">
              <tr class="table-info">
                <th class="table-info">ID</th>
                <th class="table-info">Category</th>
                <th class="">Number of Questions</th>
                <th class="table-info">Number of code</th>
                <th class="table-info">Time Given<br>(in minute)</th>
                <th class="table-info" colspan="3" >Action</th>
              </tr>
             <tbody>
              <?php foreach($cat as $ca): $ui=$ca['uid']; ?>
                <tr class="table-success">
                  <td><?php echo $ca['cid']?></td>
                  <td><?php echo $ca['cname']?></td>
                  <td><?php echo $ca['cnq']?></td>
                  <td><?php echo $ca['cnc']?></td>
                  <td><?php echo $ca['ctime']?></td>
                  <td> 
                  <form method="POST" action="quest.php" style="display: inline-block ;">
                    <input type="hidden" name="cid" value="<?php echo $ca['cid']?>">
                    <input type="submit" name="cquest" value="View" class="btn btn-sm btn-outline-primary">
                  </form>
                  
                   
                   <button  data-bs-target="#editmodal" data-bs-toggle="modal" name="edit" id="rugant" onlick="boom();" value="<?php echo $ca['uid']?>" class="rugant btn btn-sm btn-outline-info" data-id="<?php echo $ca['cid']?>">Edit</button>
                  
                  </form>
                    <form method="POST" action="delete.php" style="display: inline-block ;">
                    <input type="hidden" name="cid" value="<?php echo $ca['cid']?>">
                    <button type="submit" name="cdelete" class="btn btn-sm btn-outline-danger">Delete</button>
                  </form>
                  </td>
                </tr>
              <?php endforeach; ?>
             </tbody>
            </table>
           </div>
          
                 <!-- Edit Modal -->

                    <div class="modal fade" id="editmodal" tabindex="-1" data-bs-backdrop="static"  aria-labelledby="exampleModalLabel" aria-hidden="true">                          
                      <div class="modal-dialog">
                        <div id="ruyan" class="modal-content"> 
                 </div>
             </div>
          </div>

      
      </div>
     
    </div>
    <script type="text/javascript">

$(document).ready(function () 
{
  $(document).on('click', '.rugant', function(){
    var cudo = $(this).val();
    $.ajax({
          url:"modal.php",
          method:"POST",
          data:{cudo:cudo,page:'admin',action:'modall'},
          success:function(data)
          {
            $('#ruyan').html(data); 
          }
      })
  })
});
</script> 
   
  </body>
</html>
<?php 
}else{
     header("Location: aindex.php");
     exit();
}
 ?>