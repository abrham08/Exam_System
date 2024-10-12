<?php 
session_start();
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
 
include "dbc.php";
if (isset( $_SESSION['suid']) ) {
if(isset($_POST['page']))
{


  if($_POST['page'] == 'home')
  {
    if($_POST['action'] == 'modall')
  
    {
      $stat=$_POST['cudo'];
      $nid=$_POST['id'];
        $cmy=$pdo->prepare("UPDATE notice SET stat=:stat WHERE nid=:nid");
        $cmy->bindValue(':stat',$stat);
        $cmy->bindValue(':nid',$nid);
        $cmy->execute();
        echo '<div class="alert  alert-success" id="usualert" role="alert">
        The notice status is succesfuly changed !
        <script>
        $("#usualert").alert();
        setTimeout(function() {
        $("#usualert").alert("close");
          }, 20000);
        
        </script>
        </div>';
    }
    if($_POST['action'] == 'del')
  
    {
      $id=$_POST['cudo'];
        $cmy=$pdo->prepare("DELETE FROM notice WHERE nid=:nid");
        $cmy->bindValue(':nid',$id);
        $cmy->execute();
        echo '<div class="alert  alert-success" id="usualert" role="alert">
                    The cnotice is succesfully deleted !
                    <script>
                    $("#usualert").alert();
                    setTimeout(function() {
                    $("#usualert").alert("close");
                      }, 20000);
                    
                    </script>
                    </div>';
     
     
  
    
    }
    if($_POST['action'] == 'deltext')
  
    {
  
      $sql = "DELETE FROM notice WHERE type=:idat";
      $ustmt = $pdo->prepare($sql);
      $ustmt->bindValue(':idat', 0);
      $ustmt->execute();
      echo '<div class="alert  alert-success" id="usualert" role="alert">
      The text is succesfully deleted !
      <script>
      $("#usualert").alert();
      setTimeout(function() {
      $("#usualert").alert("close");
        }, 20000);
      
      </script>
      </div>';
  
    }
  
            if($_POST['action'] == 'tpost')
  
            {
              $data = $_POST['data'];
              $post = $data['aopt6'];
              $id=random('t');
  
              $sql = "SELECT * FROM notice WHERE type=:idat";
              $ustmt = $pdo->prepare($sql);
              $ustmt->bindValue(':idat', 0);
              $ustmt->execute();
              $userd = $ustmt->fetchAll(PDO::FETCH_ASSOC);
              if(count($userd) >0){
                $cmy=$pdo->prepare("UPDATE notice SET notice=:stat WHERE type=:nid");
                $cmy->bindValue(':stat',$post);
                $cmy->bindValue(':nid',0);
                $cmy->execute();
              }
              else{
              $dcmy = $pdo->prepare("INSERT INTO notice(nid,type,notice,stat)
              VALUES (:cat_id,:exam_id,:notice,:stat)");
                  $dcmy->bindValue(':cat_id', $id);
                  $dcmy->bindValue(':exam_id', 0);
                  $dcmy->bindValue(':notice', $post);
                  $dcmy->bindValue(':stat', 1);
                  $dcmy->execute();
  
              }
  
                echo '<div class="alert  alert-success" id="usualert" role="alert">
                            The new notice is succesfully inserted !
                            <script>
                            document.getElementById("aopt6").reset();
                            $("#usualert").alert();
                            setTimeout(function() {
                            $("#usualert").alert("close");
                              }, 20000);
                              var editor6 = CKEDITOR.instances.aopt6;
                              editor6.setData("");
                            </script>
                            </div>';
            
            
  
            
            }
  }
  








if($_POST['page'] == 'addHead')
	{
		if($_POST['action'] == 'addinss')
        
		{  
            $output ='';
            $photos= '';
			$depa=$_POST['depa']; 
            $tit=$_POST['title'];
            $fname= ucwords(strtolower($_POST['fname']));
            $mname= ucwords(strtolower($_POST['mname']));
            $lname= ucwords(strtolower($_POST['lname']));
            $phone=$_POST['phone'];
            $email=$_POST['email'];
            $usertype = 'Head';
            $photo = $_FILES['photo'] ?? null;
            $accept = ["jpg","jpeg", "png", "gif", "webp",null];
           
            $date=date('d-m-y H:i:s');
           

            if( $fname  && $mname && $lname && $phone && $email  && $depa   !=null){
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) { 

                    $sql = "SELECT * FROM account WHERE email=:idat AND user_type=:utipi ";
                    $eustmt = $pdo->prepare($sql);
                    $eustmt->bindValue(':idat', $email);
                    $eustmt->bindValue(':utipi', $usertype);
                    $eustmt->execute();
                    $eemail = $eustmt->fetchAll(PDO::FETCH_ASSOC);

          if(count($eemail) <= 0){


                $email_stat='';
                $slicii= strtoupper(substr($fname, 0, 3));
                $userid = random($slicii);
                $llname = strtoupper(substr($lname, 0, 3));
                $username= random('H');
                $passwordn = random($mname);
                $password = password_hash($passwordn, PASSWORD_BCRYPT);

            $sql = "SELECT * FROM account WHERE user_id=:idat OR user_name=:unami";
            $ustmt = $pdo->prepare($sql);
            $ustmt->bindValue(':idat', $userid);
            $ustmt->bindValue(':unami', $username);
            $ustmt->execute();
            $userd = $ustmt->fetchAll(PDO::FETCH_ASSOC);
            
            if(count($userd) > 0){
                $userid = $userid.$llname;
                $username = $username.$llname;
            }
            $photo_name = '';
            if($photo != null){
            $ext = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION)) ?? null;
            if  (in_array($ext, $accept)){
              $photo = $_FILES['photo'];
      
              $photo_name = $userid . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
      
              // Upload photo to server
              $target_dir = 'img/account/';
              $target_file = $target_dir . $photo_name;
              move_uploaded_file($photo['tmp_name'], $target_file);
      
            }
          }
           
                $mail = new PHPMailer(true);
               
                try {
                    
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;   
                    $mail->SMTPDebug = 0;            
                    $mail->isSMTP();                                            
                    $mail->Host       = 'smtp.gmail.com';                    
                    $mail->SMTPAuth   = true;                                
                    $mail->Username   = 'abrhamgelawu@gmail.com';                     
                    $mail->Password   = 'iozdnqljvzngppmk';                               
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
                    $mail->Port       = 465;                                    
                
                    
                    $mail->setFrom('abrhamgelawu@gmail.com', 'DKU OES');
                    $mail->addAddress($email);     
                              
                    $mail->addReplyTo('abrhamgelawu@gmail.com', 'DKU OES');
                    
                    $mail->isHTML(true);                                  
                    $mail->Subject = 'DKU OES';
                    $mail->Body = file_get_contents('verify.html');
                    $mail->Body = str_replace('{{ $tit }}', $tit, $mail->Body);
                    $mail->Body = str_replace('{{ $fname }}', $fname, $mail->Body);
                    $mail->Body = str_replace('{{ $mname }}', $mname, $mail->Body);
                    $mail->Body = str_replace('{{ $lname }}', $lname, $mail->Body);
                    $mail->Body = str_replace('{{ $username }}', $username, $mail->Body);
                    $mail->Body = str_replace('{{ $password }}', $passwordn, $mail->Body);
                    

                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
                    $mail->send();
                    $email_stat=1;
                    
                } catch (Exception $e) {
                    $email_stat=0;
                    echo '<div class="alert alert-danger" id ="emailerror" role="alert">
                    The email could not be sent
                    <script>
                    document.getElementById("addins").reset();
                    $("#emailerror").alert();
                    setTimeout(function() {
                    $("#emailerror").alert("close");
                      }, 25000);
                    </div>';
                }

                $ins=$pdo->prepare("INSERT INTO account(Department,user_id,user_type,title,fname,lname,gname,phone,email,email_stat,photo,user_name,password) 
                VALUES(:depa,:uiiid,:utyp,:titi,:fnam,:laname,:gname,:phone,:email,:estat,:photo,:uname,:pass)");
              $ins->bindValue(':depa',$depa);
              $ins->bindValue(':uiiid',$userid);
              $ins->bindValue(':utyp',$usertype);
              $ins->bindValue(':titi',$tit);
              $ins->bindValue(':fnam',$fname);
              $ins->bindValue(':laname',$mname);
              $ins->bindValue(':gname',$lname);
              $ins->bindValue(':phone',$phone);
              $ins->bindValue(':email',$email);
              $ins->bindValue(':estat',$email_stat);
              $ins->bindValue(':photo',$photo_name);
              $ins->bindValue(':uname',$username);
              $ins->bindValue(':pass',$password);
              $ins->execute();

                echo '<div class="alert  alert-success" id="susualert" role="alert">
           The new Head has been successfully added!
           <script>
           document.getElementById("addins").reset();
           $("#susualert").alert();
           setTimeout(function() {
           $("#susualert").alert("close");
             }, 2000);
           
           </script>
           </div>';}
        else{
            echo '<div class="alert alert-danger" role="alert">
            Sorry, the email is already exist!
            </div>';
        }
        }
           else {
            echo '<div class="alert alert-danger" role="alert">
            The email is invalid
            </div>';
        }
            }
            
            else{
            echo '<div class="alert alert-danger" role="alert">
            Please fill the form correctlly!
            </div>';
            }

        }


        if($_POST['action'] == 'activ')
		{  
          $uid=$_POST['uid'];
       
        $assteacher=$pdo->prepare("UPDATE account SET status = :asteacher WHERE user_id=:bcat  ");
        $assteacher->bindValue(':asteacher', 1);
        $assteacher->bindValue(':bcat',$uid);
        $assteacher->execute();
        echo '<script>
           location.reload();
       
           
           </script>';


        }

        if($_POST['action'] == 'ban')
		{  
            $uid=$_POST['uid'];
            $assteacher=$pdo->prepare("UPDATE account SET status = :asteacher WHERE user_id=:bcat  ");
            $assteacher->bindValue(':asteacher', 0);
            $assteacher->bindValue(':bcat',$uid);
            $assteacher->execute();
            echo '<script>
               location.reload();
           
               
               </script>';
        echo '<script>
           location.reload();
       
           
           </script>';


        }
        
        if($_POST['action'] == 'editHead')
		{   
             $output='';
             $uid =$_POST['uid'];

             $fetch = $pdo->prepare('SELECT * FROM account WHERE user_id=:uiid');
             $fetch->bindValue(':uiid',$uid);
             $fetch->execute();
             $epart = $fetch->fetch(PDO::FETCH_ASSOC);
             

            $dfetch = $pdo->prepare('SELECT * FROM department ORDER BY dep_name ASC');
            $dfetch->execute();
            $depart = $dfetch->fetchAll(PDO::FETCH_ASSOC);
            $output='';



             $output.='
             
            <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Department Head Profile</h5>
          <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>
        <div class="modal-body">
          <div class="form signup">
            <form class="was-validated" method="POST" id="updins" action="#"  enctype="multipart/form-data">
              <div class="mb-1" id="updInsSuccess"></div>
              <input type="hidden" value="'.$uid.'" id="uid" name="uid" >
              <div class=" row ">
                <div class="col mb-1">
                  <label>Title</label>
                  <select id="title" name="title" class="form-select" required aria-label="stype">
                    <option selected value="'.$epart['title'].'">'.$epart['title'].'</option>
                    <option value="Mr.">Mr.</option>
                    <option value="Ms.">Ms.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Dr.">Dr.</option>
                    <option value="Professor">Professor</option>
                  </select>

                </div>
                <div class="col mb-1">
                  <label>First Name</label>
                  <input type="text" id="fname" value="'.$epart['fname'].'" class="form-control" name="fname" required placeholder="First Name ">

                </div>
                <div class=" col mb-1">
                  <label>Middle Name</label>
                  <input type="text" id="mname"  value="'.$epart['lname'].'" class="form-control" name="mname" required placeholder="Middle Name ">

                </div>
                <div class=" col mb-1">
                  <label>Last Name</label>
                  <input type="text" id="lname"  value="'.$epart['gname'].'" class="form-control" name="lname" required placeholder="Last Name ">
                </div>
              </div>
              <div class="row">
              <div class="col mb-1">

                  <label>Department</label>
                  <select id="depa" name="depa" class="form-select" required aria-label="taype">
                    <option value></option>';
                     foreach ($depart as $colfep) {  
                        if($epart['Department'] ==  $colfep['dep_id'] ){
                        $output.='<option selected value='. $colfep['dep_id'].' >'. $colfep['dep_name'] .'</option>';
                        }
                    }
                  
                    $output.='</select>
                </div>
                <div class="col mb-1">
                  <label>Phone Number</label>
                  <input type="number" class="form-control"  value="'.$epart['phone'].'" maximum="10" id="phone" name="phone" required placeholder="Enter your phone number ">
                </div>
                <div class="col mb-1">
                  <label>Email</label>
                  <input type="Email" class="form-control"  value="'.$epart['email'].'" maximum="10" id="email" name="email" required placeholder="Enter your phone number ">
                </div>
              </div>
              <div class=" mb-1">
                <label>Photo</label>
                <input type="hidden" value="'.$epart['photo'].'"  id="photop" name="photop" >
                <input type="File" class="form-control"   id="photo" accept=".jpg,.jpeg,.png,.gif,.webp" name="photo"  placeholder="Enter your photo ">
              </div>
              <div class="modal-footer">
                <button type="button" onclick="window.location.reload()" class="caca btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button class="addinstructor btn btn-primary" id="updateinstructor" type="button" name="enter"> Update</button>
              </div>
            </form>
          </div>
        </div>
             
             
             ';

       echo $output;
         
        }

        if($_POST['action'] == 'updinss')
		    { 




          $output ='';
          $photos= '';
          $depa=$_POST['depa']; 
          $tit=$_POST['title'];
          $fname= ucwords(strtolower($_POST['fname']));
          $mname= ucwords(strtolower($_POST['mname']));
          $lname= ucwords(strtolower($_POST['lname']));
          $phone=$_POST['phone'];
          $email=$_POST['email'];
          $photop=$_POST['photop'];
          
          $usertype ='Head';
          $uid=$_POST['uid'];        
          $photo = $_FILES['photo'] ?? null;
          $accept = ["jpg","jpeg", "png", "gif", "webp",null];        
          $date=date('d-m-y H:i:s');
         

          if( $fname  && $mname && $lname && $phone && $email  && $depa   !=null){
              if (filter_var($email, FILTER_VALIDATE_EMAIL)) { 

                  $sql = "SELECT * FROM account WHERE email=:idat AND user_type=:utipi ";
                  $eustmt = $pdo->prepare($sql);
                  $eustmt->bindValue(':idat', $email);
                  $eustmt->bindValue(':utipi', $usertype);
                  $eustmt->execute();
                  $eemail = $eustmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($eemail) < 2){


              $email_stat='';

          $photo_name = '';

          if($photo != null){
          $ext = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION)) ?? null;
          if  (in_array($ext, $accept)){
            
            $directory = 'img/account/';
            $filenameWithoutExtension = $photop;
            
            $files = glob($directory . $filenameWithoutExtension . '.*');
            
            if (!empty($files)) {
                $fileToDelete = $files[0];
                if (is_file($fileToDelete)) {
                    unlink($fileToDelete);
                }
            }
           
            $photo = $_FILES['photo'];
    
            $photo_name = $uid . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
    
            // Upload photo to server
            $target_dir = 'img/account/';
            $target_file = $target_dir . $photo_name;
            move_uploaded_file($photo['tmp_name'], $target_file);
    
          }
        }
        else{
          $photo_name =$photop;
        }
                                         
      

                      $update = $pdo->prepare("UPDATE account 
                      SET Department = :depa,
              
                          title = :titi,
                          fname = :fnam,
                          lname = :laname,
                          gname = :gname,
                          phone = :phone,
                          email = :email,

                          photo = :photo

                      WHERE user_id = :uiiid");

              $update->bindValue(':depa', $depa);
              $update->bindValue(':titi', $tit);
              $update->bindValue(':fnam', $fname);
              $update->bindValue(':laname', $mname);
              $update->bindValue(':gname', $lname);
              $update->bindValue(':phone', $phone);
              $update->bindValue(':email', $email);
              $update->bindValue(':photo', $photo_name);
              $update->bindValue(':uiiid', $uid);
              $update->execute();


              echo '<div class="alert  alert-success" id="susualert" role="alert">
         The account has been successfully updated!
         <script>
         document.getElementById("addins").reset();
         $("#susualert").alert();
         setTimeout(function() {
         $("#susualert").alert("close");
           }, 2000);
           window.location.reload();
         </script>
         </div>';}
      else{
          echo '<div class="alert alert-danger" role="alert">
          Sorry, the email is already exist!
          </div>';
      }
      }
         else {
          echo '<div class="alert alert-danger" role="alert">
          The email is invalid
          </div>';
      }
          }
          
          else{
          echo '<div class="alert alert-danger" role="alert">
          Please fill the form correctlly!
          </div>';
          }






        }


        if($_POST['action'] == 'deletehead')
		    {
          $directory = 'img/account/';
            $filenameWithoutExtension = $_POST['uid'];
            
            $files = glob($directory . $filenameWithoutExtension . '.*');
            
            if (!empty($files)) {
                $fileToDelete = $files[0];
                if (is_file($fileToDelete)) {
                    unlink($fileToDelete);
                }
            }
          $sql = "DELETE FROM account WHERE user_id = :id ";
          $sdtmt = $pdo->prepare($sql);
          $sdtmt->bindValue(':id', $_POST['uid']);
          $sdtmt->execute();
          echo '<div class="alert  alert-success" id="usualert" role="alert">
        The department Head has been successfully deleted!
        <script>
        $("#usualert").alert();
        setTimeout(function() {
        $("#usualert").alert("close");
          }, 20000);
        
        </script>
        </div>';
          
        }

        if($_POST['action'] == 'send_again')
		    {
          $uid =$_POST['uid'];

          $fetch = $pdo->prepare('SELECT * FROM account WHERE user_id=:uiid');
          $fetch->bindValue(':uiid',$uid);
          $fetch->execute();
          $epart = $fetch->fetch(PDO::FETCH_ASSOC);

          $mname = $epart['lname'];
          $passwordn = random($mname);
          $password = password_hash($passwordn, PASSWORD_BCRYPT);

          $snewmy = $pdo->prepare("UPDATE account 
          SET password = :pass WHERE user_id = :uiiid");
          $snewmy->bindValue(':uiiid',$uid);  
          $snewmy->bindValue(':pass',$password);         
          $snewmy->execute();

          $mail = new PHPMailer(true);
               
          try {
              
              $mail->SMTPDebug = SMTP::DEBUG_SERVER;   
              $mail->SMTPDebug = 0;            
              $mail->isSMTP();                                            
              $mail->Host       = 'smtp.gmail.com';                    
              $mail->SMTPAuth   = true;                                
              $mail->Username   = 'abrhamgelawu@gmail.com';                     
              $mail->Password   = 'iozdnqljvzngppmk';                               
              $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
              $mail->Port       = 465;                                    
          
              
              $mail->setFrom('abrhamgelawu@gmail.com', 'DKU OES');
              $mail->addAddress($epart['email']);     
                        
              $mail->addReplyTo('abrhamgelawu@gmail.com', 'DKU OES');
              
              $mail->isHTML(true);                                  
              $mail->Subject = 'DKU OES';
              $mail->Body = file_get_contents('verify.html');
              $mail->Body = str_replace('{{ $tit }}', $epart['title'], $mail->Body);
              $mail->Body = str_replace('{{ $fname }}', $epart['fname'], $mail->Body);
              $mail->Body = str_replace('{{ $mname }}',$epart['lname'], $mail->Body);
              $mail->Body = str_replace('{{ $lname }}', $epart['gname'], $mail->Body);
              $mail->Body = str_replace('{{ $username }}',$epart['user_name'], $mail->Body);
              $mail->Body = str_replace('{{ $password }}', $passwordn , $mail->Body);
              

              $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          
              $mail->send();
              $email_stat=1;
              
          
              echo '<div class="alert  alert-success" id="usualert" role="alert">
              The confirmation cod has been successfully sendede to '.$epart['title'].' '.$epart['fname'].'!
              <script>
              $("#usualert").alert();
              setTimeout(function() {
              $("#usualert").alert("close");
                }, 20000);
              
              </script>
              </div>';
          
            } catch (Exception $e) {
              $email_stat=0;
              echo '<div class="alert alert-danger" id ="emailerror" role="alert">
              The email could not be sent
              <script>
              document.getElementById("addins").reset();
              $("#emailerror").alert();
              setTimeout(function() {
              $("#emailerror").alert("close");
                }, 25000);
              </div>';
          }














         
          
        }




        

    }



    if($_POST['page'] == 'addHR')
    {
      if($_POST['action'] == 'addinss')
          
      {  
              $output ='';
              $photos= '';
              $depa='HR'; 
              $tit=$_POST['title'];
              $fname= ucwords(strtolower($_POST['fname']));
              $mname= ucwords(strtolower($_POST['mname']));
              $lname= ucwords(strtolower($_POST['lname']));
              $phone=$_POST['phone'];
              $email=$_POST['email'];
              $usertype = 'HR';
              $photo = $_FILES['photo'] ?? null;
              $accept = ["jpg","jpeg", "png", "gif", "webp",null];
             
              $date=date('d-m-y H:i:s');
             
  
              if( $fname  && $mname && $lname && $phone && $email  && $depa   !=null){
                  if (filter_var($email, FILTER_VALIDATE_EMAIL)) { 
  
                      $sql = "SELECT * FROM account WHERE email=:idat AND user_type=:utipi ";
                      $eustmt = $pdo->prepare($sql);
                      $eustmt->bindValue(':idat', $email);
                      $eustmt->bindValue(':utipi', $usertype);
                      $eustmt->execute();
                      $eemail = $eustmt->fetchAll(PDO::FETCH_ASSOC);
  
            if(count($eemail) <= 0){
  
  
                  $email_stat='';
                  $slicii= strtoupper(substr($fname, 0, 3));
                  $userid = random($slicii);
                  $llname = strtoupper(substr($lname, 0, 3));
                  $username= random('HR');
                  $passwordn = random($mname);
                  $password = password_hash($passwordn, PASSWORD_BCRYPT);

  
              $sql = "SELECT * FROM account WHERE user_id=:idat OR user_name=:unami";
              $ustmt = $pdo->prepare($sql);
              $ustmt->bindValue(':idat', $userid);
              $ustmt->bindValue(':unami', $username);
              $ustmt->execute();
              $userd = $ustmt->fetchAll(PDO::FETCH_ASSOC);
              
              if(count($userd) > 0){
                  $userid = $userid.$llname;
                  $username = $username.$llname;
              }
              $photo_name = '';
              if($photo != null){
              $ext = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION)) ?? null;
              if  (in_array($ext, $accept)){
                $photo = $_FILES['photo'];
        
                $photo_name = $userid . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
        
                // Upload photo to server
                $target_dir = 'img/account/';
                $target_file = $target_dir . $photo_name;
                move_uploaded_file($photo['tmp_name'], $target_file);
        
              }
            }
             
                  $mail = new PHPMailer(true);
                 
                  try {
                      
                      $mail->SMTPDebug = SMTP::DEBUG_SERVER;   
                      $mail->SMTPDebug = 0;            
                      $mail->isSMTP();                                            
                      $mail->Host       = 'smtp.gmail.com';                    
                      $mail->SMTPAuth   = true;                                
                      $mail->Username   = 'abrhamgelawu@gmail.com';                     
                      $mail->Password   = 'iozdnqljvzngppmk';                               
                      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
                      $mail->Port       = 465;                                    
                  
                      
                      $mail->setFrom('abrhamgelawu@gmail.com', 'DKU OES');
                      $mail->addAddress($email);     
                                
                      $mail->addReplyTo('abrhamgelawu@gmail.com', 'DKU OES');
                      
                      $mail->isHTML(true);                                  
                      $mail->Subject = 'DKU OES';
                      $mail->Body = file_get_contents('verify.html');
                      $mail->Body = str_replace('{{ $tit }}', $tit, $mail->Body);
                      $mail->Body = str_replace('{{ $fname }}', $fname, $mail->Body);
                      $mail->Body = str_replace('{{ $mname }}', $mname, $mail->Body);
                      $mail->Body = str_replace('{{ $lname }}', $lname, $mail->Body);
                      $mail->Body = str_replace('{{ $username }}', $username, $mail->Body);
                      $mail->Body = str_replace('{{ $password }}', $passwordn, $mail->Body);
                      
  
                      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                  
                      $mail->send();
                      $email_stat=1;
                      
                  } catch (Exception $e) {
                      $email_stat=0;
                      echo '<div class="alert alert-danger" id ="emailerror" role="alert">
                      The email could not be sent
                      <script>
                      document.getElementById("addins").reset();
                      $("#emailerror").alert();
                      setTimeout(function() {
                      $("#emailerror").alert("close");
                        }, 25000);
                      </div>';
                  }
  
                  $ins=$pdo->prepare("INSERT INTO account(Department,user_id,user_type,title,fname,lname,gname,phone,email,email_stat,photo,user_name,password) 
                  VALUES(:depa,:uiiid,:utyp,:titi,:fnam,:laname,:gname,:phone,:email,:estat,:photo,:uname,:pass)");
                $ins->bindValue(':depa',$depa);
                $ins->bindValue(':uiiid',$userid);
                $ins->bindValue(':utyp',$usertype);
                $ins->bindValue(':titi',$tit);
                $ins->bindValue(':fnam',$fname);
                $ins->bindValue(':laname',$mname);
                $ins->bindValue(':gname',$lname);
                $ins->bindValue(':phone',$phone);
                $ins->bindValue(':email',$email);
                $ins->bindValue(':estat',$email_stat);
                $ins->bindValue(':photo',$photo_name);
                $ins->bindValue(':uname',$username);
                $ins->bindValue(':pass',$password);
                $ins->execute();
  
                  echo '<div class="alert  alert-success" id="susualert" role="alert">
             The new Registrar has been successfully added!
             <script>
             document.getElementById("addins").reset();
             $("#susualert").alert();
             setTimeout(function() {
             $("#susualert").alert("close");
               }, 2000);
             
             </script>
             </div>';}
          else{
              echo '<div class="alert alert-danger" role="alert">
              Sorry, the email is already exist!
              </div>';
          }
          }
             else {
              echo '<div class="alert alert-danger" role="alert">
              The email is invalid
              </div>';
          }
              }
              
              else{
              echo '<div class="alert alert-danger" role="alert">
              Please fill the form correctlly!
              </div>';
              }
  
          }
  
  
          if($_POST['action'] == 'activ')
      {  
            $uid=$_POST['uid'];
         
          $assteacher=$pdo->prepare("UPDATE account SET status = :asteacher WHERE user_id=:bcat  ");
          $assteacher->bindValue(':asteacher', 1);
          $assteacher->bindValue(':bcat',$uid);
          $assteacher->execute();
          echo '<script>
             location.reload();
         
             
             </script>';
  
  
          }
  
          if($_POST['action'] == 'ban')
      {  
              $uid=$_POST['uid'];
              $assteacher=$pdo->prepare("UPDATE account SET status = :asteacher WHERE user_id=:bcat  ");
              $assteacher->bindValue(':asteacher', 0);
              $assteacher->bindValue(':bcat',$uid);
              $assteacher->execute();
              echo '<script>
                 location.reload();
             
                 
                 </script>';
  
  
  
          }
          
          if($_POST['action'] == 'editHead')
      {   
               $output='';
               $uid =$_POST['uid'];
  
               $fetch = $pdo->prepare('SELECT * FROM account WHERE user_id=:uiid');
               $fetch->bindValue(':uiid',$uid);
               $fetch->execute();
               $epart = $fetch->fetch(PDO::FETCH_ASSOC);
               
               $output.='
               
              <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit HR Manager Profile</h5>
            <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  
          </div>
          <div class="modal-body">
            <div class="form signup">
              <form class="was-validated" method="POST" id="updins" action="#"  enctype="multipart/form-data">
                <div class="mb-1" id="updInsSuccess"></div>
                <input type="hidden" value="'.$uid.'" id="uid" name="uid" >
                <div class=" row ">
                <div class="col mb-1">
                      <label>Title</label>
                      <select id="title" name="title" class="form-select" required aria-label="stype">
                        <option selected value="'.$epart['title'].'">'.$epart['title'].'</option>
                        <option value="Mr.">Mr.</option>
                        <option value="Ms.">Ms.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Dr.">Dr.</option>
                        <option value="Professor">Professor</option>
                      </select>

                    </div>
                  <div class="col mb-1">
                    <label>First Name</label>
                    <input type="text" id="fname" value="'.$epart['fname'].'" class="form-control" name="fname" required placeholder="First Name ">
  
                  </div>
                  <div class=" col mb-1">
                    <label>Middle Name</label>
                    <input type="text" id="mname"  value="'.$epart['lname'].'" class="form-control" name="mname" required placeholder="Middle Name ">
  
                  </div>
                  <div class=" col mb-1">
                    <label>Last Name</label>
                    <input type="text" id="lname"  value="'.$epart['gname'].'" class="form-control" name="lname" required placeholder="Last Name ">
                  </div>
                </div>
                <div class="row">

                  <div class="col mb-1">
                    <label>Phone Number</label>
                    <input type="number" class="form-control"  value="'.$epart['phone'].'" maximum="10" id="phone" name="phone" required placeholder="Enter your phone number ">
                  </div>
                  <div class="col mb-1">
                    <label>Email</label>
                    <input type="Email" class="form-control"  value="'.$epart['email'].'" maximum="10" id="email" name="email" required placeholder="Enter your phone number ">
                  </div>
                </div>
                <div class=" mb-1">
                  <label>Photo</label>
                  <input type="hidden" value="'.$epart['photo'].'"  id="photop" name="photop" >
                  <input type="File" class="form-control"   id="photo" accept=".jpg,.jpeg,.png,.gif,.webp" name="photo"  placeholder="Enter your photo ">
                </div>
                <div class="modal-footer">
                  <button type="button" onclick="window.location.reload()" class="caca btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                  <button class="addinstructor btn btn-primary" id="updateinstructor" type="button" name="enter"> Update</button>
                </div>
              </form>
            </div>
          </div>
               
               
               ';
  
         echo $output;
           
          }
  
          if($_POST['action'] == 'updinss')
          { 
  
  
  
  
            $output ='';
            $photos= '';
            $depa='HR'; 
            $tit=$_POST['title'];
            $fname= ucwords(strtolower($_POST['fname']));
            $mname= ucwords(strtolower($_POST['mname']));
            $lname= ucwords(strtolower($_POST['lname']));
            $phone=$_POST['phone'];
            $email=$_POST['email'];
            $photop=$_POST['photop'];
            echo  $photop;
            $usertype ='HR';
            $uid=$_POST['uid'];        
            $photo = $_FILES['photo'] ?? null;
            $accept = ["jpg","jpeg", "png", "gif", "webp",null];        
            $date=date('d-m-y H:i:s');
           
  
            if( $fname  && $mname && $lname && $phone && $email  && $depa   !=null){
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) { 
  
                    $sql = "SELECT * FROM account WHERE email=:idat AND user_type=:utipi ";
                    $eustmt = $pdo->prepare($sql);
                    $eustmt->bindValue(':idat', $email);
                    $eustmt->bindValue(':utipi', $usertype);
                    $eustmt->execute();
                    $eemail = $eustmt->fetchAll(PDO::FETCH_ASSOC);
  
          if(count($eemail) < 2){
  
  
                $email_stat='';
  
            $photo_name = '';
  
            if($photo != null){
            $ext = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION)) ?? null;
            if  (in_array($ext, $accept)){
              
              $directory = 'img/account/';
              $filenameWithoutExtension = $photop;
              
              $files = glob($directory . $filenameWithoutExtension . '.*');
              
              if (!empty($files)) {
                  $fileToDelete = $files[0];
                  if (is_file($fileToDelete)) {
                      unlink($fileToDelete);
                  }
              }
             
              $photo = $_FILES['photo'];
      
              $photo_name = $uid . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
      
              // Upload photo to server
              $target_dir = 'img/account/';
              $target_file = $target_dir . $photo_name;
              move_uploaded_file($photo['tmp_name'], $target_file);
      
            }
          }
          else{
            $photo_name =$photop;
          }
                                           
        
  
                        $update = $pdo->prepare("UPDATE account 
                        SET Department = :depa,
                
                            title = :titi,
                            fname = :fnam,
                            lname = :laname,
                            gname = :gname,
                            phone = :phone,
                            email = :email,
  
                            photo = :photo
  
                        WHERE user_id = :uiiid");
  
                $update->bindValue(':depa', $depa);
                $update->bindValue(':titi', $tit);
                $update->bindValue(':fnam', $fname);
                $update->bindValue(':laname', $mname);
                $update->bindValue(':gname', $lname);
                $update->bindValue(':phone', $phone);
                $update->bindValue(':email', $email);
                $update->bindValue(':photo', $photo_name);
                $update->bindValue(':uiiid', $uid);
                $update->execute();
  
  
                echo '<div class="alert  alert-success" id="susualert" role="alert">
           The account has been successfully updated!
           <script>
           document.getElementById("addins").reset();
           $("#susualert").alert();
           setTimeout(function() {
           $("#susualert").alert("close");
             }, 2000);
             window.location.reload();
           </script>
           </div>';}
        else{
            echo '<div class="alert alert-danger" role="alert">
            Sorry, the email is already exist!
            </div>';
        }
        }
           else {
            echo '<div class="alert alert-danger" role="alert">
            The email is invalid
            </div>';
        }
            }
            
            else{
            echo '<div class="alert alert-danger" role="alert">
            Please fill the form correctlly!
            </div>';
            }
  
  
  
  
  
  
          }
  
  
          if($_POST['action'] == 'deletehead')
          {
            $directory = 'img/account/';
              $filenameWithoutExtension = $_POST['uid'];
              
              $files = glob($directory . $filenameWithoutExtension);
              
              if (!empty($files)) {
                  $fileToDelete = $files[0];
                  if (is_file($fileToDelete)) {
                      unlink($fileToDelete);
                  }
              }
            $sql = "DELETE FROM account WHERE user_id = :id ";
            $sdtmt = $pdo->prepare($sql);
            $sdtmt->bindValue(':id', $_POST['uid']);
            $sdtmt->execute();
            echo '<div class="alert  alert-success" id="usualert" role="alert">
          The HR Manager has been successfully deleted!
          <script>
          $("#usualert").alert();
          setTimeout(function() {
          $("#usualert").alert("close");
            }, 20000);
          
          </script>
          </div>';
            
          }
  
          if($_POST['action'] == 'send_again')
          {
            $uid =$_POST['uid'];
  
            $fetch = $pdo->prepare('SELECT * FROM account WHERE user_id=:uiid');
            $fetch->bindValue(':uiid',$uid);
            $fetch->execute();
            $epart = $fetch->fetch(PDO::FETCH_ASSOC);

            $mname = $epart['lname'];
            $passwordn = random($mname);
            $password = password_hash($passwordn, PASSWORD_BCRYPT);

            $snewmy = $pdo->prepare("UPDATE account 
            SET password = :pass WHERE user_id = :uiiid");
            $snewmy->bindValue(':uiiid',$uid);  
            $snewmy->bindValue(':pass',$password);         
            $snewmy->execute();
  
  
  
            $mail = new PHPMailer(true);
                 
            try {
                
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;   
                $mail->SMTPDebug = 0;            
                $mail->isSMTP();                                            
                $mail->Host       = 'smtp.gmail.com';                    
                $mail->SMTPAuth   = true;                                
                $mail->Username   = 'abrhamgelawu@gmail.com';                     
                $mail->Password   = 'iozdnqljvzngppmk';                               
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
                $mail->Port       = 465;                                    
            
                
                $mail->setFrom('abrhamgelawu@gmail.com', 'DKU OES');
                $mail->addAddress($epart['email']);     
                          
                $mail->addReplyTo('abrhamgelawu@gmail.com', 'DKU OES');
                
                $mail->isHTML(true);                                  
                $mail->Subject = 'DKU OES';
                $mail->Body = file_get_contents('verify.html');
                $mail->Body = str_replace('{{ $tit }}', $epart['title'], $mail->Body);
                $mail->Body = str_replace('{{ $fname }}', $epart['fname'], $mail->Body);
                $mail->Body = str_replace('{{ $mname }}',$epart['lname'], $mail->Body);
                $mail->Body = str_replace('{{ $lname }}', $epart['gname'], $mail->Body);
                $mail->Body = str_replace('{{ $username }}',$epart['user_name'], $mail->Body);
                $mail->Body = str_replace('{{ $password }}',$passwordn, $mail->Body);
                
  
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                $mail->send();
                $email_stat=1;
                
            
                echo '<div class="alert  alert-success" id="usualert" role="alert">
                The confirmation cod has been successfully sendede to '.$epart['title'].' '.$epart['fname'].'!
                <script>
                $("#usualert").alert();
                setTimeout(function() {
                $("#usualert").alert("close");
                  }, 20000);
                
                </script>
                </div>';
            
              } catch (Exception $e) {
                $email_stat=0;
                echo '<div class="alert alert-danger" id ="emailerror" role="alert">
                The email could not be sent
                <script>
                document.getElementById("addins").reset();
                $("#emailerror").alert();
                setTimeout(function() {
                $("#emailerror").alert("close");
                  }, 25000);
                </div>';
            }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
           
            
          }
  
  
  
  
          
  
      }
  






      if($_POST['page'] == 'addRegistrar')
      {
        if($_POST['action'] == 'addinss')
            
        {  
                $output ='';
                $photos= '';
                $depa='Registrar'; 
                $tit=$_POST['title'];
                $fname= ucwords(strtolower($_POST['fname']));
                $mname= ucwords(strtolower($_POST['mname']));
                $lname= ucwords(strtolower($_POST['lname']));
                $phone=$_POST['phone'];
                $email=$_POST['email'];
                $usertype = 'Registrar';
                $photo = $_FILES['photo'] ?? null;
                $accept = ["jpg","jpeg", "png", "gif", "webp",null];
               
                $date=date('d-m-y H:i:s');
               
    
                if( $fname  && $mname && $lname && $phone && $email  && $depa   !=null){
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { 
    
                        $sql = "SELECT * FROM account WHERE email=:idat AND user_type=:utipi ";
                        $eustmt = $pdo->prepare($sql);
                        $eustmt->bindValue(':idat', $email);
                        $eustmt->bindValue(':utipi', $usertype);
                        $eustmt->execute();
                        $eemail = $eustmt->fetchAll(PDO::FETCH_ASSOC);
    
              if(count($eemail) <= 0){
    
    
                    $email_stat='';
                    $slicii= strtoupper(substr($fname, 0, 3));
                    $userid = random($slicii);
                    $llname = strtoupper(substr($lname, 0, 3));
                    $username= random('RE');
                    $passwordn = random($mname);
                    $password = password_hash($passwordn, PASSWORD_BCRYPT);
  
    
                $sql = "SELECT * FROM account WHERE user_id=:idat OR user_name=:unami";
                $ustmt = $pdo->prepare($sql);
                $ustmt->bindValue(':idat', $userid);
                $ustmt->bindValue(':unami', $username);
                $ustmt->execute();
                $userd = $ustmt->fetchAll(PDO::FETCH_ASSOC);
                
                if(count($userd) > 0){
                    $userid = $userid.$llname;
                    $username = $username.$llname;
                }
                $photo_name = '';
                if($photo != null){
                $ext = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION)) ?? null;
                if  (in_array($ext, $accept)){
                  $photo = $_FILES['photo'];
          
                  $photo_name = $userid . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
          
                  // Upload photo to server
                  $target_dir = 'img/account/';
                  $target_file = $target_dir . $photo_name;
                  move_uploaded_file($photo['tmp_name'], $target_file);
          
                }
              }
               
                    $mail = new PHPMailer(true);
                   
                    try {
                        
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;   
                        $mail->SMTPDebug = 0;            
                        $mail->isSMTP();                                            
                        $mail->Host       = 'smtp.gmail.com';                    
                        $mail->SMTPAuth   = true;                                
                        $mail->Username   = 'abrhamgelawu@gmail.com';                     
                        $mail->Password   = 'iozdnqljvzngppmk';                               
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
                        $mail->Port       = 465;                                    
                    
                        
                        $mail->setFrom('abrhamgelawu@gmail.com', 'DKU OES');
                        $mail->addAddress($email);     
                                  
                        $mail->addReplyTo('abrhamgelawu@gmail.com', 'DKU OES');
                        
                        $mail->isHTML(true);                                  
                        $mail->Subject = 'DKU OES';
                        $mail->Body = file_get_contents('verify.html');
                        $mail->Body = str_replace('{{ $tit }}', $tit, $mail->Body);
                        $mail->Body = str_replace('{{ $fname }}', $fname, $mail->Body);
                        $mail->Body = str_replace('{{ $mname }}', $mname, $mail->Body);
                        $mail->Body = str_replace('{{ $lname }}', $lname, $mail->Body);
                        $mail->Body = str_replace('{{ $username }}', $username, $mail->Body);
                        $mail->Body = str_replace('{{ $password }}', $passwordn, $mail->Body);
                        
    
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    
                        $mail->send();
                        $email_stat=1;
                        
                    } catch (Exception $e) {
                        $email_stat=0;
                        echo '<div class="alert alert-danger" id ="emailerror" role="alert">
                        The email could not be sent
                        <script>
                        document.getElementById("addins").reset();
                        $("#emailerror").alert();
                        setTimeout(function() {
                        $("#emailerror").alert("close");
                          }, 25000);
                        </div>';
                    }
    
                    $ins=$pdo->prepare("INSERT INTO account(Department,user_id,user_type,title,fname,lname,gname,phone,email,email_stat,photo,user_name,password) 
                    VALUES(:depa,:uiiid,:utyp,:titi,:fnam,:laname,:gname,:phone,:email,:estat,:photo,:uname,:pass)");
                  $ins->bindValue(':depa',$depa);
                  $ins->bindValue(':uiiid',$userid);
                  $ins->bindValue(':utyp',$usertype);
                  $ins->bindValue(':titi',$tit);
                  $ins->bindValue(':fnam',$fname);
                  $ins->bindValue(':laname',$mname);
                  $ins->bindValue(':gname',$lname);
                  $ins->bindValue(':phone',$phone);
                  $ins->bindValue(':email',$email);
                  $ins->bindValue(':estat',$email_stat);
                  $ins->bindValue(':photo',$photo_name);
                  $ins->bindValue(':uname',$username);
                  $ins->bindValue(':pass',$password);
                  $ins->execute();
    
                    echo '<div class="alert  alert-success" id="susualert" role="alert">
               The new HR Manager has been successfully added!
               <script>
               document.getElementById("addins").reset();
               $("#susualert").alert();
               setTimeout(function() {
               $("#susualert").alert("close");
                 }, 2000);
               
               </script>
               </div>';}
            else{
                echo '<div class="alert alert-danger" role="alert">
                Sorry, the email is already exist!
                </div>';
            }
            }
               else {
                echo '<div class="alert alert-danger" role="alert">
                The email is invalid
                </div>';
            }
                }
                
                else{
                echo '<div class="alert alert-danger" role="alert">
                Please fill the form correctlly!
                </div>';
                }
    
            }
    
    
            if($_POST['action'] == 'activ')
        {  
              $uid=$_POST['uid'];
           
            $assteacher=$pdo->prepare("UPDATE account SET status = :asteacher WHERE user_id=:bcat  ");
            $assteacher->bindValue(':asteacher', 1);
            $assteacher->bindValue(':bcat',$uid);
            $assteacher->execute();
            echo '<script>
               location.reload();
           
               
               </script>';
    
    
            }
    
            if($_POST['action'] == 'ban')
        {  
                $uid=$_POST['uid'];
                $assteacher=$pdo->prepare("UPDATE account SET status = :asteacher WHERE user_id=:bcat  ");
                $assteacher->bindValue(':asteacher', 0);
                $assteacher->bindValue(':bcat',$uid);
                $assteacher->execute();
                echo '<script>
                   location.reload();
               
                   
                   </script>';
    
    
    
            }
            
            if($_POST['action'] == 'editHead')
        {   
                 $output='';
                 $uid =$_POST['uid'];
    
                 $fetch = $pdo->prepare('SELECT * FROM account WHERE user_id=:uiid');
                 $fetch->bindValue(':uiid',$uid);
                 $fetch->execute();
                 $epart = $fetch->fetch(PDO::FETCH_ASSOC);
                 
                 $output.='
                 
                <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Registrar Profile</h5>
              <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    
            </div>
            <div class="modal-body">
              <div class="form signup">
                <form class="was-validated" method="POST" id="updins" action="#"  enctype="multipart/form-data">
                  <div class="mb-1" id="updInsSuccess"></div>
                  <input type="hidden" value="'.$uid.'" id="uid" name="uid" >
                  <div class=" row ">
                  <div class="col mb-1">
                        <label>Title</label>
                        <select id="title" name="title" class="form-select" required aria-label="stype">
                          <option selected value="'.$epart['title'].'">'.$epart['title'].'</option>
                          <option value="Mr.">Mr.</option>
                          <option value="Ms.">Ms.</option>
                          <option value="Mrs.">Mrs.</option>
                          <option value="Dr.">Dr.</option>
                          <option value="Professor">Professor</option>
                        </select>
  
                      </div>
                    <div class="col mb-1">
                      <label>First Name</label>
                      <input type="text" id="fname" value="'.$epart['fname'].'" class="form-control" name="fname" required placeholder="First Name ">
    
                    </div>
                    <div class=" col mb-1">
                      <label>Middle Name</label>
                      <input type="text" id="mname"  value="'.$epart['lname'].'" class="form-control" name="mname" required placeholder="Middle Name ">
    
                    </div>
                    <div class=" col mb-1">
                      <label>Last Name</label>
                      <input type="text" id="lname"  value="'.$epart['gname'].'" class="form-control" name="lname" required placeholder="Last Name ">
                    </div>
                  </div>
                  <div class="row">
  
                    <div class="col mb-1">
                      <label>Phone Number</label>
                      <input type="number" class="form-control"  value="'.$epart['phone'].'" maximum="10" id="phone" name="phone" required placeholder="Enter your phone number ">
                    </div>
                    <div class="col mb-1">
                      <label>Email</label>
                      <input type="Email" class="form-control"  value="'.$epart['email'].'" maximum="10" id="email" name="email" required placeholder="Enter your phone number ">
                    </div>
                  </div>
                  <div class=" mb-1">
                    <label>Photo</label>
                    <input type="hidden" value="'.$epart['photo'].'"  id="photop" name="photop" >
                    <input type="File" class="form-control"   id="photo" accept=".jpg,.jpeg,.png,.gif,.webp" name="photo"  placeholder="Enter your photo ">
                  </div>
                  <div class="modal-footer">
                    <button type="button" onclick="window.location.reload()" class="caca btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button class="addinstructor btn btn-primary" id="updateinstructor" type="button" name="enter"> Update</button>
                  </div>
                </form>
              </div>
            </div>
                 
                 
                 ';
    
           echo $output;
             
            }
    
            if($_POST['action'] == 'updinss')
            { 
    
    
    
    
              $output ='';
              $photos= '';
              $depa='Registrar'; 
              $tit=$_POST['title'];
              $fname= ucwords(strtolower($_POST['fname']));
              $mname= ucwords(strtolower($_POST['mname']));
              $lname= ucwords(strtolower($_POST['lname']));
              $phone=$_POST['phone'];
              $email=$_POST['email'];
              $photop=$_POST['photop'];
              echo  $photop;
              $usertype ='Registrar';
              $uid=$_POST['uid'];        
              $photo = $_FILES['photo'] ?? null;
              $accept = ["jpg","jpeg", "png", "gif", "webp",null];        
              $date=date('d-m-y H:i:s');
             
    
              if( $fname  && $mname && $lname && $phone && $email  && $depa   !=null){
                  if (filter_var($email, FILTER_VALIDATE_EMAIL)) { 
    
                      $sql = "SELECT * FROM account WHERE email=:idat AND user_type=:utipi ";
                      $eustmt = $pdo->prepare($sql);
                      $eustmt->bindValue(':idat', $email);
                      $eustmt->bindValue(':utipi', $usertype);
                      $eustmt->execute();
                      $eemail = $eustmt->fetchAll(PDO::FETCH_ASSOC);
    
            if(count($eemail) < 2){
    
    
                  $email_stat='';
    
              $photo_name = '';
    
              if($photo != null){
              $ext = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION)) ?? null;
              if  (in_array($ext, $accept)){
                
                $directory = 'img/account/';
                $filenameWithoutExtension = $photop;
                
                $files = glob($directory . $filenameWithoutExtension);
                
                if (!empty($files)) {
                    $fileToDelete = $files[0];
                    if (is_file($fileToDelete)) {
                        unlink($fileToDelete);
                    }
                }
               
                $photo = $_FILES['photo'];
        
                $photo_name = $uid . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
        
                // Upload photo to server
                $target_dir = 'img/account/';
                $target_file = $target_dir . $photo_name;
                move_uploaded_file($photo['tmp_name'], $target_file);
        
              }
            }
            else{
              $photo_name =$photop;
            }
                                             
          
    
                          $update = $pdo->prepare("UPDATE account 
                          SET Department = :depa,
                  
                              title = :titi,
                              fname = :fnam,
                              lname = :laname,
                              gname = :gname,
                              phone = :phone,
                              email = :email,
    
                              photo = :photo
    
                          WHERE user_id = :uiiid");
    
                  $update->bindValue(':depa', $depa);
                  $update->bindValue(':titi', $tit);
                  $update->bindValue(':fnam', $fname);
                  $update->bindValue(':laname', $mname);
                  $update->bindValue(':gname', $lname);
                  $update->bindValue(':phone', $phone);
                  $update->bindValue(':email', $email);
                  $update->bindValue(':photo', $photo_name);
                  $update->bindValue(':uiiid', $uid);
                  $update->execute();
    
    
                  echo '<div class="alert  alert-success" id="susualert" role="alert">
             The account has been successfully updated!
             <script>
             document.getElementById("addins").reset();
             $("#susualert").alert();
             setTimeout(function() {
             $("#susualert").alert("close");
               }, 2000);
               window.location.reload();
             </script>
             </div>';}
          else{
              echo '<div class="alert alert-danger" role="alert">
              Sorry, the email is already exist!
              </div>';
          }
          }
             else {
              echo '<div class="alert alert-danger" role="alert">
              The email is invalid
              </div>';
          }
              }
              
              else{
              echo '<div class="alert alert-danger" role="alert">
              Please fill the form correctlly!
              </div>';
              }
    
    
    
    
    
    
            }
    
    
            if($_POST['action'] == 'deletehead')
            {
              $directory = 'img/account/';
                $filenameWithoutExtension = $_POST['uid'];
                
                $files = glob($directory . $filenameWithoutExtension);
                
                if (!empty($files)) {
                    $fileToDelete = $files[0];
                    if (is_file($fileToDelete)) {
                        unlink($fileToDelete);
                    }
                }
              $sql = "DELETE FROM account WHERE user_id = :id ";
              $sdtmt = $pdo->prepare($sql);
              $sdtmt->bindValue(':id', $_POST['uid']);
              $sdtmt->execute();
              echo '<div class="alert  alert-success" id="usualert" role="alert">
            The HR Manager has been successfully deleted!
            <script>
            $("#usualert").alert();
            setTimeout(function() {
            $("#usualert").alert("close");
              }, 20000);
            
            </script>
            </div>';
              
            }
    
            if($_POST['action'] == 'send_again')
            {
              $uid =$_POST['uid'];
    
              $fetch = $pdo->prepare('SELECT * FROM account WHERE user_id=:uiid');
              $fetch->bindValue(':uiid',$uid);
              $fetch->execute();
              $epart = $fetch->fetch(PDO::FETCH_ASSOC);
  
              $mname = $epart['lname'];
              $passwordn = random($mname);
              $password = password_hash($passwordn, PASSWORD_BCRYPT);
  
              $snewmy = $pdo->prepare("UPDATE account 
              SET password = :pass WHERE user_id = :uiiid");
              $snewmy->bindValue(':uiiid',$uid);  
              $snewmy->bindValue(':pass',$password);         
              $snewmy->execute();
    
    
    
              $mail = new PHPMailer(true);
                   
              try {
                  
                  $mail->SMTPDebug = SMTP::DEBUG_SERVER;   
                  $mail->SMTPDebug = 0;            
                  $mail->isSMTP();                                            
                  $mail->Host       = 'smtp.gmail.com';                    
                  $mail->SMTPAuth   = true;                                
                  $mail->Username   = 'abrhamgelawu@gmail.com';                     
                  $mail->Password   = 'iozdnqljvzngppmk';                               
                  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
                  $mail->Port       = 465;                                    
              
                  
                  $mail->setFrom('abrhamgelawu@gmail.com', 'DKU OES');
                  $mail->addAddress($epart['email']);     
                            
                  $mail->addReplyTo('abrhamgelawu@gmail.com', 'DKU OES');
                  
                  $mail->isHTML(true);                                  
                  $mail->Subject = 'DKU OES';
                  $mail->Body = file_get_contents('verify.html');
                  $mail->Body = str_replace('{{ $tit }}', $epart['title'], $mail->Body);
                  $mail->Body = str_replace('{{ $fname }}', $epart['fname'], $mail->Body);
                  $mail->Body = str_replace('{{ $mname }}',$epart['lname'], $mail->Body);
                  $mail->Body = str_replace('{{ $lname }}', $epart['gname'], $mail->Body);
                  $mail->Body = str_replace('{{ $username }}',$epart['user_name'], $mail->Body);
                  $mail->Body = str_replace('{{ $password }}',$passwordn, $mail->Body);
                  
    
                  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
              
                  $mail->send();
                  $email_stat=1;
                  
              
                  echo '<div class="alert  alert-success" id="usualert" role="alert">
                  The confirmation cod has been successfully sendede to '.$epart['title'].' '.$epart['fname'].'!
                  <script>
                  $("#usualert").alert();
                  setTimeout(function() {
                  $("#usualert").alert("close");
                    }, 20000);
                  
                  </script>
                  </div>';
              
                } catch (Exception $e) {
                  $email_stat=0;
                  echo '<div class="alert alert-danger" id ="emailerror" role="alert">
                  The email could not be sent
                  <script>
                  document.getElementById("addins").reset();
                  $("#emailerror").alert();
                  setTimeout(function() {
                  $("#emailerror").alert("close");
                    }, 25000);
                  </div>';
              }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
             
              
            }
    
    
    
    
            
    
        }




      }else{
        header("Location: ../index.php");
        exit();
   }










}
function random($slici){
	$char='123456789';
	$str= $slici;
	$num='';
	for($i=0;$i<7;$i++)
	{
		$index=rand(0,strlen($char) -1 );
		$str  .=$char[$index];
	}
	$num=$num.$str;
	return $num;
}

?>