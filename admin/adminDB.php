<?php
include "dbc.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
$uid=random();
$date=date('d-m-y H:i:s');
$photop= '';

if(isset($_POST['enter'])){

    $fname=$_POST['fname'];
    $phone=$_POST['phone'];
    $gender=$_POST['gender'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    if(!is_dir('admins')){
        mkdir('admins');
    }
    if(!is_dir('admins/'.$uid)){
        mkdir('admins/'.$uid);
        
        
    }
    $photo=$_FILES['photo'] ?? null;
    if($photo && $photo['tmp_name']){
        $photop ='admins/'.$uid.'/'.$photo['name'];
        move_uploaded_file($photo['tmp_name'],$photop); 
    }
    

    $fetch=$pdo->prepare("SELECT COUNT(*) AS fname FROM admn WHERE uiid=:uiid"); 
    $fetch->bindValue(':uiid',$uid);
    $fetch->execute();
    $prof=$fetch->fetchAll(PDO::FETCH_ASSOC);
    if($prof['fname']>0){
      $uid=random()."#";
    } 
    else{ 
$sttmt=$pdo->prepare("INSERT INTO admn(uiid,fname,phone,gender,email,password,photo,opt)
  VALUES (:uiid,:fname,:phone,:gender,:email,:password,:photo,:opt)");
  $sttmt->bindValue(':uiid',$uid);
  $sttmt->bindValue(':fname',$fname);
  $sttmt->bindValue(':phone',$phone);
  $sttmt->bindValue(':gender',$gender);
  $sttmt->bindValue(':email',$email);
  $sttmt->bindValue(':password',$password);
  $sttmt->bindValue(':photo',$photop);
  $sttmt->bindValue(':opt',$date);
  $sttmt->execute();
  header('location: adminadmin.php?q=' .$uid. ' && n='.$fname. ' ');

    }

}
}



function random(){
    $char='@0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str= '';
    for($i=0;$i<7;$i++)
    {
        $index=rand(0,strlen($char) -1 );
        $str  .=$char[$index];
    }
    return $str;
}

?>