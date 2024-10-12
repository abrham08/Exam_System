<?php
include "dbc.php";
if (isset($_POST['page'])) {
	if ($_POST['page'] == 'question') {
		if ($_POST['action'] == 'addquestion' || $_POST['action'] == 'advaddquestion' ) {
              $it = 1;
              $catid=$_POST['catid'];
              $examid=$_POST['examid'];
              $qtype = 'choose';
              $slici = strtoupper(substr($examid, 0, 3));
		      $quest_id = random($slici);
              $photo1='';
              $photo2='';
              $photo3='';
              $photo4='';
              $photo5='';
              $photo6='';
              $photo7='';
        if($_POST['action'] == 'advaddquestion' ){
            $cvalue= $_POST['agmark'];
          //  $data = $_POST['data'];
            $question = encryptText($_POST['aque']);

            $opt1 = trim($_POST['aopt1']);          
            $opt2 = trim($_POST['aopt2']);;
            $opt3 = trim($_POST['aopt3']);
            $opt4 = trim($_POST['aopt4']);
            $opt5 = trim($_POST['aopt5']);
            $opt6 = trim($_POST['aopt6']);

            $uploadedPhotos = [];

            // Handle the uploaded files
            foreach ($_FILES as $name => $file) {
                // Check if file was uploaded successfully
                if ($file['error'] === UPLOAD_ERR_OK) {
                    // Assign the file to a specific variable based on the name attribute
                    if ($name === 'image1') {
                        $photo1 = $file;
                    } elseif ($name === 'image2') {
                        $photo2 = $file;
                    } elseif ($name === 'image3') {
                        $photo3 = $file;
                    }
                 elseif ($name === 'image4') {
                    $photo4 = $file;
                } elseif ($name === 'image5') {
                    $photo5 = $file;
                }
                elseif ($name === 'image6') {
                        $photo6 = $file;
                    }
                elseif ($name === 'image7') {
                    $photo7 = $file;
                }
                } else {
                    echo "Error uploading file '$name'.<br>";
                }
            }
           


            $accept = ["jpg","jpeg", "png", "gif", "webp",null];

            if(!empty($_POST['aasot'])){
            $ans = hash_password($_POST['aasot']);
            }
            else{
                $ans=null;
            }
           //  
        }
      else{
              $cvalue=$_POST['gmark'];
              $question =  encryptText($_POST['question']);
              $opt1 =$_POST['opt1'];
              $opt2 =$_POST['opt2'];
              $opt3 =$_POST['opt3'] ?? null;
              $opt4 =$_POST['opt4'] ?? null;
              $opt5 =$_POST['opt5'] ?? null;
              $opt6 =$_POST['opt6'] ?? null;
              if(!empty($_POST['asot'])){
                $ans = hash_password($_POST['asot']);
                }
                else{
                    $ans=null;
                }
            }
     if ($catid && $examid && $cvalue && $question && $opt1 && $opt2  && $ans   != null) {

                $sql = "SELECT * FROM question WHERE quest_id=:idat";
                $ustmt = $pdo->prepare($sql);
                $ustmt->bindValue(':idat', $quest_id);
                $ustmt->execute();
                $userd = $ustmt->fetchAll(PDO::FETCH_ASSOC);
                $qphoto_name ='';
                $opphoto_name ='';
                
                if(count($userd) > 0){
                $quest_id = $quest_id.$cvalue;
                }
                if ($photo1 !='') {
                $ext = strtolower(pathinfo($photo1["name"], PATHINFO_EXTENSION)) ?? null;
                if  (in_array($ext, $accept)){
                  $photo =$photo1;
          
                  $qphoto_name = $examid.$quest_id. '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
          
                  // Upload photo to server
                  $target_dir = 'img/question/';
                  $target_file = $target_dir . $qphoto_name;
                  move_uploaded_file($photo['tmp_name'], $target_file);
          
                }
            }
            $sqlv = "SELECT * FROM exam WHERE cat_id=:idat AND exam_id=:eid";
                $vustmt = $pdo->prepare($sqlv);
                $vustmt->bindValue(':idat', $catid);
                $vustmt->bindValue(':eid', $examid);
                $vustmt->execute();
                $userd = $vustmt->fetch(PDO::FETCH_ASSOC);
                $totval=$userd['exam_value'];

               $fet=$pdo->prepare("SELECT SUM(right_ans) as total_mark FROM question WHERE
               cat_id=:cat AND  exam_id=:eid ");
               $fet->bindValue(':cat',$catid);
               $fet->bindValue(':eid',$examid);
               $fet->execute();
               $marks_result=$fet->fetchAll(PDO::FETCH_ASSOC);
               foreach($marks_result as $row)
               {
                   $user_sum=$row["total_mark"];
               }
               
               if ((float)($cvalue + $user_sum) > (float)$totval) {
                echo '<div class="alert  alert-danger" id="usualert" role="alert">
                The exam value limit can not exceed from '.$totval.'!
                <script>
                $("#usualert").alert();
                setTimeout(function() {
                $("#usualert").alert("close");
                  }, 20000);
                
                </script>
                </div>';
               }
              else{
              $dcmy = $pdo->prepare("INSERT INTO question(cat_id,exam_id,quest_type,quest_id,question_image,question,quest_ans,right_ans,qcreator)
              VALUES (:cat_id,:exam_id,:quest_type,:quest_id,:qimage,:question,:quest_ans,:right_ans,:qcreator)");
                  $dcmy->bindValue(':cat_id', $catid);
                  $dcmy->bindValue(':exam_id', $examid);
                  $dcmy->bindValue(':quest_type', $qtype);
                  $dcmy->bindValue(':quest_id', $quest_id);
                  $dcmy->bindValue(':qimage', $qphoto_name);
                  $dcmy->bindValue(':question', $question);
                  $dcmy->bindValue(':quest_ans', $ans);
                  $dcmy->bindValue(':right_ans', $cvalue);
                  $dcmy->bindValue(':qcreator', $_POST['creator']);

                  $dcmy->execute();

                  while ($it <= 6) {
                    $optm = '';
                    $imname = '';
                    $ioptm = '';
                
                    switch ($it) {
                        case 1:
                            $optm = $opt1;
                            $ioptm = $photo2;
                            break;
                        case 2:
                            $optm = $opt2;
                            $ioptm = $photo3;
                            break;
                        case 3:
                            $optm = $opt3;
                            $ioptm = $photo4;
                            break;
                        case 4:
                            $optm = $opt4;
                            $ioptm = $photo5;
                            break;
                        case 5:
                            $optm = $opt5;
                            $ioptm = $photo6;
                            break;
                        case 6:
                            $optm = $opt6;
                            $ioptm = $photo7;
                            break;
                    }
                
                    if (!empty($optm)) {
                        $opphoto_name = null;
                
                        if ($ioptm != '' && isset($ioptm['name']) && !empty($ioptm['name'])) {
                            $iname = $examid . $quest_id . $it;
                            $accept = ["jpg", "jpeg", "png", "gif", "webp"];
                
                            $ext = strtolower(pathinfo($ioptm["name"], PATHINFO_EXTENSION));
                
                            if (in_array($ext, $accept)) {
                                $photo = $ioptm;
                                $opphoto_name = $iname . '.' . $ext;
                                $target_dir = 'img/option/';
                                $target_file = $target_dir . $opphoto_name;
                                move_uploaded_file($photo['tmp_name'], $target_file);
                            }
                        }
                
                        $cmy = $pdo->prepare("INSERT INTO option_list(cat_id, exam_id, quest_type, quest_id, opt_no, ot, option_image) 
                            VALUES (:cid, :eid, :qtype, :qid, :ono, :ot, :option_image)");
                        $cmy->bindValue(':cid', $catid);
                        $cmy->bindValue(':eid', $examid);
                        $cmy->bindValue(':qtype', $qtype);
                        $cmy->bindValue(':qid', $quest_id);
                        $cmy->bindValue(':ono', $it);
                        $cmy->bindValue(':ot', $optm);
                        $cmy->bindValue(':option_image', $opphoto_name);
                        $cmy->execute();
                    }
                
                    $it++;
                }
                

             
             

            echo '<div class="alert  alert-success" id="sualert" role="alert">
			The new question succesfully added!
			<script>
			document.getElementById("naddQuestion").reset();
			$("#sualert").alert();
			setTimeout(function() {
			$("#sualert").alert("close");
				}, 2000);
			
                var editor1 = CKEDITOR.instances.aque;
                var editor2 = CKEDITOR.instances.aopt1;
                var editor3 = CKEDITOR.instances.aopt2;
                var editor4 = CKEDITOR.instances.aopt3;
                var editor5 = CKEDITOR.instances.aopt4;
                var editor6 = CKEDITOR.instances.aopt5;
                var editor7 = CKEDITOR.instances.aopt6;
                
                // Reset the value of each CKEditor instance
                editor1.setData("");
                editor2.setData("");
                editor3.setData("");
                editor4.setData("");
                editor5.setData("");
                editor6.setData("");
                editor7.setData("");


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

        if($_POST['action'] == 'editquestion'  ) {

            $photo0='';
            $photo1='';
            $photo2='';
            $photo3='';
            $photo4='';
            $photo5='';
            $photo6='';

           $catid = $_POST['catid'];
           $examid = $_POST['examid'];
           $questid = $_POST['questid'];
           $mkmark = $_POST['gmark'];
           $itn=1;
           $ans = hash_password($_POST['asot']);
           $question =  encryptText(trim($_POST['question']));
           $opt1 = trim($_POST['opt1']);
           $opt2 = trim($_POST['opt2']);
           $opt3 = trim($_POST['opt3']);
           $opt4 = trim($_POST['opt4']);
           $opt5 = trim($_POST['opt5']);
           $opt6 = trim($_POST['opt6']);

           $uploadedPhotos = [];

            // Handle the uploaded files
            foreach ($_FILES as $name => $file) {
                // Check if file was uploaded successfully
                if ($file['error'] === UPLOAD_ERR_OK) {
                    // Assign the file to a specific variable based on the name attribute
                    if ($name === 'image0') {
                        $photo0 = $file;
                    } elseif ($name === 'image1') {
                        $photo1 = $file;
                    } elseif ($name === 'image2') {
                        $photo2 = $file;
                    }
                 elseif ($name === 'image3') {
                    $photo3 = $file;
                } elseif ($name === 'image4') {
                    $photo4 = $file;
                }
                elseif ($name === 'image5') {
                        $photo5 = $file;
                    }
                elseif ($name === 'image6') {
                    $photo6 = $file;
                }
                } else {
                    echo "Error uploading file '$name'.<br>";
                }
            }
           


            $accept = ["jpg","jpeg", "png", "gif", "webp",null];



    if ($catid && $examid && $mkmark && $question && $opt1 && $opt2  && $ans   != null) {

        $qqimg='';
        $sql = "SELECT question_image FROM question WHERE cat_id=:idat AND exam_id=:eid AND quest_id=:qid ";
        $eustmt = $pdo->prepare($sql);
        $eustmt->bindValue(':idat', $catid);
        $eustmt->bindValue(':eid', $examid);
        $eustmt->bindValue(':qid', $questid);
        $eustmt->execute();
        $qimage = $eustmt->fetch(PDO::FETCH_ASSOC);
        $qqimg = $qimage['question_image'];

        $sqlv = "SELECT * FROM exam WHERE cat_id=:idat AND exam_id=:eid";
        $vustmt = $pdo->prepare($sqlv);
        $vustmt->bindValue(':idat', $catid);
        $vustmt->bindValue(':eid', $examid);
        $vustmt->execute();
        $userd = $vustmt->fetch(PDO::FETCH_ASSOC);
        $totval=$userd['exam_value'];

       $fet=$pdo->prepare("SELECT SUM(right_ans) as total_mark FROM question WHERE
       cat_id=:cat AND  exam_id=:eid ");
       $fet->bindValue(':cat',$catid);
       $fet->bindValue(':eid',$examid);
       $fet->execute();
       $marks_result=$fet->fetchAll(PDO::FETCH_ASSOC);
       foreach($marks_result as $row)
       {
           $user_sum=$row["total_mark"];
       }
       
       if ((float)($mkmark + $user_sum) > (float)$totval) {
        echo '<div class="alert  alert-danger" id="usualert" role="alert">
        The exam value limit can not exceed from '.$totval.'!
        <script>
        $("#usualert").alert();
        setTimeout(function() {
        $("#usualert").alert("close");
          }, 20000);
        
        </script>
        </div>';
       }
      else{
        if ($photo0 !='') {

           if($qimage['question_image'] != ''){
            $directory = 'img/question/';
            $filenameWithoutExtension = $qimage['question_image'];
            
            $files = glob($directory . $filenameWithoutExtension . '.*');
            
            if (!empty($files)) {
                $fileToDelete = $files[0];
                if (is_file($fileToDelete)) {
                    unlink($fileToDelete);
                }
            }
        }

                $ext = strtolower(pathinfo($photo0["name"], PATHINFO_EXTENSION)) ?? null;
                if  (in_array($ext, $accept)){
                  $photo =$photo0;
          
                  $qqimg  = $examid.$questid. '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
          
                  // Upload photo to server
                  $target_dir = 'img/question/';
                  $target_file = $target_dir . $qqimg ;
                  move_uploaded_file($photo['tmp_name'], $target_file);
          
                }




            }

                        $dcmy = $pdo->prepare("UPDATE question
                        SET question = :question,
                            question_image=:qimage,
                            quest_ans = :quest_ans,
                            right_ans = :right_ans
                        WHERE cat_id = :cat_id
                        AND exam_id = :exam_id
                        AND quest_id = :quest_id");
                    $dcmy->bindValue(':cat_id', $catid);
                    $dcmy->bindValue(':exam_id', $examid);
                    $dcmy->bindValue(':quest_id', $questid);
                    $dcmy->bindValue(':question', $question);
                    $dcmy->bindValue(':qimage', $qqimg);
                    $dcmy->bindValue(':quest_ans', $ans);
                    $dcmy->bindValue(':right_ans', $mkmark);
                    $dcmy->execute();

            while($itn<=6){

                        $optm ='';
                        $imname='';
                        $ioptm ='';
                         switch ($itn) {
                             case 1:
                                 $optm = $opt1;
                                 $ioptm =$photo1;
                                 break;
                             case 2:
                                 $optm= $opt2;
                                 $ioptm =$photo2;
                                 break;
                             case 3:
                                 $optm = $opt3;
                                 $ioptm =$photo3;
                                 break;
                             case 4:
                                 $optm = $opt4;
                                 $ioptm =$photo4;
                                 break;
                             case 5:
                                 $optm = $opt5;
                                 $ioptm =$photo5;
                                 break;
                             case 6:
                                 $optm = $opt6;
                                 $ioptm =$photo6;
                                 break;
                         }
                         if (!empty($optm)) {

                            $sql = "SELECT option_image FROM option_list WHERE cat_id=:idat AND exam_id=:eid AND quest_id=:qid AND opt_no=:optno";
                            $eustmt = $pdo->prepare($sql);
                            $eustmt->bindValue(':idat', $catid);
                            $eustmt->bindValue(':eid', $examid);
                            $eustmt->bindValue(':qid', $questid);
                            $eustmt->bindValue(':optno', $itn);
                            $eustmt->execute();
                            $oqimage = $eustmt->fetch(PDO::FETCH_ASSOC);
                            $imname = $oqimage['option_image'];

                            if ($ioptm != '') {

                                if($qimage['question_image'] != ''){
                                    $directory = 'img/option/';
                                    $filenameWithoutExtension = $oqimage['option_image'];
                                    
                                    $files = glob($directory . $filenameWithoutExtension . '.*');
                                    
                                    if (!empty($files)) {
                                        $fileToDelete = $files[0];
                                        if (is_file($fileToDelete)) {
                                            unlink($fileToDelete);
                                        }
                                    }
                                }
                                $iname=$examid.$questid.$itn;
                                $accept = ["jpg","jpeg", "png", "gif", "webp",null];
        
                                $ext = strtolower(pathinfo($ioptm["name"], PATHINFO_EXTENSION)) ?? null;
                                if  (in_array($ext, $accept)){
                                $photo =$ioptm;
                        
                                $imname = $iname. '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
                                $target_dir = 'img/option/';
                                $target_file = $target_dir . $imname;
                                move_uploaded_file($photo['tmp_name'], $target_file);
                                }
        
                            }
                            $update = $pdo->prepare("
                            UPDATE option_list
                            SET ot = :ot,
                            option_image=:oimg
                            WHERE cat_id = :cid
                            AND exam_id = :eid
                            AND quest_id = :qid
                            AND opt_no = :ono
                        ");
                        
                        $update->bindValue(':cid', $catid);
                        $update->bindValue(':eid', $examid);
                        $update->bindValue(':qid', $questid);
                        $update->bindValue(':ono', $itn);
                        $update->bindValue(':ot', $optm);
                        $update->bindValue(':oimg', $imname);
                        $update->execute();

                         }
         
                     $itn++;
         
                     }
                     echo '<div class="alert alert-success" role="alert">
            The question have been succesfully updated!
          </div>';


    }}
    else{
        echo '<div class="alert alert-danger" role="alert">
        Please fill the form correctlly!
      </div>';
    }

        }
        if($_POST['action'] == 'questcdelete'  ) {

            $delete_sql = "DELETE FROM question WHERE quest_id = :id AND exam_id=:tdepdd";
                $delete_stmt = $pdo->prepare($delete_sql);
                $delete_stmt->bindValue(':id', $_POST['questid']);
                $delete_stmt->bindValue(':tdepdd', $_POST['examid']);
                $delete_stmt->execute();

                $ddelete_sql = "DELETE FROM option_list WHERE quest_id = :iid AND exam_id=:mdepdd";
                $ddelete_stmt = $pdo->prepare($ddelete_sql);
                $ddelete_stmt->bindValue(':iid', $_POST['questid']);
                $ddelete_stmt->bindValue(':mdepdd', $_POST['examid']);
                $ddelete_stmt->execute();

                echo '<div class="alert  alert-success" id="udsualert" role="alert">
                The question successfully deleted!
      
                </div>';
        }

  // Matching question Start


  if ($_POST['action'] == 'matchadd') {

    $answerOptions = $_POST['answerOptions'] ?? null;
    $columnA = $_POST['columnA'] ?? null;
    $columnB = $_POST['columnB'] ?? null;
    $pcolumnA = $_POST['pcolumnA'] ?? null;
    $pcolumnB = $_POST['pcolumnB'] ?? null;
    $catid = $_POST['catid'] ?? null;
    $examid = $_POST['examid'] ?? null;
    $right_ans = $_POST['mvalue'] ?? null;
    $check_update = $_POST['chkupdate'] ?? null;
    $quest_type = 'match';
    $creator = $_POST['creator'] ?? null;

    if ($answerOptions !== null && $columnA !== null && $columnB !== null) {
        // Validation
        $errors = array();

        // Validate and sanitize the form data
        $sanitizedAnswerOptions = array_map('sanitizeInput', $answerOptions);
        $sanitizedColumnA = array_map('sanitizeInput', $columnA);
        $sanitizedColumnB = array_map('sanitizeInput', $columnB);
        if($pcolumnA != null){
            $psanitizedColumnA = array_map('sanitizeInput', $pcolumnA);
        }
        else{
            $psanitizedColumnA =$pcolumnA;
        }
        if($pcolumnB != null){
            $psanitizedColumnB = array_map('sanitizeInput', $pcolumnB);
        }
        else{
            $psanitizedColumnB=$pcolumnB;
        }

        try {
            $Qm = 0;
            $stmt = $pdo->prepare("INSERT INTO question (cat_id, exam_id, quest_type, quest_id, question_image, question, quest_ans, right_ans,qcreator) 
                VALUES (:cat_id, :exam_id, :quest_type, :quest_id, :question_image, :question, :quest_ans, :right_ans,:qcreator)");

            for ($i = 0; $i < count($sanitizedColumnA); $i++) {
                $slici = strtoupper(substr($examid, 0, 3));
                $quest_id = random($slici);

                $quest = encryptText($sanitizedColumnA[$i]);
                $ans = hash_password($sanitizedAnswerOptions[$i]);

                if ($sanitizedColumnA[$i] && $sanitizedAnswerOptions[$i] && $right_ans !== ' ') {

                    if ($Qm == 0 && $check_update !=null) {
                        $ysmatch=$pdo->prepare('SELECT * FROM question WHERE  quest_type=:qtype');
                        $ysmatch->bindValue(':qtype','match');
                        $ysmatch->execute();
                        $ysmatcht=$ysmatch->fetchAll(PDO::FETCH_ASSOC);

                          if(count($ysmatcht) > 0){

                        $asql = "DELETE FROM question WHERE quest_type=:idat";
                        $austmt = $pdo->prepare($asql);
                        $austmt->bindValue(':idat', 'match');
                        $austmt->execute();
                        $Qm = 1;
                          }
                    }

                    $sql = "SELECT * FROM question WHERE quest_id=:idat";
                    $ustmt = $pdo->prepare($sql);
                    $ustmt->bindValue(':idat', $quest_id);
                    $ustmt->execute();
                    $userd = $ustmt->fetchAll(PDO::FETCH_ASSOC);

                    $imageAName = '';
                    $imageAPath = '';

                    if (count($userd) > 0) {
                        $quest_id = $quest_id . $right_ans;
                    }

                    // Handle image uploads for Column A
                    $fileError = $_FILES['columnA']['error'][$i];

                    if ($fileError === UPLOAD_ERR_OK) {
                        if(is_array($psanitizedColumnA) && isset($psanitizedColumnA[$i])){
                            $filenameWithoutExtension = $psanitizedColumnA[$i];
            
                            $files = glob($filenameWithoutExtension);
                            
                            if (!empty($files)) {
                                $fileToDelete = $files[0];
                                if (is_file($fileToDelete)) {
                                    unlink($fileToDelete);
                                }
                            }
                        }
                        $imageAName = $examid . $quest_id . '.' . pathinfo($_FILES['columnA']['name'][$i], PATHINFO_EXTENSION);
                        $imageATmpName = $_FILES['columnA']['tmp_name'][$i];
                    
                        $imageAPath = "img/question/" . $imageAName;
                        move_uploaded_file($imageATmpName, $imageAPath);
                    } elseif (is_array($psanitizedColumnA) && isset($psanitizedColumnA[$i])) {
                        $imageAPath = $psanitizedColumnA[$i];
                    } else {
                        $imageAPath = '';
                    }
                    

                    $stmt->bindParam(':cat_id', $catid);
                    $stmt->bindParam(':qcreator', $creator);
                    $stmt->bindParam(':exam_id', $examid);
                    $stmt->bindParam(':quest_type', $quest_type);
                    $stmt->bindParam(':quest_id', $quest_id);
                    $stmt->bindParam(':question_image', $imageAPath);
                    $stmt->bindParam(':question', $quest);
                    $stmt->bindParam(':quest_ans', $ans);
                    $stmt->bindParam(':right_ans', $right_ans);
                    $stmt->execute();
                } elseif ($quest && $ans === ' ' && $right_ans !== ' ') {
                    echo '<div class="alert alert-warning">column A at index ' . $i . ' not set</div>';
                } else {
                    $errors[] = '<div class="alert alert-danger">Please fill column A value correctly</div>';
                }
            }

            $fetchm = $pdo->prepare('SELECT * FROM option_list WHERE cat_id=:cid AND exam_id=:exid AND quest_type=:qtype ORDER BY opt_no ASC ');
            $fetchm->bindValue(':cid', $catid);
            $fetchm->bindValue(':exid', $examid);
            $fetchm->bindValue(':qtype', 'match');
            $fetchm->execute();
            $sub_res = $fetchm->fetchAll(PDO::FETCH_ASSOC);

            $ccanscount = count($sub_res);
            $j = $ccanscount;
            $OQm = 0;
            $ostmt = $pdo->prepare("INSERT INTO option_list (cat_id, exam_id, quest_type, quest_id, opt_no, ot, option_image) 
                VALUES (:cat_id, :exam_id, :quest_type, :quest_id, :opt_no, :ot, :option_image)");

            for ($im = 0; $im < count($sanitizedColumnB); $im++) {
                $oimageAName = '';
                $oimageAPath = '';

                if ($sanitizedColumnB[$im] && $right_ans !== ' ') {
                    $j = $j + 1;
                    if ($OQm == 0 && $check_update !=null){
                        
                        $ymatch=$pdo->prepare('SELECT * FROM option_list WHERE  quest_type=:qtype');
                        $ymatch->bindValue(':qtype','match');
                        $ymatch->execute();
                        $ymatcht=$ymatch->fetchAll(PDO::FETCH_ASSOC);

                          if(count($ymatcht) > 0){

                        $asql = "DELETE FROM option_list WHERE quest_type=:idat";
                        $austmt = $pdo->prepare($asql);
                        $austmt->bindValue(':idat', 'match');
                        $austmt->execute();
                        $OQm = 1;
                          }
                    }

                    $fileError = $_FILES['columnB']['error'][$im];
                    if ($fileError === UPLOAD_ERR_OK) {
                        if(is_array($psanitizedColumnB) && isset($psanitizedColumnB[$im])){
                            $filenameWithoutExtension = $psanitizedColumnB[$im];
            
                            $files = glob($filenameWithoutExtension);
                            
                            if (!empty($files)) {
                                $fileToDelete = $files[0];
                                if (is_file($fileToDelete)) {
                                    unlink($fileToDelete);
                                }
                            }
                        }
                        $oimageAName = $examid . $quest_id . $j . '.' . pathinfo($_FILES['columnB']['name'][$im], PATHINFO_EXTENSION);
                        $imageATmpName = $_FILES['columnB']['tmp_name'][$im];
                    
                        $oimageAPath = "img/option/" . $oimageAName;
                        move_uploaded_file($imageATmpName, $oimageAPath);
                    } elseif (is_array($psanitizedColumnB) && isset($psanitizedColumnB[$im])) {
                        $oimageAPath = $psanitizedColumnB[$im];
                    } else {
                        $oimageAPath = '';
                    }                    

                    $ostmt->bindParam(':cat_id', $catid);
                    $ostmt->bindParam(':exam_id', $examid);
                    $ostmt->bindParam(':quest_type', $quest_type);
                    $ostmt->bindParam(':quest_id', $quest_id);
                    $ostmt->bindParam(':option_image', $oimageAPath);
                    $ostmt->bindParam(':ot', $sanitizedColumnB[$im]);
                    $ostmt->bindParam(':opt_no', $j);
                    $ostmt->execute();
                } elseif ($sanitizedColumnB[$im] === null && $right_ans !== ' ') {
                    echo 'Successfully Inserted';
                } else {
                    $errors[] = 'Successfully Inserted';
                }
            }

            $stmt = $pdo->prepare("SELECT * FROM option_list WHERE cat_id = :id AND exam_id = :eid AND quest_type = :qtype ORDER BY opt_no");
            $stmt->bindValue(':id', $catid);
            $stmt->bindValue(':eid', $examid);
            $stmt->bindValue(':qtype', 'match');
            $stmt->execute();
            $options = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $updateStmt = $pdo->prepare("UPDATE option_list SET opt_no = :opt_no WHERE cat_id = :id AND exam_id=:eid 
            AND quest_type=:qtype AND opt_no=:opn  ");
           
           $newOptionNumber = 1;
           foreach ($options as $option) {
                // Update the option number for the remaining options
               $updateStmt->bindValue(':opt_no', $newOptionNumber);
               $updateStmt->bindValue(':id',  $catid);
               $updateStmt->bindValue(':eid', $examid);
               $updateStmt->bindValue(':opn',  $option['opt_no']);
               $updateStmt->bindValue(':qtype',  'match');
               $updateStmt->execute();
           
               $newOptionNumber++;
           }

            if (count($errors) > 0) {
                // Handle validation errors
                $data = array(
                    "status" => "error",
                    "message" => $errors
                );
                echo json_encode($data);
                exit;
            }

            echo "Form submitted successfully!";
        } catch (PDOException $e) {
            echo "An error occurred while submitting the form. Please try again.";
        }
    }
}
     


        if($_POST['action'] == 'matchopen'  ) {
        
        $matchout='';
        
        $d="A";
        $countc = 1;
        $match=$pdo->prepare('SELECT * FROM question WHERE cat_id=:cid AND quest_type=:qtype AND exam_id=:exid ');
        $match->bindValue(':cid',$_POST['catid']);
        $match->bindValue(':exid',$_POST['examid']);
        $match->bindValue(':qtype','match');
        $match->execute();
        $matcht=$match->fetchAll(PDO::FETCH_ASSOC);

        $ccmatchcount = count($matcht);


        $fetchm=$pdo->prepare('SELECT * FROM option_list WHERE cat_id=:cid AND exam_id=:exid AND quest_type=:qtype  ORDER BY opt_no ASC ');
        $fetchm->bindValue(':cid',$_POST['catid']);
        $fetchm->bindValue(':exid',$_POST['examid']);
        $fetchm->bindValue(':qtype','match');
        $fetchm->execute();
        $sub_res=$fetchm->fetchAll(PDO::FETCH_ASSOC);

        $ccanscount =count($sub_res);
        
       if( $ccmatchcount  == 0 && $ccanscount == 0 ){
        echo '<div class="alert alert-danger">No matching question have beeen created yet!</div>';
        exit;
       }
       else{

        $matchout.=' <div class="row">
        <div class ="col-7" >
        <div class="overflow-auto" style="flex-wrap: wrap;">';



        $indexu=1;  
        foreach($matcht as $matchu){

            $matchout.=' 
        <div class="mb-2" style="display:flex;">
     


        <select style="width:70px;" disabled class=" form-select form-select-sm" id="mySelectm">';
        $dd = 'A';
        $dcountc = 1;
        foreach($sub_res as $optioni){
           

        if (password_verify($optioni['opt_no'], $matchu['quest_ans'])){

            $matchout.=' <option selected  data-qimd="'.$matchu['quest_id'].'" data-id="'.$dcountc.'" 
                         value="'.$dcountc.'">'.$dd.'</option>';
        }

         else{
            $matchout.=' <option   data-qimd="'.$matchu['quest_id'].'" data-id="'.$dcountc.'" 
                         value="'.$dcountc.'">'.$dd.'</option>';


          }
        $dd++;
        $dcountc++;
        }	
        $matchout.='    </select> 
        

        <h5>'.$indexu.') </h5>';
        if($matchu['question_image'] !=''){
            $matchout.=' <img src="'.$matchu['question_image'].'"  onclick="enlargePhoto(this)" width="50" height="50" >';
        }
     $matchout.='<h5>'.decryptText($matchu['question']).'</h5> 
      
        <button  class="maquest btn" data-image="'.$matchu['question_image'].'" value="'.$matchu['quest_id'].'" ><i title="Delete" class="fa fa-trash" style="color: #f41a1a;" ></i></button>
        
        </div>';
       
        $indexu++; 
    }


    $matchout.='   </div>
    </div>
        <div class ="col-5">
        <div class="overflow-auto" style="flex-wrap: wrap;">';
         
        $d="A"; 
        $countc = 1; 
        
        foreach($sub_res as $optioni){
    $matchout.='      
        <div class="mb-2" style="display:flex;">

        <h5>'.$d.')  </h5> ';
        if($optioni['option_image'] !=''){
            $matchout.=' <img src="'.$optioni['option_image'].'"  onclick="enlargePhoto(this)" width="50" height="50" >';
        }
        $matchout.='<h5 >'.$optioni['ot'].'</h5> 
        
        
        
        <button class="machoice btn" data-image="'.$optioni['option_image'].'" value="'.$optioni['opt_no'].'" ><i title="Delete" class="fa fa-trash" style="color: #f41a1a;" ></i></button>
       
        
        </div>';

        $d++; }

        
        
        $matchout.='  </div> </div>   </div>
        <button class="wamatchedit border-0 fa fa-edit fs-1 d-flex justify-content-center" style="color: skyblue; margin-right: 3%;" data-bs-toggle="modal" data-bs-target="#matchmatchedit"></button>
        ';
        echo $matchout;
        }




        }
        if($_POST['action'] == 'eeeditmatch'  ) {
         $out ='';
         $d="A";
         $countc = 1;
         $match = $pdo->prepare('SELECT *, right_ans FROM question WHERE cat_id=:cid AND quest_type=:qtype AND exam_id=:exid');
         $match->bindValue(':cid', $_POST['catid']);
         $match->bindValue(':exid', $_POST['examid']);
         $match->bindValue(':qtype', 'match');
         $match->execute();
         $matcht = $match->fetchAll(PDO::FETCH_ASSOC);
         
 
         $ccmatchcount = count($matcht);
 
 
         $fetchm=$pdo->prepare('SELECT * FROM option_list WHERE cat_id=:cid AND exam_id=:exid AND quest_type=:qtype  ORDER BY opt_no ASC ');
         $fetchm->bindValue(':cid',$_POST['catid']);
         $fetchm->bindValue(':exid',$_POST['examid']);
         $fetchm->bindValue(':qtype','match');
         $fetchm->execute();
         $sub_res=$fetchm->fetchAll(PDO::FETCH_ASSOC);
 
         $ccanscount =count($sub_res);

         $vv='';
         $vv =  $matcht[0]['right_ans'];


         //$v = array_map('strval', $rightAnsValues);

         $out.='
         <div class="modal-header">
                        <h5 class="modal-title" id="matchmodalLabel">Edit Match</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <div class="container">
 
                    <div class="container">
                    <form id="editmatchingForm" class="was-validated" enctype="multipart/form-data">
                        <div id="editmatch_status"></div>
                        <div class="mb-2 row"  style="display: flex;">
                    <label class="col-1 fs-5 mx-2" for="mvalue">Mark: </label>
                    <div class="mb-2" style="display:flex;">
                    <input value="'.$vv.'" required type="number" style="max-width: 98px;max-height:55px;" class="col form-control" id="mvalue" name="mvalue" min="1" >
                    <div class="d-flex justify-content-end">
                    <button type="button" onclick="document.getElementById(\'editmatchingForm\').reset();"  class="btn btn-danger btn-sm position-absolute end-0">Reset Form</button></div>   
                     </div>                 
                    <div class="row">
                    <div class="col">
                    <div class="mx-4"><label class="mx-3 text-center mb-2 fs-5" ><b><u>Column A</u></b></label></div>';
                    
                    
                    
                    $indexu=1; 
                     foreach($matcht as $matchu){
                        $out.='    
                        <div class="mb-2" style="display:flex;">  
                        <div class="row">
                        <div class="col-2">
                        ';
                         

                    $mm = 'A';
                    $dcountc = 1;
                    $out.='   <select required class="form-control answer-option" id="answerOption'.$indexu.'" name="answerOptions[]">';

                    foreach($sub_res as $optioni){

                    if (password_verify($optioni['opt_no'], $matchu['quest_ans'])){

                        $out.='   <option  value="'.$optioni['opt_no'].'" selected>'.$mm.'</option>';

                    }
                    else{
                        $out.='   <option value="'.$optioni['opt_no'].'" >'.$mm.'</option>';
                    }
                    $mm++;
                    $dcountc++;
                }
                    $out.='        </select>
                    </div>
                    <div class="col">
                    <div style="display:flex;">
                    
                    <label class="fs-5" for="columnA'.$indexu.'">'.$indexu. ') </label>

                    <input  type="file" style="max-width:98px;" class=" form-control custom-file-input" id="columnA'.$indexu.'" name="columnA[]" accept="image/*">
                    <input value="'.$matchu['question_image'].'" type="hidden" class=" form-control" id="pcolumnA'.$indexu.'" name="pcolumnA[]">

                    <textarea style="width:300px;" required class="form-control" id="columnA'.$indexu.'" name="columnA[]" rows="1">'.decryptText($matchu['question']).'</textarea>
                   </div> </div></div>
                    </div>';
                    $indexu++;
                   
                }
                $out.='</div>
                <div class="col"> 
                <label class="text-center mb-2 fs-5" ><b><u>Column B</u></b></label>';
                

                $oindexu=1;
                $dd = 'A';
                foreach($sub_res as $optioni){
                    $out.='   
                    <div class="mb-2" style="display:flex;">    



                    <label class=" fs-5" for="columnB'.$oindexu.'"> '.$dd. ') </label>
                    
                    <input  type="file" style="max-width:98px;" class=" form-control custom-file-input"  id="columnB'.$oindexu.'" name="columnB[]" accept="image/*">
                    <input value="'.$optioni['option_image'].'" type="hidden" class=" form-control" id="pcolumnB'.$oindexu.'" name="pcolumnB[]">
                    <textarea required class="form-control" id="columnB'.$oindexu.'" name="columnB[]" rows="1">'.$optioni['ot'].'</textarea>
                    
                    
                    </div>
                    ';

                    $oindexu++;
                    $dd++;
                }
                    
                



                $out.='      </div>
                             </div>
                    </form>
                </div>
                </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-target="#mainchoosemodal" data-bs-toggle="modal">Back to first</button>
                        <button class="updatematch btn btn-primary"  >Update</button>

                    </div>

        </div>';

        echo $out;




        }
       
        if($_POST['action'] == 'matchcdelete'  ) {

            $filenameWithoutExtension = $_POST['image'];
            
            $files = glob($filenameWithoutExtension);
            
            if (!empty($files)) {
                $fileToDelete = $files[0];
                if (is_file($fileToDelete)) {
                    unlink($fileToDelete);
                }
            }

            $sql = "DELETE FROM question WHERE cat_id = :id AND exam_id=:eid AND quest_id=:qid ";
            $sdtmt = $pdo->prepare($sql);
            $sdtmt->bindValue(':id', $_POST['catid']);
            $sdtmt->bindValue(':eid', $_POST['examid']);
            $sdtmt->bindValue(':qid', $_POST['questid']);
            $sdtmt->execute();
            echo '<div class="alert  alert-success" id="usualert" role="alert">
          The question has been successfully deleted!
          <script>
          $("#usualert").alert();
          setTimeout(function() {
          $("#usualert").alert("close");
            }, 20000);
          
          </script>
          </div>';
        
        
        
        
        }

    
    if($_POST['action'] == 'exam_load'  ) {
        $oout='';
        $oout.='   <div class="modal-header">
        <h5 class="modal-title" id="matchmodalLabel2">Match</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">

    <div class="container">

    <div class="container">
<form id="matchingForm" class="was-validated" enctype="multipart/form-data">
<div id="match_status"></div>
<div class="mb-2 row"  style="display: flex;">

<button type="button" onclick="addMatchingPair()" class="col-3 btn btn-primary mb-2">Add Matching Pair</button>
<label class="col-1 fs-5 mx-2" for="mvalue">Mark: </label> 
<input required type="number" style="max-width: 98px;max-height:55px;" class="col form-control" id="mvalue" name="mvalue" min="1" pattern = "/^(?=.*[1-9])\d*(\.\d+)?$/" >

<button style="width:100px;" onclick="document.getElementById(\'matchingForm\').reset();" class="col btn btn-danger btn-sm btn-block position-absolute end-0" >Reset Form</button>

</div>
<div id="matchingPairsContainer"></div>

</form>


</div>';

$match=$pdo->prepare('SELECT * FROM question WHERE cat_id=:cid AND quest_type=:qtype AND exam_id=:exid ');
$match->bindValue(':cid',$_POST['catid']);
$match->bindValue(':exid',$_POST['examid']);
$match->bindValue(':qtype','match');
$match->execute();
$matcht=$match->fetchAll(PDO::FETCH_ASSOC);

$ccmatchcount = count($matcht);


$fetchm=$pdo->prepare('SELECT * FROM option_list WHERE cat_id=:cid AND exam_id=:exid AND quest_type=:qtype ORDER BY opt_no ASC ');
$fetchm->bindValue(':cid',$_POST['catid']);
$fetchm->bindValue(':exid',$_POST['examid']);
$fetchm->bindValue(':qtype','match');
$fetchm->execute();
$sub_res=$fetchm->fetchAll(PDO::FETCH_ASSOC);

$ccanscount =count($sub_res);

$oout.=' <script>
var numq = '.$ccmatchcount.';
var numopt = '.$ccanscount.';

if(numq == 0){
numq=1;
}
else{
numq++;
}
if(numopt == 0){
numopt=1;
}
else{
numopt++;
}

var pairCounter = numq; // Counter for matching pair IDs
var questionCounter = numopt; // Counter for the number of questions

function addMatchingPair() {
var matchingPairsContainer = document.getElementById("matchingPairsContainer");

var newPair = document.createElement("div");
newPair.classList.add("form-row");
newPair.classList.add("row");
newPair.classList.add("mb-2");
newPair.innerHTML = `
<div class="form-group col-md-1">
<select required class="form-control answer-option" id="answerOption${pairCounter}" name="answerOptions[]">
<option disabled selected>Select Answer Option</option>
</select>
</div>
<div class="form-group col-md-5">
<div style="display:flex;">    
<label class="fs-4 mx-1" for="columnA${pairCounter}"> ${pairCounter}</label>
<input required type="file" style="max-width:98px;" class=" form-control custom-file-input" id="columnA${pairCounter}" name="columnA[]" accept="image/*">
<textarea required class="form-control" id="columnA${pairCounter}" name="columnA[]" rows="1"></textarea>
</div>
</div>
<div class="form-group col-md-6">
<div style="display:flex;">    
<label class=" fs-4 mx-1" for="columnB${questionCounter}"> ${String.fromCharCode(65 + questionCounter - 1)}</label>
<input required type="file" style="max-width:98px;" class=" form-control custom-file-input"  id="columnB${questionCounter}" name="columnB[]" accept="image/*">
<textarea required class="form-control" id="columnB${questionCounter}" name="columnB[]" rows="1"></textarea>
</div>
</div>
`;

matchingPairsContainer.appendChild(newPair);

var answerOptions = document.getElementsByClassName("answer-option");

for (var i = 0; i < answerOptions.length; i++) {
var select = answerOptions[i];
select.innerHTML = ""; // Clear existing options
var placeholderOption = document.createElement("option");
placeholderOption.value = "";
placeholderOption.text = "";
select.appendChild(placeholderOption);
for (var j = 1; j <= questionCounter; j++) {
var option = document.createElement("option");
option.value = j;
option.text = String.fromCharCode(65 + j - 1);
select.appendChild(option);
}
}

pairCounter++;
questionCounter++;
}
</script>



        
    </div>
    <div class="modal-footer">
        <button class="btn btn-danger" data-bs-target="#mainchoosemodal" data-bs-toggle="modal">Back to first</button>
        <button class="addmatch btn btn-primary"  >Add</button>

    </div>';
    echo $oout;



    }
        if($_POST['action'] == 'matchchoicedelete'  ) {

            $filenameWithoutExtension = $_POST['image'];
            
            $files = glob($filenameWithoutExtension);
            
            if (!empty($files)) {
                $fileToDelete = $files[0];
                if (is_file($fileToDelete)) {
                    unlink($fileToDelete);
                }
            }


            
            // Step 2: Determine the option number to delete
            $optionToDelete =  $_POST['questid']; // Replace with the option number you want to delete
            
            // Step 3: Delete the option from the table
            $sql = "DELETE FROM option_list WHERE cat_id = :cat_id AND exam_id = :exam_id AND opt_no = :opt_no AND quest_type = :quest_type";
            $stfmt = $pdo->prepare($sql);
            $stfmt->bindValue(':cat_id', $_POST['catid']);
            $stfmt->bindValue(':exam_id', $_POST['examid']);
            $stfmt->bindValue(':opt_no', $_POST['questid']);
            $stfmt->bindValue(':quest_type', 'match');
            $stfmt->execute();
            
            $stmt = $pdo->prepare("SELECT * FROM option_list WHERE cat_id = :id AND exam_id = :eid AND quest_type = :qtype ORDER BY opt_no");
            $stmt->bindValue(':id', $_POST['catid']);
            $stmt->bindValue(':eid', $_POST['examid']);
            $stmt->bindValue(':qtype', 'match');
            $stmt->execute();
            $options = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $updateStmt = $pdo->prepare("UPDATE option_list SET opt_no = :opt_no WHERE cat_id = :id AND exam_id=:eid 
             AND quest_type=:qtype AND opt_no=:opn  ");
            
            $newOptionNumber = 1;
            foreach ($options as $option) {
                 // Update the option number for the remaining options
                $updateStmt->bindValue(':opt_no', $newOptionNumber);
                $updateStmt->bindValue(':id',  $_POST['catid']);
                $updateStmt->bindValue(':eid',  $_POST['examid']);
                $updateStmt->bindValue(':opn',  $option['opt_no']);
                $updateStmt->bindValue(':qtype',  'match');
                $updateStmt->execute();
            
                $newOptionNumber++;
            }
            echo '<div class="alert  alert-success" id="usualert" role="alert">
          The question has been successfully deleted!
          <script>
          $("#usualert").alert();
          setTimeout(function() {
          $("#usualert").alert("close");
            }, 20000);
          
          </script>
          </div>';
        
        
        
        
        }



	
  //Matcing Question End


    }



}
        function sanitizeInput($input) {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }
        function hash_password($password) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            return $hashed_password;
        }
        function encryptText($plainText)
            {
                $key= 'zewerha megabit maeltu welelitu asirte we kliete';
                $ivlen = openssl_cipher_iv_length($cipher="AES-256-CBC");
                $iv = openssl_random_pseudo_bytes($ivlen);
                $cipherText = openssl_encrypt($plainText, $cipher, $key, $options=0, $iv);
                return base64_encode($iv . $cipherText);
            }
        function random($slici)
        {
            $char = '123456789ABCXZY4321KLMNT789GHREXJGJH234FWEIOU';
            $str = $slici;
            $num = '';
            for ($i = 0; $i < 15; $i++) {
                $index = rand(0, strlen($char) - 1);
                $str  .= $char[$index];
            }
            $num = $num . $str;
            return $num;
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