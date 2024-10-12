<?php 

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



include "dbc.php";
session_start();



 
 //Load Composer's autoloader

 
 //Create an instance; passing `true` enables exceptions
 

if (isset($_SESSION['huid']) && isset($_SESSION['hdepid'])) {

if(isset($_POST['page']))
{

  if($_POST['page'] == 'actexam')
	{
    if($_POST['action'] == 'activ')
    {  
          $uid=$_POST['uid'];
          $suid=$_POST['target'];

        $nassteacher=$pdo->prepare("UPDATE exam SET sttatus = :asteacher WHERE exam_id=:bcat ");
        $nassteacher->bindValue(':asteacher', 1);
        $nassteacher->bindValue(':bcat',$uid);
        $nassteacher->execute();

        $assteacher=$pdo->prepare("UPDATE assexam SET estatus = :asteacher WHERE exam_id=:bcat AND assigned_Department=:assd");
        $assteacher->bindValue(':asteacher', 1);
        $assteacher->bindValue(':bcat',$uid);
        $assteacher->bindValue(':assd',$suid);
        $assteacher->execute();
        echo '<script>
           location.reload();
       
           
           </script>';


        }

        if($_POST['action'] == 'date_ch')
        {  
              $date=$_POST['date'];
              $suid=$_POST['target'];

              $bsttmt=$pdo->prepare("UPDATE assexam SET exam_date=:edate
		          WHERE exam_id=:acreta ");	   
			        $bsttmt->bindValue(':edate', $date);
			        $bsttmt->bindValue(':acreta', $suid);
			        $bsttmt->execute();

              $bsttmt=$pdo->prepare("UPDATE exam SET exam_date=:edate
		          WHERE exam_id=:acreta ");	   
			        $bsttmt->bindValue(':edate', $date);
			        $bsttmt->bindValue(':acreta', $suid);
			        $bsttmt->execute();


              
              echo '<div class="alert  alert-success" id="susualert" role="alert">
               The exam date has been successfully updated!
               <script>
               $("#susualert").alert();
               setTimeout(function() {
               $("#susualert").alert("close");
                 }, 4000);
               
               </script>
               </div>';
            }
            if($_POST['action'] == 'time_ch')
            {  
                  $date=$_POST['date'];
                  $suid=$_POST['target'];
    
                  $bsttmt=$pdo->prepare("UPDATE assexam SET start_time=:edate
                  WHERE exam_id=:acreta ");	   
                  $bsttmt->bindValue(':edate', $date);
                  $bsttmt->bindValue(':acreta', $suid);
                  $bsttmt->execute();
    
                  $bsttmt=$pdo->prepare("UPDATE exam SET start_time=:edate
                  WHERE exam_id=:acreta ");	   
                  $bsttmt->bindValue(':edate', $date);
                  $bsttmt->bindValue(':acreta', $suid);
                  $bsttmt->execute();
    
    
                  
                  echo '<div class="alert  alert-success" id="susualert" role="alert">
                   The exam time has been successfully updated!
                   <script>
                   $("#susualert").alert();
                   setTimeout(function() {
                   $("#susualert").alert("close");
                     }, 4000);
                   
                   </script>
                   </div>';
                }

        if($_POST['action'] == 'ban')
    {  
            $uid=$_POST['uid'];
            $suid=$_POST['target'];

            $nassteacher=$pdo->prepare("UPDATE exam SET sttatus = :asteacher WHERE exam_id=:bcat ");
            $nassteacher->bindValue(':asteacher', 3);
            $nassteacher->bindValue(':bcat',$uid);
            $nassteacher->execute();


            $assteacher=$pdo->prepare("UPDATE  assexam SET estatus = :asteacher WHERE exam_id=:bcat AND assigned_Department=:assd");
            $assteacher->bindValue(':asteacher', 3);
            $assteacher->bindValue(':bcat',$uid);
            $assteacher->bindValue(':assd',$suid);
            $assteacher->execute();
            echo '<script>
               location.reload();
           
               
               </script>';
        echo '<script>
           location.reload();
       
           
           </script>';


        }

        if($_POST['action'] == 'assign')
        {  
          $assteacher=$pdo->prepare("UPDATE assexam SET examiner = :asteacher WHERE id=:idd AND exam_id=:bcat AND 
          assigned_Department=:cdepa  ");
          $assteacher->bindValue(':asteacher', $_POST['teacher']);
          $assteacher->bindValue(':bcat',$_POST['examid']);
          $assteacher->bindValue(':idd',$_POST['sid']);
          $assteacher->bindValue(':cdepa',$_POST['tdepa']);
          $assteacher->execute();

          $vcifetch=$pdo->prepare('SELECT * FROM exam WHERE exam_id =:deppid ');
          $vcifetch->bindValue(':deppid',$_POST['examid']);
          $vcifetch->execute();
          $vcicat=$vcifetch->fetch(PDO::FETCH_ASSOC);

          $mvcifetch=$pdo->prepare('SELECT * FROM assexam WHERE id=:idd AND exam_id=:bcat AND 
              assigned_Department=:cdepa  ');
           $mvcifetch->bindValue(':bcat',$_POST['examid']);
           $mvcifetch->bindValue(':idd',$_POST['sid']);
           $mvcifetch->bindValue(':cdepa',$_POST['tdepa']);
          $mvcifetch->execute();
          $mvcicat=$mvcifetch->fetch(PDO::FETCH_ASSOC);

          $cifetch=$pdo->prepare('SELECT * FROM account WHERE user_id =:deppid ');
          $cifetch->bindValue(':deppid',$_POST['teacher']);
          $cifetch->execute();
          $cicat=$cifetch->fetch(PDO::FETCH_ASSOC);

          $hcifetch=$pdo->prepare('SELECT * FROM account WHERE Department =:deppid AND user_type=:utytpe ');
          $hcifetch->bindValue(':deppid',$vcicat['creator_dep']);
          $hcifetch->bindValue(':utytpe','Head');
          $hcifetch->execute();
          $hcicat=$hcifetch->fetch(PDO::FETCH_ASSOC);

          $atrifetch=$pdo->prepare('SELECT dep_name FROM department WHERE dep_id =:deeppid');
          $atrifetch->bindValue(':deeppid',$_POST['tdepa']);
          $atrifetch->execute();
          $atricat=$atrifetch->fetch(PDO::FETCH_ASSOC);

          $depname = $atricat['dep_name'];


          $trifetch=$pdo->prepare('SELECT * FROM category WHERE cat_id =:deeppid');
          $trifetch->bindValue(':deeppid',$vcicat['cat_id']);
          $trifetch->execute();
          $tricat=$trifetch->fetch(PDO::FETCH_ASSOC);   

          $coname = $tricat['cat_name'];

          $startTime =$mvcicat['start_time'];
					$formattedTime = date("h:i A", strtotime($startTime));
					$timee=$formattedTime.' (Local Time)';

          $mail = new PHPMailer(true);
                   
          try {
              
              $mail->SMTPDebug = SMTP::DEBUG_SERVER;   
              $mail->SMTPDebug = 0;            
              $mail->isSMTP();                                            
              $mail->Host       = 'smtp.gmail.com';                    
              $mail->SMTPAuth   = true;                                
              $mail->Username   = 'dkuoes@gmail.com';                     
              $mail->Password   = 'qtgctgvmojibpcon';                               
              $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
              $mail->Port       = 465;                                    
          
              
              $mail->setFrom('dkuoes@gmail.com', 'DKU OES');
              $mail->addAddress($cicat['email']);     
                        
              $mail->addReplyTo('dkuoes@gmail.com', 'DKU OES');
              
              $mail->isHTML(true);                                  
              $mail->Subject = 'DKU OES';
              $mail->Body = file_get_contents('aemail.html');
              $mail->Body = str_replace('{{ $tit }}', $cicat['title'], $mail->Body);
              $mail->Body = str_replace('{{ $fname }}', $cicat['fname'], $mail->Body);
              $mail->Body = str_replace('{{ $mname }}', $cicat['lname'], $mail->Body);
              $mail->Body = str_replace('{{ $course }}', $coname, $mail->Body);
              $mail->Body = str_replace('{{ $Department }}', $depname, $mail->Body);
              $mail->Body = str_replace('{{ $stream }}', $mvcicat['assigned_group'], $mail->Body);

              $mail->Body = str_replace('{{ $time }}',	$timee, $mail->Body);

              $mail->Body = str_replace('{{ $hfname }}',$hcicat['fname'], $mail->Body);
              $mail->Body = str_replace('{{ $hmname }}',$hcicat['lname'], $mail->Body);

              $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          
              $mail->send();
              $email_stat=1;
              
          
              
          
            } catch (Exception $e) {
              $email_stat=0;
              
          }









          echo '<script>
          location.reload();
      
          
          </script>';
    
    
            }
            if($_POST['action'] == 'chassign')
        {  
    
          $assteacher=$pdo->prepare("UPDATE assexam SET examiner = :asteacher WHERE id=:idd AND exam_id=:bcat AND assigned_Department=:cdepa  ");
          $assteacher->bindValue(':asteacher', $_POST['cteacher']);
          $assteacher->bindValue(':bcat',$_POST['echdepaidu']);
          $assteacher->bindValue(':idd',$_POST['csid']);
          $assteacher->bindValue(':cdepa',$_POST['cdepart']);
          $assteacher->execute();





          $vcifetch=$pdo->prepare('SELECT * FROM exam WHERE exam_id =:deppid ');
          $vcifetch->bindValue(':deppid',$_POST['echdepaidu']);
          $vcifetch->execute();
          $vcicat=$vcifetch->fetch(PDO::FETCH_ASSOC);

          $mvcifetch=$pdo->prepare('SELECT * FROM assexam WHERE id=:idd AND exam_id=:bcat AND 
              assigned_Department=:cdepa  ');
           $mvcifetch->bindValue(':bcat',$_POST['echdepaidu']);
           $mvcifetch->bindValue(':idd',$_POST['csid']);
           $mvcifetch->bindValue(':cdepa',$_POST['cdepart']);
          $mvcifetch->execute();
          $mvcicat=$mvcifetch->fetch(PDO::FETCH_ASSOC);

          $cifetch=$pdo->prepare('SELECT * FROM account WHERE user_id =:deppid ');
          $cifetch->bindValue(':deppid',$_POST['cteacher']);
          $cifetch->execute();
          $cicat=$cifetch->fetch(PDO::FETCH_ASSOC);

          $hcifetch=$pdo->prepare('SELECT * FROM account WHERE Department =:deppid AND user_type=:utytpe ');
          $hcifetch->bindValue(':deppid',$vcicat['creator_dep']);
          $hcifetch->bindValue(':utytpe','Head');
          $hcifetch->execute();
          $hcicat=$hcifetch->fetch(PDO::FETCH_ASSOC);

          $atrifetch=$pdo->prepare('SELECT dep_name FROM department WHERE dep_id =:deeppid');
          $atrifetch->bindValue(':deeppid',$_POST['cdepart']);
          $atrifetch->execute();
          $atricat=$atrifetch->fetch(PDO::FETCH_ASSOC);

          $depname = $atricat['dep_name'];


          $trifetch=$pdo->prepare('SELECT * FROM category WHERE cat_id =:deeppid');
          $trifetch->bindValue(':deeppid',$vcicat['cat_id']);
          $trifetch->execute();
          $tricat=$trifetch->fetch(PDO::FETCH_ASSOC);   

          $coname = $tricat['cat_name'];

          
          $startTime =$mvcicat['start_time'];
					$formattedTime = date("h:i A", strtotime($startTime));
					$timee=$formattedTime.' (Local Time)';

          $mail = new PHPMailer(true);
                   
          try {
              
              $mail->SMTPDebug = SMTP::DEBUG_SERVER;   
              $mail->SMTPDebug = 0;            
              $mail->isSMTP();                                            
              $mail->Host       = 'smtp.gmail.com';                    
              $mail->SMTPAuth   = true;                                
              $mail->Username   = 'dkuoes@gmail.com';                     
              $mail->Password   = 'qtgctgvmojibpcon';                               
              $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
              $mail->Port       = 465;                                    
          
              
              $mail->setFrom('dkuoes@gmail.com', 'DKU OES');
              $mail->addAddress($cicat['email']);     
                        
              $mail->addReplyTo('dkuoes@gmail.com', 'DKU OES');
              
              $mail->isHTML(true);                                  
              $mail->Subject = 'DKU OES';
              $mail->Body = file_get_contents('aemail.html');
              $mail->Body = str_replace('{{ $tit }}', $cicat['title'], $mail->Body);
              $mail->Body = str_replace('{{ $fname }}', $cicat['fname'], $mail->Body);
              $mail->Body = str_replace('{{ $mname }}', $cicat['lname'], $mail->Body);
              $mail->Body = str_replace('{{ $course }}', $coname, $mail->Body);
              $mail->Body = str_replace('{{ $Department }}', $depname, $mail->Body);
              $mail->Body = str_replace('{{ $stream }}', $mvcicat['assigned_group'], $mail->Body);

              $mail->Body = str_replace('{{ $time }}',$timee, $mail->Body);

              $mail->Body = str_replace('{{ $hfname }}',$hcicat['fname'], $mail->Body);
              $mail->Body = str_replace('{{ $hmname }}',$hcicat['lname'], $mail->Body);

              $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          
              $mail->send();
              $email_stat=1;
              
          
              
          
            } catch (Exception $e) {
              $email_stat=0;
              
          }











          echo '<script>
          location.reload();
      
          
          </script>';
    
            }
    




      }

      if($_POST['page'] == 'registrar')
      {
   if($_POST['action'] == 'modallbig')

        {
        $boutpu='';
        $colname = '';
        $cat_id=$_POST['cudo'];
        $fetch=$pdo->prepare('SELECT * FROM category WHERE cat_id=:uid  ');
        $fetch->bindValue(':uid',$cat_id);
        $fetch->execute();
        $cat=$fetch->fetchAll(PDO::FETCH_ASSOC);
        foreach($cat as $ca){
    
          $cname=$ca['cat_name'];
          $ctype=$ca['cat_type'];
          $cid = $ca['cat_code'];
          $strmi = $ca['stream'];
          $collegi = $ca['college'];
         
          
        }
        $dsfetdch = $pdo->prepare('SELECT  dep_name, dep_id  FROM department  WHERE dep_id=:colepid');
        $dsfetdch->bindValue(':colepid', $collegi);
        $dsfetdch->execute();
        $msstulist = $dsfetdch->fetch(PDO::FETCH_ASSOC);

       
        
    
        $boutpu.='
        <div class="modal-header">
        <h5 class="modal-title" id="mexampleModalLabel">Edit Category :<b class="color-primary"> '. $cname .'</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
          <div id="success_updatebig"></div>
          <form class="form-group was-validated" id="bigcupdate" method="POST" action="#" >
          <div class="mb-1">
          <label>Name</label>
          <input type = "hidden" value= "'.$cat_id.'" id="bigcat_id" >
          <input type="text" class="form-control" value="'.$cname.'" id="bigucname" name="ucname" required placeholder="Enter category name"></div>
          <div class="mb-1">
          <label>Category Code</label>
          <input type="text" class="form-control" value="'.$cid.'" id="bigucaco" name="ucid" required placeholder="Enter category code" ></div>
          <div class=" mb-1">
                      <label>Stream</label>
                      <select id="strm" name="strm" class="form-select" required aria-label="stype">
                      <option value="'.$strmi.'" selected>'.$strmi.'</option>
                      <option value="Degree">Degree</option>
                      <option value="Masters">Masters</option>
                      <option value="Phd" disabled>Phd</option>';
    
             $boutpu.='  </select>
                      
                    </div>
                    <div class=" mb-1">
                      <label>College</label>
                      <select id="coltype" name="coltype" class="form-select" required aria-label="taype">';
                        $boutpu.='<option value = "'.$msstulist['dep_id'] .'" selected>'.$msstulist['dep_name'] .'</option>';
                        
                        
    
        $boutpu.='       </select>
                      
         </div>
          <div class="row">
             <div class="col mb-1">
          <label>Type</label>
                <select id="biguctype" name="uctype" value=" " class="form-select" required aria-label="type">
                <option value="'.$ctype.'" selected>'.$ctype.'</option>
              
                  <option value="course">Course</option>
                  <option value="coc">COC</option>
                  <option value="other">Other</option>                                         
                </select>
                <div class="invalid-feedback">Please, select the category</div>
            </div> 
          
          
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <input type="button" id="biguppdate" name="ccupdate" class="bigcupdate btn btn-primary" value="Update"> </div>
            </form>
          </div>
          </div>' ;
          echo $boutpu;
        }
    
        if($_POST['action'] == 'modall')
    
        {
          $output = '';
                $date=date('d-m-y H:i:s');             
                $id=$_POST['cudo'];
                $depid=$_POST['dep_id'];
                $dyear=$_POST['dep_year'];
                
                $sdfetch = $pdo->prepare('SELECT dep_name FROM department WHERE dep_id=:deppin');
                $sdfetch->bindValue(':deppin',$depid);
                $sdfetch->execute();
                $sdepart = $sdfetch->fetchAll(PDO::FETCH_ASSOC);
                foreach($sdepart as $sca){
                  $depname=$sca['dep_name'];
                  
                }
    
                $fetch=$pdo->prepare('SELECT * FROM category WHERE cat_id=:uid  ');
                $fetch->bindValue(':uid',$id);
                $fetch->execute();
                $cat=$fetch->fetchAll(PDO::FETCH_ASSOC);
                foreach($cat as $ca){
                  $cname=$ca['cat_name'];
                  
                }
    
                $fmetch=$pdo->prepare('SELECT   assigned_group FROM course WHERE cat_id=:uid AND  Department=:depp AND assigned_year=:ayear ');
                $fmetch->bindValue(':uid',$id);
                $fmetch->bindValue(':depp',$depid);
                $fmetch->bindValue(':ayear',$dyear);
                $fmetch->execute();
                $cyiru=$fmetch->fetchAll(PDO::FETCH_ASSOC);
                
                  $cc=$dyear;
              
    
                $output .= '
                                  
                                
                                <div class="modal-header">
                                <h5 class="modal-title" id="mexampleModalLabel">Edit Category :<b class="color-primary"> '. $cname .'</b></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                                <div class="modal-body">
                                  <div id="success_update"></div>
                                  <form class="form-group was-validated" id="cupdate" method="POST" action="#" >
                        <input type="hidden" value="'.$cc.'" id="oyear" name="oyear">
                        <input type="hidden" value="'.$depid.'" id="odepart" name="odepart">
                                  <div class="row">
                                  <div class="col-5 mb-1">
                                    <label>Category</label>
                                    <select id="ucatid" name="ucatid" class="form-select" required aria-label="type">
                                      
                                        </option>
                                        
                                          <option value="'.$id.' " selected disabled>'.$cname.'</option>
                                        
                                    </select>
                                    <div class="invalid-feedback">Please, select the category</div>
                                  </div>
                                  <div class="col-7 mb-1">
                                    <label>Department</label>
                                    <select id="ucdep" name="ucdep" class="form-select" required aria-label="type">
                                      
                                      
                                        <option value="'.$depid.' " selected disabled>'.$depname.' </option>
                                      
                                      
                                    </select>
                                    <div class="invalid-feedback">Please, select the department</div>
                                  </div>
                                </div>
                    
                    <div class="row">
                      <div class="col-7">
                        <label>Target Group</label>
                        <div class="form-check">';
                        foreach($cyiru as $yir){
                        if($yir['assigned_group'] == "Regular"){
                          $output .= '<input class="form-check-input" name="myupRadioGroup" checked required type="checkbox" value="Regular" id="flexCheckDefault1">';
                          break;}
                          else{
                      $output .= '<input class="form-check-input" name="myupRadioGroup" required type="checkbox" value="Regular" id="flexCheckDefault1">';
                    }}
    
                          $output .= ' <label class=" mb-2" for="flexCheckDefault1">
                            Regular
                          </label></br>';
                          
                          foreach($cyiru as $yir){
                          if($yir['assigned_group'] == 'Extension'){
                            $output .= '<input class="form-check-input" name="myupRadioGroup" checked  required type="checkbox" value="Extension" id="flexCheckDefault11">';
                          break;}
                            else{
                        $output .= '<input class="form-check-input" name="myupRadioGroup" required type="checkbox" value="Extension" id="flexCheckDefault11">';}}
    
                        $output .= ' <label class=" mb-2" for="flexCheckDefault2">
                            Extension
                          </label></br>';
                            
                            foreach($cyiru as $yir){
                          if($yir['assigned_group'] == 'Summer'){
                            $output .= '<input class="form-check-input" name="myupRadioGroup" checked required type="checkbox" value="Summer" id="flexCheckDefault11">';
                            break;}
                            else{
                        $output .= '<input class="form-check-input" name="myupRadioGroup" required type="checkbox" value="Summer" id="flexCheckDefault11">';}}
    
                         $output .= '  <label class=" mb-2" for="flexCheckDefaul3">
                            Summer
                          </label>';
                        
                        $output .= '</div>
                      </div>
    
                      <div class="col-5">
                        <label>Target Year</label>
                        <select id="ucyira" name="ucyira" class="form-select" required aria-label="type">
                          <option value="'.$cc.'" selected>'.$cc.' Year</option>
                          <option value="1">1<sup>st</sup> Year</option>
                          <option value="2">2<sup>nd</sup> Year</option>
                          <option value="3">3<sup>rd</sup> Year</option>
                          <option value="4">4<sup>th</sup> Year</option>
                          <option value="5">5<sup>th</sup> Year</option>
                          <option value="6">6<sup>th</sup> Year</option>
                        </select>
                        <div class="invalid-feedback">Please, select the correct year </div>
                      </div>
                    </div>
                                        
             <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                  <input type="button" id="uppdate" name="ccupdate" class="cupdate btn btn-primary" value="Update"> </div>
                                  </form>
                                </div>';
                 echo $output;
            
              
        }
    
        if($_POST['action'] == 'add')
        {
                $adate=date('d-m-y H:i:s');      
                $acname=$_POST['cname'];
                 $slici= strtoupper(substr($acname, 0, 3));
                 $acpid = random($slici);            
                 $acid=$_POST['cid'];
                $actype=$_POST['ctype'];
                $strm=$_POST['strm'];
                $coltype=$_POST['coltype'];
    
            if($acname && $acpid && $acid && $actype    !=null){
              $sql = mysqli_query($conn,"SELECT * FROM category WHERE cat_id = '$acpid' or cat_code='$acid'  OR cat_name = '$acname'  ");
              $row =mysqli_fetch_array($sql);
              if(is_array($row)){     
                echo '
                
                <div class="alert alert-danger" role="alert">
                Please select another department to replicate category name or code!
                              </div>
                ';
                
              }  
            else{ 
            $cmy=$pdo->prepare("INSERT INTO category(cat_id,cat_code,college,stream,cat_type,cat_name,date)
            VALUES (:cati,:cid,:colity,:strm,:ctype,:cname,:cdate)");
         
           $cmy->bindValue(':cati',$acpid);  
            $cmy->bindValue(':ctype',$actype);
            $cmy->bindValue(':cid',$acid);
            $cmy->bindValue(':strm',$strm);
            $cmy->bindValue(':colity',$coltype);
            $cmy->bindValue(':cname',$acname);
            $cmy->bindValue(':cdate',$adate);
            $cmy->execute();
            echo' 
                  <div class="alert  alert-success" id="ssualert" role="alert">
                        The new category succesfully added!
                        <script>
                        document.getElementById("addcat").reset();
                        $("#ssualert").alert();
                        setTimeout(function() {
                        $("#ssualert").alert("close");
                          }, 2000);
                          location.reload();
                        </script>
                        </div>
                  ';
            }
    
          }
            else{
              echo '<div class="alert alert-danger" role="alert">
              Please fill the form correctlly!
              </div>';
            }
        }
        // if($_POST['action'] == 'listcati')
        // {
        //   $outi =''; 
        //   $depppid= $_POST['depppid'];
        //  if($depppid == null){
        //   $qfetch = $pdo->prepare('SELECT * FROM category ORDER BY date DESC');
        //   $qfetch->execute();
        //   $qcat = $qfetch->fetchAll(PDO::FETCH_ASSOC);
    
        //   $outi.=' <option value></option>';
        //   foreach ($qcat as $qccms) {
    
        //      $outi.=' <option value="'. $qccms['cat_id'].' "> '.$qccms['cat_name'].'</option> ';
        //   }
        //  }
        //  else{
    
        //   $bcolstr = $pdo->prepare('SELECT col_id,stream FROM department WHERE dep_id=:depnet');
        //   $bcolstr->bindValue(':depnet',$depppid);
        //   $bcolstr->execute();
        //   $bcolstrm = $bcolstr->fetchAll(PDO::FETCH_ASSOC);
        //   foreach($bcolstrm as $bbstr){
        //     $colln= $bbstr['col_id'];
        //     $stream = $bbstr['stream'];
        //   }
    
        //   $mbcolstr = $pdo->prepare('SELECT * FROM category WHERE college=:collis AND stream=:strmm');
        //   $mbcolstr->bindValue(':collis',$colln);
        //   $mbcolstr->bindValue(':strmm',$stream);
        //   $mbcolstr->execute();
        //   $mcolstrm = $mbcolstr->fetchAll(PDO::FETCH_ASSOC);
    
        //   $outi.=' <option value></option>';
        //   foreach ($mcolstrm as $mqccms) {
    
        //      $outi.=' <option value="'. $mqccms['cat_id'].' "> '.$mqccms['cat_name'].'</option> ';
        //   }
        //  }
    
        //       echo  $outi;
         
        // }
        if($_POST['action'] == 'assignadd')
    
        {
                 $date=date('d-m-y H:i:s');
                  if (isset($_POST['cgroup'])) {
                    
                    $cgroup=$_POST['cgroup'];
                  } else {
                    
                    $cgroup = null; 
                  }
    
                 
                  $cpid=$_POST['cid'];
                  $truedep=$_POST['truedep'];
                  $depa=$_POST['depa'] ?? null;
                  $yera=$_POST['yera'];
           if(  $cpid && $depa && $yera && $cgroup    !=null){
    
            $sql = mysqli_query($conn,"SELECT * FROM course WHERE cat_id = '$cpid' AND Department='$depa' AND catDepartment='$truedep'");
            $rowi =mysqli_fetch_array($sql);
            $nordepartment = $rowi['Department'] ?? null;
    
                 
                  
                
    
                  if($nordepartment == null ){

                $cmy=$pdo->prepare("INSERT INTO asscategory(Department,cat_id,date)
                VALUES (:depa,:cati,:cdate)");
              
               $cmy->bindValue(':depa',$depa);  
               $cmy->bindValue(':cati',$cpid);  
                $cmy->bindValue(':cdate',$date);
                $cmy->execute();
                  }
                if($cgroup !=null){
            foreach($cgroup as $ccg) {

              $bfetch=$pdo->prepare('SELECT * FROM course WHERE cat_id=:uid AND Department=:depa AND catDepartment=:cadepa AND assigned_year=:ayear AND assigned_group=:agorup');
              $bfetch->bindValue(':uid',$cpid);
              $bfetch->bindValue(':depa',$depa);
              $bfetch->bindValue(':cadepa',$truedep);
              $bfetch->bindValue(':ayear',$yera);
              $bfetch->bindValue(':agorup',$ccg);
              $bfetch->execute();
              $bcat=$bfetch->fetchAll(PDO::FETCH_ASSOC);

              if(count($bcat) >0 ){
                echo '
                
                <div class="alert alert-danger" role="alert">
                Please select another department to replicate category name or code!
                              </div>
                ';
                continue;                
              }  
           

                $sccmy=$pdo->prepare("INSERT INTO course(catDepartment,Department,cat_id,assigned_group,assigned_year,assigned_teacher)
                VALUES (:catDepar,:depa,:cati,:cgroup,:cyear,:assigned_teacher)");
    
              $sccmy->bindValue(':catDepar',$truedep);
               $sccmy->bindValue(':depa',$depa);  
               $sccmy->bindValue(':cati',$cpid);  
                $sccmy->bindValue(':cgroup',$ccg);
                $sccmy->bindValue(':cyear',$yera);
                $sccmy->bindValue(':assigned_teacher','empty');
                $sccmy->execute();
                echo' 
            <div class="alert  alert-success" id="ssualert" role="alert">
                  Category assignment for '.$ccg.' '.$yera.' year successfully done!
                  <script>
                  document.getElementById("addcat").reset();
                  $("#ssualert").alert();
                  setTimeout(function() {
                  $("#ssualert").alert("close");
                    }, 5000);
                    
                  </script>
                  </div>
            ';
            }
    

          
          }
    
    
    
    
               
              }
               
              else{
                echo '<div class="alert alert-danger" role="alert">
                Please fill the form correctlly!
                </div>';
              }
         }
                
         if($_POST['action'] == 'bigcuupdate')
    
                {
                  $bumain_p = $_POST['bumain_p'];
                  $bucname=$_POST['bucname'];
                  $bucid=$_POST['bucid'];
                  $buctype=$_POST['buctype'];
                  $strm=$_POST['strm'];
                  $coltype=$_POST['coltype'];
                  
    
                  $bfetch=$pdo->prepare('SELECT * FROM category WHERE cat_id=:uid  ');
                  $bfetch->bindValue(':uid',$bumain_p);
                  $bfetch->execute();
                  $bcat=$bfetch->fetchAll(PDO::FETCH_ASSOC);
                  foreach($bcat as $bca){
              
                    $bcname=$bca['cat_name'];
                    $bctype=$bca['cat_type'];
                    $bcid = $bca['cat_code'];
                    $bstrm=$bca['stream'];
                    $bcoltype = $bca['college'];
                    
                    
                  }
                  if( $bucname  && $bucid && $buctype    !=null){
                    if ($bucname === $bcname && $bucid === $bcid && $buctype === $bctype && $strm === $bstrm && $coltype === $bcoltype     ) {
                      echo '
                      <div class="alert  alert-info" id="nusualert" role="alert">
                      Sorry, no change was found!
                      <script>
                      $("#nusualert").alert();
                      setTimeout(function() {
                      $("#nusualert").alert("close");
                        }, 2100);
                      
                      </script>
                      </div>';
                        
                    } 
                    else{
                      $bsttmt=$pdo->prepare("UPDATE category SET cat_name = :catis, cat_code = :cacode,stream=:strmi,college=:colli,
                       cat_type = :catypi WHERE cat_id=:bcat  ");
                      
                      $bsttmt->bindValue(':catis',$bucname);
                      $bsttmt->bindValue(':cacode',$bucid);
                      $bsttmt->bindValue(':strmi',$strm);
                      $bsttmt->bindValue(':colli',$coltype);
                      $bsttmt->bindValue(':catypi',$buctype);
                      $bsttmt->bindValue(':bcat',$bumain_p);
                      $bsttmt->execute();
                      echo '<div class="alert  alert-success" id="usualert" role="alert">
                      The category has been successfully updated!
                      <script>
                      $("#usualert").alert();
                      setTimeout(function() {
                      $("#usualert").alert("close");
                        }, 800);
                      
                      </script>
                      </div>';
                    }
                  }
                  else{
                    echo '<div class="alert alert-danger" role="alert">
                Please fill the form correctlly!
                </div>';
                  }
                }
         
         
         
         if($_POST['action'] == 'cuupdate')
    
                {
                  if (isset($_POST['ucgroup'])) {
                    
                    $ucgroup=$_POST['ucgroup'];
                  } else {
                    
                    $ucgroup = null; 
    
                  }
    
    
                  
                 
                 $ucpid = $_POST['umain_p'];
                  
                  
                  $udepa=$_POST['udepa'];
                  $uyera=$_POST['uyera'];
                  $oyear=$_POST['oyear'];
                  $odepart=$_POST['odepart'];
    
    
    
    
           if( $ucpid  && $udepa && $uyera && $ucgroup    !=null){
            $sql = "SELECT * FROM course WHERE assigned_teacher !=:atech AND cat_id=:catii AND Department=:depr AND assigned_year=:ayear ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':atech', 'empty');  
            $stmt->bindValue(':catii', $ucpid);  
            $stmt->bindValue(':depr', $udepa); 
            $stmt->bindValue(':ayear', $oyear); 
            $stmt->execute();
            $tresults = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if(count($tresults) == 0){

              $sql = "SELECT assigned_group, assigned_year FROM course WHERE cat_id=:catii AND Department=:dedspr";
              $nustmt = $pdo->prepare($sql);
              $nustmt->bindValue(':catii', $ucpid);
              $nustmt->bindValue(':dedspr', $udepa);  
              $nustmt->execute();
              $sucgroup = $nustmt->fetchAll(PDO::FETCH_ASSOC);
              $ucgroup_str = implode(',', array_map('strval', $ucgroup));
              $sucgroup_str = implode(',', array_map('strval', array_column($sucgroup, 'assigned_group')));
              
              foreach($sucgroup as $syear){
                $fsyear = $syear['assigned_year'];
                break;
              }
              
              
              
                
            
            if ($ucgroup_str === $sucgroup_str && $uyera === $fsyear) {
              echo '
              <div class="alert  alert-info" id="nusualert" role="alert">
              Sorry, no change was found!
              <script>
              $("#nusualert").alert();
              setTimeout(function() {
              $("#nusualert").alert("close");
                }, 1100);
              
              </script>
              </div>';
                
            } 
            else{

              
              $sql = "DELETE FROM course WHERE cat_id = :id AND Department=:dpepp AND assigned_year=:ayear";
              $sdtmt = $pdo->prepare($sql);
              
              $sdtmt->bindValue(':id', $ucpid);
              $sdtmt->bindValue(':dpepp', $udepa);
              $sdtmt->bindValue(':ayear', $oyear);

              $sdtmt->execute();
              foreach($ucgroup as $uccg) {

                $sql = "SELECT * FROM course WHERE assigned_teacher !=:atech AND cat_id=:catii AND Department=:depr AND assigned_year=:ayear ";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':atech', 'empty');  
                $stmt->bindValue(':catii', $ucpid);  
                $stmt->bindValue(':depr', $udepa); 
                $stmt->bindValue(':ayear', $oyear); 
                $stmt->execute();
                $tresults = $stmt->fetchAll(PDO::FETCH_ASSOC);

                
                $sccmy=$pdo->prepare("INSERT INTO course(catDepartment,Department,cat_id,assigned_group,assigned_year)
                VALUES (:catDepartment,:depa,:cati,:cgroup,:cyear)");

               $sccmy->bindValue(':catDepartment',$odepart);                
               $sccmy->bindValue(':depa',$udepa);  
               $sccmy->bindValue(':cati',$ucpid);  
                $sccmy->bindValue(':cgroup',$uccg);
                $sccmy->bindValue(':cyear',$uyera);
                $sccmy->execute();
                
    
            }
            echo '<div class="alert  alert-success" id="usualert" role="alert">
            The category has been successfully updated!
            <script>
            $("#usualert").alert();
            setTimeout(function() {
            $("#usualert").alert("close");
              }, 800);
            
            </script>
            </div>';
    
            }
          }
            else{
              echo '<div class="alert alert-danger" role="alert">
              Sorry, you can not update this category since the teacher has been assigned!
              </div>';
            }
    
           }
           else{
            echo '<div class="alert alert-danger" role="alert">
                Please fill the form correctlly!
                </div>';
           }
    
    
      //             $previous_page = $_SERVER['HTTP_REFERER'];
    
      // // Redirect to the previous page
      // echo $previous_page;
    
                }
        if($_POST['action'] == 'cdelete')
                {
       
    //$dcpid = filter_var($_POST['dcid'], FILTER_SANITIZE_STRING);
    $dcpid = $_POST['dcid'];
    $department = $_POST['depart'];
    $dep_year = $_POST['dep_year'];
    $check_sql = "SELECT COUNT(*) FROM course WHERE cat_id=:catii AND Department=:depdd AND assigned_teacher !=:atech AND assigned_year=:ayira ";
    $check_stmt = $pdo->prepare($check_sql);
    $check_stmt->bindValue(':catii', $dcpid);
    $check_stmt->bindValue(':depdd', $department);
    $check_stmt->bindValue(':atech', 'empty');
    $check_stmt->bindValue(':ayira', $dep_year);
    $check_stmt->execute();
    $dependency_count = $check_stmt->fetchColumn();
    
    if ($dependency_count > 0) {
        
        echo '<div class="alert  alert-danger" id="udsualert" role="alert">
        Sorry, you can not delete this category since the teacher has been assigned!
    
        </div>';
    } else {
        $delete_sql = "DELETE FROM course WHERE cat_id = :id AND Department=:tdepdd AND assigned_year=:ayira ";
        $delete_stmt = $pdo->prepare($delete_sql);
        $delete_stmt->bindValue(':id', $dcpid);
        $delete_stmt->bindValue(':tdepdd', $department);
        $delete_stmt->bindValue(':ayira', $dep_year);
        $delete_stmt->execute();

                $sql = "SELECT * FROM course WHERE cat_id=:idat AND Department=:utipi ";
        $eustmt = $pdo->prepare($sql);
        $eustmt->bindValue(':idat', $dcpid);
        $eustmt->bindValue(':utipi', $department);
        $eustmt->execute();
        $eemail = $eustmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($eemail) == 0){
    
        $ddelete_sql = "DELETE FROM asscategory WHERE cat_id = :iid AND Department=:mdepdd";
        $ddelete_stmt = $pdo->prepare($ddelete_sql);
        $ddelete_stmt->bindValue(':iid', $dcpid);
        $ddelete_stmt->bindValue(':mdepdd', $department);
        $ddelete_stmt->execute();
        }
        echo '
        
        <script>
        location.reload();
    
        
        </script>
        ';
    }
    
              
                }
                
          if($_POST['action'] == 'bbigcdelete')
          {
              
            $dcpid = $_POST['mdcid'];
      
            $check_sql = "SELECT COUNT(*) FROM course WHERE assigned_teacher !=:atech AND cat_id=:catii";
            $check_stmt = $pdo->prepare($check_sql);
            $check_stmt->bindValue(':atech', 'empty');
            $check_stmt->bindValue(':catii', $dcpid);
            $check_stmt->execute();
            $dependency_count = $check_stmt->fetchColumn();
      
            if ($dependency_count > 0) {
                
                echo '<div class="alert  alert-danger" id="udsualert" role="alert">
                Sorry, you can not delete this category since the teacher has been assigned!
      
                </div>';
            }
            else{
            $sql = "DELETE category, asscategory, course 
                    FROM category 
                    LEFT JOIN asscategory ON category.cat_id = asscategory.cat_id 
                    LEFT JOIN course ON category.cat_id = course.cat_id 
                    WHERE category.cat_id = :cat_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':cat_id', $dcpid);
            $stmt->execute();
            echo '
          
            <script>
            location.reload();
        
            
            </script>
            ';
      
            }
      
            }
        

        
        }







if($_POST['page'] == 'addinstruct')
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
                $usertype = 'Teacher';
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
                    $username= random('T');
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
                  $mail->Username   = 'dkuoes@gmail.com';
                  $mail->Password   = 'qtgctgvmojibpcon';
                  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                  $mail->Port       = 465;
              
                  $mail->setFrom('dkuoes@gmail.com', 'DKU OES');
                  $mail->addAddress($email);
              
                  $mail->addReplyTo('dkuoes@gmail.com', 'DKU OES');
              
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
                  $email_stat = 1;
              } catch (Exception $e) {
                  $email_stat = 0;
                  echo '<div class="alert alert-danger" id="emailerror" role="alert">
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
               The new Teacher has been successfully added!
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
                 
       
                 $output.='
                 
                <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Teacher Profile</h5>
              <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    
            </div>
            <div class="modal-body">
              <div class="form signup">
                <form class="was-validated" method="POST" id="updins" action="#"  enctype="multipart/form-data">
                  <div class="mb-1" id="updInsSuccess"></div>

                  <input type="hidden" value="'.$epart['Department'].'" id="depa" name="depa">
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
              $depa=$_POST['depa'];
              $tit=$_POST['title'];
              $fname= ucwords(strtolower($_POST['fname']));
              $mname= ucwords(strtolower($_POST['mname']));
              $lname= ucwords(strtolower($_POST['lname']));
              $phone=$_POST['phone'];
              $email=$_POST['email'];
              $photop=$_POST['photop'];
             
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
                          SET 
                  
                              title = :titi,
                              fname = :fnam,
                              lname = :laname,
                              gname = :gname,
                              phone = :phone,
                              email = :email,
    
                              photo = :photo
    
                          WHERE user_id = :uiiid AND Department = :depa");
    
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
            The account has been successfully deleted!
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
                  $mail->Username   = 'dkuoes@gmail.com';                     
                  $mail->Password   = 'qtgctgvmojibpcon';                               
                  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
                  $mail->Port       = 465;                                    
              
                  
                  $mail->setFrom('dkuoes@gmail.com', 'DKU OES');
                  $mail->addAddress($epart['email']);     
                            
                  $mail->addReplyTo('dkuoes@gmail.com', 'DKU OES');
                  
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

    if($_POST['page'] == 'category')
	{
		if($_POST['action'] == 'assign')
		{  
           $assteacher=$pdo->prepare("UPDATE course SET assigned_teacher = :asteacher WHERE id=:bcat AND catDepartment=:cdepa  ");
           $assteacher->bindValue(':asteacher', $_POST['teacher']);
           $assteacher->bindValue(':bcat',$_POST['sid']);
           $assteacher->bindValue(':cdepa',$_POST['depart']);
           $assteacher->execute();
           echo '<script>
           location.reload();
       
           
           </script>';


        }
        if($_POST['action'] == 'chassign')
		{  

           $assteacher=$pdo->prepare("UPDATE course SET assigned_teacher = :asteacher WHERE id=:bcat AND catDepartment=:cdepa  ");
           $assteacher->bindValue(':asteacher', $_POST['cteacher']);
           $assteacher->bindValue(':bcat',$_POST['csid']);
           $assteacher->bindValue(':cdepa',$_POST['cdepart']);
           $assteacher->execute();
           echo '<script>
           location.reload();
       
           
           </script>';


        }

    }



}

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












}else{
  header("Location: ../index.php");
     exit();
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
