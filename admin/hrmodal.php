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
if (isset($_SESSION['hruid'])) {




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
          $exam_date=$ca['exam_date'];
          $start_time = $ca['start_time'];
          $apply_limit = $ca['apply_limit'];
          $required_limit = $ca['required_limit'];
          $stat = $ca['stat'];
          
        }

       
        
    
        $boutpu.='
        <div class="modal-header">
        <h5 class="modal-title" id="mexampleModalLabel">Edit Job :<b class="color-primary"> '. $cname .'</b></h5>
        <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
          <div id="success_updatebig"></div>
          <form class="form-group was-validated" id="bigcupdate" method="POST" action="#" >
          <div class="mb-1">
          <label  class="fs-5" >Job Title </label>
          <input type = "hidden" value= "'.$cat_id.'" id="bigcat_id" >
          <input type="text" class="form-control" value="'.$cname.'" id="bigucname" name="ucname" required placeholder="Enter job title"></div>
          <div class="mb-1">
          <label class="fs-5" >Apply Limit</label>
          <input type="number" class="form-control" value="'.$apply_limit.'" id="bigalimit" name="alimit" required placeholder="Enter apply limit" ></div>
          <div class=" mb-1">
           <label class="fs-5" >Required Candidate</label>
           <input type="number" class="form-control" value="'.$required_limit.'" id="bigrlimit" name="rlimit" required placeholder="Enter Required candidate number" >
           </div>
           ';
    
             $boutpu.='  
                      
                    
                    <div class=" mb-1">
                    <div class="row">
                    <div class="col">
                    <label class="fs-5">Exam_Date</label>
                    <input type="date" class="form-control"  value="'.$exam_date.'"  id="bigedate" name="edate" required placeholder="Enter exam date">
                    </div>
                    <div class="col">
                    <label class="fs-5">Exam_Time</label>
                    <input type="time" class="form-control"  value="'.$start_time.'"  id="bigetime" name="etime" required placeholder="Enter exam time">
                    </div>
                </div>                        
                      
                      ';
                      
    
        $boutpu.='       
                      
         </div>
          <div class="row">
            <div class="col mb-1">
              <label class="fs-5" >Type</label>
                <select id="biguctype" name="uctype" value=" " class="form-select" required aria-label="type">
                <option value="HR" selected>HR</option>                                        
                </select>
                <div class="invalid-feedback">Please, select the category</div>
            </div> 
            <div class="col mb-1">
            <label class="fs-5" >Status</label>
              <select id="bigstati" name="stati" value=" " class="form-select" required aria-label="type">';

              if($stat == 1 ){
                $boutpu.='<option value="1" selected><span class="d-inline-block bg-success rounded-circle p-1"></span> Activated</option> 
                <option value="0" ><span class="d-inline-block bg-danger rounded-circle p-1"></span> Deactivate</option>  ';    

              }
              else{
                $boutpu.='<option value="0" selected><span class="d-inline-block bg-danger rounded-circle p-1"></span> Deactivated</option> 
                <option value="1" ><span class="d-inline-block bg-success rounded-circle p-1"></span> Activate</option>  ';  
              }
              
              
              $boutpu.='     </select>
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
                
        
                $asdfetch = $pdo->prepare('SELECT cat_no FROM asscategory WHERE Department=:deppin AND cat_id=:cid');
                $asdfetch->bindValue(':deppin',$depid);
                $asdfetch->bindValue(':cid',$id);
                $asdfetch->execute();
                $asdepart = $asdfetch->fetch(PDO::FETCH_ASSOC);
                $asnum=$asdepart['cat_no'];

                $csdfetch = $pdo->prepare('SELECT id FROM course WHERE Department=:deppin AND cat_id=:cid AND catDepartment=:catdep');
                $csdfetch->bindValue(':deppin',$depid);
                $csdfetch->bindValue(':cid',$id);
                $csdfetch->bindValue(':catdep','HR');
                $csdfetch->execute();
                $csdepart = $csdfetch->fetch(PDO::FETCH_ASSOC);
                $conum=$csdepart['id'];


                $lsdfetch = $pdo->prepare('SELECT * FROM department ORDER BY dep_name ASC ');
                $lsdfetch->execute();
                $lsdepart = $lsdfetch->fetchAll(PDO::FETCH_ASSOC);

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
    
               
    
                $output .= '
                                  
                                
                                <div class="modal-header">
                                <h5 class="modal-title" id="mexampleModalLabel">Edit Request :<b class="color-primary"> '. $cname .'</b></h5>
                                <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                                <div class="modal-body">
                                  <div id="success_update"></div>
                                  <form class="form-group was-validated" id="cupdate" method="POST" action="#" >
                                    <input type="hidden" id="asnum" value="'.$asnum.'"> 
                                    <input type="hidden" id="conum" value="'.$conum.'"> 
                                  <div class="row">
                                  <div class="col-5 mb-1">
                                    <label class="fs-5" >Job Title</label>
                                    <select id="ucatid" name="ucatid" class="form-select" required aria-label="type">
                                      
                                        </option>
                                        
                                          <option value="'.$id.' " selected disabled>'.$cname.'</option>
                                        
                                    </select>
                                    <div class="invalid-feedback">Please, select the category</div>
                                  </div>
                                  <div class="col-7 mb-1">
                                    <label class="fs-5">Department</label>
                                    <select id="ucdep" name="ucdep" class="form-select" required aria-label="type">
                                      
                                      
                                        <option value="'.$depid.' " selected >'.$depname.' </option>';
                                        foreach($lsdepart as $plsls){
                                    $output .= '<option value="'. $plsls['dep_id'].' "  >'. $plsls['dep_name'].' </option>';
                                        }
                                      
                                      
                                $output .= '    </select>
                                    <div class="invalid-feedback">Please, select the department</div>
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
                 $alimit=$_POST['alimit'];
                $rlimit=$_POST['rlimit'];
                $edate=$_POST['edate'] ?? '';
                $etime=$_POST['etime'] ?? '';
                $cctyped=$_POST['cctyped'];
                $stati=$_POST['stati'];

            if($acname && $rlimit && $alimit && $cctyped    !=null){

                $bfetch=$pdo->prepare('SELECT * FROM category WHERE cat_id=:uiid OR cat_name = :cname AND college=:coll');
                $bfetch->bindValue(':uiid',$acpid);
                $bfetch->bindValue(':cname',$acname);
                $bfetch->bindValue(':coll','HR');
                $bfetch->execute();
                $bcat=$bfetch->fetchAll(PDO::FETCH_ASSOC);
              if(count($bcat) > 0){     
                echo '
                
                <div class="alert alert-danger" role="alert">
               The job title already existed!
                              </div>
                ';
                
              }  
            else{ 
            $cmy=$pdo->prepare("INSERT INTO category(cat_id,cat_code,college,stream,cat_type,cat_name,exam_date,start_time,apply_limit,required_limit,stat,date)
            VALUES (:cati,:cid,:colity,:strm,:ctype,:cname,:edate,:etime,:alimit,:rlimit,:stat,:cdate)");
         
           $cmy->bindValue(':cati',$acpid);  
            $cmy->bindValue(':ctype',$cctyped);
            $cmy->bindValue(':cid','HR');
            $cmy->bindValue(':strm','HR');
            $cmy->bindValue(':colity','HR');
            $cmy->bindValue(':cname',$acname);

            $cmy->bindValue(':edate',$edate);
            $cmy->bindValue(':etime',$etime);
            $cmy->bindValue(':alimit',$alimit);
            $cmy->bindValue(':rlimit',$rlimit);
            $cmy->bindValue(':stat',$stati);

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
                  
                  $cpid=$_POST['cid'];
                  $truedep='HR';
                  $depa=$_POST['depa'] ?? null;
           if(  $cpid && $depa    !=null){
    

            $bfetch=$pdo->prepare('SELECT * FROM course WHERE cat_id=:uiid AND Department = :cname AND catDepartment=:cdepapa ');
            $bfetch->bindValue(':uiid',$cpid);
            $bfetch->bindValue(':cname',$depa);
            $bfetch->bindValue(':cdepapa',$truedep);
            $bfetch->execute();
            $bcat=$bfetch->fetchAll(PDO::FETCH_ASSOC);

                    if(count($bcat) > 0 ){
                      echo '
                      
                      <div class="alert alert-danger" role="alert">
                      Please select another department to replicate category name or code!
                                    </div>
                      ';
                      
                    }  
                 
                  
                else{ 
    
                 
                $cmy=$pdo->prepare("INSERT INTO asscategory(Department,cat_id,date)
                VALUES (:depa,:cati,:cdate)");
              
               $cmy->bindValue(':depa',$depa);  
               $cmy->bindValue(':cati',$cpid);  
                $cmy->bindValue(':cdate',$date);
                $cmy->execute();
                  
           
                $sccmy=$pdo->prepare("INSERT INTO course(catDepartment,Department,cat_id)
                VALUES (:catDepar,:depa,:cati)");
    
              $sccmy->bindValue(':catDepar',$truedep);
               $sccmy->bindValue(':depa',$depa);  
               $sccmy->bindValue(':cati',$cpid);  

                $sccmy->execute();

                  echo' 
                  <div class="alert  alert-success" id="ssualert" role="alert">
                        Category assignment successfully done!
                        <script>
                        document.getElementById("addcat").reset();
                        $("#ssualert").alert();
                        setTimeout(function() {
                        $("#ssualert").alert("close");
                          }, 2000);
                          
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
                
         if($_POST['action'] == 'bigcuupdate')
    
                {
                  $bumain_p = $_POST['bumain_p'];
                  $bucname=$_POST['bucname'];

                  $bigalimit=$_POST['bigalimit'];
                  $bigrlimit=$_POST['bigrlimit'];
                  $bigedate=$_POST['bigedate'];
                  $bigetime=$_POST['bigetime'];
                  $bigstati=$_POST['bigstati'];

    
                  $bfetch=$pdo->prepare('SELECT * FROM category WHERE cat_id=:uid  ');
                  $bfetch->bindValue(':uid',$bumain_p);
                  $bfetch->execute();
                  $bcat=$bfetch->fetchAll(PDO::FETCH_ASSOC);
                  foreach($bcat as $bca){
              
                    $bcname=$bca['cat_name'];
                    $bctype=$bca['apply_limit'];
                    $bcid = $bca['required_limit'];                    
                    $stat = $bca['stat']; 
                    $dates = $bca['exam_date']; 
                    $times = $bca['start_time'];                    

                  }
                  if( $bucname  && $bigalimit && $bigrlimit    !=null){
                    if ($bigedate == $dates && $bigetime == $times && $bucname == $bcname && $bigalimit == $bctype && $bigrlimit == $bcid && $bigstati == $stat ) {
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
                      $bsttmt=$pdo->prepare("UPDATE category SET cat_name = :catis, apply_limit = :apply_limit,required_limit=:required_limit,
                      exam_date=:exam_date,start_time = :start_time ,stat = :stat WHERE cat_id=:bcat  ");
                      
                      $bsttmt->bindValue(':catis',$bucname);
                      $bsttmt->bindValue(':apply_limit',$bigalimit);
                      $bsttmt->bindValue(':required_limit',$bigrlimit);
                      $bsttmt->bindValue(':exam_date',$bigedate);
                      $bsttmt->bindValue(':start_time',$bigetime);
                      $bsttmt->bindValue(':stat',$bigstati);
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
                  
    
                  
                 
                 $ucpid = $_POST['umain_p'];
                 $conum = $_POST['conum'];
                 $asnum = $_POST['asnum'];
                  $udepa=$_POST['udepa'];
    
    
    
    
           if( $ucpid  && $udepa !=null){
            $sql = "SELECT * FROM course WHERE assigned_teacher IS NOT NULL AND cat_id=:catii AND Department=:depr";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':catii', $ucpid);  
            $stmt->bindValue(':depr', $udepa);  
            $stmt->execute();
            $tresults = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if(count($tresults) == 0){

              $sql = "SELECT Department FROM course WHERE cat_id=:catii AND id=:dedspr AND catDepartment=:cadep";
              $nustmt = $pdo->prepare($sql);
              $nustmt->bindValue(':catii', $ucpid);
              $nustmt->bindValue(':dedspr', $conum);  
              $nustmt->bindValue(':cadep', 'HR');  
              $nustmt->execute();
              $sucgroup = $nustmt->fetch(PDO::FETCH_ASSOC);
              
            if ($udepa == $sucgroup['Department']) {
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
                $bsttmt=$pdo->prepare("UPDATE course SET Department = :catis
                WHERE cat_id=:bcat AND  id=:dedspr AND catDepartment=:cadep");
                
                $bsttmt->bindValue(':catis',$udepa);

                $bsttmt->bindValue(':dedspr',$conum);
                $bsttmt->bindValue(':cadep','HR');

                $bsttmt->bindValue(':bcat',$ucpid);
                $bsttmt->execute();



                $bsttmt=$pdo->prepare("UPDATE asscategory SET Department = :catis
                WHERE cat_id=:bcat AND  cat_no=:dedspr");
                
                $bsttmt->bindValue(':catis',$udepa);

                $bsttmt->bindValue(':dedspr',$asnum);
                $bsttmt->bindValue(':bcat',$ucpid);
                $bsttmt->execute();

             
            echo '<div class="alert  alert-success" id="usualert" role="alert">
            The job category has been successfully updated!
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
              Sorry, you can not update this job category since the teacher has been assigned!
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
    
    $check_sql = "SELECT COUNT(*) FROM course WHERE cat_id=:catii AND Department=:depdd AND assigned_teacher !=:atech ";
    $check_stmt = $pdo->prepare($check_sql);
    $check_stmt->bindValue(':catii', $dcpid);
    $check_stmt->bindValue(':depdd', $department);
    $check_stmt->bindValue(':atech', 'empty');
    $check_stmt->execute();
    $dependency_count = $check_stmt->fetchColumn();
    
    if ($dependency_count > 0) {
        
        echo '<div class="alert  alert-danger" id="udsualert" role="alert">
        Sorry, you can not delete this category since the examiner has been assigned!
    
        </div>';
    } else {
        $delete_sql = "DELETE FROM course WHERE cat_id = :id AND Department=:tdepdd";
        $delete_stmt = $pdo->prepare($delete_sql);
        $delete_stmt->bindValue(':id', $dcpid);
        $delete_stmt->bindValue(':tdepdd', $department);
        $delete_stmt->execute();
    
        $ddelete_sql = "DELETE FROM asscategory WHERE cat_id = :iid AND Department=:mdepdd";
        $ddelete_stmt = $pdo->prepare($ddelete_sql);
        $ddelete_stmt->bindValue(':iid', $dcpid);
        $ddelete_stmt->bindValue(':mdepdd', $department);
        $ddelete_stmt->execute();
    
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
           $ophoni && $sphoni && $semail && $plocation && $photo && $dodoc && $kebeleid   !=null){
    
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
            $target_dir = 'img/examinee/';
            $target_file = $target_dir . $photo_name;
            move_uploaded_file($photo['tmp_name'], $target_file);
    
          }

          $kebeleext = strtolower(pathinfo($kebeleid["name"], PATHINFO_EXTENSION)) ?? null;
          if  (in_array($kebeleext, $accept)){
           // $kebeleid = $kebeleid["name"];
    
            $kebelephoto_name = $userid . '.' . pathinfo($kebeleid['name'], PATHINFO_EXTENSION);
    
            // Upload photo to server
            $target_dir = 'img/examinee/kebeleid/';
            $kebeletarget_file = $target_dir . $kebelephoto_name;
            move_uploaded_file($kebeleid['tmp_name'], $kebeletarget_file);
    
          }

          $certificateext = strtolower(pathinfo($dodoc["name"], PATHINFO_EXTENSION)) ?? null;
          if  (in_array($certificateext, $accept)){
          //  $dodoc = $dodoc["name"];
    
            $docphoto_name = $userid . '.' . pathinfo($dodoc['name'], PATHINFO_EXTENSION);
    
            // Upload photo to server
            $target_dir = 'img/examinee/certificate/';
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
              document.getElementById("addnewStudent").reset();
              $("#emailerror").alert();
              setTimeout(function() {
              $("#emailerror").alert("close");
                }, 2000);
                </script>
              </div>';
          }
    
          $snewmy=$pdo->prepare("INSERT INTO examinee(uiid,examinee_type,stream,college,Department,program,fname,lname,gname,gender,phone,email,email_stat,photo,user_name,password,date,
          job_cat,o_phone,p_location,nationality,e_back,field_study,n_id,doc)
                VALUES (:uiid,:etype,:stream,:college,:Department,:prog,:fname,:lname,:gname,:gender,:phone,:email,:email_stat,:photo,:usename,:pword,:dte,
              :job_cat,:o_phone,:p_location,:nationality,:e_back,:field_study,:n_id,:doc  )");
              
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
        //update candidate
        if($_POST['action'] == 'update_student')
		{
      
         $soutput='';
         $uid =$_POST['cudo'];

         $fetch = $pdo->prepare('SELECT * FROM examinee WHERE uiid=:uiid AND  examinee_type=:caatimp');
         $fetch->bindValue(':caatimp', 'Applicant');
         $fetch->bindValue(':uiid',$uid);
         $fetch->execute();
         $epart = $fetch->fetch(PDO::FETCH_ASSOC);
         

        $dfetch = $pdo->prepare('SELECT * FROM category WHERE cat_type=:catimp AND stat=:stat ORDER BY cat_name ASC');
        $dfetch->bindValue(':catimp', 'HR');
        $dfetch->bindValue(':stat', '1');

        $dfetch->execute();
        $depart = $dfetch->fetchAll(PDO::FETCH_ASSOC);

         $soutput.='
         <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit Candidate Profile</h5>
         <button type="button" class="btn-close" onclick="window.location.reload()" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">
         <form class="form-group was-validated" id="editStudent" method="POST" enctype="multipart/form-data" action="#">
             <div class="mb-1" id="editStudentsuccess"></div>
             <input type="hidden" value="'.$uid.'" id="uid" name="uid" >
             <div class="row">
                 <div class="col  mb-1">
                     <label class="form-check-label" for="">First Name</label>
                     <input type="text" value="'.$epart['fname'].'" class="form-control" placeholder="First Name" name="fname" id="fname" required>
                 </div>
                 <div class="col  mb-1">
                     <label class="form-check-label" for="">Middle Name</label>
                     <input type="text" value="'.$epart['lname'].'" class="form-control" placeholder="Middle Name" name="mname" id="mname" required>
                 </div>
                 <div class="col  mb-1">
                     <label class="form-check-label" for="">Last Name</label>
                     <input type="text" value="'.$epart['gname'].'" class="form-control" placeholder="Last Name" name="lname" id="lname" required>
                 </div>



             </div>

             <div class="row">
                 <div class="col mb-1">
                     <label>Gender</label>
                     <select id="genderi" name="genderi" class="form-select" required aria-label="type">
                         <option value="'.$epart['gender'].'" Selected>'.$epart['gender'].' </option>

                         <option value="Male">Male</option>
                         <option value="Female">Female</option>

                     </select>
                 </div>
                 <div class="col mb-1">
                     <label>Job Category</label>
                     <select id="depari" name="depari" class="form-select" required aria-label="type">
                         ';
                         foreach ($depart as $colfep) {  
                          if($epart['job_cat'] ==  $colfep['cat_id'] ){
                          $soutput.='<option selected value='. $colfep['cat_id'].' >'. $colfep['cat_name'] .'</option>';
                          }
                          $soutput.='<option value='. $colfep['cat_id'].' >'. $colfep['cat_name'] .'</option>';
                      }
                         
                     
                     $soutput.='</select>
                 </div>
                 <div class="col mb-1">
                     <label>Nationality</label>
                     <select id="nationality" name="nationality" class="form-select" required aria-label="stype">
                         <option value="'.$epart['nationality'].'" Selected>'.$epart['nationality'].'</option>
                         <option value="Ethopian">Ethopian</option>
                        <option value="Sudaneez">Sudaneez</option>
                        <option value="French">French</option>
                        <option value="Somalia">Somalia</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Indiaan">India</option>
                     </select>
                 </div>
             </div>
             <div class="row">


                 <input id="stype" name="catid" class="form-control" type="hidden" value="Student">

                 <div class="col">
                     <label>Field Of Study</label>
                     <input type="text" value="'.$epart['field_study'].'" class="form-control" placeholder="Field of Study" name="fstudy" id="fstudy" required>                              

                 </div>

                 <div class="col">
                     <label>Educational Background</label>
                     <select id="ebackground" name="ebackground" class="form-select" required aria-label="type">
                         <option value="'.$epart['e_back'].'" Selected>'.$epart['e_back'].' </option>
                         <option value="Grade 12 completed">Grade 12 completed</option>
                         <option value="Level-I completed">Level-I completed</option>
                         <option value="Level-II completed">Level-II completed</option>
                         <option value="Level-III completed">Level-III completed</option>
                         <option value="Level-IV completed">Level-IV completed</option>
                         <option value="Level-V completed">Level-V completed</option>
                         <option value="BA/BSc/First degree graduate">BA/BSc/First degree graduate</option>
                         <option value="Masters/Second degree graduate">Masters/Second degree graduate</option>
                         <option value="Masters/Second degree graduate">PHD/Third degree graduate</option>

                     </select>
                 </div>
             </div>
             <div class="row">
                 <div class="col  mb-1">
                     <label class="form-check-label" for="">Phone Number</label>
                     <input type="number" value="'.$epart['phone'].'" class="form-control" placeholder="Phone Number" name="sphoni" id="sphoni" required>
                 </div>
                 <div class="col  mb-1">
                     <label class="form-check-label" for="">Alternative Phone Number(Optional)</label>
                     <input type="number" value="'.$epart['o_phone'].'" class="form-control" placeholder="Email" name="ophoni"  id="ophoni" required>
                 </div>

             </div>
             <div class="row">
             <div class="col  mb-1">
                 <label class="form-check-label" for="">Physical Location(City)</label>
                 <input type="text" value="'.$epart['p_location'].'" class="form-control" placeholder="Phone Number" name="plocation" id="plocation" required>
             </div>
             <div class="col  mb-1">
                 <label class="form-check-label" for="">Email</label>
                 <input type="email" value="'.$epart['email'].'" class="form-control" placeholder="Email" name="semaili"  id="semaili" required>
             </div>

            </div>


             
             <div class="  mb-1">
                 <label class="form-check-label" for="">Photo</label>
                 <input type="hidden" value="'.$epart['photo'].'"  id="photop" name="photop" >
                 <input type="file" class="form-control" id="photo" name="photo" accept=".jpg,.jpeg,.png,.gif,.webp"  >
             </div>
             <div class="  mb-1">
                 <label class="form-check-label" for="">Renewed Kebele Id/Passport</label>
                 <input type="hidden" value="'.$epart['n_id'].'"  id="kebeleidp" name="kebeleidp" >
                 <input type="file" class="form-control" id="kebeleid" name="kebeleid" accept=".jpg,.jpeg,.png,.gif,.webp,.PDF,.pdf,.doc,.docx"  >
             </div>
             <div class="  mb-1">
                 <label class="form-check-label" for="">Educational certificates and Birth certificate</label>
                 <input type="hidden" value="'.$epart['doc'].'"  id="dodocp" name="dodocp" >
                 <input type="file" class="form-control" id="dodoc" name="dodoc" accept=".jpg,.jpeg,.png,.gif,.webp,.PDF,.pdf,.doc,.docx"  >
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

     //update candidate

     if($_POST['action'] == 'final_stud_upd')
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






   $photop=$_POST['photop'];
   $kebeleidp=$_POST['kebeleidp'];
   $dodocp=$_POST['dodocp'];


   $userid = $_POST['uid'];
   $accept = ["jpg","jpeg", "png", "gif", "webp","PDF", "pdf", "doc", "docx",null];

  
 if( $fname  && $mname && $lname && $gender && $depar  && $fstudy && $ebackground && 
 $ophoni && $sphoni && $semail && $plocation && $photop && $dodocp && $kebeleidp    !=null){

   if (filter_var($semail, FILTER_VALIDATE_EMAIL)) { 

     $sql = "SELECT * FROM examinee WHERE email=:idat ";
     $eustmt = $pdo->prepare($sql);
     $eustmt->bindValue(':idat', $semail);
     $eustmt->execute();
     $eemail = $eustmt->fetchAll(PDO::FETCH_ASSOC);

     if(count($eemail) < 2){
   $photo_name = '';
   $Kebele_p = '';
   $doc_p = '';

   if($photo != null){
   $ext = strtolower(pathinfo($photo["name"], PATHINFO_EXTENSION)) ?? null;
   if  (in_array($ext, $accept)){
     
     $directory = 'img/examinee/';
     $filenameWithoutExtension = $photop;
     
     $files = glob($directory . $filenameWithoutExtension);
     
     if (!empty($files)) {
         $fileToDelete = $files[0];
         if (is_file($fileToDelete)) {
             unlink($fileToDelete);
         }
     }
    
     $photo_name = $userid . '.' . pathinfo($photo["name"], PATHINFO_EXTENSION);

     // Upload photo to server
     $target_dir = 'img/examinee/';
     $target_file = $target_dir . $photo_name;
     move_uploaded_file($photo['tmp_name'], $target_file);

   }
 }
 else{
   $photo_name =$photop;
 }



 if($kebeleid != null){
    $ext = strtolower(pathinfo($kebeleid["name"], PATHINFO_EXTENSION)) ?? null;
    if  (in_array($ext, $accept)){
      
      $ffilenameWithoutExtension = $kebeleidp;
      
      $files = glob($ffilenameWithoutExtension);
      
      if (!empty($files)) {
          $fileToDelete = $files[0];
          if (is_file($fileToDelete)) {
              unlink($fileToDelete);
          }
      }
     
      $Kebele_p = $userid . '.' . pathinfo($kebeleid["name"], PATHINFO_EXTENSION);
 
      // Upload photo to server
      $ttarget_dir = 'img/examinee/kebeleid/';
      $kKebele_p = $ttarget_dir . $Kebele_p;
      move_uploaded_file($kebeleid['tmp_name'], $kKebele_p);
 
    }
  }
  else{
    $Kebele_p =$kebeleidp;
  }


  if($dodoc != null){
    $ext = strtolower(pathinfo($dodoc["name"], PATHINFO_EXTENSION)) ?? null;
    if  (in_array($ext, $accept)){
      
      $fdilenameWithoutExtension = $dodocp;
      
      $files = glob($fdilenameWithoutExtension);
      
      if (!empty($files)) {
          $fileToDelete = $files[0];
          if (is_file($fileToDelete)) {
              unlink($fileToDelete);
          }
      }
     
      $doc_p= $userid . '.' . pathinfo($dodoc["name"], PATHINFO_EXTENSION);
 
      // Upload photo to server
      $gtarget_dir = 'img/examinee/certificate/';
      $docms = $gtarget_dir . $doc_p;
      move_uploaded_file($dodoc['tmp_name'],  $docms);
 
    }
  }
  else{
    $doc_p =$dodocp;
  }



  


        $snewmy = $pdo->prepare("UPDATE examinee 
        SET 
        
        p_location = :p_location,
        nationality = :nationality,
        e_back = :e_back,
        field_study = :field_study,

            job_cat = :job_cat,
            o_phone = :o_phone,

            fname = :fname,
            lname = :lname,
            gname = :gname,
            gender = :gender,
            phone = :phone,
            email = :email,

            photo = :photo,
            n_id =:n_id,
            doc= :doc

        WHERE uiid = :uiiid");
        $snewmy->bindValue(':uiiid',$userid); 

        $snewmy->bindValue(':p_location',$plocation);  
        $snewmy->bindValue(':nationality',$nationality);
        $snewmy->bindValue(':e_back',$ebackground);
        $snewmy->bindValue(':field_study',$fstudy);

        $snewmy->bindValue(':job_cat',$depar);  
        $snewmy->bindValue(':o_phone',$ophoni);

        $snewmy->bindValue(':fname',$fname);
        $snewmy->bindValue(':lname',$mname);
        $snewmy->bindValue(':gname',$lname);  
        $snewmy->bindValue(':gender',$gender);  
        $snewmy->bindValue(':phone',$sphoni);
        $snewmy->bindValue(':email',$semail);

        $snewmy->bindValue(':photo',$photo_name); 
        $snewmy->bindValue(':n_id',$Kebele_p); 
        $snewmy->bindValue(':doc',$doc_p); 

       $snewmy->execute();




        echo '<div class="alert  alert-success" id="susualert" role="alert">
        The candidate profile has been successfully updated!
        <script>
        $("#susualert").alert();
        setTimeout(function() {
        $("#susualert").alert("close");
          }, 3000);
        
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
 $cat = $pro['job_cat'] ?? null;
 $uid = $pro['uiid'] ?? null;
 $uname = $pro['nationality'] ?? null;
 $fname = $pro['fname'] ?? null;
 $lname = $pro['lname'] ?? null;
 $gname = $pro['gname'] ?? null;
 $gend = $pro['gender'] ?? null;
 $egroup = $pro['ex_group'] ?? null;
 $eyear = $pro['ex_year'] ?? null;
 $phone = $pro['phone'] ?? null;
 $image = $pro['photo'] ?? null;
 $stat = $pro['vstatus'] ?? null;
}
$fetch = $pdo->prepare('SELECT cat_name FROM category WHERE cat_id=:cid');
$fetch->bindValue(':cid', $cat);
$fetch->execute();
$show = $fetch->fetch(PDO::FETCH_ASSOC);

 $catti = $show['cat_name'] ?? null;


$soutput.='
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">Candidate Profile</h5>
<button type="button" class="btn-close" onclick="window.location.reload()" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
     
  
<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item" role="presentation">
  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Personal Detail</button>
</li>
<li class="nav-item" role="presentation">
  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Kebele/Passport ID</button>
</li>
<li class="nav-item" role="presentation">
  <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Educational Certificates</button>
</li>
</ul>
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

<div class="row g-0 d-flex">
<div class="col-md-4">
  <div class="row mb-4" >
    <img src="img/examinee/'.$image.'" class="img-fluid rounded-start" alt="No Image Found!" style="height: 168px;width:200px;">
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
          <p class="mb-0">Job Category</p>
        </div>
        <div class="col-sm-7">
          <p class="text-muted mb-0" style="text-transform: capitalize ;"> '.$catti.' </p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-5">
          <p class="mb-0">Nationality</p>
        </div>
        <div class="col-sm-7">
          <p class="text-muted mb-0" style="text-transform: capitalize ;"> '.$uname.'</p>
        </div>
      </div>
      <hr>
      <div class="row">
      <div class="col-sm-5">
        <p class="mb-0">Field of Study</p>
      </div>
      <div class="col-sm-7">
        <p class="text-muted mb-0">'.$pro['field_study'].'</p>
      </div>
    </div>
    <hr>
      <div class="row">
        <div class="col-sm-5">
          <p class="mb-0">Educational Background</p>
        </div>
        <div class="col-sm-7">
          <p class="text-muted mb-0" style="text-transform: capitalize ;">'.$pro['e_back'].'</p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-5">
          <p class="mb-0">Physical Location </p>
        </div>
        <div class="col-sm-7">
          <p class="text-muted mb-0" style="text-transform: capitalize ;">'. $pro['p_location'] .'</p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-5">
          <p class="mb-0">Phone Number</p>
        </div>
        <div class="col-sm-7">
          <p class="text-muted mb-0">'.$phone.'</p>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-5">
          <p class="mb-0">Alternative Phone Number</p>
        </div>
        <div class="col-sm-7">
          <p class="text-muted mb-0">'.$pro['o_phone'].'</p>
        </div>
      </div>
      <hr>

      <div class="row">
        <div class="col-sm-5">
          <p class="mb-0">Status</p>
        </div>
        <div class="col-sm-7">';

         if ($stat == 0) {
           $soutput.='   <span class="mb-0 badge bg-warning">Pending...</span>';
         }
           if ($stat == 1) {
             $soutput.='  <span class="mb-0 badge bg-success">Accepted</span>';
          }
         if ($stat == 2) {
           $soutput.=' <span class="mb-0 badge bg-danger">Rejected</span>';
          }

          $soutput.='    </div>
      </div>
    </div>
  </div>
</div>
</div>





</div>
<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
<div class="row mb-4" >
    <img src="img/examinee/kebeleid/'.$pro['n_id'].'" class="img-fluid rounded-start" alt="No Image Found!" style="height: 168px;width:200px;">
  </div>


</div>
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">.333..



</div>
</div>


 </div>';
echo  $soutput;
}




if($_POST['action'] == 'deletehead')

{
    $uid=$_POST['uid'];
    $fetch = $pdo->prepare('SELECT * FROM examinee WHERE uiid=:uiid AND examinee_type=:etype');
    $fetch->bindValue(':uiid', $uid);
    $fetch->bindValue(':etype', 'Applicant');
    $fetch->execute();
    $prof = $fetch->fetch(PDO::FETCH_ASSOC);



    $directory = 'img/examinee/certificate/';
    $fdilenameWithoutExtension = $prof['doc'] ;
      
    $files = glob($directory.$fdilenameWithoutExtension);
    
    if (!empty($files)) {
        $fileToDelete = $files[0];
        if (is_file($fileToDelete)) {
            unlink($fileToDelete);
        }
    }

    $directory = 'img/examinee/kebeleid/';
    $ffilenameWithoutExtension = $prof['n_id'] ;
      
    $files = glob($directory.$ffilenameWithoutExtension);
    
    if (!empty($files)) {
        $fileToDelete = $files[0];
        if (is_file($fileToDelete)) {
            unlink($fileToDelete);
        }
    }



    $directory = 'img/examinee/';
    $filenameWithoutExtension = $prof['photo'] ?? null;
    
    $files = glob($directory . $filenameWithoutExtension);
    
    if (!empty($files)) {
        $fileToDelete = $files[0];
        if (is_file($fileToDelete)) {
            unlink($fileToDelete);
        }
    }



  $sql = "DELETE FROM examinee WHERE uiid = :id AND examinee_type=:etype";
  $sdtmt = $pdo->prepare($sql);
  $sdtmt->bindValue(':id', $_POST['uid']);
  $sdtmt->bindValue(':etype','Applicant');
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
  $email_stat='';

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
        </script>
      </div>';
  }

  $snewmy = $pdo->prepare("UPDATE examinee 
  SET password = :pass,email_stat=:estat WHERE uiid = :uiiid");
  $snewmy->bindValue(':uiiid',$uid);  
  $snewmy->bindValue(':estat',$email_stat);  
  $snewmy->bindValue(':pass',$password);         
  $snewmy->execute();


}


if($_POST['action'] == 'activ')
{  
      $uid=$_POST['uid'];
   
    $assteacher=$pdo->prepare("UPDATE examinee SET vstatus = :asteacher WHERE uiid=:bcat  ");
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
        $assteacher=$pdo->prepare("UPDATE examinee SET vstatus = :asteacher WHERE uiid=:bcat  ");
        $assteacher->bindValue(':asteacher', 2);
        $assteacher->bindValue(':bcat',$uid);
        $assteacher->execute();
        echo '<script>
           location.reload();
       
           
           </script>';



    }


//////////
        }



    }

else{
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