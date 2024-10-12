<?php 
include "dbc.php";
if(isset($_POST['page']))
{
if($_POST['page'] == 'exam')
	{
		if($_POST['action'] == 'load_question')
		{
			$ufetch=$pdo->prepare('SELECT sttatus FROM examinee WHERE uiid=:uiid ');
			$ufetch->bindValue(':uiid',$_POST['user']);
			$ufetch->execute();
			$uresult=$ufetch->fetchAll(PDO::FETCH_ASSOC);
			foreach($uresult as $use){
				$stat=$use['sttatus'];
			}
            if($stat !=1){
				echo "<script>
				var myButton= document.getElementById('submitAns');
				myButton.click();
				var conf = confirm('Sorry, You are blocked beacause of displine! ');
					if(conf == true){

						window.location='First.php'; 
					
					}
							else{
								window.location='First.php'; 

					}
				
				</script> ";

			}
			else{


			
				$arri = array_filter($_POST['jsArray']);
				$typinet = $_POST['qtype'];
                if($_POST['qid'] == null){
					$_POST['qid'] = $arri[1];
				}
if($typinet == ''){
				$etch=$pdo->prepare('SELECT quest_type FROM question WHERE cat_id=:cid AND exam_id=:exid AND quest_id=:qid');
				$etch->bindValue(':cid',$_POST['cat_id']);
				$etch->bindValue(':exid',$_POST['exam_id']);
				$etch->bindValue(':qid',$_POST['qid']);
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
				foreach($resultd as $rowi){
				$cmark=$rowi['right_ans'];
				}
				$output .= '
				<h3>'.$indexu.'. '.$row['question'].'('.$cmark.'<sub>Pt</sub>)</h3>
				<hr />
				<br />
				<div class="row">
				';
				$fetch=$pdo->prepare('SELECT * FROM option_list WHERE cat_id=:cid AND exam_id=:exid AND quest_type=:qtype AND quest_id=:qid ORDER BY opt_no ASC');
				$fetch->bindValue(':cid',$_POST['cat_id']);
				$fetch->bindValue(':exid',$_POST['exam_id']);
				$fetch->bindValue(':qtype','choose');
				$fetch->bindValue(':qid',$row['quest_id']);
				$fetch->execute();
				$sub_result=$fetch->fetchAll(PDO::FETCH_ASSOC);

				$count = 1;
				$d="A";
				// $di=$_POST['array'];
				foreach($sub_result as $sub_row)
				{ 
					$stmmtk = $pdo->prepare("SELECT uans FROM temporary WHERE cat_id = :cat_id AND exam_id = :exam_id AND quest_type = :qtype AND uans = :uans AND qid = :qid AND uid = :uidd ");
					$stmmtk->bindValue(':cat_id', $_POST['cat_id']);
					$stmmtk->bindValue(':exam_id', $_POST['exam_id']);
					$stmmtk->bindValue(':qtype', "choose");
					$stmmtk->bindValue(':uans', $count);
					$stmmtk->bindValue(':qid', $sub_row['quest_id']);
					$stmmtk->bindValue(':uidd', $_POST['user']);
					$stmmtk->execute();
					$resut = $stmmtk->fetchAll(PDO::FETCH_ASSOC);
					

            if (count($resut) > 0 ) {
					// $m=$row['quest_id'] .'m'.$count;
					// if(in_array($m,$di)){
					$output .= '
					<div class="col-md-6" style="margin-bottom:32px;">
						<div class="radio">
							<label><h5><input type="radio" checked  name="option_1" id="'.$count.'" class=" answer_option optionbox form-check-input " 
							 value="'.$sub_row['opt_no'].'" data-check="'.$sub_row['quest_id'].'m'.$count.'"  data-linku="'.$sub_row['quest_id'].'"
							 data-qid="'.$sub_row['quest_id'].'" data-id="'.$count.'"/>'.$d.'.&nbsp;'.$sub_row['ot'].'</h5></label>
						</div>
					</div>
					';
                    }
					else{
						$output .= '
					<div class="col-md-6" style="margin-bottom:32px;">
						<div class="radio">
						
							<label><h5><input type="radio"  name="option_1" id="'.$count.'"  
							class=" answer_option optionbox form-check-input "  value="'.$sub_row['opt_no'].'" 
							data-check="'.$sub_row['quest_id'].'m'.$count.'"  data-qid="'.$sub_row['quest_id'].'" data-id="'.$count.'" 
							onclick="hide();"  />'.$d.'.&nbsp;'.$sub_row['ot'].'</h5></label>
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
				$output .='<script> 
							
				var matchButton= document.getElementById("nav_choose");
                matchButton.click();
			    </script>';
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
		$stm = $pdo->prepare("SELECT uans FROM temporary WHERE cat_id = :cat_id AND exam_id = :exam_id AND quest_type = :qtype  AND qid = :qid AND uid = :uidd ");
		$stm->bindValue(':cat_id', $_POST['cat_id']);
		$stm->bindValue(':exam_id', $_POST['exam_id']);
		$stm->bindValue(':qtype', "match");
		$stm->bindValue(':qid', $matchu['quest_id']);
		$stm->bindValue(':uidd', $_POST['user']);
		$stm->execute();
		$rowa = $stm->fetchAll(PDO::FETCH_ASSOC);
		if (count($rowa) > 0 ) {
			foreach($rowa as $aarow)	{
				$ansur=$aarow['uans'];
			}
				if($ansur != null){
					$output .='<div class = "col-3 "> 
				<select class=" form-select form-select-sm" id="mySelectm">';
				foreach($sub_res as $optioni){
					if($countc == $ansur){
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
				<h5>'.$indexu.'. '.$matchu['question'].'</h5>
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
			$output .='<script> 
							
				var matchButton= document.getElementById("nav_match");
                matchButton.click();
			</script>';
		}
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

			$resultu = array_filter($_POST['jsArray']);
			$output = '
			<div class="card">
				<div class="card-header">Navigation</div>
				<div class="card-body">
					<div class="col" style="text:center;">
			';
			$count = 1;

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
					if (count($results) > 0 || count($resu) == 0) {
					$output .= '
					<div class="row-sm" style="margin-bottom:2px;">
						<button type="button" class="btn btn-danger btn-sm question_navigation"  data-question_id="'.$row.'">'.$count.'</button>
					</div>
					';}
				else{
					$output .= '
				<div class="col-sm-1" style="margin-bottom:2px;">
					<button type="button" class="btn btn-success btn-sm question_navigation"  data-question_id="'.$row.'">'.$count.'</button>
				</div>
				';}
			$count++;
		  }
			$output .= '
				</div>
			</div></div>
			';
			echo $output;
			
			 foreach($resultu as $sa){
				echo $sa ;
			}
			
		  }
		  if($_POST['action'] == 'answer')

		 {
			$date=date('d-m-y H:i:s');
			$pers=$_POST['user'];
			$arry = array_filter($_POST['jsArray']);

			$stmu = $pdo->prepare("SELECT * FROM temporary WHERE cat_id = :cat_id AND exam_id = :exam_id AND uid = :uidd ");
			$stmu->bindValue(':cat_id', $_POST['cat_id']);
			$stmu->bindValue(':exam_id', $_POST['exam_id']);
			$stmu->bindValue(':uidd', $_POST['user']);
			$stmu->execute();
			$rowi = $stmu->fetchAll(PDO::FETCH_ASSOC);
			if (count($rowi) <= 0 ) {
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

				$sttmt=$pdo->prepare("INSERT INTO temporary(uid,cat_id,exam_id,qid,quest_type,uans,cans,total,stat,ts,date)
				VALUES (:uid,:cat,:exid,:qid,:qtype,:uans,:cans,:total,:stat,:ts,:date)");
				$sttmt->bindValue(':uid',$pers);
				$sttmt->bindValue(':cat',$_POST['cat_id']);
				$sttmt->bindValue(':exid',$_POST['exam_id']);
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
					$ans=$arow['quest_ans'];
				}
				
				// $sql = "SELECT * FROM question WHERE cat_id = '$_POST[cat_id]' AND exam_id='$_POST[exam_id]' ";
				// $query = $conn->query($sql);
				// $num=$query->num_rows;

				// $numi=$_POST['inc'] ?? 1;
				// $cur= $numi .'/'. $num;
				// //echo $cur;
              


			$marks = 0;
			$stat=0;
           
			$stmur = $pdo->prepare("SELECT * FROM temporary WHERE cat_id = :cat_id AND exam_id = :exam_id AND qid=:qid AND uid = :uidd ");
			$stmur->bindValue(':cat_id', $_POST['cat_id']);
			$stmur->bindValue(':exam_id', $_POST['exam_id']);
			$stmur->bindValue(':uidd', $_POST['user']);
			$stmur->bindValue(':qid',$_POST['qid']);
			$stmur->execute();
			$row = $stmur->fetchAll(PDO::FETCH_ASSOC);
			if (count($row) > 0 ) {
				foreach($row as $rows)	{
					$ansi=$rows['stat'];
				}
			  if($ansi == 0){
				if($ans == $_POST['answer_option'])
			    {
				$marks = '+' . $cmark;
				$stat=1;
			    }
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
				$marks = '-' . $cmark;
				$stat=0;
			    }
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
				
				
			
			
		}}
        
	}

}

?>