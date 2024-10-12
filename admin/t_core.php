<?php
session_start();
if (isset($_SESSION['tuid'])) {
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
  			<button style="box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);" id="catag_b" class="table-hover btn btn-light border-1 border-primary shadow-md p-3 mb-2 rounded" type="button"
			data-sep = "' . $teach['dep'] . '" data-name="' . $teach['namu'] . '" value ="' . $teach['idi'] . '" >' . $teach['namu'] . '</button>
			</div>

		   </li>';
			}
			$e_output .= '</ul> </div>
			</div>
			
			
			';
			echo $e_output;
		}

		if ($_POST['action'] == 'exam_l') {
			$q_output = '';
			$cat_id = trim($_POST['cat_id']);
			$cat_name = strval($_POST['cat_name']);
			$teacher = trim($_POST['teacher']);
			$tdepart = trim(strval($_POST['tdepa']));

			$netchs = $pdo->prepare('SELECT * FROM exam WHERE cat_id=:caaati AND exam_creator=:acreta');
			$netchs->bindValue(':caaati', $cat_id );
			$netchs->bindValue(':acreta', $teacher);	
			$netchs->execute();
			$rexename = $netchs->fetchAll(PDO::FETCH_ASSOC);

			$q_output .= '
			<div class=" shadow p-2 mb-1 container list-group-item bg-light" ><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#examhmodal">
			Add Exam 
			</button>
			<span class=" float-end">' . $cat_name . '</span>
			</div>';

			if (count($rexename) > 0) {
			
				foreach ($rexename as $meexam) {
					$dnetchs = $pdo->prepare('SELECT * FROM assexam WHERE  exam_id=:acreta');
			        $dnetchs->bindValue(':acreta', $meexam['exam_id']);	
			        $dnetchs->execute();
					$assdepa = $dnetchs->fetchAll(PDO::FETCH_ASSOC);
					$q_output .= '
				<div class ="container mt-1">
				<div class="accordion" id="accordionPanelsStayOpenExample">
				<div class="accordion-item">
					<h2 class=" accordion-header" id="panelsStayOpen-headingTwo">
					<button class=" accordion-button collapsed" type="button" data-bs-toggle="collapse" id="'.$meexam['exam_id'].'Two" data-bs-target="#abc'.$meexam['exam_id'].'" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
						'.$meexam['exam_name'].' 
						<span class="position-absolute top-50 end-50 translate-middle-y">';
						if($meexam['sttatus'] == 1){
							$q_output .= 'Status: <span class="badge rounded-pill bg-success">Active</span>';
						}
						elseif($meexam['sttatus'] == 3){
							$q_output .= 'Status: <span class="badge rounded-pill bg-danger">Rejected</span>';
						}
						else{
							$q_output .= 'Status: <span class="badge rounded-pill bg-warning text-dark">Pending...</span>';
						}
						
						
						$q_output .= '</span>
						<span class="position-absolute top-50 end-0 translate-middle-y me-7">
						
						</span>
					</button>
					</h2>
					<div id="abc'.$meexam['exam_id'].'" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
					<div
					 class="accordion-body">


					 <div class="card">
                  <div class="card-header">
  
					<div>
					<div class="nav nav-tabs" id="nav-tab" role="tablist">
					  <button class="nav-link active" id="nav-home-tab'.$meexam['exam_id'].'" data-bs-toggle="tab" data-bs-target="#nav-home'.$meexam['exam_id'].'" type="button" role="tab" aria-controls="nav-home'.$meexam['exam_id'].'" aria-selected="true">Detail</button>
					  <button class="nav-link" id="nav-profile-tab'.$meexam['exam_id'].'" data-bs-toggle="tab" data-bs-target="#nav-profile'.$meexam['exam_id'].'" type="button" role="tab" aria-controls="nav-profile'.$meexam['exam_id'].'" aria-selected="false">Assign</button>
					  <button class="nav-link" id="nav-contact-tab'.$meexam['exam_id'].'" data-bs-toggle="tab" data-bs-target="#nav-contact'.$meexam['exam_id'].'" type="button" role="tab" aria-controls="nav-contact'.$meexam['exam_id'].'" aria-selected="false">Question</button>
					</div>
				  </div>
				  </div>
				  <div class="card-body">
				  <div class="tab-content" id="nav-tabContent">






					<div class="tab-pane fade show active" id="nav-home'.$meexam['exam_id'].'" role="tabpanel" aria-labelledby="nav-home-tab'.$meexam['exam_id'].'">
					
					<div class=" mx-1 px-1 card border-left-info shadow  py-1 ">
					<div class="position-absolute top-0 end-0">
					<span class="badge bg-primary">'.$meexam['exam_category'].'</span>
					<span class="badge bg-primary">'.$meexam['exam_type'].'</span>
				  </div>
					<div class="row mb-1">
					
				  <div class="col mb-3"> <span class="col fs-5  font-weight-bold text-primary ml-1 text-uppercase mb-1">Exam Name: </span>
				  <span class=" fs-5"> '.$meexam['exam_name'].'</span>
				  </div>

				  <div class="col"><span class="col fs-5  font-weight-bold text-primary ml-1 text-uppercase mb-1">Exam Value: </span>
				  <span class=" fs-5"> '.$meexam['exam_value'].'%</span></div>
				    </div>
					<div class="row mb-3">
				<div class="col"> <span class="col fs-5  font-weight-bold text-primary ml-1 text-uppercase mb-1">Number of Question: </span>
				<span class=" fs-5">'.$meexam['exam_nq'].'</span></div>

				  <div class="col"><span class="col fs-5  font-weight-bold text-primary ml-1 text-uppercase mb-1">Given Time: </span>
				  <span class=" fs-5"> '.$meexam['exam_time'].' Minutes</span></div>
					</div>
					<div class="row mb-3">
				<div class="col"> 

				<div class="row align-items-left">
				<div class="col-4">
				<span class="fs-5 font-weight-bold text-primary  text-uppercase mb-1">Exam Date: </span></div>';
				if($meexam['exam_category'] == 'Special'){

                 $q_output.='<div class="col-8"><input type="date" value="'.$meexam['exam_date'].'" data-eid="'.$meexam['exam_id'].'" class="form-control  eedate" id="eedate" name="eedate" required placeholder="Enter exam date">
				<script>
				 $(document).ready(function() {
				   $(document).on("change", ".eedate", function() {
					 var selectedDate = $(this).val();
					 $(this).attr("value", selectedDate);
				   });
				 });
			   </script></div></div>';
				}
                     
                 else{
				if($meexam['exam_date'] != ''){

				$q_output.='<div class="col-8"><span class=" fs-5">'.$meexam['exam_date'].'</span></div></div>';
				}				
				else{
					$q_output.='<div class="col-8"><span class="badge bg-danger">Not Set</span></div></div>';
				  }

				 }
				$q_output.='	</div>

				  <div class="col">
				  <div class="row align-items-center">
				<div class="col-4">
				  <span class="col fs-5 font-weight-bold text-primary ml-1 text-uppercase mb-1">Start Time: </span></div>';

				  if($meexam['exam_category'] == 'Special'){

					$q_output.='<div class="col-8"><input type="time" value="'.$meexam['start_time'].'" data-eid="'.$meexam['exam_id'].'" class="form-control eetime" id="eetime" name="eetime" required placeholder="Enter start time">
				   <script>
					$(document).ready(function() {
					  $(document).on("change", ".eetime", function() {
						var selectedDate = $(this).val();
						$(this).attr("value", selectedDate);
					  });
					});
				  </script></div></div>';
				   }
						
					else{

				  if($meexam['start_time'] != ''){
					$startTime = $meexam['start_time'];
					$formattedTime = date("h:i A", strtotime($startTime));
					$q_output.='<div class="col-8"><span class=" fs-5">'.$formattedTime.' (Local Time)</span></div></div>';
				  }
				  else{
					$q_output.='<div class="col-8"><span class="badge bg-danger">Not Set</span></div></div>';
				  }
				}
				  
				 
				  $q_output.='  </div>
					</div>
					<div class="row mb-3">
				<div class="col"> <span class="col fs-5 font-weight-bold text-primary ml-1 text-uppercase mb-1">Department: </span>';
				
				
				$target='ruyan'.$meexam['exam_id'];
				if(count($assdepa) > 0){

                $q_output.='<span class="badge bg-success">Assigned</span>';
				}
				else{
					$q_output.='<span class="badge bg-danger">Not Assigned</span>';
				}				
				$q_output.='</div>

				  <div class="col"><span class="col fs-5 font-weight-bold text-primary ml-1 text-uppercase mb-1">Course: </span>
				  <span class=" fs-5"> '.$cat_name.'</span>

				  <button title="Delete Exam" data-bs-toggle="modal"  value="'.$meexam['exam_id'].'"  data-dep="'.$tdepart.'"
				  data-cname="'.$cat_name.'" data-catid="'.$cat_id.'"
				  class="delete_exam btn btn-danger float-end me-4"><i class="col  fas fa-fw fa-trash  text-white"></i></button>

				  <button title="Edit Exam" data-bs-toggle="modal" data-bs-target="#vsd'.$meexam['exam_id'].'" value="'.$meexam['exam_id'].'"  data-gtime="'.$meexam['exam_time'].'" data-stime="'.$meexam['download'].'"
				   data-echo="'.$target.'" data-edate="'.$meexam['exam_value'].'" data-numq="'.$meexam['exam_nq'].'" data-ename="'.$meexam['exam_name'].'"
				   data-etype="'.$meexam['exam_type'].'" data-ecat="'.$meexam['exam_category'].'"  data-cname="'.$cat_name.'" data-catid="'.$cat_id.'"
				  class="edimainexam btn btn-info float-end me-4"><i class="col  fas fa-fw fa-edit  text-white"></i></button>



 
				  </div>


					</div>
				
				</div>

                </div>



				<div class="modal fade" id="vsd'.$meexam['exam_id'].'" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg">
					  <div id="'.$target.'" class="modal-content">
  
					  
					  </div>
					</div>
				  </div>
  

					<div class="tab-pane fade" id="nav-profile'.$meexam['exam_id'].'" role="tabpanel" aria-labelledby="nav-profile-tab'.$meexam['exam_id'].'">
					<div class="card border-left-info shadow h-100 py-2 ">
					
					
					
					
					';

					
					


			$fetchs = $pdo->prepare('SELECT * FROM  course   WHERE assigned_teacher = :uiid AND cat_id=:cati GROUP BY Department, assigned_year  ORDER BY Department ASC');
			$fetchs->bindValue(':uiid', $teacher);
			$fetchs->bindValue(':cati', $cat_id);
			$fetchs->execute();
			$formi = $fetchs->fetchAll(PDO::FETCH_ASSOC);

   			$q_output.='
			<div class="ml-3"><label><h6 class="m-1 font-weight-bold text-primary">Assign the exam for candidaates</h6></label></div>
				
			<div class="row">
					
					<div class="col">
					<div class="card border-left-warning shadow h-100 py-2">
					<div class="card-body">
					<div id="assigne'.$meexam['exam_id'].'"></div>	
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
								   Select the Department</div>
							</div>
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
								   Target Group</div>
							</div>
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
								   Target Year</div>
							</div>
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
									Number of Student(Optional)</div>
							</div>
							';






							$inc = 1;
		  foreach ($formi as $fu) {

				$alfetchs = $pdo->prepare('SELECT * FROM  assexam  WHERE  exam_id=:edepu AND assigned_by=:asby AND assigned_Department=:adep AND assigned_year=:ayiru');
				$alfetchs->bindValue(':edepu', $meexam['exam_id']);
				$alfetchs->bindValue(':asby', $fu['catDepartment']);
				$alfetchs->bindValue(':adep', $fu['Department']);
				$alfetchs->bindValue(':ayiru', $fu['assigned_year']);
				$alfetchs->execute();
				$assigndep = $alfetchs->fetchAll(PDO::FETCH_ASSOC);

					   
							$mfetchs = $pdo->prepare('SELECT dep_name FROM  department  WHERE  dep_id=:depu  ');
							$mfetchs->bindValue(':depu', $fu['Department']);
							$mfetchs->execute();
							$mforq = $mfetchs->fetchAll(PDO::FETCH_ASSOC);
							foreach ($mforq as $mfo) {
								$dep_name=$mfo['dep_name'];

							}

			  $q_output .= '<form class="was-validated">
			          
						   <div class="row">
                                

							<div class="col mb-1">
						   <div class="form-check">';
						   if(count($assigndep) > 0){

		                   $q_output.='<input checked class="depacheck form-check-input" name="departmentradio" data-catname="'.$cat_name.'" data-catid="'. $cat_id.'" data-assigner="'.$fu['catDepartment'].'" data-id="'.$meexam['exam_id'].'" required type="checkbox" data-year="'.$fu['assigned_year'].'" value="'.$fu['Department'].'" id="flexCheckDefault'.$inc.''.$meexam['exam_id'].'">';

						   }
						   else{
							$q_output.='<input class="depacheck form-check-input" name="departmentradio" data-catname="'.$cat_name.'" data-catid="'. $cat_id.'" data-assigner="'.$fu['catDepartment'].'" data-id="'.$meexam['exam_id'].'" required type="checkbox" data-year="'.$fu['assigned_year'].'" value="'.$fu['Department'].'" id="flexCheckDefault'.$inc.''.$meexam['exam_id'].'">';

						   }

						   $q_output.='<label class="form-check-label mb-2" for="flexCheckDefault'.$inc.''.$meexam['exam_id'].'">
						   ' .$dep_name. '
						   </label></br>
						 </div> </div> ';

							$qfetchs = $pdo->prepare('SELECT DISTINCT assigned_group  FROM  course   WHERE assigned_year=:ayear AND assigned_teacher = :uiid AND cat_id=:cati AND department=:depu  ');
							$qfetchs->bindValue(':ayear', $fu['assigned_year']);
							$qfetchs->bindValue(':uiid', $teacher);
							$qfetchs->bindValue(':cati', $cat_id);
							$qfetchs->bindValue(':depu', $fu['Department']);
							$qfetchs->execute();
							$forq = $qfetchs->fetchAll(PDO::FETCH_ASSOC);


				            $q_output .= ' <div class="col mb-1">
						 
							   
				         <select id="group'.$inc.'" name="uctype"   class="spcifigrouppp form-select" required  aria-label="type" data-catname="'.$cat_name.'" data-catid="'. $cat_id.'" data-assigner="'.$fu['catDepartment'].'" data-id="'.$meexam['exam_id'].'" data-year="'.$fu['assigned_year'].'" data-vvalue="'.$fu['Department'].'" >
							   <option  ></option>';

							   if(count($assigndep) > 0){
							   foreach ($assigndep as $asfo) {
				        		foreach ($forq as $fo) {

							if($asfo['assigned_group'] == $fo['assigned_group'] )	{
								$q_output .= '<option selected data-oyear="'.$fu['assigned_year'] .'" value="'.$fo['assigned_group'].'">'.$fo['assigned_group'].'</option>';

							}	
							else{
							$q_output .= '<option data-oyear="'.$fu['assigned_year'] .'" value="'.$fo['assigned_group'].'">'.$fo['assigned_group'].'</option>';

							}

						}}}
						else{
							foreach ($forq as $fo) {
			$q_output .= '<option data-oyear="'.$fu['assigned_year'] .'" value="'.$fo['assigned_group'].'">'.$fo['assigned_group'].'</option>';

							}
						}
						if( count($forq) > 1  ) {
							$q_output .= ' 
					   <option value="ALL" >ALL</option>';
						}


					   $q_output .= ' 
					   
					 </select>
							   
						   </div>
						   <div class="col mb-1">
						   
					 <select id="coltype" name="coltype" class="form-select" required aria-label="taype">';

						  
	  
					 $q_output.='  <option value = " '.$fu['assigned_year'] .' " selected disabled>'.$fu['assigned_year'] .'</option>';
	  

						$q_output.='
						</select>
						</div>
						<div class="col mb-1">
								
						  <input type="number" class="form-control" min="1" data-nyear="'.$fu['assigned_year'] .'" id="stnum'.$inc.'" name="nums"  placeholder="Enter student number "></div>
							
							</div>
						   ';
						 $inc ++;	}




							$q_output .= '  </div></div>    <div class="modal-footer">
							                <!---<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
											<input type="button"  name="csent" id="runn" class="addi_exam btn btn-primary" value="Assign"> -->
											</div>
											</form>
											</div>
											
									
								</div>
							</div>
							</div>
							</div>
							<!--  -->
							';

					
					$q_output.='</div

					
					</div>

					<div class="tab-pane fade" id="nav-contact'.$meexam['exam_id'].'" role="tabpanel" aria-labelledby="nav-contact-tab'.$meexam['exam_id'].'">
					<div class="card border-left-info shadow h-100 py-2 ">';
					
					$questchs = $pdo->prepare('SELECT * FROM  question  WHERE  exam_id=:depu  ');
					$questchs->bindValue(':depu', $meexam['exam_id']);
					$questchs->execute();
					$questforq = $questchs->fetchAll(PDO::FETCH_ASSOC);

					$squestchs = $pdo->prepare('SELECT SUM(right_ans) AS total_right_answers FROM question WHERE exam_id = :depu');
					$squestchs->bindValue(':depu', $meexam['exam_id']);
					$squestchs->execute();
					$squestforq = $squestchs->fetch(PDO::FETCH_ASSOC);

					$totalRightAnswers = $squestforq['total_right_answers'];


					if(count($questforq) > 0){
                     $q_output.='<div class="container alert alert-success" role="alert mb-5 mt-2">
					  <h3 <h3 class="text-center">Currently, '.count($questforq).'/'.$meexam['exam_nq'].' questions </h3>
					  <h3 <h3 class="text-center">and '.$totalRightAnswers.'%'.' of the '.$meexam['exam_value'].'% mark has been created!</h3>
				     </div>';
					}
					else{
						$q_output.='<div class="container alert alert-danger" role="alert mb-5 mt-2">
						<h3 class="text-center">No question have been created yet!</h3>
						 </div>';
					}
					$q_output.='
                <form method="POST" action="question">
                  <input type="hidden" name="exam_id" value="'.$meexam['exam_id'].'">
				  <input type="hidden" name="cat_id" value="'.$cat_id.'">
				  <input type="hidden" name="ename" value="'.$meexam['exam_name'].'">
				  <input type="hidden" name="numq" value="'.$meexam['exam_nq'].'">
				  <button type="submit" name="questions" class="btn btn-info float-end me-4"><i class="col  fas fa-fw fa-add  text-white"></i>Add Question</button>
                 </form>
				  </div>
					
					</div> </div>

				  </div>
				  </div>
				  </div>

                    </div>
					</div>
				  </div>

	
					</div>
					</div>
				</div>
				</div>

				</div>
				';
				}
			}
				 else {
				$q_output .= '
				<p class="text-center alert alert-danger mt-3 mb-2">There is no exam created yet</p>
			';
			}













			$q_output .= '
			<!-- exam_Modal -->
      <div class="modal fade" id="examhmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg ">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Exam </h5>
							<span id="boom" class="text-end"> ( ' . $cat_name . ' ) </span>
                            <button type="button" data-catname="'.$cat_name.'" data-catid="'.$cat_id.'" data-dep="'.$tdepart.'"  class="normal_close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                            <div class="modal-body">
                              <div id="adde_result"></div>
                              <form class="form-group was-validated" method="POST" id="new_exam" action="#" >
							  <div id="exam_success"  > </div>
							      <input type="hidden" id="cat_id" value=" '.$cat_id.'">
								  <input type="hidden" id="creator" value=" '.$teacher.'">
								  <input type="hidden" id="creator_dep" value="'.$tdepart.'">
								  <div class="col mb-1">
                                  <label><h6 class="m-1 font-weight-bold text-primary">Exam Category </h6></label>
                                  <select  class="form-control" id="ecat" name="ecat" required>
								    <option disabled selected> </option>
								    <option value="Regular">Regular</option>
                                    <option value="Special">Special</option>
								 </select>
								  </div>
								  <div class=" row mb-1">
                                  <div class="col mb-1">
                                  <label><h6 class="m-1  font-weight-bold text-primary">Name</h6></label>
                                  <input type="text" class="form-control" id="ename" name="cname" required placeholder="Enter exam name"></div>
                                  
                                  <div class="col mb-1">
                                  <label><h6 class="m-1 font-weight-bold text-primary">Given Time</h6></label>
                                  <input type="number" class="form-control" min="1" id="gtime" name="gtime" required placeholder="Enter given time in minute" ></div>
                                </div>
								  <div class="row">
                                  <div class="col mb-1">
                                  <label><h6 class="m-1 font-weight-bold text-primary">Exam Value</h6></label>
                                  <div class="input-group">
									<input type="number" min="1" pattern = "/^(?=.*[1-9])\d*(\.\d+)?$/" class="form-control" id="edate" name="edate" required placeholder="Enter exam value">
									<div class="input-group-append">
										<span class="input-group-text">%</span>
									</div>
									</div>
									</div>
                                  <div class="col mb-1">
                                  <label><h6 class="m-1 font-weight-bold text-primary">Quesion Download </h6></label>
                                  <select  class="form-control" id="etime" name="etime" required>
								    <option disabled selected></option>
								    <option value="1">Permit</option>
                                    <option value="0">Deny</option>
								 </select>
								  </div>
                                </div> 
								
								<div class="row">

								<div class="col mb-1">
								<label><h6 class="m-1 font-weight-bold text-primary">Number of Question</h6></label>
								<input type="number" class="form-control" min="1" id="numq" name="numq" required placeholder="Enter number of question" >
								</div>
								

								<div class="col mb-1">
								<label><h6 class="m-1 font-weight-bold text-primary">Exam Type</h6></label>
                                <select id="etype" name="etype" class="form-select" required aria-label="type">
                                    <option disabled selected> </option>
                                    <option value="Real">Real</option>
                                    <option value="Practise">Practise</option>
                                </select>
								</div>  
								</div>
								
								';

								$q_output .= '   <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                              <input type="button"  name="csent" id="runn" class="addi_exam btn btn-primary" value="ADD"> </div>
                              </form>
                            </div>
                            
                     
                 </div>
             </div>
          </div>
		  </div>';
								
			echo $q_output;
		}
		if($_POST['action'] == 'date_ch')
        {  
              $date=$_POST['date'];
              $suid=$_POST['target'];

			  $bsttmt=$pdo->prepare("UPDATE exam SET exam_date=:edate
		          WHERE exam_id=:acreta ");	   
			        $bsttmt->bindValue(':edate', $date);
			        $bsttmt->bindValue(':acreta', $suid);
			        $bsttmt->execute();

              $bsttmt=$pdo->prepare("UPDATE assexam SET exam_date=:edate
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
                 }, 5000);
               
               </script>
               </div>';
            }

			if($_POST['action'] == 'time_ch')
            {  
                  $date=$_POST['date'];
                  $suid=$_POST['target'];
				  
				  $bsttmt=$pdo->prepare("UPDATE exam SET start_time=:edate
                  WHERE exam_id=:acreta ");	   
                  $bsttmt->bindValue(':edate', $date);
                  $bsttmt->bindValue(':acreta', $suid);
                  $bsttmt->execute();

                  $bsttmt=$pdo->prepare("UPDATE assexam SET start_time=:edate
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
                     }, 5000);
                   
                   </script>
                   </div>';
                }


		if ($_POST['action'] == 'addd_exami') {


			$date = trim(date('d-m-y H:i:s'));
			$new_cat_id = trim($_POST['new_cat_id']);
			$creator = trim($_POST['creator']);
			$creator_dep = trim($_POST['creator_dep']);
			$ename = trim($_POST['ename']);
			$numq = trim($_POST['numq']);
			$slici = strtoupper(substr($ename, 0, 3));
			$exam_id = random($slici);
			$gtime = trim($_POST['gtime']);
			$etype = trim($_POST['etype']);
			$edate = trim($_POST['edate']);
			$etime = trim($_POST['etime']);
			$ecat = trim($_POST['ecat']);

			if ($new_cat_id && $creator && $creator_dep && $exam_id && $ename && $numq && $gtime && $etype && $edate  && $ecat   != null) {

				$sql = "SELECT * FROM exam WHERE exam_id=:idat";
				$ustmt = $pdo->prepare($sql);
				$ustmt->bindValue(':idat', $exam_id);
				$ustmt->execute();
				$userd = $ustmt->fetchAll(PDO::FETCH_ASSOC);
				
				if(count($userd) > 0){
				  $exam_id = $exam_id.$numq;
				}
				
				
				$sql = "SELECT exam_name FROM exam WHERE exam_name=:datii";
				$dustmt = $pdo->prepare($sql);
				$dustmt->bindValue(':datii', $ename);
				$dustmt->execute();
				$dcolstr = $dustmt->fetchAll(PDO::FETCH_ASSOC);
				
				if(count($dcolstr) <= 0){


				$cmy = $pdo->prepare("INSERT INTO exam(cat_id,exam_id,creator_dep,exam_category,exam_creator,exam_name,exam_nq,exam_type,exam_time,exam_value,
			    download,date)
                VALUES (:cid,:eid,:cdep,:ecat,:ecre,:ename,:exnqr,:enq,:etime,:edate,:stime,:cdate)");

				$cmy->bindValue(':cid', $new_cat_id);
				$cmy->bindValue(':eid', $exam_id);
				$cmy->bindValue(':cdep', $creator_dep);
				$cmy->bindValue(':ecat', $ecat);
				$cmy->bindValue(':ecre', $creator);
				$cmy->bindValue(':ename', $ename);
				$cmy->bindValue(':exnqr', $numq);
				$cmy->bindValue(':enq', $etype);
				$cmy->bindValue(':etime', $gtime);
				$cmy->bindValue(':edate', $edate);
				$cmy->bindValue(':stime', $etime);
				$cmy->bindValue(':cdate', $date);
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
				}else{
					echo '<div class="alert alert-danger" role="alert">
				Sorry, exam name already exist!
			  </div>';
				}
		
		
		} else {
				echo '<div class="alert alert-danger" role="alert">
				Please fill the form correctlly!
			  </div>';
			}
		}



		if ($_POST['action'] == 'update_exami') {

			$new_cat_id = trim($_POST['new_cat_id']);
			$exam_id = trim($_POST['exam_id']);
			$ename = trim($_POST['ename']);
			$numq = trim($_POST['numq']);
			$gtime = trim($_POST['gtime']);
			$etype = trim($_POST['etype']);
			$edate = trim($_POST['edate']);
			$etime = trim($_POST['etime']);
			$ecat = trim($_POST['ecat']);
			

			  if($ecat == 'Special' &&  $edate > 10){
				echo '<div class="alert alert-danger" role="alert">
				Special exam value not exceed 10%!
			  </div>';
			  }
           else{
			if ($new_cat_id  && $exam_id && $ename && $numq && $gtime && $etype && $edate  && $ecat   != null) {
			
				$sql = "SELECT exam_name FROM exam WHERE exam_name=:datii AND exam_id!=:examidd";
				$dustmt = $pdo->prepare($sql);
				$dustmt->bindValue(':datii', $ename);
				$dustmt->bindValue(':examidd',$exam_id);
				$dustmt->execute();
				$dcolstr = $dustmt->fetchAll(PDO::FETCH_ASSOC);
				
				if(count($dcolstr) <= 0){

				$cmy = $pdo->prepare("UPDATE exam SET exam_category=:ecat, exam_name=:ename, exam_nq=:exnqr, exam_type=:enq, exam_time=:etime, 
				exam_value=:edate, download=:stime WHERE cat_id=:cid AND exam_id=:eid");

				$cmy->bindValue(':ecat', $ecat);
				$cmy->bindValue(':cid', $new_cat_id);
				$cmy->bindValue(':eid', $exam_id);
				$cmy->bindValue(':ename', $ename);
				$cmy->bindValue(':exnqr', $numq);
				$cmy->bindValue(':enq', $etype);
				$cmy->bindValue(':etime', $gtime);
				$cmy->bindValue(':edate', $edate);
				$cmy->bindValue(':stime', $etime);
				$cmy->execute();

				$ncmy = $pdo->prepare("UPDATE assexam SET exam_category=:eecat,exam_date=:edate, start_time=:stime WHERE exam_id=:eid");
				$ncmy->bindValue(':eecat', $ecat);
                 if( $ecat == 'Special'){
				$ncmy->bindValue(':edate', $edate);
				$ncmy->bindValue(':stime', $etime);
				 }
				 else{
					$sqll = "SELECT exam_date, start_time FROM assexam WHERE exam_category=:datii AND exam_id =:examidd";
					$adustmt = $pdo->prepare($sqll);
					$adustmt->bindValue(':datii', 'Regular');
					$adustmt->bindValue(':examidd',$exam_id);
					$adustmt->execute();
					$adcolstr = $adustmt->fetch(PDO::FETCH_ASSOC);
					$datess = '';
					$dtime = '';

					if (is_array($adcolstr)) {
						if (isset($adcolstr['exam_date'])) {
							$datess = $adcolstr['exam_date'];
						}

						if (isset($adcolstr['start_time'])) {
							$dtime = $adcolstr['start_time'];
						}
					}

					$ncmy->bindValue(':edate', $datess);
				    $ncmy->bindValue(':stime', $dtime);
				 }
				$ncmy->bindValue(':eid', $exam_id);
				$ncmy->execute();

				echo '<div class="alert  alert-success" id="sualert" role="alert">
			The  exam succesfully updated!
			<script>
			document.getElementById("new_exam").reset();
			$("#sualert").alert();
			setTimeout(function() {
			$("#sualert").alert("close");
				}, 2000);
			
			</script>
		  </div>';
				}else{
					echo '<div class="alert alert-danger" role="alert">
				Sorry, exam name already exist!
			  </div>';
				}
		
		
		} else {
				echo '<div class="alert alert-danger" role="alert">
				Please fill the form correctlly!
			  </div>';
			
		}

		}
		}





		if ($_POST['action'] == 'assignexami') {

			//$isChecked = $_POST['is_checked'];
			$department = trim($_POST['department']);
			$yeari = trim($_POST['yeari']);
			$assiner_dep = trim($_POST['assiner_dep']);
			$exam_id = trim($_POST['exam_id']);

			$nfetch=$pdo->prepare('SELECT * FROM exam WHERE exam_id = :euid ');
			$nfetch->bindValue(':euid',$exam_id);
			$nfetch->execute();
			$nshow=$nfetch->fetch(PDO::FETCH_ASSOC);

			$mskin = $pdo->prepare('SELECT * FROM assexam WHERE  exam_id=:acreta AND assigned_by=:asbiy AND assigned_Department=:asdep AND assigned_year=:asyear  ');
			$mskin->bindValue(':acreta',$exam_id);
			$mskin->bindValue(':asbiy', $assiner_dep);
			$mskin->bindValue(':asdep', $department);
			$mskin->bindValue(':asyear',$yeari);	
			$mskin->execute();
			$myassdepa = $mskin->fetchAll(PDO::FETCH_ASSOC);

         if(count($myassdepa) == 0){
				$ctmy = $pdo->prepare("INSERT INTO assexam(exam_category,exam_id,assigned_by,assigned_Department,assigned_year,exam_date,start_time)
                VALUES (:ecat,:eid,:asby,:assdep,:assyear,:edate,:stime)");

				$ctmy->bindValue(':ecat', $nshow['exam_category']);
				$ctmy->bindValue(':eid', $exam_id);
				$ctmy->bindValue(':asby', $assiner_dep);
				$ctmy->bindValue(':assdep', $department);
				$ctmy->bindValue(':assyear', $yeari);
				$ctmy->bindValue(':edate', $nshow['exam_date']);
				$ctmy->bindValue(':stime', $nshow['start_time']);
				$ctmy->execute();
				echo'<span id="asssuccess" class="alert alert-success" >Succesfully Assigned</span>
				<script>
				$("#asssuccess").alert();
				setTimeout(function() {
				$("#asssuccess").alert("close");
				  }, 2000);
				
				</script>';
			}
			else{
				$delete_sql = "DELETE FROM assexam WHERE exam_id=:acreta AND assigned_by=:asbiy AND assigned_Department=:asdep AND assigned_year=:asyear";
				$delete_stmt = $pdo->prepare($delete_sql);
				$delete_stmt->bindValue(':acreta', $exam_id);
				$delete_stmt->bindValue(':asbiy', $assiner_dep);
				$delete_stmt->bindValue(':asdep', $department);
				$delete_stmt->bindValue(':asyear', $yeari);
				$delete_stmt->execute();

				echo'<span id="asssuccess" class="alert alert-danger" >The department is successfully unassigned </span>
				<script>
				$("#asssuccess").alert();
				setTimeout(function() {
				$("#asssuccess").alert("close");
				  }, 2000);
				
				</script>';
			
			}





		}

		if ($_POST['action'] == 'assignexamigroup') {

			$assgroup = trim($_POST['assgroup']);
			$department = trim($_POST['department']);
			$yeari = trim($_POST['yeari']);
			$assiner_dep = trim($_POST['assiner_dep']);
			$exam_id = trim($_POST['exam_id']);

			$nfetch=$pdo->prepare('SELECT * FROM exam WHERE exam_id = :euid ');
			$nfetch->bindValue(':euid',$exam_id);
			$nfetch->execute();
			$nshow=$nfetch->fetch(PDO::FETCH_ASSOC);

			$qmskin = $pdo->prepare('SELECT * FROM assexam WHERE  exam_id=:acreta AND assigned_by=:asbiy AND assigned_Department=:asdep AND assigned_year=:asyear ');
			$qmskin->bindValue(':acreta',$exam_id);
			$qmskin->bindValue(':asbiy', $assiner_dep);
			$qmskin->bindValue(':asdep', $department);
			$qmskin->bindValue(':asyear',$yeari);	
			$qmskin->execute();
			$qmyassdepa = $qmskin->fetchAll(PDO::FETCH_ASSOC);
			if($assgroup !=null){
	if(count($qmyassdepa) > 0){
		 $bsttmt=$pdo->prepare("UPDATE assexam SET assigned_group = :assgroup,exam_date=:edate,start_time=:stime
		 WHERE exam_id=:acreta AND assigned_by=:asbiy AND assigned_Department=:asdep AND assigned_year=:asyear ");
			   
			   $bsttmt->bindValue(':assgroup',$assgroup);
			   $bsttmt->bindValue(':acreta',$exam_id);
			   $bsttmt->bindValue(':asbiy', $assiner_dep);
			   $bsttmt->bindValue(':asdep', $department);
			   $bsttmt->bindValue(':asyear',$yeari);
			   $bsttmt->bindValue(':edate', $nshow['exam_date']);
			   $bsttmt->bindValue(':stime', $nshow['start_time']);
			   $bsttmt->execute();

            echo'<span id="asssuccess" class="alert alert-success" >Succesfully Updated</span>
			<script>
			$("#asssuccess").alert();
			setTimeout(function() {
			$("#asssuccess").alert("close");
			  }, 2000);
			
			</script>';

			}
			
			else{
				$ctmy = $pdo->prepare("INSERT INTO assexam(exam_id,assigned_by,assigned_Department,assigned_group,assigned_year,exam_date,start_time)
                VALUES (:eid,:asby,:assdep,:assgroup,:assyear,:edate,:stime)");

				$ctmy->bindValue(':eid', $exam_id);
				$ctmy->bindValue(':asby', $assiner_dep);
				$ctmy->bindValue(':assdep', $department);
				$ctmy->bindValue(':assgroup', $assgroup);
				$ctmy->bindValue(':assyear', $yeari);
				$ctmy->bindValue(':edate', $nshow['exam_date']);
			    $ctmy->bindValue(':stime', $nshow['start_time']);
				$ctmy->execute();

				echo'<span id="asssuccess" class="alert alert-success" >Succesfully Assigned</span>
				<script>
				$("#asssuccess").alert();
				setTimeout(function() {
				$("#asssuccess").alert("close");
				  }, 2000);
				
				</script>';


			}
		}
			
		}

		
		if ($_POST['action'] == 'delexam') {
			$cat_id = trim($_POST['catid']);
			$exam_id = trim($_POST['exam_id']);

			$qmskin = $pdo->prepare('SELECT * FROM assexam WHERE  exam_id=:acreta');
			$qmskin->bindValue(':acreta',$exam_id);	
			$qmskin->execute();
			$qmyassdepa = $qmskin->fetchAll(PDO::FETCH_ASSOC);
	    if(count($qmyassdepa) > 0){
			echo'<div id="asssuccess" class="alert alert-danger" >Please unassign the departments!</div>
			<script>
			$("#asssuccess").alert();
			setTimeout(function() {
			$("#asssuccess").alert("close");
			  }, 3000);
			
			</script>';
		}
    else{
		$delete_sql = "DELETE FROM exam WHERE exam_id=:acreta AND cat_id=:asyear";
		$delete_stmt = $pdo->prepare($delete_sql);
		$delete_stmt->bindValue(':acreta', $exam_id);
		$delete_stmt->bindValue(':asyear', $cat_id);
		$delete_stmt->execute();
	    echo'<div id="asssuccess" class="alert alert-success" >The exam is successfully deleted!</div>
			<script>
			$("#asssuccess").alert();
			setTimeout(function() {
			$("#asssuccess").alert("close");
			  }, 2000);
			
			</script>';
	}
		}
		if ($_POST['action'] == 'editexami') {
			
			$editexam_output='';

			$exam_id = trim($_POST['exam_id']);
			$gtime = trim($_POST['gtime']);
			$stime = trim($_POST['stime']);
			$edate = trim($_POST['edate']);
			$numq = trim($_POST['numq']);
			$ename = trim($_POST['ename']);
			$etype = trim($_POST['etype']);
			$cat_name = trim($_POST['cname']);
			$cat_id = trim($_POST['catid']);
			$ecat = trim($_POST['ecat']);

			$fetch = $pdo->prepare('SELECT creator_dep FROM exam WHERE cat_id=:cid AND exam_id=:exid');
			$fetch->bindValue(':cid', $cat_id);
			$fetch->bindValue(':exid', $exam_id);
			$fetch->execute();
			$result = $fetch->fetchAll(PDO::FETCH_ASSOC);
			foreach ($result as $row) {
				$dep = $row['creator_dep'];
				
			}
			

			$editexam_output .= '
			<!-- exam_Modal -->

                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Exam </h5>
							<span id="boom" class="text-end"> ( ' . $cat_name . ' ) </span>
                            <button type="button" data-catname="'.$cat_name.'" data-catid="'.$cat_id.'" data-dep="'.$dep.'"    " class="update_exam_close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                            <div class="modal-body">
                              <div id="adde_result"></div>
                              <form class="form-group was-validated" method="POST" id="up_exam" action="#" >
							  <div id="Update_exam_success"  > </div>
							      <input type="hidden" id="cat_id" value=" '.$cat_id.'">
								  <input type="hidden" id="exam_id" value=" '.$exam_id.'">
								  <div class="col mb-1">
                                  <label><h6 class="m-1 font-weight-bold text-primary">Exam Category </h6></label>
                                  <select  class="form-control" id="ecat" name="ecat" required>';

								  if($ecat == 'Regular'){
									$editexam_output .= '  <option selected value="Regular">Regular</option>';
								  }
								  if($ecat == 'Special'){
									$editexam_output .= '  <option selected value="Special">Special</option>';
								  }
								   
								   $editexam_output.=' <option value="Regular">Regular</option>
                                    <option value="Special">Special</option>
								 </select>
								  </div>
								  <div class=" row mb-1">
                                  <div class="col mb-1">
                                  <label><h6 class="m-1 font-weight-bold text-primary">Name</h6></label>
                                  <input type="text" class="form-control" id="ename" value="'.$ename.'" name="cname" required placeholder="Enter exam name"></div>
                                  
                                  <div class="col mb-1">
                                  <label><h6 class="m-1 font-weight-bold text-primary">Given Time</h6></label>
                                  <input type="number" class="form-control" value="'.$gtime.'" min="1" id="gtime" name="gtime" required placeholder="Enter given time in minute" ></div>
                                </div>
								  <div class="row">
                                  <div class="col mb-1">
                                  <label><h6 class="m-1 font-weight-bold text-primary">Exam Value</h6></label>
								  <div class="input-group">
								  <input type="number" pattern = "/^(?=.*[1-9])\d*(\.\d+)?$/" min="10" value="'.$edate.'" class="form-control" id="edate" name="edate" required placeholder="Enter exam value">
								  <div class="input-group-append">
									  <span class="input-group-text">%</span>
								  </div>
								  </div>							 
								  </div>
                                  <div class="col mb-1">
                                  <label><h6 class="m-1 font-weight-bold text-primary">Quesion Download</h6></label>
								  <select  class="form-control" id="etime" name="stime" required>';
								    
                                              if($stime == '1'){
												$editexam_output .= '  <option selected value="1">Permited</option>';
											  }
											  if($stime == '0'){
												$editexam_output .= '  <option selected value="0">Denyed</option>';
											  }

								 
								  $editexam_output .= ' <option value="1">Permit</option>
								                        <option value="0">Deny</option>';



									$editexam_output .= '	 </select>
                                </div> 
								</div> 
								<div class="row">

								<div class="col mb-1">
								<label><h6 class="m-1 font-weight-bold text-primary">Number of Question</h6></label>
								<input type="number" class="form-control" value="'.$numq.'" min="1" id="numq" name="numq" required placeholder="Enter number of question" >
								</div>
								

								<div class="col mb-1">
								<label><h6 class="m-1 font-weight-bold text-primary">Exam Type</h6></label>
                                <select id="etype" name="etype" class="form-select" required aria-label="type">
                                    <option value="'.$etype.'" selected>'.$etype.'</option>
                                    <option value="Real">Real</option>
                                    <option value="Practise">Practise</option>
                                </select>
								</div>  
								</div>
							  <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                              <input type="button"  name="csent" id="runn" class="update_exam btn btn-primary" value="Update"> </div>
                              </form>
                            </div>                
                 </div>';
				 echo $editexam_output;




		}
	}
}

}else{
	header("Location: ../index");
	exit();
}
function random($slici)
{
	$char = '123456789';
	$str = $slici;
	$num = '';
	for ($i = 0; $i < 17; $i++) {
		$index = rand(0, strlen($char) - 1);
		$str  .= $char[$index];
	}
	$num = $num . $str;
	return $num;
}


?>
