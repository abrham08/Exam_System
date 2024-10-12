<?php
session_start();

include "dbc.php";
if (isset( $_SESSION['suid']) ) {

if($_SERVER['REQUEST_METHOD']=='POST'){
$uid=random();
$date=date('d-m-y H:i:s');
$photo= '';
$video= '';
$doc= '';
$stat=0;

if(isset($_POST['enter'])){
    $descr=$_POST['notice'];
    $no=$_POST['no'];
    $type=$_POST['type'];
    $cat=$_POST['cat'];
    $tit=$_POST['title'];
    $cstat=1;

    if($_POST['check'] != null){
      $stat=1;
    }
    else{
      $stat=0;
    }

     if(!is_dir('notice')){
          mkdir('notice');
      }
            if($type == 1){
            if(!is_dir('notice/img')){
                mkdir('notice/img');    
            }
          }
          if($type == 2){
            if(!is_dir('notice/video')){
                mkdir('notice/video');    
            }
          }
          if($type == 3){
            if(!is_dir('notice/document')){
                mkdir('notice/document');    
            }
          }
      $file=$_FILES['file'] ?? null;

      if($type == 1){
          if($file && $file['tmp_name']){
            $photop ='notice/img/'.$file['name'];
            move_uploaded_file($file['tmp_name'],$photop); 
        }
      }
      if($type == 2){
        if($file && $file['tmp_name']){
          $photop ='notice/video/'.$file['name'];
          move_uploaded_file($file['tmp_name'],$photop); 
      }
    }
    if($type == 3){
      if($file && $file['tmp_name']){
        $photop ='notice/document/'.$file['name'];
        move_uploaded_file($file['tmp_name'],$photop); 
    }
  }

    

    $fetch=$pdo->prepare("SELECT COUNT(*) AS notice FROM notice WHERE nid=:nid"); 
    $fetch->bindValue(':nid',$uid);
    $fetch->execute();
    $prof=$fetch->fetchAll(PDO::FETCH_ASSOC);
    if($prof['notice']>0){
      $uid=random()."#";
    }  
    else{ 
$sttmt=$pdo->prepare("INSERT INTO notice(nid,type,cat,cstat,no,notice,title,description,stat,date)
  VALUES (:nid,:type,:cat,:cstat,:no,:notice,:title,:description,:stat,:date)");
  $sttmt->bindValue(':nid',$uid);
  $sttmt->bindValue(':type',$type);
  $sttmt->bindValue(':cat',$cat);
  $sttmt->bindValue(':cstat',$cstat);
  $sttmt->bindValue(':no',$no);
  $sttmt->bindValue(':notice',$photop);
  $sttmt->bindValue(':title',$tit);
  $sttmt->bindValue(':description',$descr);
  $sttmt->bindValue(':stat',$stat);
  $sttmt->bindValue(':date',$date);
  $sttmt->execute();
  //header('location: home.php?q=' .$uid. ' && n='.$notice. ' && nl='.$no. '');

    }

}
}



function random(){
    $char='@0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str= '';
    for($i=0;$i<5;$i++)
    {
        $index=rand(0,strlen($char) -1 );
        $str  .=$char[$index];
    }
    return $str;
}
}else{
  header("Location: ../index.php");
  exit();
}

?>