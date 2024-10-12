<?php 
session_start();

include "dbc.php";
//if (isset($_SESSION['stuid'])) {

if(isset($_POST['page']))
{
if($_POST['page'] == 'exam')
	{
		if($_POST['action'] == 'warning')
		{
			$oute='';
			$cat_id= $_POST['cat_id'];
			$exam_id= $_POST['exam_id'];
			$user = $_POST['user'];

			$ufetch=$pdo->prepare('SELECT * FROM displine WHERE uid=:uiid AND cat_id=:cat AND exam_id=:eid AND wtype=:wtype');
			$ufetch->bindValue(':wtype',2);
			$ufetch->bindValue(':uiid',$user);
			$ufetch->bindValue(':cat',$cat_id);
			$ufetch->bindValue(':eid',$exam_id);
			$ufetch->execute();
			$uresult=$ufetch->fetchAll(PDO::FETCH_ASSOC);

			$ufetch=$pdo->prepare('SELECT * FROM displine WHERE uid=:uiid AND cat_id=:cat AND exam_id=:eid AND wtype=:wtype AND rread=:rr');
			$ufetch->bindValue(':wtype',1);
			$ufetch->bindValue(':uiid',$user);
			$ufetch->bindValue(':cat',$cat_id);
			$ufetch->bindValue(':eid',$exam_id);
			$ufetch->bindValue(':rr',1);
			$ufetch->execute();
			$wuresult=$ufetch->fetch(PDO::FETCH_ASSOC);
			
			if(count($uresult)>0){
				echo '1';			}
		    if(!empty($wuresult['uid'])){
							
			$oute='<div id="warningModalhdbgcl" data-bs-backdrop="static" class="modal modal-edu-general FullColor-popup-DangerModal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header header-color-modal bg-color-3">
						<h4 class="modal-title"></h4>
						<div class="modal-close-area modal-close-df">

						</div>
					</div>
					<div class="modal-body">
					    <span><i class="fa fa-message-exclamation fa-shake fa-2xl" style="color: #fdb10d;"></i></span>
						<h2>Warning!</h2>
						<p>'.$wuresult['reason'].'!</p>
					</div>
					<div class="modal-footer d-flex justify-content-center">
					<button value="'.$user.'" data-cid="'.$cat_id.'" data-eid="'.$exam_id.'" 
					 type="button" class="okokwawa btn btn-warning" data-bs-dismiss="modal" aria-label="Close">Ok</button>
					</div>
				</div>
			</div>
		   </div>';
		   echo $oute;
			}
		}
		if($_POST['action'] == 'accept_warning')
		{
			$cat_id= $_POST['cat_id'];
			$exam_id= $_POST['exam_id'];
			$user = $_POST['user'];

			$stmt=$pdo->prepare("UPDATE displine SET rread = :rstat WHERE cat_id=:cid AND exam_id=:eid AND uid=:uiid AND wtype=:wt");
			$stmt->bindValue(':cid',$cat_id);
			$stmt->bindValue(':eid',$exam_id);
			$stmt->bindValue(':wt',1);
			$stmt->bindValue(':uiid',$user);
			$stmt->bindValue(':rstat',0);

			$stmt->execute();

		}


		if($_POST['action'] == 'load_question')
		{
			$ufetch=$pdo->prepare('SELECT sttatus FROM examinee WHERE uiid=:uiid ');
			$ufetch->bindValue(':uiid',$_POST['user']);
			$ufetch->execute();
			$uresult=$ufetch->fetchAll(PDO::FETCH_ASSOC);
			foreach($uresult as $use){
				//$stat=$use['sttatus'];
				$stat=1;
			}
            if($stat !=1){
				echo "<script>
				var myButton= document.getElementById('submitAns');
				myButton.click();
				var conf = confirm('Sorry, You are blocked beacause of displine! ');
					if(conf == true){

						window.location='index'; 
					
					}
							else{
								window.location='index'; 

					}
				
				</script> ";

			}
			else{

				$output = '';
			
				$arri = array_filter($_POST['jsArray']);
				$typinet = $_POST['qtype'];
                if($_POST['qid'] == null){
					$_POST['qid'] = $arri[1];
				}
     if($typinet == ''){
				$etch=$pdo->prepare('SELECT quest_type FROM question WHERE cat_id=:cid AND exam_id=:exid AND quest_id=:qid');
				$etch->bindValue(':cid',$_POST['cat_id']);
				$etch->bindValue(':exid',$_POST['exam_id']);
				$etch->bindValue(':qid',trim($_POST['qid']));
				$etch->execute();
				$types=$etch->fetchAll(PDO::FETCH_ASSOC);
				foreach($types as $typi)
				{
					$typinet = $typi['quest_type'];
				}
			}
			
   if($typinet == 'choose'){
				$fetch=$pdo->prepare('SELECT * FROM question WHERE cat_id=:cid AND quest_type=:qtype AND exam_id=:exid AND quest_id=:qid');
				$fetch->bindValue(':cid',$_POST['cat_id']);
				$fetch->bindValue(':exid',$_POST['exam_id']);
				$fetch->bindValue(':qtype','choose');
				$fetch->bindValue(':qid',$_POST['qid']);
				$fetch->execute();
				$result=$fetch->fetchAll(PDO::FETCH_ASSOC);
			

				$indexu = array_search($_POST['qid'], $arri);

			$output = '';
			// $cmark = '';
			foreach($result as $row)
			{
				$fetch=$pdo->prepare('SELECT right_ans FROM question  WHERE cat_id=:cid AND exam_id=:exid AND quest_type=:qtype AND quest_id=:qid');
				$fetch->bindValue(':cid',$_POST['cat_id']);
				$fetch->bindValue(':exid',$_POST['exam_id']);
				$fetch->bindValue(':qtype','choose');
				$fetch->bindValue(':qid',$row['quest_id']);
				$fetch->execute();
				$resultd=$fetch->fetchAll(PDO::FETCH_ASSOC);
				$dmquestion = decryptText($row['question']);
				// if (strpos($dmquestion, "/p") != 0) {
				// 	$dmquestion = substr($dmquestion, 3);
				// 	$dmquestion = substr($dmquestion, 0, -5);
				// }
				$dmquestion = preg_replace('/<p[^>]*>(.*?)<\/p>/i', '$1', $dmquestion);
				
				foreach($resultd as $rowi){
				$cmark=$rowi['right_ans'];
				}
			   if($row['question_image'] !='' ){
				$output .= '<img src="admin/img/question/'.$row['question_image'].'" onclick="enlargePhoto(this)" class="mx-5" width="400" height="150">';
			   }
				$output .= '
				<h5>'.'<b class="text-primary">'.$indexu.'</b>'.'. '.$dmquestion.'(<b class="text-primary">'.$cmark.'</b><sub>Pt</sub>)</h5>
				<hr />
				<br />
				<div class="row" style="height: auto;">
				';
				$fetch=$pdo->prepare('SELECT * FROM option_list WHERE cat_id=:cid AND exam_id=:exid AND quest_type=:qtype AND quest_id=:qid ORDER BY opt_no ASC');
				$fetch->bindValue(':cid',$_POST['cat_id']);
				$fetch->bindValue(':exid',$_POST['exam_id']);
				$fetch->bindValue(':qtype','choose');
				$fetch->bindValue(':qid',$row['quest_id']);
				$fetch->execute();
				$sub_result=$fetch->fetchAll(PDO::FETCH_ASSOC);

				$count = 1;
				$dchoose='';
				$d="A";
				// $di=$_POST['array'];
				foreach($sub_result as $sub_row)
				{ 
					$dchoose = $sub_row['ot'];
				    // if (strpos($dchoose, "/p") != 0) {
					// $dchoose = substr($dchoose, 3);
					// $dchoose = substr($dchoose, 0, -4);
				    //  }
					$dchoose = preg_replace('/<p[^>]*>(.*?)<\/p>/i', '$1', $dchoose);
					$sql = mysqli_query($conn,"SELECT uans FROM temporary  WHERE cat_id ='$_POST[cat_id]' AND quest_type = 'choose' AND uans='$count' AND exam_id='$_POST[exam_id]' AND qid= '$sub_row[quest_id]' AND  uid='$_POST[user]' ");
					$row =mysqli_fetch_array($sql);
					if(is_array($row)){
                               


						
					$output .= '
					<div class="row mb-2">';
					if($sub_row['option_image'] !='' ){
						$output .= '<img src="admin/img/option/'.$sub_row['option_image'].'" onclick="enlargePhoto(this)" class="mx-1" width="10" height="160">';
					   }
					   $output .= '<div class="radio">
							<label><h5><input type="radio" checked  name="option_1" id="'.$count.'" class=" answer_option optionbox form-check-input " 
							 value="'.$sub_row['opt_no'].'" data-check="'.$sub_row['quest_id'].'m'.$count.'"  data-linku="'.$sub_row['quest_id'].'"
							 data-qid="'.$sub_row['quest_id'].'" data-id="'.$count.'"/>'.$d.')&nbsp;'.$dchoose.'</h5></label>
						</div>
					</div>
					';
                    }
					else{
						$output .= '
					<div class="row mb-2">';
					if($sub_row['option_image'] !='' ){
						$output .= '<img src="admin/img/option/'.$sub_row['option_image'].'" onclick="enlargePhoto(this)" class="mx-1" width="170" height="160">';
					   }
					   $output .= '	<div class="radio">
						
							<label><h5><input type="radio"  name="option_1" id="'.$count.'"  
							class=" answer_option optionbox form-check-input "  value="'.$sub_row['opt_no'].'" 
							data-check="'.$sub_row['quest_id'].'m'.$count.'"  data-qid="'.$sub_row['quest_id'].'" data-id="'.$count.'" 
							onclick="hide();"  />'.$d.')&nbsp;'.$dchoose.'</h5></label>
						</div>
						<script> function hide() {
							
							document.getElementById("<?php echo $count?>").checked = true;
						}
						</script>
					</div>
					';
                    
					}
					$d++;
					$count = $count + 1;
				}
				$output .='</div>';
				//$output .='<script> 
							
				//var matchButton= document.getElementById("nav_choose");
               // matchButton.click();
			   // </script>';
			}}
           
			if($typinet == 'match'){
				
				$order = $_POST['jsArray'] ; 

				$match=$pdo->prepare('SELECT * FROM question WHERE cat_id=:cid AND quest_type=:qtype AND exam_id=:exid ORDER BY FIELD(quest_id, "' . implode('", "', $order) . '") ');
				$match->bindValue(':cid',$_POST['cat_id']);
				$match->bindValue(':exid',$_POST['exam_id']);
				$match->bindValue(':qtype','match');
				$match->execute();
				$matcht=$match->fetchAll(PDO::FETCH_ASSOC);
				
				
			$fetchm=$pdo->prepare('SELECT * FROM option_list WHERE cat_id=:cid AND exam_id=:exid AND quest_type=:qtype  ORDER BY opt_no ASC ');
			$fetchm->bindValue(':cid',$_POST['cat_id']);
			$fetchm->bindValue(':exid',$_POST['exam_id']);
			$fetchm->bindValue(':qtype','match');
			$fetchm->execute();
			$sub_res=$fetchm->fetchAll(PDO::FETCH_ASSOC);
            
			

			$output = '';
			$d="A";
			$countc = 1;
			$output .='<div class="row">';
			$output .='<div class ="col-7 " >';
			foreach($matcht as $matchu)
			{
				$indexu = array_search($matchu['quest_id'], $arri);
				$output .='<div class="row mb-1 ">';

			$sql = mysqli_query($conn,"SELECT uans FROM temporary  WHERE cat_id ='$_POST[cat_id]' AND quest_type = 'match' AND exam_id='$_POST[exam_id]' AND qid= '$matchu[quest_id]' AND  uid='$_POST[user]' ");
			$rowa =mysqli_fetch_array($sql);
			if(is_array($rowa)){
				
				
				if($rowa['uans'] != null){
					$output .='<div class = "col-3 "> 
				<select class=" form-select form-select-sm" id="mySelectm">';
				foreach($sub_res as $optioni){
					if($countc == $rowa['uans']){
						$output .='<option selected  data-qimd="'.$matchu['quest_id'].'" data-id="'.$countc.'" 
					 value="'.$countc.'">'.$d.'</option>'; 
					}
					else{
					$output .='<option   data-qimd="'.$matchu['quest_id'].'" data-id="'.$countc.'" 
					 value="'.$countc.'">'.$d.'</option>'; 
					}

					$d++;
					$countc++;
				}
				$d="A";
				$countc = 1;
				$output .='</select> </div>';
			  }
			 
			else {
				$output .='<div class = "col-3 "> 
				<select class=" form-select form-select-sm" id="mySelectm">
				<option selected> </option>';
				foreach($sub_res as $optioni){
						$output .='<option   data-qimd="'.$matchu['quest_id'].'" data-id="'.$countc.'" 
					 value="'.$countc.'">'.$d.'</option>';
					 $d++;
					$countc++;
					}
					
				$d="A";
				$countc = 1;
				$output .='</select> </div>';
				}
				
			}
			else{
				$output .='<div class = "col-3 "> 
				<select class=" form-select form-select-sm" id="mySelectm">
				<option selected> </option>';
				foreach($sub_res as $optioni){
					$output .='<option   data-qimd="'.$matchu['quest_id'].'" data-id="'.$countc.'" 
					 value="'.$countc.'">'.$d.'</option>';
					$d++;
					$countc++;
				}
				$d="A";
				$countc = 1;
				$count = 1;
				$output .='</select> </div>';

			}
				$output .= '<div class="col-7 ">
				<div class="row mb-1">
				<h5>'.$indexu.'. '. decryptText($matchu['question']).'</h5>
				</div>
				</div>';
				$output .='</div>';
			}
			$d="A";
			$output .='</div>';
			$output .='<div class ="col-5">';
			foreach($sub_res as $optioni){
				$output .='<div class="row mb-1">';
				$output .='<h5 >'.$d.'. '.$optioni['ot'].'</h5> 
				</div>';
				$d++;
			}

			$output .='</div>';
			$output .='</div>';
			//$output .='<script> 
							
				//var matchButton= document.getElementById("nav_match");
              //  matchButton.click();
			//</script>';
		}
		//$output='';
				$index = array_search($_POST['qid'], $arri);

				$previous_id = '';
				$next_id = '';

				if($index - 1 == false){
					$previous_id = '';
				}
				else{
					$previous_id = $arri[$index - 1 ];
				}
				if(array_key_exists($index + 1,$arri)){
					$next_id = $arri[$index + 1];
				}
				else{
					
					$next_id = '';
				}
				

				$if_previous_disable = '';
				$if_next_disable = '';

				if($previous_id == "")
				{
					$if_previous_disable = 'disabled';
				}
				
				if($next_id == "")
				{
					$if_next_disable = 'disabled';
				}

				$output .= '
					<br /><br />
				  	<div align="center">
				   		<button type="button" name="previous" class="btn btn-info btn-sm previous" id="'.$previous_id.'" '.$if_previous_disable.'>Previous</button>
				   		<button type="button" name="next" class="btn btn-warning btn-sm next" id="'.$next_id.'" '.$if_next_disable.'>Next</button>
				  	</div>
				  	<br /><br />';
			
             
			echo $output;
		// }
		// else{
		// 	echo'No exam';
		// }
			
		   }
		
		
		
		}
		   if($_POST['action'] == 'question_navigation')
		   {
             $output ='';
			$resultu = array_filter($_POST['jsArray']);
			$output .= '
			<div class="card">
				<div class="card-header">Navigation</div>
				<div class="card-body">



				<table><tr>
			';
			$count = 1;
			$i=1; $j=1;
			$output .= '<td>';
			foreach($resultu as $row)	{

					$stmt = $pdo->prepare("SELECT uans FROM temporary WHERE uans=:cans  AND cat_id = :cat_id AND exam_id = :exam_id 
					AND qid = :row AND uid = :user");
						$stmt->bindValue(':cat_id', $_POST['cat_id']);
						$stmt->bindValue(':exam_id', $_POST['exam_id']);
						$stmt->bindValue(':row', $row);
						$stmt->bindValue(':cans', ' ');
						$stmt->bindValue(':user', $_POST['user']);
						$stmt->execute();
						$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$stmmt = $pdo->prepare("SELECT uans FROM temporary WHERE cat_id = :cat_id AND exam_id = :exam_id  AND uid = :user");
							$stmmt->bindValue(':cat_id', $_POST['cat_id']);
							$stmmt->bindValue(':exam_id', $_POST['exam_id']);
							$stmmt->bindValue(':user', $_POST['user']);
							$stmmt->execute();
							$resu = $stmmt->fetchAll(PDO::FETCH_ASSOC);
							if ($i == $j+14) {
								$output .= '</td><td>';
								$j=$j+14;
									}
							
					if (count($results) > 0 || count($resu) == 0) {
					$output .= '
					<div class="row-sm" style="margin-bottom:2px;">
						<button type="button" id="ay'.$row.'" class="btn btn-danger btn-sm question_navigation"  data-question_id="'.$row.'">'.$count.'</button>
					</div>
					';}
				else{
					$output .= '
				<div class="row-sm-1" style="margin-bottom:2px;">
					<button type="button" id="ay'.$row.'" class="btn btn-success btn-sm question_navigation"  data-question_id="'.$row.'">'.$count.'</button>
				</div>
				';}
				
			$count++;
			$i++;

		  }
		  $output .= '</td>';

			$output .= '
			
			</tr>
			</table>





			</div></div>
			';
			echo $output;
			
			 
			
		  }

		  if($_POST['action'] == 'answer')

		 {
			$date=date('d-m-y H:i:s');
			$pers=$_POST['user'];
			$arry = array_filter($_POST['jsArray']);
			$sql = mysqli_query($conn,"SELECT uid FROM temporary  WHERE cat_id ='$_POST[cat_id]' AND exam_id='$_POST[exam_id]' AND  uid='$_POST[user]' ");
			$rowi =mysqli_fetch_array($sql);
			if(!is_array($rowi)){
			foreach($arry as $reserve){

				$fetcht=$pdo->prepare('SELECT quest_type FROM question WHERE cat_id=:cid AND exam_id=:exid AND quest_id=:qid');
				$fetcht->bindValue(':cid',$_POST['cat_id']);
				$fetcht->bindValue(':exid',$_POST['exam_id']);
				$fetcht->bindValue(':qid',$reserve);
				$fetcht->execute();
				$res=$fetcht->fetchAll(PDO::FETCH_ASSOC);
				foreach($res as $row)	{
					$qtype=$row['quest_type'];
				}

				$sttmt=$pdo->prepare("INSERT INTO temporary(uid,cat_id,exam_id,exam_type,qid,quest_type,uans,cans,total,stat,ts,date)
				VALUES (:uid,:cat,:exid,:etype,:qid,:qtype,:uans,:cans,:total,:stat,:ts,:date)");
				$sttmt->bindValue(':uid',$pers);
				$sttmt->bindValue(':cat',$_POST['cat_id']);
				$sttmt->bindValue(':exid',$_POST['exam_id']);
				$sttmt->bindValue(':etype',$_SESSION['etype']);
				$sttmt->bindValue(':qid',$reserve);
				$sttmt->bindValue(':qtype',$qtype);
				$sttmt->bindValue(':uans','');
				$sttmt->bindValue(':cans','');
				$sttmt->bindValue(':total','');
				$sttmt->bindValue(':stat','');
				$sttmt->bindValue(':ts','');
				$sttmt->bindValue(':date',$date);
				$sttmt->execute();

			}
			}




			$fetch=$pdo->prepare('SELECT right_ans FROM question WHERE cat_id=:cid AND exam_id=:exid AND quest_id=:qid');
				$fetch->bindValue(':cid',$_POST['cat_id']);
				$fetch->bindValue(':exid',$_POST['exam_id']);
				$fetch->bindValue(':qid',$_POST['qid']);
				$fetch->execute();
				$resultu=$fetch->fetchAll(PDO::FETCH_ASSOC);
				foreach($resultu as $row)	{
					$cmark=$row['right_ans'];
				}
				$fetch=$pdo->prepare('SELECT quest_ans FROM question WHERE cat_id=:cid AND exam_id=:exid AND quest_id=:qid');
				$fetch->bindValue(':cid',$_POST['cat_id']);
				$fetch->bindValue(':exid',$_POST['exam_id']);
				$fetch->bindValue(':qid',$_POST['qid']);
				$fetch->execute();
				$result=$fetch->fetchAll(PDO::FETCH_ASSOC);
				foreach($result as $arow)	{
					$ansi=$arow['quest_ans'];
				}

				if (password_verify(1, $ansi)){
					$ans =1;
				}
				elseif (password_verify(2, $ansi)){
					$ans =2;
				}
				elseif (password_verify(3, $ansi)){
					$ans =3;
				}
				elseif (password_verify(4, $ansi)){
					$ans =4;
				}
				elseif (password_verify(5, $ansi)){
					$ans =5;
				}
				elseif (password_verify(6, $ansi)){
					$ans =6;
				}
				elseif (password_verify(7, $ansi)){
					$ans =7;
				}
				elseif (password_verify(8, $ansi)){
					$ans =8;
				}
				elseif (password_verify(9, $ansi)){
					$ans =9;
				}
				elseif (password_verify(10, $ansi)){
					$ans =10;
				}
				elseif (password_verify(11, $ansi)){
					$ans =11;
				}
				elseif (password_verify(12, $ansi)){
					$ans =12;
				}
				elseif (password_verify(13, $ansi)){
					$ans =13;
				}
				elseif (password_verify(14, $ansi)){
					$ans =14;
				}
				elseif (password_verify(15, $ansi)){
					$ans =15;
				}
				elseif (password_verify(16, $ansi)){
					$ans =16;
				}
				elseif (password_verify(17, $ansi)){
					$ans =17;
				}
				elseif (password_verify(18, $ansi)){
					$ans =18;
				}
				elseif (password_verify(19, $ansi)){
					$ans =19;
				}
				elseif (password_verify(20, $ansi)){
					$ans =20;
				}
				elseif (password_verify(21, $ansi)){
					$ans =21;
				}				
				elseif (password_verify(22, $ansi)){
					$ans =22;
				}
				else{
					$ans=null;
				}
				    
				$sql = "SELECT * FROM question WHERE cat_id = '$_POST[cat_id]' AND exam_id='$_POST[exam_id]' ";
				$query = $conn->query($sql);
				$num=$query->num_rows;

				$numi=$_POST['inc'] ?? 1;
				$cur= $numi .'/'. $num;
				//echo $cur;
              


			$marks = 0;
			$stat=0;
           
			
			$sql = mysqli_query($conn,"SELECT * FROM temporary  WHERE cat_id ='$_POST[cat_id]' AND exam_id='$_POST[exam_id]' AND qid= '$_POST[qid]' AND  uid='$pers' ");
			$row =mysqli_fetch_array($sql);
			if(is_array($row)){
              $ansiii=$row['stat'];
			  if($ansiii == 0){
				if($ans == $_POST['answer_option'])
			    {
				$marks =  $cmark;
				$stat=1;
			    }
				$marks = abs($marks);
				$sttmt=$pdo->prepare("UPDATE temporary SET uans = :uans, cans = :cans, total = :total , stat = :stat,date=:date 
				 WHERE cat_id=:cat AND exam_id=:exid AND qid=:qid AND  uid=:uid ");
				 $sttmt->bindValue(':uans',$_POST['answer_option']);
				 $sttmt->bindValue(':cans',$ans);
				 $sttmt->bindValue(':total',$marks);
				 $sttmt->bindValue(':stat',$stat);
				 $sttmt->bindValue(':cat',$_POST['cat_id']);
				 $sttmt->bindValue(':exid',$_POST['exam_id']);
				 $sttmt->bindValue(':qid',$_POST['qid']);
				 $sttmt->bindValue(':uid',$pers);
				 $sttmt->bindValue(':date',$date);
				 $sttmt->execute();
			
			  }
			  else{
                if($ans == $_POST['answer_option'])
			    {
				$marks =  $cmark;
				$stat=1;
			    }
				$marks = abs($marks);
				$sttmt=$pdo->prepare("UPDATE temporary SET uans = :uans, cans = :cans, total = :total , stat = :stat,date=:date   
				 WHERE cat_id=:cat AND exam_id=:exid AND qid=:qid AND  uid=:uid ");
				 $sttmt->bindValue(':uans',$_POST['answer_option']);
				 $sttmt->bindValue(':cans',$ans);
				 $sttmt->bindValue(':total',$marks);
				 $sttmt->bindValue(':stat',$stat);
				 $sttmt->bindValue(':cat',$_POST['cat_id']);
				 $sttmt->bindValue(':exid',$_POST['exam_id']);
				 $sttmt->bindValue(':qid',$_POST['qid']);
				 $sttmt->bindValue(':uid',$pers);				 
				 $sttmt->bindValue(':date',$date);
				 $sttmt->execute();
			  }
				
				
			
			
		}

	}
		if($_POST['action'] == 'attempt')
		{
			$qstmmt = $pdo->prepare("SELECT COUNT(*) FROM question WHERE  cat_id=:cat_id AND exam_id=:exam_id");
			$qstmmt->bindValue(':cat_id', $_POST['cat_id']);
			$qstmmt->bindValue(':exam_id', $_POST['exam_id']);
			$qstmmt->execute();
			$qcount = $qstmmt->fetchColumn();
			

		 $stmmt = $pdo->prepare("SELECT COUNT(*) FROM temporary WHERE uans!=:cans AND cat_id=:cat_id AND exam_id=:exam_id AND uid=:user");
		 $stmmt->bindValue(':cat_id', $_POST['cat_id']);
		 $stmmt->bindValue(':exam_id', $_POST['exam_id']);
		 $stmmt->bindValue(':cans', ' ');
		 $stmmt->bindValue(':user', $_POST['user']);
		 $stmmt->execute();
		 $count = $stmmt->fetchColumn();
		 echo '<span class="badge rounded-pill bg-light text-info fs-5">'.$count.'/'.$qcount.'</span>' ;
		 
		}
		if($_POST['action'] == 'mresult')
		{
			
			$qa=$_POST['cat_id'] ?? null;
			$examid=$_POST['exam_id'] ?? null;
			$pers=$_POST['user'] ?? null;

	if ($_POST['etype'] == 'Real') {

		$stmtb = $pdo->prepare("SELECT * FROM temporary WHERE uid = :uid AND cat_id = :cat AND exam_id = :eid");
		$stmtb->bindValue(':uid', $pers);
		$stmtb->bindValue(':cat', $qa);
		$stmtb->bindValue(':eid', $examid);
		$stmtb->execute();
		$rasmark=$stmtb->fetchAll(PDO::FETCH_ASSOC);
		if(count($rasmark) > 0){

	  $fed=$pdo->prepare("SELECT SUM(right_ans) as total_mark FROM question WHERE cat_id=:cid AND exam_id=:eid ");
	  $fed->bindValue(':cid',$qa);
	  $fed->bindValue(':eid',$examid);
	  $fed->execute();
	  $rmark=$fed->fetchAll(PDO::FETCH_ASSOC);
	  foreach($rmark as $rrow)
	  {
		  $sum=$rrow["total_mark"];
	  }
	  $tfed=$pdo->prepare("SELECT exam_type FROM exam WHERE cat_id=:cid AND exam_id=:eid ");
	  $tfed->bindValue(':cid',$qa);
	  $tfed->bindValue(':eid',$examid);
	  $tfed->execute();
	  $trmark=$tfed->fetchAll(PDO::FETCH_ASSOC);
	  foreach($trmark as $trrow)
	  {
		  $eetype=$trrow["exam_type"];
	  }
		  $fet=$pdo->prepare("SELECT SUM(total) as total_mark FROM temporary WHERE
		   uid=:uid AND cat_id=:cat AND  exam_id=:eid ");
		  $fet->bindValue(':uid',$pers);
		  $fet->bindValue(':cat',$qa);
		  $fet->bindValue(':eid',$examid);
		  $fet->execute();
		  $marks_result=$fet->fetchAll(PDO::FETCH_ASSOC);
		  foreach($marks_result as $row)
		  {
			  $user_sum=$row["total_mark"];
		  }

			
			$stmt = $pdo->prepare("SELECT * FROM question WHERE cat_id = :cat AND exam_id = :eid");
			$stmt->bindValue(':cat', $qa);
			$stmt->bindValue(':eid', $examid);
			$stmt->execute();
			$num = $stmt->rowCount();
			
			// Prepare the third query
			
			$stmt = $pdo->prepare("SELECT * FROM temporary WHERE uid = :uid AND cat_id = :cat AND exam_id = :eid AND uans !=:uan");
			$stmt->bindValue(':uid', $pers);
			$stmt->bindValue(':cat', $qa);
			$stmt->bindValue(':eid', $examid);
			$stmt->bindValue(':uan', '');
			$stmt->execute();
			$at = $stmt->rowCount();
			
			// Prepare the fourth query
			
			$stmt = $pdo->prepare("SELECT * FROM temporary WHERE uid = :uid AND cat_id = :cat AND exam_id = :eid AND stat = 1");
			$stmt->bindValue(':uid', $pers);
			$stmt->bindValue(':cat', $qa);
			$stmt->bindValue(':eid', $examid);
			$stmt->execute();
			$cor = $stmt->rowCount();
  
	  $stat ='';  
	  $total=$num;
	  $attempt=$at;
	  $correct=$cor;
	  $wrong=$attempt-$cor;
	  $ts=$user_sum;
	  $result=($user_sum/$sum*100);
	  $date=date('d-m-y H:i:s');
      if($result >= 50){
        $stat =1;
	  }
	  else{
		$stat= 0;
	  }

			$stmt = $pdo->prepare("SELECT * FROM final_result WHERE uid = :pers AND exam_id = :examid");


			$stmt->bindValue(':pers', $pers);
			$stmt->bindValue(':examid', $examid);

			$stmt->execute();

			$row = $stmt->fetch();

			if(is_array($row)){
  
                     
  
				  echo "<script>
				  var conf = confirm('You can not submit again! ');
			  if(conf == true){
  
				  window.location='index.php'; 
				
			  }
					  else{
						  window.history.back();
  
				}
			
			</script>";
				
	  } 
	  else{ 
   $sttmt=$pdo->prepare("INSERT INTO final_result(uid,cat_id,exam_id,etype,correct,wrong,attempt,stat,total,result,date)
	VALUES (:uid,:cat,:eid,:etyp,:correct,:wrong,:attempt,:stt,:total,:result,:date)");
	$sttmt->bindValue(':uid',$pers);
	$sttmt->bindValue(':cat',$qa);
	$sttmt->bindValue(':eid',$examid);
	$sttmt->bindValue(':etyp',$eetype);
	$sttmt->bindValue(':correct',$correct);
	$sttmt->bindValue(':wrong',$wrong);
	$sttmt->bindValue(':attempt',$at);
	$sttmt->bindValue(':stt',$stat);
	$sttmt->bindValue(':total',$num);
	$sttmt->bindValue(':result',$result);
	$sttmt->bindValue(':date',$date);
	$sttmt->execute();


$insertStmt = $pdo->prepare("INSERT INTO history SELECT * FROM temporary WHERE uid = :uiid AND cat_id = :cat_id AND exam_id = :exam_id AND exam_type=:etype");

// Disable autocommit to start a transaction
$pdo->beginTransaction();
try {
    // Insert the records into the destination table
    $insertStmt->bindValue(':uiid', $pers);
    $insertStmt->bindValue(':cat_id', $qa);
	$insertStmt->bindValue(':etype', 'Real');
    $insertStmt->bindValue(':exam_id', $examid);
    $insertStmt->execute();

    // Delete the records from the source table
    $deleteStmt = $pdo->prepare("DELETE FROM temporary WHERE uid = :uiid AND cat_id = :cat_id AND exam_id = :exam_id AND exam_type=:etype");
    $deleteStmt->bindValue(':uiid', $pers);
    $deleteStmt->bindValue(':cat_id', $qa);
    $deleteStmt->bindValue(':exam_id', $examid);
	$deleteStmt->bindValue(':etype', 'Real');
	$deleteStmt->execute();
    // Commit the transaction
    $pdo->commit();
} catch (PDOException $e) {
    // Rollback the transaction if an error occurred
    $pdo->rollBack();
    die("Copy failed: " . $e->getMessage());
}

	
	$deleteQuery = $pdo->prepare('DELETE FROM user_sessions WHERE  exam_id = :examid AND user_id = :uiid');
	$deleteQuery->bindValue(':examid',$examid);
	$deleteQuery->bindValue(':uiid', $pers);
	$deleteQuery->execute();


	  }  
	  
			  echo'
			  
			  <script>
			  
				$("#DangerModalhdbgcl").modal("show");
			  
			</script>
			
			 
			  ';


	}else{
		$deleteQuery = $pdo->prepare('DELETE FROM user_sessions WHERE  exam_id = :examid AND user_id = :uiid');
		//$deleteQuery->bindValue(':scid', session_id());
		$deleteQuery->bindValue(':examid',$examid);
		$deleteQuery->bindValue(':uiid',$pers);
		$deleteQuery->execute();
		header('Location: session');
	}


		}
		else{
			echo 'sbhbhjsbjhjervjbjre';
		}
		
        
	}}


}
function decryptText($encryptedText)
{
    $key = 'zewerha megabit maeltu welelitu asirte we kliete';
    $encryptedText = base64_decode($encryptedText);
    $ivlen = openssl_cipher_iv_length($cipher = "AES-256-CBC");
    $iv = substr($encryptedText, 0, $ivlen);
    $cipherText = substr($encryptedText, $ivlen);
    return openssl_decrypt($cipherText, $cipher, $key, $options = 0, $iv);
}
// }{

// }
?>