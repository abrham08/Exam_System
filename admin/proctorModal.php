<?php
session_start();
if (isset($_SESSION['exam_id'])  && $_SESSION['tdepar'] ) {
    include "dbc.php";
    if (isset($_POST['page'])) {
        if ($_POST['page'] == 'proctorPage') {

            if ($_POST['action'] == 'active_exmainee') {
                $mfetch=$pdo->prepare('SELECT DISTINCT * FROM temporary WHERE cat_id=:cat AND exam_id=:uisd AND exam_type=:typei GROUP BY uid');
                $mfetch->bindValue(':cat', $_POST['cat_id']);
                $mfetch->bindValue(':uisd',$_POST['exam_id']);
                $mfetch->bindValue(':typei', 'Real');
                $mfetch->execute();
                $mprof=$mfetch->fetchAll(PDO::FETCH_ASSOC);
                echo  count($mprof);
            }
            if ($_POST['action'] == 'load_exmainee') {

                $output='';
                $cat_id = $_POST['cat_id'];
                $exam_id= $_POST['exam_id'];
                $etype= $_POST['etype'];
                $tdepar =$_POST['tdepart'];

                $mfetch=$pdo->prepare('SELECT DISTINCT * FROM temporary WHERE cat_id=:cat AND exam_id=:uisd AND exam_type=:typei GROUP BY uid');
                $mfetch->bindValue(':cat',$cat_id  );
                $mfetch->bindValue(':uisd',$exam_id );
                $mfetch->bindValue(':typei',$etype );
                $mfetch->execute();
                $mprof=$mfetch->fetchAll(PDO::FETCH_ASSOC);
                $output.='  <table id="datatableid" class="table table-striped table-hover container table-hover">
                    <thead><tr>
                    <th scope="col"> Photo</th>
                    <th scope="col"> Full Name</th>
                    <th scope="col"> Discipline</th>
                    <th scope="col"> Status </th>
                    <th scope="col"> Progress </th>
                    <th scope="col"> Action </th>
                </tr>
            </thead><tbody id="">   ';
                foreach($mprof as $mpro){

                     
                    
            $output.='                  <tr>';
                 
                 
                      
                      $fet=$pdo->prepare('SELECT * FROM examinee WHERE uiid=:cat AND Department=:depa');
                      $fet->bindValue(':cat',$mpro['uid']);
                      $fet->bindValue(':depa',$tdepar);
                      $fet->execute();
                      $pr=$fet->fetchAll(PDO::FETCH_ASSOC);

                      $wfet=$pdo->prepare('SELECT * FROM displine WHERE uid=:catn AND cat_id=:cat AND exam_id=:uisd AND wtype=:wtype');
                      $wfet->bindValue(':catn',$mpro['uid']);
                      $wfet->bindValue(':cat',$cat_id  );
                      $wfet->bindValue(':uisd',$exam_id );
                      $wfet->bindValue(':wtype',1 );
                      $wfet->execute();
                      $wpr=$wfet->fetchALL(PDO::FETCH_ASSOC);
                 
                     
                    foreach($pr as $user){
                         

                        $dstmt = $pdo->prepare("SELECT * FROM final_result WHERE uid = :uid AND cat_id = :cat AND exam_id = :eid ");
                        $dstmt->bindValue(':uid', $user['uiid']);
                        $dstmt->bindValue(':cat', $cat_id);
                        $dstmt->bindValue(':eid', $exam_id);
                        $dstmt->execute();
                        $dat = $dstmt->rowCount();

                        $output.=' <td><button class="border-primary"><img src="img/examinee/'.$user['photo'].'" onclick="enlargePhoto(this)" alt="No Image" style="width:2cm; height:1.5cm;"></td>
                      <td>'.$user['fname'].' '.$user['lname'].'</button></td>
                     
                      <td>';
                      $output.='  '. count($wpr).' Warnings 
                        </td>
                      <td>';
                      if($dat > 0){
                        $output.='     <span class="mb-0 badge bg-success">Complete</span>  ';

                      }
                      else{
                        if($user['sttatus'] == 1){
                            $output.='     <span class="mb-0 badge bg-success">Active</span>  ';
                        }
                         if($user['sttatus'] != 1){
                            $output.='   <span class="mb-0 badge bg-danger">Blocked</span>  '; 
                         }
                        }
                 
              $output.=' </td>
                     <td>';

                     $stmt = $pdo->prepare("SELECT * FROM question WHERE cat_id = :cat AND exam_id = :eid");
                     $stmt->bindValue(':cat', $cat_id);
                     $stmt->bindValue(':eid', $exam_id);
                     $stmt->execute();
                     $num = $stmt->rowCount();

                     $stmt = $pdo->prepare("SELECT * FROM temporary WHERE uid = :uid AND cat_id = :cat AND exam_id = :eid AND uans !=:uan");
                     $stmt->bindValue(':uid', $user['uiid']);
                     $stmt->bindValue(':cat', $cat_id);
                     $stmt->bindValue(':eid', $exam_id);
                     $stmt->bindValue(':uan', '');
                     $stmt->execute();
                     $at = $stmt->rowCount();
                     
                     
                     
                     $output.=' '.$at.'/'.$num.'   </td>
                        
                 
                 <td>
                             
                 <div style="display: flex;">
                 <div class="dropdown px-0">
                       <a href="#" class="d-flex align-items-center text-black btn btn-sm btn-warning text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                       <strong>Warning</strong>
                       </a>
                       <ul class="dropdown-menu text-small  ">
                       <li class="dropdown-item">
                   
                       <form id="wwreason'.$mpro['uid'].'"  method="POST" action="#">
                                     <textarea name="reason'.$mpro['uid'].'" id="wreason'.$mpro['uid'].'" placeholder="Enter the reason" required></textarea>
                                     <button type="button" value="'.$mpro['uid'].'"  name="ban" 
                                     data-cid="'.$cat_id.'" data-eid="'.$exam_id.'"class="btnwarnag btn btn-sm btn-warning" >Warn</button>
                        </form></li>
                       
                       </ul>
                     </div>
                     <div class="dropdown ms-4">
                       <a href="#" class="d-flex align-items-center text-white btn btn-sm btn-danger text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                       <strong>Block</strong>
                       </a>
                       <ul class="dropdown-menu text-small  ">
                       <li class="dropdown-item">
                   
                       <form id="bbreason'.$mpro['uid'].'"  method="POST" action="#">
                                     <textarea id="breason'.$mpro['uid'].'"  name="reason" placeholder="Enter the reason" required></textarea>
                                     <button type="button" value="'.$mpro['uid'].'" 
                                     data-cid="'.$cat_id.'" data-eid="'.$exam_id.'" name="ban" class="btnblockag btn btn-sm btn-danger" >Block</button>
                        </form></li>
                       
                       </ul>
                     </div>
                 </div>
                   
                 </td>';
                     
                         }
                         $output.='</tr> ';
                 
                        }
                        $output.='</tbody>
                        </table>';

                echo $output;
                

            }

            if ($_POST['action'] == 'warning') {
               
                $date=date('d-m-y');
                $time=date('H:i:s a');
                $cat_id = $_POST['cat_id'];
                $exam_id= $_POST['exam_id'];
                $uid= $_POST['uid'];
                $reason= $_POST['reason'];
                $sttmt=$pdo->prepare("INSERT INTO displine(wtype,uid,cat_id,exam_id,reason,blocker,date,time)
                VALUES (:wtype,:uid,:cat,:eid,:etyp,:correct,:tdate,:ttime)");
                $sttmt->bindValue(':wtype',1);
                $sttmt->bindValue(':uid',$uid);
                $sttmt->bindValue(':cat',$cat_id);
                $sttmt->bindValue(':eid',$exam_id);
                $sttmt->bindValue(':etyp',$reason);
                $sttmt->bindValue(':correct',$_SESSION['tuid']);
                $sttmt->bindValue(':tdate',$date);
                $sttmt->bindValue(':ttime',$time);
                $sttmt->execute();
                echo '<div class="alert alert-success">Successfully Warned</div>';
            }

            if ($_POST['action'] == 'onoff') {

				$stmt=$pdo->prepare("UPDATE assexam SET im_status = :stat WHERE exam_id=:uiid AND assigned_Department=:assd");
				 $stmt->bindValue(':stat',$_POST['onie']);
                 $stmt->bindValue(':uiid',$_POST['exam_id']);
                 $stmt->bindValue(':assd',$_POST['tdepart']);
				 $stmt->execute();
                 echo '<script>
                 location.reload();
             
                 
                 </script>';
            }
           
            if ($_POST['action'] == 'block') {
               
                $date=date('d-m-y');
                $time=date('H:i:s a');
                $cat_id = $_POST['cat_id'];
                $exam_id= $_POST['exam_id'];
                $uid= $_POST['uid'];
                $reason= $_POST['reason'];
 
                $ufetch=$pdo->prepare('SELECT * FROM displine WHERE uid=:uiid AND cat_id=:cat AND exam_id=:eid AND wtype=:wtype');
                $ufetch->bindValue(':wtype',2);
                $ufetch->bindValue(':uiid',$uid);
                $ufetch->bindValue(':cat',$cat_id);
                $ufetch->bindValue(':eid',$exam_id);
                $ufetch->execute();
                $uresult=$ufetch->fetchAll(PDO::FETCH_ASSOC);

                if(count($uresult) == 0){
                $sttmt=$pdo->prepare("INSERT INTO displine(wtype,uid,cat_id,exam_id,reason,blocker,date,time)
                VALUES (:wtype,:uid,:cat,:eid,:etyp,:correct,:tdate,:ttime)");
                $sttmt->bindValue(':wtype',2);
                $sttmt->bindValue(':uid',$uid);
                $sttmt->bindValue(':cat',$cat_id);
                $sttmt->bindValue(':eid',$exam_id);
                $sttmt->bindValue(':etyp',$reason);
                $sttmt->bindValue(':correct',$_SESSION['tuid']);
                $sttmt->bindValue(':tdate',$date);
                $sttmt->bindValue(':ttime',$time);
                $sttmt->execute();

				$stmt=$pdo->prepare("UPDATE examinee SET sttatus = :stat WHERE uiid=:uiid");
				 $stmt->bindValue(':stat',0);
                 $stmt->bindValue(':uiid',$uid);

				 $stmt->execute();


                echo '<div class="alert alert-success">Successfully blocked</div>';
                }
                else{
                    echo '<div class="alert alert-danger">The examinee already blocked!</div>';
                }
            }

        }
    }



}else{
	header("Location: ../index");
	exit();
}

?>