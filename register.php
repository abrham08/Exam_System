
<?php 
session_start();
use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;
 
 //Load Composer's autoloader
 require 'admin/vendor/autoload.php';
 
 //Create an instance; passing `true` enables exceptions
 
include "dbc.php";
if(isset($_POST['page'])){



if($_POST['page'] == 'student')
        {
            if($_POST['action'] == 'addStudent')
            {
          $output ='';
          $photo= '';
          $kebeleid='';
          $dodoc='';
          $date=date('d-m-y H:i:s');
          $fname=  ucwords(strtolower($_POST['fname']));
          $mname=ucwords(strtolower($_POST['mname']));
          $lname=ucwords(strtolower($_POST['lname']));
          $gender=$_POST['genderi'];
          $depar=$_POST['depari'];

          $nationality=$_POST['nationality'];
          $fstudy=$_POST['fstudy'];
          $ebackground=$_POST['ebackground'];
          $ophoni=$_POST['ophoni'];
          $sphoni=$_POST['sphoni'];
          $age=$_POST['age'];
          $birth_date=$_POST['bdate'];
          
          $plocation=$_POST['plocation'];
          $semail=$_POST['semaili'];


          foreach ($_FILES as $name => $file) {
            // Check if file was uploaded successfully
            if ($file['error'] === UPLOAD_ERR_OK) {
                // Assign the file to a specific variable based on the name attribute
                if ($name === 'photo') {
                    $photo = $file;
                } elseif ($name === 'kebeleid') {
                    $kebeleid = $file;
                } elseif ($name === 'dodoc') {
                    $dodoc = $file;
                }
            
            } else {
                
            }
        }



         // $kebeleid=$_FILES['kebeleid'];
         // $dodoc=$_FILES['dodoc'];

         // $photo = $_FILES['photo'] ?? null;
          $accept = ["jpg","jpeg", "png", "gif", "webp", "PDF", "pdf", "doc", "docx",null];
    
         
        if( $fname  && $mname && $lname && $gender && $depar  && $fstudy && $ebackground && 
        $birth_date && $age && $ophoni && $sphoni && $semail && $plocation && $photo && $dodoc && $kebeleid   !=null){
    
          if (filter_var($semail, FILTER_VALIDATE_EMAIL)) { 
    
            $sql = "SELECT * FROM examinee WHERE email=:idat ";
            $eustmt = $pdo->prepare($sql);
            $eustmt->bindValue(':idat', $semail);
            $eustmt->execute();
            $eemail = $eustmt->fetchAll(PDO::FETCH_ASSOC);
    
            if(count($eemail) <= 0){
    
          $slicii='V'.strtoupper(substr($fname, 0, 3));
          $userid = random($slicii);
          $llname = strtoupper(substr($lname, 0, 3));
          $username= random($llname);
          $passwordn = random($mname);
          $password = password_hash($passwordn, PASSWORD_BCRYPT);
    
    
    
    
          
            $stream = 'HR' ;
            $coll = 'HR' ;
          
    
          $sql = "SELECT * FROM examinee WHERE uiid=:idat OR user_name=:unami AND examinee_type=:extype";
          $ustmt = $pdo->prepare($sql);
          $ustmt->bindValue(':idat', $userid);
          $ustmt->bindValue(':unami', $username);
          $ustmt->bindValue(':extype', 'Applicant');

          $ustmt->execute();
          $userd = $ustmt->fetchAll(PDO::FETCH_ASSOC);
          
          if(count($userd) > 0){
            $userid = $userid.$llname;
            $username = $username.$llname;
          }
    
          $ext = strtolower(pathinfo($photo["name"], PATHINFO_EXTENSION)) ?? null;
          if  (in_array($ext, $accept)){
           // $photo = $photo["name"];
    
            $photo_name = $userid . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
    
            // Upload photo to server
            $target_dir = 'admin/img/examinee/';
            $target_file = $target_dir . $photo_name;
            move_uploaded_file($photo['tmp_name'], $target_file);
    
          }

          $kebeleext = strtolower(pathinfo($kebeleid["name"], PATHINFO_EXTENSION)) ?? null;
          if  (in_array($kebeleext, $accept)){
           // $kebeleid = $kebeleid["name"];
    
            $kebelephoto_name = $userid . '.' . pathinfo($kebeleid['name'], PATHINFO_EXTENSION);
    
            // Upload photo to server
            $target_dir = 'admin/img/examinee/kebeleid/';
            $kebeletarget_file = $target_dir . $kebelephoto_name;
            move_uploaded_file($kebeleid['tmp_name'], $kebeletarget_file);
    
          }

          $certificateext = strtolower(pathinfo($dodoc["name"], PATHINFO_EXTENSION)) ?? null;
          if  (in_array($certificateext, $accept)){
          //  $dodoc = $dodoc["name"];
    
            $docphoto_name = $userid . '.' . pathinfo($dodoc['name'], PATHINFO_EXTENSION);
    
            // Upload photo to server
            $target_dir = 'admin/img/examinee/certificate/';
            $doctarget_file = $target_dir . $docphoto_name;
            move_uploaded_file($dodoc['tmp_name'], $doctarget_file);
    
          }





          $estat='';
          $mail = new PHPMailer(true);
                   
          try {
              
              $mail->SMTPDebug = SMTP::DEBUG_SERVER;   
              $mail->SMTPDebug = 0;            
              $mail->isSMTP();                                            
              $mail->Host       = 'smtp.gmail.com';                    
              $mail->SMTPAuth   = true;                                
              $mail->Username   = 'dkuoes@gmail.com';                     
              $mail->Password   = 'qtgctgvmojibpcon';                               
              $mail->SMTPSecure = "tls";            
              $mail->Port       = '587';                                    
          
              
              $mail->setFrom('dkuoes@gmail.com', 'DKU OES');
              $mail->addAddress($semail);     
                        
              $mail->addReplyTo('dkuoes@gmail.com', 'DKU OES');
              
              $mail->isHTML(true);                                  
              $mail->Subject = 'DKU OES';
              $mail->Body = "
              
                <h2>
               
               <h1 > Hello,   $fname   $mname</h1>
               Your username is: <b > $username </b><br>
               Your default password is: <b > $passwordn</b>
           </h2>
           
              ";
              
              
    
              $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          
              $mail->send();
            $estat=1;
              
          } catch (Exception $e) {
            $estat=0;
              echo '<div class="alert alert-danger" id ="emailerror" role="alert">
              Message could not be sent. Mailer Error: {$mail->ErrorInfo}
              <script>
              document.getElementById("msform").reset();
              $("#emailerror").alert();
              setTimeout(function() {
              $("#emailerror").alert("close");
                }, 2000);
                </script>
              </div>';
          }
    
          $snewmy=$pdo->prepare("INSERT INTO examinee(uiid,examinee_type,stream,college,Department,program,fname,lname,gname,gender,phone,email,email_stat,photo,user_name,password,date,
          job_cat,o_phone,p_location,nationality,e_back,field_study,n_id,doc,age,birth_date)
                VALUES (:uiid,:etype,:stream,:college,:Department,:prog,:fname,:lname,:gname,:gender,:phone,:email,:email_stat,:photo,:usename,:pword,:dte,
              :job_cat,:o_phone,:p_location,:nationality,:e_back,:field_study,:n_id,:doc,:age,:birth_date  )");
              
               $snewmy->bindValue(':uiid',$userid);  
               $snewmy->bindValue(':etype','Applicant'); 
               $snewmy->bindValue(':stream','HR');  
               $snewmy->bindValue(':college','HR');
               $snewmy->bindValue(':Department','HR');
               $snewmy->bindValue(':prog','HR'); 

               $snewmy->bindValue(':fname',$fname);
               $snewmy->bindValue(':lname',$mname);
               $snewmy->bindValue(':gname',$lname);  
               $snewmy->bindValue(':gender',$gender);  
               $snewmy->bindValue(':phone',$sphoni);
               $snewmy->bindValue(':email',$semail);
               $snewmy->bindValue(':email_stat',$estat);
               $snewmy->bindValue(':photo',$photo_name);
               $snewmy->bindValue(':usename',$username);  
               $snewmy->bindValue(':pword',$password);
               $snewmy->bindValue(':dte',$date);

                $snewmy->bindValue(':birth_date',$birth_date);
               $snewmy->bindValue(':age',$age);
               $snewmy->bindValue(':job_cat',$depar);  
               $snewmy->bindValue(':o_phone',$ophoni);
               $snewmy->bindValue(':p_location',$plocation);
               $snewmy->bindValue(':nationality',$nationality);
               $snewmy->bindValue(':e_back',$ebackground);
               $snewmy->bindValue(':field_study',$fstudy);  
               $snewmy->bindValue(':n_id',$kebelephoto_name);

               $snewmy->bindValue(':doc',$docphoto_name);

               $snewmy->execute();
    
    
              
    
    
    
    
               echo '<div class="alert  alert-success" id="susualert" role="alert">
               The new candidate has been successfully added!
               <script>
               document.getElementById("msform").reset();
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