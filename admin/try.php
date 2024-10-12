<?php
include "dbc.php";
if (isset($_POST['page'])) {
	if ($_POST['page'] == 'tHome') {
		if ($_POST['action'] == 'dashboard') {

			echo "Welcome Teacher";
		}
		if ($_POST['action'] == 'exam') {
			$teacher = $_POST['teacher'];
			$fetch = $pdo->prepare('SELECT DISTINCT cat.cat_id as idi ,  cat.cat_name as namu, co.catDepartment as dep, co.assigned_group as groupi
			 FROM category AS cat JOIN course AS co ON co.cat_id=cat.cat_id WHERE co.assigned_teacher = :uiid GROUP BY (cat.cat_name) ');
			$fetch->bindValue(':uiid', $teacher);
			$fetch->execute();
			$teacheru = $fetch->fetchAll(PDO::FETCH_ASSOC);

			$e_output = '';
			$e_output .= '
			<div class="card">
			<h5 class="card-header">Please select the course</h5>
			<div class="card-body">
			<ul class="list-group list-group-flush">';
			foreach ($teacheru as $teach) {
				$e_output .= '
				
		   <li class="list-group-item bg-light">
		   <div class="d-grid gap-2 col-6 mx-auto">
  			<button id="catag_b" class="btn btn-light btn-outline-info shadow-md p-3 mb-2 rounded" type="button"
			data-sep = "'.$teach['dep'].'" data-name="'.$teach['namu'].'" value ="'.$teach['idi'].'" >'.$teach['namu'].'</button>
			</div>

		   </li>';
			}
			$e_output .= '</ul> </div>
			</div>';
			echo $e_output;
		}

		if ($_POST['action'] == 'exam_l') {
			$q_output = '';
			$cat_id = strval($_POST['cat_id']);
			$cat_name = strval($_POST['cat_name']);
			$teacher = strval($_POST['teacher']);
			//
			echo $cat_id;
			echo $teacher;
			$netchs = $pdo->prepare('SELECT * FROM exam WHERE cat_id=:caaati   ');
			$netchs->bindValue(':caaati', 'BAS8567289');
			//$netchs->bindValue(':acreta', $teacher);	
			$netchs->execute();
			$rexename = $netchs->fetchAll(PDO::FETCH_ASSOC);
            echo count($rexename);
			

			$fetchs = $pdo->prepare('SELECT  assigned_year as syear, assigned_group as groupi
			FROM  course   WHERE assigned_teacher = :uiid AND cat_id=:cati  GROUP BY(assigned_year)  ORDER BY assigned_year ASC');
			$fetchs->bindValue(':uiid', $teacher);
			$fetchs->bindValue(':cati', $cat_id);
			$fetchs->execute();
			$formi = $fetchs->fetchAll(PDO::FETCH_ASSOC);


			
			$q_output .= '
			<div class=" shadow p-3 mb-1 container list-group-item bg-light" ><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#examhmodal">
			Add Exam 
			</button>
			<span class=" float-end">' . $cat_name . '</span>
			</div>';
			

				foreach ($rexename as $meexam) {
					$q_output .= '
				<div class ="container mt-2">
				<div class="accordion" id="accordionPanelsStayOpenExample">
				<div class="accordion-item">
					<h2 class="accordion-header" id="panelsStayOpen-headingTwo">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#'.$meexam['exam_id'].'-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
						'.$meexam['exam_name'].'
					</button>
					</h2>
					<div id="'.$meexam['exam_id'].'-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
					<div class="accordion-body">
						<span>dfghjk</span>
					</div>
					</div>
				</div>
				</div>

				</div>
				';
				}
				if (count($rexename) > 0) {
			} else {
				$q_output .= '
			<div class="card border border-danger mt-3 mx-3" style="width: 18rem;">
			<div class="card-body">
			<h5 class="card-body">There is no exam created yet</h5>
			</div>
			</div>
			';
			}













			$q_output .= '
			<!-- exam_Modal -->
      <div class="modal fade" id="examhmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Exam </h5>
							<span id="boom" class="text-end"> ( ' . $cat_name . ' ) </span>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                            <div class="modal-body">
                              <div id="adde_result"></div>
                              <form class="form-group was-validated" method="POST" id="new_exam" action="#" >
							  <div id="exam_success"  > </div>
							      <input type="hidden" id="cat_id" value=" '.$cat_id.' ">
								  <input type="hidden" id="creator" value=" '.$teacher.' ">
                                  <div class="mb-1">
                                  <label>Name</label>
                                  <input type="text" class="form-control" id="ename" name="cname" required placeholder="Enter Exam name"></div>
                                  <div class="row mb-1 ">
                                    <div class="col">
                                    <label>Target Group</label>
									<!-- Example single danger button -->
									


									
                                    <select class="form-control" id="tgroup"  required>
									<option ></option>';
									foreach ($formi as $eexam) {
                                 $q_output.='<option value="'.$eexam['groupi'].'">'.$eexam['groupi'].'</option>';
									}
								 $q_output.='<option value="Both" >Both</option>  </select>

                                    </div>
                                    <div class="col">
                                    <label>Year</label>
                                    <select class="form-control" id="tyear"  required>
                                        <option value ></option>';
										foreach ($formi as $eexam) {
											$q_output.='<option value="'.$eexam['syear'].'">'.$eexam['syear'].'</option>';
											   }
                                    $q_output .='</select>
                                    </div>
                                  </div>
                                  <div class=" row mb-1">
                                  <div class="col mb-1">
                                  <label>Given Time</label>
                                  <input type="number" class="form-control" id="gtime" name="gtime" required placeholder="Enter given in minute" ></div>
                                  <div class="col mb-1">
                                  <label>Number of Questions</label>
                                  <input type="number" class="form-control" id="nquest" name="cnq" required placeholder="Enter number of questions"></div>
                                  </div>
                                  <div class="mb-1">
                                  <label>Exam Date</label>
                                  <input type="date" class="form-control" id="edate" name="edate" required placeholder="Enter exam date"></div>
                                  <div class="mb-1">
                                  <label>Start Time</label>
                                  <input type="time" class="form-control" id="etime" name="stime" required placeholder="Enter start time"></div>
                                  

                                  <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                              <input type="button"  name="csent" id="runn" class="addi_exam btn btn-primary" value="ADD"> </div>
                              </form>
                            </div>
                            
                     
                 </div>
             </div>
          </div>
		  </div>
          <!--  -->
			';

			echo $q_output;
		}
		
		if ($_POST['action'] == 'addd_exami') {

			
			$date=date('d-m-y H:i:s');
			$new_cat_id = $_POST['new_cat_id'];
			$creator = $_POST['creator'];
			
			$ename = $_POST['ename'];
			$slici= strtoupper(substr($ename, 0, 3));
			$exam_id = random($slici);

			$tgroup = $_POST['tgroup'];
			$tyear = $_POST['tyear'];
			$gtime = $_POST['gtime'];
			$nquest = $_POST['nquest'];
			$edate = $_POST['edate'];
			$etime = $_POST['etime'];
			if($new_cat_id && $creator && $exam_id && $ename && $tgroup && $tyear && $gtime && $nquest && $edate && $etime   !=null){
			$cmy=$pdo->prepare("INSERT INTO exam(cat_id,exam_id,exam_creator,exam_name,exam_nq,exam_time,exam_date,
			start_time,target_group,target_year,date)
            VALUES (:cid,:eid,:ecre,:ename,:enq,:etime,:edate,:stime,:tg,:tye,:cdate)");
          
            $cmy->bindValue(':cid',$new_cat_id);  
            $cmy->bindValue(':eid',$exam_id);
            $cmy->bindValue(':ecre',$creator);
            $cmy->bindValue(':ename',$ename);
			//$cmy->bindValue(':etype',$tyear);
			$cmy->bindValue(':enq',$nquest);
			$cmy->bindValue(':etime',$tyear);
			$cmy->bindValue(':edate',$edate);
			$cmy->bindValue(':stime',$etime);
			$cmy->bindValue(':tg',$tgroup);
			$cmy->bindValue(':tye',$tyear);
            $cmy->bindValue(':cdate',$date);
            $cmy->execute();
		
			echo '<div class="alert  alert-success" id="sualert" role="alert">
			The new exam succesfully added!
			<script>
			document.getElementById("new_exam").reset();
			$("#sualert").alert();
			setTimeout(function() {
			$("#sualert").alert("close");
				}, 2000);
			
			</script>
		  </div>';


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