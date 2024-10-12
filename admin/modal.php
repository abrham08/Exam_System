<?php 
session_start();
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



include "dbc.php";

if (isset( $_SESSION['ruid'])) {
if(isset($_POST['page']))
{
if($_POST['page'] == 'admin')
	{
		if($_POST['action'] == 'modall')

		{
            $date=date('d-m-y H:i:s');             
            $id=$_POST['cudo'];
          
     $fetch=$pdo->prepare('SELECT * FROM category WHERE uid=:uid');
            $fetch->bindValue(':uid',$id);
            $fetch->execute();
            $cat=$fetch->fetchAll(PDO::FETCH_ASSOC);
            foreach($cat as $ca){
              $cid=$ca['cid'];
              $cname=$ca['cname'];
              $cnq=$ca['cnq'];
              $cnc=$ca['cnc'];
              $ctime=$ca['ctime'];
            }
    $output = '';
            $output .= '
            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Category :<b class="color-primary"> '. $cname .'</b></h5>
                            <div id="current"></div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                            <div  class="modal-body">
                               
                              
                            
            <form  action="#" class="form-group was-validated" method="POST" >
            <input type="hidden" name="uid" value="'.$id.'">
            <div class="mb-1" id="admin">
            <label >Name</label>
            <input type="text" class="form-control" value="'. $cname .' " name="cname" required placeholder="Enter category name"></div>
            <div class="mb-1">
            <label>ID</label>
            <input type="text" class="form-control" value="'.$cid.' "  name="cid" required placeholder="Enter category ID" ></div>
            <div class="mb-1">
            <label>Number of Questions</label>
            <input type="number" class="form-control" value="'.$cnq.'"  name="cnq" required placeholder="Enter number of question"></div>
            <div class="mb-1">
            <label>Number of codes</label>
            <input type="number" class="form-control" value="'.$cnc.'"  name="cnc" required placeholder="Enter number of codes"></div>
            <div class="mb-1">
            <label>Time</label>
            <input type="number" class="form-control" value="'.$ctime.'"  name="ctime" required placeholder="Enter the time given in minute"></div>
            <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <input type="submit" name="cupdate" class="btn btn-primary" value="Update"> </div>
        </form></div>';
             echo $output;
        }
    }

    if($_POST['page'] == 'quest')
	{
		if($_POST['action'] == 'modall'){
      include "dbc.php";
   
    $cat=$_POST['cat'];
    $ud= number_format($_POST['cudo']);
    
    $my=$pdo->prepare('SELECT * FROM question WHERE cid=:cid AND qid=:qid');
    $my->bindValue(':cid',$cat);
    $my->bindValue(':qid',$ud);
    $my->execute();
    $questu=$my->fetchAll(PDO::FETCH_ASSOC);
         foreach($questu as $row){
            $qid=$row['qid'];
            $qd=$row['question'];
            $ans=$row['answer'];
            $mark=$row['rmark'];      
         }   
         $cmy=$pdo->prepare('SELECT * FROM option_list WHERE cid=:cid AND qid=:qid ORDER BY ono ASC');
         $cmy->bindValue(':cid',$cat);
         $cmy->bindValue(':qid',$ud);
         $cmy->execute();
         $choice=$cmy->fetchAll(PDO::FETCH_ASSOC);
              
    $output='';
		
      $output .= '
       <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Question No: <b class="color-primary">'. $qid.' </b></h5>
      <div id="current"></div>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div  class="modal-body">
      <form class="form-group was-validated" method="POST" action="#" >
      <div class="row g-3">
      <div class="col mb-1">
      <label>Enter question ID</label>
      <input type="hidden" value="'.$cat.'" class="form-control" name="cid">
      <input type="text" value="'.$qid.'"  class="form-control" name="qid" required placeholder="Enter question ID" ></div>                                
      <div class="col mb-1">
      <label>Mark for right answer</label>
      <input type="number"class="form-control" value="'.$mark.'" name="rm" required placeholder="Enter mark for right answer" ></div>
      </div>
      <div class="mb-1">
      <label>Question</label>
      <textarea class="form-control" rows="" name="que" required placeholder="Enter the question">'.$qd.'</textarea></div>';
      $i=1;
      foreach($choice as $ch){

      $output.=' <div class="mb-1">
      <label>option_'.$i.'</label>
      <textarea class="form-control" style="height:25px;"  name="opt'.$i.'" required placeholder="Enter option_'.$i.'">'.$ch['ot'].'</textarea></div>';
      $i++;

      }
   $output.='   <div class="mb-1">
        <label>Answer</label>
        <select name="ans" value="" required class="form-control">
            <option value="'.$ans.'" selected>option_'.$ans.'</option>
            <option value="1">option_1</option>
            <option value="2">option_2</option>
            <option value="3">option_3</option>
            <option value="4">option_4</option>
            <option value="5">option_5</option>
        </select>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      <input type="submit" name="qedit" class="btn btn-primary" value="Update"> </div>
  </form>
        </div>';
    
       echo $output;
    }
  }
  if($_POST['page'] == 'viewexaminer')
	{
		if($_POST['action'] == 'modall')
         $eid=$_POST['cudo'];
         $fetch=$pdo->prepare('SELECT * FROM qadmin WHERE eid=:eid');
         $fetch->bindValue(':eid',$eid);
         $fetch->execute();
      $prof=$fetch->fetchAll(PDO::FETCH_ASSOC);
         foreach($prof as $ca){
         $id=$ca['eid'];
         $uname=$ca['fname'];
         $fname=$ca['name'];
         $pass=$ca['password'];
         $phone=$ca['phone'];
         }
		{
      $output='';
      $output='
          <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Examiner</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="form signup">
        <form class="was-validated" method="POST" action="#" enctype="multipart/form-data" >
            <div class=" row ">
            <div class="mb-1">
                <label >ID</label>
                <input type="text" cla value="'. $id.'" class="form-control" name="id"  required placeholder="Enter ID number ">
                <div class="invalid-feedback">Please ID number</div>
              </div>
              <div class=" mb-1">
                <label >Full Name</label>
                <input type="text" class="form-control" value="'. $fname.'" name="name"  required placeholder="Enter full name ">
                <div class="invalid-feedback">Please enter name</div>
              </div>
            </div>

              <div class="mb-1">
                <label >Phone Number</label>
                <input type="number" class="form-control" maximum="10" name="phone" value="'. $phone.'"  required placeholder="Enter your phone number ">
                <div class="invalid-feedback">Please enter your number</div>
              </div>
              <div class="mb-1">
                <button class="btn btn-primary" type="submit" name="update"> Update</button>
              </div>
            </form>
          </div>
        </div>';
        echo $output;
    }
  }
  if($_POST['page'] == 'viewadmin')
	{
		if($_POST['action'] == 'modall')
         $eid=$_POST['cudo'];
         $fetch=$pdo->prepare('SELECT * FROM aadmin WHERE qid=:qid');
         $fetch->bindValue(':qid',$eid);
         $fetch->execute();
      $prof=$fetch->fetchAll(PDO::FETCH_ASSOC);
         foreach($prof as $ca){
         $id=$ca['qid'];
         $uname=$ca['fname'];
         $fname=$ca['name'];
         $pass=$ca['password'];
         $phone=$ca['phone'];
         }
		{
      $output='';
      $output='
          <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Questioner</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="form signup">
        <form class="was-validated" method="POST" action="#" enctype="multipart/form-data" >
            <div class=" row ">
            <div class="mb-1">
                <label >ID</label>
                <input type="text" cla value="'. $id.'" class="form-control" name="id"  required placeholder="Enter ID number ">
                <div class="invalid-feedback">Please ID number</div>
              </div>
              <div class=" mb-1">
                <label >Full Name</label>
                <input type="text" class="form-control" value="'. $fname.'" name="name"  required placeholder="Enter full name ">
                <div class="invalid-feedback">Please enter name</div>
              </div>
            </div>

              <div class="mb-1">
                <label >Phone Number</label>
                <input type="number" class="form-control" maximum="10" name="phone" value="'. $phone.'"  required placeholder="Enter your phone number ">
                <div class="invalid-feedback">Please enter your number</div>
              </div>
              <div class="mb-1">
                <button class="btn btn-primary" type="submit" name="update"> Update</button>
              </div>
            </form>
          </div>
        </div>';
        echo $output;
    }
  }
  if($_POST['page'] == 'madmin')
	{
		if($_POST['action'] == 'modall')
         $eid=$_POST['cudo'];
         $fetch=$pdo->prepare('SELECT * FROM admin WHERE mid=:mid');
         $fetch->bindValue(':mid',$eid);
         $fetch->execute();
      $prof=$fetch->fetchAll(PDO::FETCH_ASSOC);
         foreach($prof as $ca){
         $id=$ca['mid'];
         $uname=$ca['fname'];
         $fname=$ca['name'];
         $phone=$ca['phone'];
         }
		{
      $output='';
      $output='
          <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Edit Questioner</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="form signup">
        <form class="was-validated" method="POST" action="#" enctype="multipart/form-data" >
            <div class=" row ">
            <div class="mb-1">
                <label >ID</label>
                <input type="text" cla value="'. $id.'" class="form-control" name="id"  required placeholder="Enter ID number ">
                <div class="invalid-feedback">Please ID number</div>
              </div>
              <div class=" mb-1">
                <label >Full Name</label>
                <input type="text" class="form-control" value="'. $fname.'" name="name"  required placeholder="Enter full name ">
                <div class="invalid-feedback">Please enter name</div>
              </div>
            </div>

              <div class="mb-1">
                <label >Phone Number</label>
                <input type="number" class="form-control" maximum="10" name="phone" value="'. $phone.'"  required placeholder="Enter your phone number ">
                <div class="invalid-feedback">Please enter your number</div>
              </div>
              <div class="mb-1">
                <button class="btn btn-primary" type="submit" name="update"> Update</button>
              </div>
            </form>
          </div>
        </div>';
        echo $output;
    }
  }
  if($_POST['page'] == 'service')
	{
		if($_POST['action'] == 'modall'){
         $pers=$_POST['cudo'];
         $qa='';
         $fe=$pdo->prepare('SELECT cat FROM user WHERE  uiid=:uiid');
         $fe->bindValue(':uiid',$pers);
         $fe->execute();
         $resultc=$fe->fetchAll(PDO::FETCH_ASSOC); 
        foreach($resultc as $resc){
          $qa=$resc['cat'] ?? null;
        }
        
       $fetch=$pdo->prepare('SELECT * FROM temporary WHERE  uid=:uid AND cat=:cat ');
       $fetch->bindValue(':uid',$pers);
       $fetch->bindValue(':cat',$qa);
        $fetch->execute();
        $result=$fetch->fetchAll(PDO::FETCH_ASSOC); 
        foreach($result as $res){
            //1
        $fetch=$pdo->prepare('SELECT question FROM question WHERE cid=:cid AND qid=:qid ');
        $fetch->bindValue(':cid',$qa);
        $fetch->bindValue(':qid',$res['qid']);
        $fetch->execute();
        $quest=$fetch->fetchAll(PDO::FETCH_ASSOC); 
        foreach($quest as $qes){
            $question = $qes['question'];
        }
            //2
            $fetch=$pdo->prepare('SELECT ot FROM option_list WHERE cid=:cid AND qid=:qid AND ono=:ono ');
            $fetch->bindValue(':cid',$qa);
            $fetch->bindValue(':qid',$res['qid']);
            $fetch->bindValue(':ono',$res['uans']);
            $fetch->execute();
            $uans=$fetch->fetchAll(PDO::FETCH_ASSOC); 
            foreach($uans as $uan){
                $uanswer = $uan['ot'];
            }
            //3
            $fetch=$pdo->prepare('SELECT ot FROM option_list WHERE cid=:cid AND qid=:qid AND ono=:ono ');
            $fetch->bindValue(':cid',$qa);
            $fetch->bindValue(':qid',$res['qid']);
            $fetch->bindValue(':ono',$res['cans']);
            $fetch->execute();
            $cans=$fetch->fetchAll(PDO::FETCH_ASSOC); 
            foreach($cans as $can){
                $canswer = $can['ot'];
            }
            $mark = $res['total'] ;
            
            if($res['stat'] == '1')
            {
                $remark = '<h4 class="badge badge-success">Right</h4>';
            }

            else
            {
                $remark = '<h4 class="badge badge-danger">Wrong</h4>';
            }


            echo '
            <tr>
            <td>'.$question.'</td>
            <td>'.$uanswer.'</td>
            <td>'.$canswer.'</td>
            <td>'.$mark.'</td>   
            ';

                if($res['stat'] == '1') {
            
                echo '<td><h4 class="btn btn-success">Right</h4></td>';}
            
               else{
            
            
               echo '<td><h4 class="btn btn-danger">Wrong</h4></td>';
               }
               echo '
                </tr>
                '
                ;
        }
        
        
    }
    if($_POST['action'] == 'modalll'){
      $pers=$_POST['cudon'];
      $qa='';
      $fe=$pdo->prepare('SELECT cat FROM user WHERE  uiid=:uiid');
      $fe->bindValue(':uiid',$pers);
      $fe->execute();
      $resultc=$fe->fetchAll(PDO::FETCH_ASSOC); 
     foreach($resultc as $resc){
       $qa=$resc['cat'] ?? null;
     }
     
    $fetch=$pdo->prepare('SELECT * FROM result WHERE  uid=:uid AND cat=:cat ');
    $fetch->bindValue(':uid',$pers);
    $fetch->bindValue(':cat',$qa);
     $fetch->execute();
     $result=$fetch->fetchAll(PDO::FETCH_ASSOC); 
     foreach($result as $res){
         //1
     $fetch=$pdo->prepare('SELECT question FROM question WHERE cid=:cid AND qid=:qid ');
     $fetch->bindValue(':cid',$qa);
     $fetch->bindValue(':qid',$res['qid']);
     $fetch->execute();
     $quest=$fetch->fetchAll(PDO::FETCH_ASSOC); 
     foreach($quest as $qes){
         $question = $qes['question'];
     }
         //2
         $fetch=$pdo->prepare('SELECT ot FROM option_list WHERE cid=:cid AND qid=:qid AND ono=:ono ');
         $fetch->bindValue(':cid',$qa);
         $fetch->bindValue(':qid',$res['qid']);
         $fetch->bindValue(':ono',$res['uans']);
         $fetch->execute();
         $uans=$fetch->fetchAll(PDO::FETCH_ASSOC); 
         foreach($uans as $uan){
             $uanswer = $uan['ot'];
         }
         //3
         $fetch=$pdo->prepare('SELECT ot FROM option_list WHERE cid=:cid AND qid=:qid AND ono=:ono ');
         $fetch->bindValue(':cid',$qa);
         $fetch->bindValue(':qid',$res['qid']);
         $fetch->bindValue(':ono',$res['cans']);
         $fetch->execute();
         $cans=$fetch->fetchAll(PDO::FETCH_ASSOC); 
         foreach($cans as $can){
             $canswer = $can['ot'];
         }
         $mark = $res['total'] ;
         
         if($res['stat'] == '1')
         {
             $remark = '<h4 class="badge badge-success">Right</h4>';
         }

         else
         {
             $remark = '<h4 class="badge badge-danger">Wrong</h4>';
         }


         echo '
         <tr>
         <td>'.$question.'</td>
         <td>'.$uanswer.'</td>
         <td>'.$canswer.'</td>
         <td>'.$mark.'</td>   
         ';

             if($res['stat'] == '1') {
         
             echo '<td><h4 class="btn btn-success">Right</h4></td>';}
         
            else{
         
         
            echo '<td><h4 class="btn btn-danger">Wrong</h4></td>';
            }
            echo '
             </tr>
             '
             ;
     }   
     
 }
}
if($_POST['page'] == 'registrar')
	{

  }


    if($_POST['page'] == 'regHome')
	  {


    if($_POST['action'] == 'reg_dashboard')

		{
     // echo "7000 Students";
    }
  }
  if($_POST['page'] == 'student')
	{

		if($_POST['action'] == 'uaddnewStudent')
		{
       $sphoni ='';
       $semail ='';
       $estat ='';
       $photo_name ='';
       $duplicate =0;
       $success = 0;
       $error = 0;
       $depart = $_POST['edepari'];
       $reg_by =  $_POST['creator'];
       $date=date('d-m-y H:i:s');
       $stype = 'Student';
       $sql = "SELECT stream, col_id FROM department WHERE dep_id=:datii";
       $dustmt = $pdo->prepare($sql);
       $dustmt->bindValue(':datii', $depart);
       $dustmt->execute();
       $dcolstr = $dustmt->fetchAll(PDO::FETCH_ASSOC);
   foreach($dcolstr as $dep){
     $stream = $dep['stream'] ?? null ;
     $coll = $dep['col_id'] ?? null ;
   }


       if (isset($_FILES['fileInput']['name']) && !empty($_FILES['fileInput']['name'])) {
        $file = $_FILES['fileInput']['tmp_name'];
         $rrow=1;
         
         $spreadsheet = IOFactory::load($file);
         $worksheet = $spreadsheet->getActiveSheet();
        // Prepare the SQL statement
        $snewmy = $pdo->prepare("INSERT INTO examinee (uiid,examinee_type,stream,college,Department,program,ex_group,ex_year,fname,lname,gname,gender,phone,email,email_stat,photo,user_name,password,rpass,date,reg_by) VALUES 
        (:uiid,:etype,:stream,:college,:Department,:prog,:ex_group,:ex_year,:fname,:lname,:gname,:gender,:phone,:email,:email_stat,:photo,:usename,:pword,:rpass,:dte,:reg_by)");
      
        // Iterate through each row in the worksheet and insert data into the database
        foreach ($worksheet->getRowIterator() as $row) {



          // Check if all cells in the row are empty
          $cellIterator = $row->getCellIterator();
          $cellIterator->setIterateOnlyExistingCells(true);

          $isEmptyRow = true;
          
      
          // Retrieve data from the cells in the row
          $fname = $worksheet->getCellByColumnAndRow(2, $row->getRowIndex())->getValue();
          $mname = $worksheet->getCellByColumnAndRow(3, $row->getRowIndex())->getValue();
          $lname = $worksheet->getCellByColumnAndRow(4, $row->getRowIndex())->getValue();
          $sex = $worksheet->getCellByColumnAndRow(5, $row->getRowIndex())->getValue();
          $username = $worksheet->getCellByColumnAndRow(6, $row->getRowIndex())->getValue();
          $group = $worksheet->getCellByColumnAndRow(7, $row->getRowIndex())->getValue();
          $year = $worksheet->getCellByColumnAndRow(8, $row->getRowIndex())->getValue();
         
          $sphoni = $worksheet->getCellByColumnAndRow(9, $row->getRowIndex())->getValue();
          $semail = $worksheet->getCellByColumnAndRow(10, $row->getRowIndex())->getValue();
          if (empty($fname) || empty($mname) || empty($lname) || empty($sex) || empty($username) || empty($group) || empty($year) ) {
            $error++;
            continue; // Skip row with empty column
        }

          if($sex == 'M'){
            $sex ='Male';
          }
          if($sex == 'F'){
            $sex ='Female';
          }

          
          $group = mb_convert_case($group, MB_CASE_TITLE, "UTF-8");



          $slicii= strtoupper(substr($fname, 0, 3));
          $userid = random($slicii);
          $passwordn = random($mname);
          $password = password_hash($passwordn, PASSWORD_BCRYPT);

          $msql = "SELECT * FROM examinee WHERE user_name=:unami";
          $mustmt = $pdo->prepare($msql);
          $mustmt->bindValue(':unami', $username);
          $mustmt->execute();
          $muserd = $mustmt->fetchAll(PDO::FETCH_ASSOC);
          if(count($muserd) > 0){
            $duplicate++;
            continue;
          }

          $sql = "SELECT * FROM examinee WHERE uiid=:idat";
          $ustmt = $pdo->prepare($sql);
          $ustmt->bindValue(':idat', $userid);
          $ustmt->execute();
          $userd = $ustmt->fetchAll(PDO::FETCH_ASSOC);
          
          if(count($userd) > 0){
            $userid = $userid.$fname;
          }


          // Bind the parameter values
          $snewmy->bindValue(':uiid',$userid);  
          $snewmy->bindValue(':etype',$stype); 
          $snewmy->bindValue(':stream',$stream);  
          $snewmy->bindValue(':college',$coll);
          $snewmy->bindValue(':Department',$depart);
          $snewmy->bindValue(':prog','Degree');
          $snewmy->bindValue(':ex_group',$group);  
          $snewmy->bindValue(':ex_year',$year);  
          $snewmy->bindValue(':fname',$fname);
          $snewmy->bindValue(':lname',$mname);
          $snewmy->bindValue(':gname',$lname);  
          $snewmy->bindValue(':gender',$sex);  
          $snewmy->bindValue(':phone',$sphoni);
          $snewmy->bindValue(':email',$semail);
          $snewmy->bindValue(':email_stat',$estat);
          $snewmy->bindValue(':photo',$photo_name);
          $snewmy->bindValue(':usename',$username);  
          $snewmy->bindValue(':pword',$password);
          $snewmy->bindValue(':rpass',$passwordn);
          $snewmy->bindValue(':dte',$date);
          $snewmy->bindValue(':reg_by',$reg_by);
          $snewmy->execute();

          $success++;


        }
        if($success > 0){
        echo '<div class="alert  alert-success" id="susualert" role="alert">
           '.$success.' new pupils have been successfully added!
           <script>
           document.getElementById("uaddnewStudent").reset();
           $("#susualert").alert();
           setTimeout(function() {
           $("#susualert").alert("close");
             }, 20000);
           
           </script>
           </div>';
            }
          if($duplicate > 0){
            echo '<div class="alert  alert-warning" id="ssusualert" role="alert">
            '.$duplicate++.' duplicated pupils have been found!
            <script>
            $("#ssusualert").alert();
            setTimeout(function() {
            $("#ssusualert").alert("close");
              }, 20000);
            
            </script>
            </div>';

          }
          if($error > 0){
            echo '<div class="alert  alert-danger" id="szusualert" role="alert">
            '.$error.' rows  have been skipped!
            <script>
            $("#szusualert").alert();
            setTimeout(function() {
            $("#szusualert").alert("close");
              }, 20000);
            
            </script>
            </div>';

          }




      } else {
        echo "Please select a file.";
      }



    }

		if($_POST['action'] == 'addStudent')
		{
      $output ='';
      $photos= '';
      $photo_name ='';
      $date=date('d-m-y H:i:s');
      $fname=  ucwords(strtolower($_POST['fname']));
      $mname=ucwords(strtolower($_POST['mname']));
      $lname=ucwords(strtolower($_POST['lname']));
      $gender=$_POST['genderi'];
      $depar=$_POST['depari'];
      $program=$_POST['program'];
      $creator=$_POST['creator'];
      $typet=$_POST['typet'];
      $stype=$_POST['stype'];
      $syira=$_POST['syira'];
      $sphoni=$_POST['sphoni'];
      $semail=$_POST['semaili'];
      $photo = $_FILES['photo'] ?? null;
      $accept = ["jpg","jpeg", "png", "gif", "webp",null];

     
    if( $fname  && $mname && $lname && $gender && $depar  && $typet && $stype  && $program     !=null){

      if (filter_var($semail, FILTER_VALIDATE_EMAIL) || $semail =='') { 

        $sql = "SELECT * FROM examinee WHERE email=:idat ";
        $eustmt = $pdo->prepare($sql);
        $eustmt->bindValue(':idat', $semail);
        $eustmt->execute();
        $eemail = $eustmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($eemail) <= 0 || $semail ==''){

      $slicii= strtoupper(substr($fname, 0, 3));
      $userid = random($slicii);
      $llname = strtoupper(substr($lname, 0, 3));
      $username= random($llname);
      $passwordn = random($mname);
      $password = password_hash($passwordn, PASSWORD_BCRYPT);




      $sql = "SELECT stream, col_id FROM department WHERE dep_id=:datii";
          $dustmt = $pdo->prepare($sql);
          $dustmt->bindValue(':datii', $depar);
          $dustmt->execute();
          $dcolstr = $dustmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($dcolstr as $dep){
        $stream = $dep['stream'] ?? null ;
        $coll = $dep['col_id'] ?? null ;
      }

      $sql = "SELECT * FROM examinee WHERE uiid=:idat OR user_name=:unami";
      $ustmt = $pdo->prepare($sql);
      $ustmt->bindValue(':idat', $userid);
      $ustmt->bindValue(':unami', $username);
      $ustmt->execute();
      $userd = $ustmt->fetchAll(PDO::FETCH_ASSOC);
      
      if(count($userd) > 0){
        $userid = $userid.$llname;
        $username = $username.$llname;
      }
     if($photo){
      $ext = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION)) ?? null;
      if  (in_array($ext, $accept)){
        $photo = $_FILES['photo'];

        $photo_name = $userid . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);

        // Upload photo to server
        $target_dir = 'img/examinee/';
        $target_file = $target_dir . $photo_name;
        move_uploaded_file($photo['tmp_name'], $target_file);

      }
    }


      $estat='';
      if($semail !=''){

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
          $mail->Body = '

           <div class="course-info">
           <h2>
          <h5 class="card-title" style="font-size: 1.25rem; margin-bottom: .75rem;">
          <strong style="background-color: #46427c;color: white;padding: 5px;"> Hello,   '.$fname.'   '.$mname.'  '.$lname .' </strong> </h5>
          <p class="card-text" style="font-size: 1rem; margin-bottom: 0;"> Your username is: <strong style="background-color: #3d3f86;color: white; padding: 5px;border-radius: 5px;"> '.$username.' </strong></p>
          <p class="card-text" style="font-size: 1rem; margin-bottom: 0;">Your default password is: <strong style="background-color: #29265c;color: white; padding: 5px;border-radius: 5px;"> '.$passwordn.'</strong></p>
      </h2>
      <p><strong>You can change the default password whenever you want, but you cannot change the default username.
          Also, do not give the above user password and username to anyone.</strong></p>
        </div>




       
          ';
          
          

          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
      
          $mail->send();
        $estat=1;
          
      } catch (Exception $e) {
        $estat=0;
          echo '<div class="alert alert-danger" id ="emailerror" role="alert">
          Message could not be sent. Mailer Error: {$mail->ErrorInfo}
          <script>
          document.getElementById("addnewStudent").reset();
          $("#emailerror").alert();
          setTimeout(function() {
          $("#emailerror").alert("close");
            }, 2000);
            </script>
          </div>';
      }
    }
      $snewmy=$pdo->prepare("INSERT INTO examinee(uiid,examinee_type,stream,college,Department,program,ex_group,ex_year,fname,lname,gname,gender,phone,email,email_stat,photo,user_name,password,rpass,date,reg_by)
            VALUES (:uiid,:etype,:stream,:college,:Department,:prog,:ex_group,:ex_year,:fname,:lname,:gname,:gender,:phone,:email,:email_stat,:photo,:usename,:pword,:rpass,:dte,:reg_by)");
          
           $snewmy->bindValue(':uiid',$userid);  
           $snewmy->bindValue(':etype',$stype); 
           $snewmy->bindValue(':stream',$stream);  
           $snewmy->bindValue(':college',$coll);
           $snewmy->bindValue(':Department',$depar);
           $snewmy->bindValue(':prog',$program);
           $snewmy->bindValue(':ex_group',$typet);  
           $snewmy->bindValue(':ex_year',$syira);  
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
           $snewmy->bindValue(':rpass',$passwordn);
           $snewmy->bindValue(':dte',$date);
           $snewmy->bindValue(':reg_by',$creator);
           $snewmy->execute();

           echo '<div class="alert  alert-success" id="susualert" role="alert">
           The new student has been successfully added!
           <script>
           document.getElementById("addnewStudent").reset();
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
    if($_POST['action'] == 'sdetail')
		{
      $id=$_POST['cudo'];
      $soutput ='';
      $fetch = $pdo->prepare('SELECT * FROM examinee WHERE uiid=:uiid');
      $fetch->bindValue(':uiid', $id);
      $fetch->execute();
      $prof = $fetch->fetchAll(PDO::FETCH_ASSOC);
    
      foreach ($prof as $pro) {
        $cat = $pro['Department'] ?? null;
        $uid = $pro['uiid'] ?? null;
        $uname = $pro['user_name'] ?? null;
        $fname = $pro['fname'] ?? null;
        $lname = $pro['lname'] ?? null;
        $gname = $pro['gname'] ?? null;
        $gend = $pro['gender'] ?? null;
        $egroup = $pro['ex_group'] ?? null;
        $eyear = $pro['ex_year'] ?? null;
        $phone = $pro['phone'] ?? null;
        $image = $pro['photo'] ?? null;
        $stat = $pro['sttatus'] ?? null;
      }
      $fetch = $pdo->prepare('SELECT dep_name FROM department WHERE dep_id=:cid');
      $fetch->bindValue(':cid', $cat);
      $fetch->execute();
      $show = $fetch->fetch(PDO::FETCH_ASSOC);
      
        $catti = $show['dep_name'] ?? null;
      

      $soutput.='
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Student Profile</h5>
      <button type="button" class="btn-close" onclick="window.location.reload()" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <div class="modal-body">
            
       

             <div class="row g-0 d-flex">
               <div class="col-md-4">
                 <div class="row mb-4" >
                   <img src="img/examinee/'.$image.'" class="img-fluid rounded-start" alt="No Image Found!" style="height: 168px;">
                 </div>
               </div>
               <div class="col-md-8">
                 <div class="card mb-4">
                   <div class="card-body">
                     <div class="row">
                       <div class="col-sm-5">
                         <p class="mb-0">Full Name</p>
                       </div>
                       <div class="col-sm-7">
                         <p class="text-muted mb-0" style="text-transform: capitalize ;">'.$fname . ' ' . $lname . ' ' . $gname.'</p>
                       </div>
                     </div>
                     <hr>
                     <div class="row">
                       <div class="col-sm-5">
                         <p class="mb-0">Gender</p>
                       </div>
                       <div class="col-sm-7">
                         <p class="text-muted mb-0" style="text-transform: capitalize ;">'. $gend.'</p>
                       </div>
                     </div>
                     <hr>
                     <div class="row">
                       <div class="col-sm-5">
                         <p class="mb-0">Department</p>
                       </div>
                       <div class="col-sm-7">
                         <p class="text-muted mb-0" style="text-transform: capitalize ;"> '.$catti.' </p>
                       </div>
                     </div>
                     <hr>
                     <div class="row">
                       <div class="col-sm-5">
                         <p class="mb-0">Username</p>
                       </div>
                       <div class="col-sm-7">
                         <p class="text-muted mb-0" style="text-transform: capitalize ;"> '.$uname.'</p>
                       </div>
                     </div>
                     <hr>
                     <div class="row">
                     <div class="col-sm-5">
                       <p class="mb-0">Program</p>
                     </div>
                     <div class="col-sm-7">
                       <p class="text-muted mb-0">'.$pro['program'].'</p>
                     </div>
                   </div>
                   <hr>
                     <div class="row">
                       <div class="col-sm-5">
                         <p class="mb-0">Password</p>
                       </div>
                       <div class="col-sm-7">
                         <p class="text-muted mb-0" style="text-transform: capitalize ;">*************</p>
                       </div>
                     </div>
                     <hr>
                     <div class="row">
                       <div class="col-sm-5">
                         <p class="mb-0">User ID </p>
                       </div>
                       <div class="col-sm-7">
                         <p class="text-muted mb-0" style="text-transform: capitalize ;">'. $uid .'</p>
                       </div>
                     </div>
                     <hr>
                     <div class="row">
                       <div class="col-sm-5">
                         <p class="mb-0">Phone</p>
                       </div>
                       <div class="col-sm-7">
                         <p class="text-muted mb-0">'.$phone.'</p>
                       </div>
                     </div>
                     <hr>

                     <div class="row">
                       <div class="col-sm-5">
                         <p class="mb-0">Status</p>
                       </div>
                       <div class="col-sm-7">';

                        if ($stat == 2) {
                          $soutput.='   <span class="mb-0 badge bg-warning">Pending...</span>';
                        }
                          if ($stat == 1) {
                            $soutput.='  <span class="mb-0 badge bg-success">Active</span>';
                         }
                        if ($stat == 0) {
                          $soutput.=' <span class="mb-0 badge bg-danger">Banned</span>';
                         }

                         $soutput.='    </div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>

     
        </div>';
    echo  $soutput;
    }

		if($_POST['action'] == 'final_stud_upd')
		{
      $output ='';
      $photos= '';
      $date=date('d-m-y H:i:s');
      $fname=  ucwords(strtolower($_POST['fname']));
      $mname=ucwords(strtolower($_POST['mname']));
      $lname=ucwords(strtolower($_POST['lname']));
      $gender=$_POST['genderi'];
      $depar=$_POST['depari'];
      $program=$_POST['program'];
      $typet=$_POST['typet'];
      $stype=$_POST['stype'];
      $syira=$_POST['syira'];
      $sphoni=$_POST['sphoni'];
      $semail=$_POST['semaili'];
      $photop=$_POST['photop'];
      $userid = $_POST['uid'];
      $photo = $_FILES['photo'] ?? null;
      $accept = ["jpg","jpeg", "png", "gif", "webp",null];

     
    if( $fname  && $mname && $lname && $gender && $depar  && $typet && $stype    !=null){

      if (filter_var($semail, FILTER_VALIDATE_EMAIL) || $semail =='') { 

        $sql = "SELECT * FROM examinee WHERE email=:idat ";
        $eustmt = $pdo->prepare($sql);
        $eustmt->bindValue(':idat', $semail);
        $eustmt->execute();
        $eemail = $eustmt->fetchAll(PDO::FETCH_ASSOC);

        if(count($eemail) < 2 || $semail =='' ){

      $sql = "SELECT stream, col_id FROM department WHERE dep_id=:datii";
          $dustmt = $pdo->prepare($sql);
          $dustmt->bindValue(':datii', $depar);
          $dustmt->execute();
          $dcolstr = $dustmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($dcolstr as $dep){
        $stream = $dep['stream'] ?? null ;
        $coll = $dep['col_id'] ?? null ;
      }

      $photo_name = '';

      if($photo != null){
      $ext = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION)) ?? null;
      if  (in_array($ext, $accept)){
        
        $directory = 'img/examinee/';
        $filenameWithoutExtension = $photop;
        
        $files = glob($directory . $filenameWithoutExtension . '.*');
        
        if (!empty($files)) {
            $fileToDelete = $files[0];
            if (is_file($fileToDelete)) {
                unlink($fileToDelete);
            }
        }
       
        $photo = $_FILES['photo'];

        $photo_name = $userid . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);

        // Upload photo to server
        $target_dir = 'img/examinee/';
        $target_file = $target_dir . $photo_name;
        move_uploaded_file($photo['tmp_name'], $target_file);

      }
    }
    else{
      $photo_name =$photop;
    }



           $snewmy = $pdo->prepare("UPDATE examinee 
           SET 
           
               stream = :stream,
               college = :college,
               Department = :Department,
               program = :program,
               ex_group = :ex_group,
               ex_year = :ex_year,
               fname = :fname,
               lname = :lname,
               gname = :gname,
               gender = :gender,
               phone = :phone,
               email = :email,
               photo = :photo

           WHERE uiid = :uiiid");
           $snewmy->bindValue(':uiiid',$userid);  
           $snewmy->bindValue(':stream',$stream);  
           $snewmy->bindValue(':college',$coll);
           $snewmy->bindValue(':Department',$depar);
           $snewmy->bindValue(':program',$program);
           $snewmy->bindValue(':ex_group',$typet);  
           $snewmy->bindValue(':ex_year',$syira);  
           $snewmy->bindValue(':fname',$fname);
           $snewmy->bindValue(':lname',$mname);
           $snewmy->bindValue(':gname',$lname);  
           $snewmy->bindValue(':gender',$gender);  
           $snewmy->bindValue(':phone',$sphoni);
           $snewmy->bindValue(':email',$semail);
           $snewmy->bindValue(':photo',$photo_name);        
          $snewmy->execute();




           echo '<div class="alert  alert-success" id="susualert" role="alert">
           The student profile has been successfully updated!
           <script>
           document.getElementById("addnewStudent").reset();
           $("#susualert").alert();
           setTimeout(function() {
           $("#susualert").alert("close");
             }, 26000);
           
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
		if($_POST['action'] == 'update_student')
		{
      
         $soutput='';
         $uid =$_POST['cudo'];

         $fetch = $pdo->prepare('SELECT * FROM examinee WHERE uiid=:uiid');
         $fetch->bindValue(':uiid',$uid);
         $fetch->execute();
         $epart = $fetch->fetch(PDO::FETCH_ASSOC);
         

        $dfetch = $pdo->prepare('SELECT * FROM department ORDER BY dep_name ASC');
        $dfetch->execute();
        $depart = $dfetch->fetchAll(PDO::FETCH_ASSOC);

         $soutput.='
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Student Profile</h5>
         <button type="button" class="btn-close" onclick="window.location.reload()" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
         <form class="form-group was-validated" id="editStudent" method="POST" enctype="multipart/form-data" action="#">
             <div class="mb-1" id="editStudentsuccess"></div>
             <input type="hidden" value="'.$uid.'" id="uid" name="uid" >
             <div class="row">
                 <div class="col  mb-1">
                     <label class="form-check-label" for="">First Name</label>
                     <input type="text" value="'.$epart['fname'].'" class="form-control" placeholder="First Name" id="fname" required>
                 </div>
                 <div class="col  mb-1">
                     <label class="form-check-label" for="">Middle Name</label>
                     <input type="text" value="'.$epart['lname'].'" class="form-control" placeholder="Middle Name" id="mname" required>
                 </div>
                 <div class="col  mb-1">
                     <label class="form-check-label" for="">Last Name</label>
                     <input type="text" value="'.$epart['gname'].'" class="form-control" placeholder="Last Name" id="lname" required>
                 </div>



             </div>

             <div class="row">
                 <div class="col mb-1">
                     <label>Gender</label>
                     <select id="genderi" name="catid" class="form-select" required aria-label="type">
                         <option value="'.$epart['gender'].'" Selected>'.$epart['gender'].' </option>

                         <option value="Male">Male</option>
                         <option value="Female">Female</option>

                     </select>
                 </div>
                 <div class="col mb-1">
                     <label>Department</label>
                     <select id="depari" name="cdep" class="form-select" required aria-label="type">
                         ';
                         foreach ($depart as $colfep) {  
                          if($epart['Department'] ==  $colfep['dep_id'] ){
                          $soutput.='<option selected value='. $colfep['dep_id'].' >'. $colfep['dep_name'] .'</option>';
                          }
                          $soutput.='<option value='. $colfep['dep_id'].' >'. $colfep['dep_name'] .'</option>';
                      }
                         
                     
                     $soutput.='</select>
                 </div>
                 <div class="col mb-1">
                     <label>Program</label>
                     <select id="sstrm" name="sstrm" class="form-select" required aria-label="stype">
                         <option value="'.$epart['program'].'" Selected>'.$epart['program'].'</option>
                         <option value="Degree">Degree</option>
                         <option value="Masters">Masters</option>
                         <option value="Phd" disabled>Phd</option>
                     </select>
                 </div>
             </div>
             <div class="row">


                 <input id="stype" name="catid" class="form-control" type="hidden" value="Student">

                 <div class="col">
                     <label>Group</label>
                     <select id="typet" name="catid" class="form-select" required aria-label="type">
                         <option value="'.$epart['ex_group'].'" Selected>'.$epart['ex_group'].' </option>
                         <option value="Regular">Regular</option>
                         <option value="Extension">Extension</option>
                         <option value="Summer">Summer</option>
                     </select>
                 </div>

                 <div class="col">
                     <label>Year</label>
                     <select id="syira" name="cyira" class="form-select" required aria-label="type">
                         <option value="'.$epart['ex_year'].'" Selected>'.$epart['ex_year'].' </option>
                         <option value="1">1<sup>st</sup> Year</option>
                         <option value="2">2<sup>nd</sup> Year</option>
                         <option value="3">3<sup>rd</sup> Year</option>
                         <option value="4">4<sup>th</sup> Year</option>
                         <option value="5">5<sup>th</sup> Year</option>
                         <option value="6">6<sup>th</sup> Year</option>

                     </select>
                 </div>
             </div>
             <div class="row">
                 <div class="col  mb-1">
                     <label class="form-check-label" for="">Phone Number</label>
                     <input type="number" value="'.$epart['phone'].'" class="form-control" placeholder="Phone Number" id="sphoni" required>
                 </div>
                 <div class="col  mb-1">
                     <label class="form-check-label" for="">Email</label>
                     <input type="email" value="'.$epart['email'].'" class="form-control" placeholder="Email" id="semaili" required>
                 </div>

             </div>
             <div class="  mb-1">
                 <label class="form-check-label" for="">Photo</label>
                 <input type="hidden" value="'.$epart['photo'].'"  id="photop" name="photop" >
                 <input type="file" class="form-control" id="photo" name="photo" accept=".jpg,.jpeg,.png,.gif,.webp"  >
             </div>

             <div class="modal-footer">
                 <button type="button" onclick="window.location.reload()" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                 <input type="button" name="sent" class="editstudent btn btn-primary" value="Update">
             </div>
         </form>
     </div>
         
         ';

    echo $soutput;



    }




    if($_POST['action'] == 'activ')
    {  
          $uid=$_POST['uid'];
       
        $assteacher=$pdo->prepare("UPDATE examinee SET sttatus = :asteacher WHERE uiid=:bcat  ");
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
            $assteacher=$pdo->prepare("UPDATE examinee SET sttatus = :asteacher WHERE uiid=:bcat  ");
            $assteacher->bindValue(':asteacher', 0);
            $assteacher->bindValue(':bcat',$uid);
            $assteacher->execute();
            echo '<script>
               location.reload();
           
               
               </script>';
    


        }












    if($_POST['action'] == 'deletehead')
    {
      $directory = 'img/examinee/';
        $filenameWithoutExtension = $_POST['uid'];
        
        $files = glob($directory . $filenameWithoutExtension . '.*');
        
        if (!empty($files)) {
            $fileToDelete = $files[0];
            if (is_file($fileToDelete)) {
                unlink($fileToDelete);
            }
        }
      $sql = "DELETE FROM examinee WHERE uiid = :id ";
      $sdtmt = $pdo->prepare($sql);
      $sdtmt->bindValue(':id', $_POST['uid']);
      $sdtmt->execute();

      $asql = "DELETE FROM final_result WHERE uid = :id ";
      $asdtmt = $pdo->prepare($asql);
      $asdtmt->bindValue(':id', $_POST['uid']);
      $asdtmt->execute();
      echo '<div class="alert  alert-success" id="usualert" role="alert">
    The account has been successfully deleted!
    <script>
    onclick="window.location.reload()"
    $("#usualert").alert();
    setTimeout(function() {
    $("#usualert").alert("close");
      }, 28000);
    
    </script>
    </div>';
      
    }

    if($_POST['action'] == 'send_again')
    {
      $uid =$_POST['uid'];

      $fetch = $pdo->prepare('SELECT * FROM examinee WHERE uiid=:uiid');
      $fetch->bindValue(':uiid',$uid);
      $fetch->execute();
      $epart = $fetch->fetch(PDO::FETCH_ASSOC);
      $mname = $epart['lname'];
      $passwordn = random($mname);
      $password = password_hash($passwordn, PASSWORD_BCRYPT);
      $email_stat = '';

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
          $mail->addAddress($epart['email']);     
                    
          $mail->addReplyTo('dkuoes@gmail.com', 'DKU OES');
          
          $mail->isHTML(true);                                  
          $mail->Subject = 'DKU OES';
          $mail->Body = 
          '
          <div class="course-info">
            <h2>
           <h5 class="card-title" style="font-size: 1.25rem; margin-bottom: .75rem;">
           <strong style="background-color: #46427c;color: white;padding: 5px;"> Hello,   '.$epart['fname'].'   '.$epart['lname'].'  '.$epart['gname'].' </strong> </h5>
           <p class="card-text" style="font-size: 1rem; margin-bottom: 0;"> Your username is: <strong style="background-color: #3d3f86;color: white; padding: 5px;border-radius: 5px;"> '.$epart['user_name'].' </strong></p>
           <p class="card-text" style="font-size: 1rem; margin-bottom: 0;">Your default password is: <strong style="background-color: #29265c;color: white; padding: 5px;border-radius: 5px;"> '.$passwordn.'</strong></p>
       </h2>
       <p><strong>You can change the default password whenever you want, but you cannot change the default username.
           Also, do not give the above user password and username to anyone.</strong></p>
         </div>
          ';
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
      
          $mail->send();
          $email_stat=1;
          
      
          echo '<div class="alert  alert-success" id="usualert" role="alert">
          The confirmation code has been successfully sendede to  '.$epart['fname'].'!
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
            }, 25000)
            </script>;
          </div>';
      }

      $snewmy = $pdo->prepare("UPDATE examinee 
      SET password = :pass , rpass=:rpass, email_stat=:email_stat WHERE uiid = :uiiid");
      $snewmy->bindValue(':uiiid',$uid);  
      $snewmy->bindValue(':pass',$password);   
      $snewmy->bindValue(':rpass',$passwordn);         
      $snewmy->bindValue(':email_stat',$email_stat);               
      $snewmy->execute();



     
      
    }


  }
  if($_POST['page'] == 'depCollege')
	{
            if($_POST['action'] == 'addcollege')
            {
               $stream =  $_POST['stream'];
               $cname =  $_POST['cname'];   
              if( $stream  && $cname !=null){

                $slicii= strtoupper(substr($cname, 0, 6));
                $colid = random($slicii);
                
            $sql = "SELECT * FROM college WHERE col_name=:idat OR col_id=:utipi ";
            $eustmt = $pdo->prepare($sql);
            $eustmt->bindValue(':idat', $cname);
            $eustmt->bindValue(':utipi', $colid);
            $eustmt->execute();
            $eemail = $eustmt->fetchAll(PDO::FETCH_ASSOC);

          if(count($eemail) <= 0){



              $ins=$pdo->prepare("INSERT INTO college(col_id,stream,col_name) 
              VALUES(:depa,:uiiid,:utyp)");
              $ins->bindValue(':depa',$colid);
              $ins->bindValue(':uiiid',$stream);
              $ins->bindValue(':utyp',$cname);
              $ins->execute();
              echo '<div class="alert  alert-success" id="usualert" role="alert">
              The new college has been successfully added!
              <script>
              document.getElementById("finaladdcol").reset();
              $("#usualert").alert();
              setTimeout(function() {
              $("#usualert").alert("close");
                }, 26000);
              
              </script>
              </div>';

          }

        else{
          echo '<div class="alert alert-danger" role="alert">
          Sorry, the college name is already exist!
          </div>';
        }
        }
        else {
          echo '<div class="alert alert-danger" role="alert">
          Please fill the form correctlly
          </div>';
        }

    }


    if($_POST['action'] == 'adddepa')
		{


               $stream =  $_POST['cid'];
               $cname =  $_POST['dname'];   
              if( $stream  && $cname !=null){

                $slicii= strtoupper(substr($cname, 0, 6));
                $colid = random($slicii);
                
            $sql = "SELECT * FROM department WHERE dep_name=:idat OR dep_id=:utipi ";
            $eustmt = $pdo->prepare($sql);
            $eustmt->bindValue(':idat', $cname);
            $eustmt->bindValue(':utipi', $colid);
            $eustmt->execute();
            $eemail = $eustmt->fetchAll(PDO::FETCH_ASSOC);

          if(count($eemail) <= 0){

            $sql = "SELECT stream FROM college WHERE col_id=:utipi ";
            $aeustmt = $pdo->prepare($sql);
            $aeustmt->bindValue(':utipi', $stream);
            $aeustmt->execute();
            $aeemail = $aeustmt->fetch(PDO::FETCH_ASSOC);


              $ins=$pdo->prepare("INSERT INTO department(dep_id,col_id,stream,dep_name) 
              VALUES(:depa,:colid,:uiiid,:utyp)");
              $ins->bindValue(':depa',$colid);
              $ins->bindValue(':colid',$stream);
              $ins->bindValue(':uiiid',$aeemail['stream']);
              $ins->bindValue(':utyp',$cname);
    
              $ins->execute();
              echo '<div class="alert  alert-success" id="usualert" role="alert">
              The new department has been successfully added!
              <script>
              document.getElementById("finaladddepa").reset();
              $("#usualert").alert();
              setTimeout(function() {
              $("#usualert").alert("close");
                }, 26000);
              
              </script>
              </div>';

          }

        else{
          echo '<div class="alert alert-danger" role="alert">
          Sorry, the department name is already exist!
          </div>';
        }
        }
        else {
          echo '<div class="alert alert-danger" role="alert">
          Please fill the form correctlly
          </div>';
        }

    }



              if($_POST['action'] == 'eaddcollege')
              {
                 $stream =  $_POST['stream'];
                 $cname =  $_POST['cname']; 
                 $uid =  $_POST['uid'];   
                if( $stream  && $cname !=null){
  
                 
                  $colid = $uid;
                  
              $sql = "SELECT * FROM college WHERE col_name=:idat OR col_id=:utipi ";
              $eustmt = $pdo->prepare($sql);
              $eustmt->bindValue(':idat', $cname);
              $eustmt->bindValue(':utipi', $colid);
              $eustmt->execute();
              $eemail = $eustmt->fetchAll(PDO::FETCH_ASSOC);
  
            if(count($eemail) < 2){
  
  
  
              $update = $pdo->prepare("UPDATE college SET stream = :uiiid, col_name = :utyp WHERE col_id = :depa");
              $update->bindValue(':uiiid', $stream);
              $update->bindValue(':utyp', $cname);
              $update->bindValue(':depa', $colid);
              $update->execute();
              

                echo '<div class="alert  alert-success" id="usualert" role="alert">
                The new college has been successfully updated!
                <script>
                document.getElementById("finaladdcol").reset();
                $("#usualert").alert();
                setTimeout(function() {
                $("#usualert").alert("close");
                  }, 26000);
                
                </script>
                </div>';
  
            }
  
          else{
            echo '<div class="alert alert-danger" role="alert">
            Sorry, the college name is already exist!
            </div>';
          }
          }
          else {
            echo '<div class="alert alert-danger" role="alert">
            Please fill the form correctlly
            </div>';
          }
  
      }
  
  
      if($_POST['action'] == 'eadddepa')
      {
  
                 $uid =  $_POST['uid'];   
                 $stream = trim($_POST['cid']);
                 $cname =  $_POST['dname'];                  
              if( $stream  && $cname !=null){
  
                  
                  $colid = $uid;
                  
              $sql = "SELECT * FROM department WHERE dep_name=:idat OR dep_id=:utipi ";
              $eustmt = $pdo->prepare($sql);
              $eustmt->bindValue(':idat', $cname);
              $eustmt->bindValue(':utipi', $colid);
              $eustmt->execute();
              $eemail = $eustmt->fetchAll(PDO::FETCH_ASSOC);
  
            if(count($eemail) < 2){
  
              $sql = "SELECT stream FROM college WHERE col_id=:utipi ";
              $aeustmt = $pdo->prepare($sql);
              $aeustmt->bindValue(':utipi', $stream);
              $aeustmt->execute();
              $aeemail = $aeustmt->fetch(PDO::FETCH_ASSOC);
  
  


                $upd = $pdo->prepare("UPDATE department SET col_id = :colid, stream = :uiiid, dep_name = :utyp WHERE dep_id = :depid");
                $upd->bindValue(':colid', $stream);
                $upd->bindValue(':uiiid', $aeemail['stream']);
                $upd->bindValue(':utyp', $cname);
                $upd->bindValue(':depid', $colid);
                $upd->execute();
      
                
                echo '<div class="alert  alert-success" id="usualert" role="alert">
                The new department has been successfully updated!
                <script>
                document.getElementById("finaladdcol").reset();
                $("#usualert").alert();
                setTimeout(function() {
                $("#usualert").alert("close");
                  }, 26000);
                
                </script>
                </div>';
  
            }
  
          else{
            echo '<div class="alert alert-danger" role="alert">
            Sorry, the department name is already exist!
            </div>';
          }
          }
          else {
            echo '<div class="alert alert-danger" role="alert">
            Please fill the form correctlly
            </div>';
          }
  
      }


  
    if($_POST['action'] == 'college_delete')
		{
      $sql = "DELETE FROM college WHERE col_id = :id ";
      $sdtmt = $pdo->prepare($sql);
      $sdtmt->bindValue(':id', $_POST['uid']);
      $sdtmt->execute();
      echo '<div class="alert  alert-success" id="usualert" role="alert">
    The college has been successfully deleted!
    <script>
    $("#usualert").alert();
    setTimeout(function() {
    $("#usualert").alert("close");
      }, 20000);
    
    </script>
    </div>';


    }
    if($_POST['action'] == 'depa_delete')
		{

      $sql = "DELETE FROM department WHERE dep_id = :id ";
      $sdtmt = $pdo->prepare($sql);
      $sdtmt->bindValue(':id', $_POST['uid']);
      $sdtmt->execute();
      echo '<div class="alert  alert-success" id="usualert" role="alert">
    The department has been successfully deleted!
    <script>
    $("#usualert").alert();
    setTimeout(function() {
    $("#usualert").alert("close");
      }, 20000);
    
    </script>
    </div>';
      
    }



    if($_POST['action'] == 'col_edit')
		{
        $output='';
        $uid =$_POST['uid'];
  
        $fetch = $pdo->prepare('SELECT * FROM college WHERE col_id=:uiid');
        $fetch->bindValue(':uiid',$uid);
        $fetch->execute();
        $epart = $fetch->fetch(PDO::FETCH_ASSOC);

       $output.='
       <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Edit College</h5>
       <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">

       <form class="form-group was-validated" id="efinaladdcol" method="POST" action="#">
         <div class="mb-1" id="ecolsuccess"></div>
         <div class="mb-1">
           <label>College Name</label>
           <input type="text" class="form-control" value="'.$epart['col_name'].'" id="cname" name="cname" required placeholder="Enter college name">
         </div>
             <input type="hidden" name="uid" value="'.$epart['col_id'].'" id="uid" >
         <div class=" mb-1">
           <label>Stream</label>
           <select id="stream" name="stream" class="form-select" required aria-label="type">';
           if($epart['stream'] =='NS'){
             
           $output.='    <option value="'.$epart['stream'].'" selected>Natural Science</option>';
           }
           else{
            $output.='    <option value="'.$epart['stream'].'" selected>Social Science</option>';
           }

             $output.=' <option value="NS">Natural Science</option>
             <option value="SC">Social Science</option>
           </select>
           
         </div>

     </div>
     <div class="modal-footer">
     <button type="button" onclick="window.location.reload()" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
     <input type="button" name="sent" class="efinalcoll btn btn-primary" value="Update">
   </div>
   </form>
       ';

       echo  $output;
    }
    if($_POST['action'] == 'depa_edit')
		{
      $output='';
      $uid =$_POST['uid'];
      $fetch = $pdo->prepare('SELECT * FROM college ORDER BY col_name ASC');
      $fetch->execute();
      $cat = $fetch->fetchAll(PDO::FETCH_ASSOC);

      $fetch = $pdo->prepare('SELECT * FROM department WHERE dep_id=:uiid');
      $fetch->bindValue(':uiid',$uid);
      $fetch->execute();
      $epart = $fetch->fetch(PDO::FETCH_ASSOC);

      $output.='
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Department</h5>
      <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">

      <form class="form-group was-validated" id="efinaladddepa" method="POST" action="#">
        <div class="mb-1" id="edepasuccess"></div>
        <input type="hidden" name="uid" value="'.$epart['dep_id'].'" id="uid" >
        <div class="mb-1">
          <label>Name</label>
          <input type="text" class="form-control" value="'.$epart['dep_name'].'" id="dname" name="dname" required placeholder="Enter department name">
        </div>

        <div class=" mb-1">
          <label>College</label>
          <select id="coltype" name="coltype" class="form-select" required aria-label="taype">
            <option value></option>';

            foreach ($cat as $colfep) {
              if($epart['col_id'] == $colfep['col_id']){
              $output.='     <option value=" '.$colfep['col_id'].' " selected>'.$colfep['col_name'].'</option>';
              }
              $output.='     <option value=" '.$colfep['col_id'].' " >'.$colfep['col_name'].'</option>';

            }

            $output.='</select>
          
        </div>

    </div>

    <div class="modal-footer">
      <button type="button" onclick="window.location.reload()" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      <input type="button" name="sent" class="efinaldepa btn btn-primary" value="Update">
    </div>
    </form>
      
      
      
      ';
     echo  $output;


    }

















      
    }
  
  
  
  
  
  
  }

}else{
  header("Location: session.php");
  exit();
}

                          function random($slici){
                            $char='1234567899877655442211123';
                            $str= $slici;
                            $num='';
                            for($i=0;$i<4;$i++)
                            {
                                $index=rand(0,strlen($char) -1 );
                                $str  .=$char[$index];
                            }
                            $num=$num.$str;
                            return $num;
                          }
