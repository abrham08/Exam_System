<?php
include "dbc.php";  
$date=date('d-m-y H:i:s');
$id=$_GET['cedit'];
                            
    if(isset($_POST['cupdate'])){
            $cid=$_POST['cid'];
            $cname=$_POST['cname'];
            $cnq=$_POST['cnq'];
            $cnc=$_POST['cnc'];
            $ctime=$_POST['ctime'];
          $cmy=$pdo->prepare("UPDATE category SET cid=:cid,cname=:cname,cnq=:cnq,cnc=:cnc,ctime=:ctime,cdate=:cdate WHERE cid=:cid");
            $cmy->bindValue(':cid',$cid);
            $cmy->bindValue(':cname',$cname);
            $cmy->bindValue(':cnq',$cnq);
            $cmy->bindValue(':cnc',$cnc);
            $cmy->bindValue(':ctime',$ctime);
            $cmy->bindValue(':cdate',$date);
            $cmy->bindValue(':cid',$cid);
            $cmy->execute();
            header('location: admin.php');


    }
    if($cid){    
        echo "<script type='text/javascript'> alert('Sorry ,the category ID already exist!')</script>";
        exit;
      }
?>