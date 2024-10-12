


$fetchs = $pdo->prepare('SELECT * FROM  course   WHERE assigned_teacher = :uiid AND cat_id=:cati GROUP BY Department, assigned_year  ORDER BY Department ASC');
			$fetchs->bindValue(':uiid', $teacher);
			$fetchs->bindValue(':cati', $cat_id);
			$fetchs->execute();
			$formi = $fetchs->fetchAll(PDO::FETCH_ASSOC);

<label><h6 class="m-0 font-weight-bold text-primary">Assign the exam for candidaates</h6></label>
								<div class="row">
								
								<div class="col">
								<div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
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

                                   
						                $mfetchs = $pdo->prepare('SELECT dep_name FROM  department  WHERE  dep_id=:depu  ');
										$mfetchs->bindValue(':depu', $fu['Department']);
										$mfetchs->execute();
										$mforq = $mfetchs->fetchAll(PDO::FETCH_ASSOC);
										foreach ($mforq as $mfo) {
											$dep_name=$mfo['dep_name'];

										}

				          $q_output .= '
									   <div class="row">


										<div class="col mb-1">
									   <div class="form-check">
									   <input class="form-check-input" name="departmentradio" required type="checkbox" value="' . $fu['Department'] . '" id="flexCheckDefault'.$inc.'">
									   <label class="form-check-label mb-2" for="flexCheckDefault'.$inc.'">
									   ' .$dep_name. '
									   </label></br>
									 </div> </div> ';

										$qfetchs = $pdo->prepare('SELECT DISTINCT assigned_group  FROM  course   WHERE assigned_teacher = :uiid AND cat_id=:cati AND department=:depu  ');
										$qfetchs->bindValue(':uiid', $teacher);
										$qfetchs->bindValue(':cati', $cat_id);
										$qfetchs->bindValue(':depu', $fu['Department']);
										$qfetchs->execute();
										$forq = $qfetchs->fetchAll(PDO::FETCH_ASSOC);


							$q_output .= ' <div class="col mb-1">
									 
										   
							<select id="group'.$inc.'" name="uctype"   class="form-select" required  aria-label="type" >
										   <option value=" " ></option>';
									foreach ($forq as $fo) {

										$q_output .= '<option value="'.$fo['assigned_group'].'">'.$fo['assigned_group'].'</option>';
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
                                            
								      <input type="number" class="form-control" id="stnum'.$inc.'" name="nums"  placeholder="Enter student number "></div>
										
                                        </div>
									   ';
		                             $inc ++;	}




			$q_output .= '  </div></div>    <div class="modal-footer">
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
