<?php
include "teacher_header.php";
$u_name = $_SESSION['tuid'];
$fetch = $pdo->prepare('SELECT user_id FROM account WHERE user_name=:uiid');
$fetch->bindValue(':uiid', $u_name);
$fetch->execute();
$show = $fetch->fetchAll(PDO::FETCH_ASSOC);
foreach ($show as $sh) {
    $t_id = $sh['user_id'];
}
 if(isset($_POST['questions'])){
    $_SESSION['qexam_id']=$_POST['exam_id'];
    $_SESSION['qcat_id']=$_POST['cat_id'];
    $_SESSION['qename'] = $_POST['ename'];
 }

$cat_id = $_SESSION['qcat_id'];
$exam_id = $_SESSION['qexam_id'];
$ename =  $_SESSION['qename'];

$cfetch = $pdo->prepare('SELECT exam_nq FROM exam WHERE exam_id=:uiid');
$cfetch->bindValue(':uiid', $exam_id);
$cfetch->execute();
$cshow = $cfetch->fetch(PDO::FETCH_ASSOC);
$targetquestion=$cshow['exam_nq'] ;


$sdtmt = $pdo->prepare("SELECT COUNT(*) FROM question  WHERE cat_id=:cid AND exam_id=:eid ");
$sdtmt->bindValue(':cid', $cat_id);
$sdtmt->bindValue(':eid', $exam_id);

$sdtmt->execute();
$dtotal_records = $sdtmt->fetchColumn();

$limit = isset($_GET['page-limit']) ? $_GET['page-limit'] : 7;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$prof = getArticles($pdo, $start, $limit, $cat_id, $exam_id);
$total_pages = getTotalPages($pdo, $limit, $cat_id, $exam_id);





?>

<head>
    <link href="css/questionCSS.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <style>

    .enlarged-photo {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.0);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
    }

    .enlarged-photo img {
      max-height: 80vh;
      max-width: 80vw;
    }
  </style>

</head>


    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
    <h5 class="h5">Exam: <?php echo $ename;?> </h5>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
      <a class="btn btn-sm btn-primary " data-bs-toggle="modal" href="#mainchoosemodal" role="button" style="display: inline-block ;">Add Question</a></div>
      </div>

    </div>
 
    <div id="qdashboard" class="mt-0">

        <div class="card">
            <div class="card-header">

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Choose</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"  type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Match</button>

                            </div>
                        </nav>


                    </div>
                </nav>
            </div>
            <div class="card-body">

                <div class="tab-content" id="nav-tabContent">

                    <!-- choose-->
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                        <div class="col mb-2">

                        <form id="pagination-form">
                            <label class="text-info fs-4" for="page-limit">Items per page:</label>
                            <select name="page-limit" id="page-limit">
                                <option value="7">7</option>
                                <option value="14">14</option>
                                <option value="21">21</option>
                                <option value="50">50</option>
                            </select>
                        </form>
                        </div>
                        <div class="text-info text-end col fs-4">
                         Created Questions:    <?php echo $dtotal_records.'/'.$targetquestion;?>
                        </div>
                        </div>
                        <hr>
                        
                        <script>
                            $(document).ready(function() {
                                $('#page-limit').on('change', function() {
                                    $('#pagination-form').submit();
                                });
                            });
                        </script>

                        <?php
                        //$cs = 1;
                        if (count($prof) > 0) :
                            foreach ($prof as $i => $pro) :
                                $cs = ($page - 1) * $limit + $i + 1;

                                $opt = $pdo->prepare('SELECT * FROM option_list  WHERE exam_id=:cid  AND quest_id=:qid ORDER BY opt_no ASC ');
                                $opt->bindValue(':cid', $exam_id);
                                $opt->bindValue(':qid', $pro['quest_id']);
                                $opt->execute();
                                $opti = $opt->fetchAll(PDO::FETCH_ASSOC);
                                $dquestion = decryptText($pro['question']);


                                
                        ?>

                                <form id="formm<?php echo $pro['quest_id'];?>" enctype="multipart/form-data" action="#" method="POST"> 
                                        
                                            
                                       <h5>
                                        
                                        <div class="" style="display: flex;">
                                       <span><?php echo $cs . ") "?></span>
                                       <textarea name="<?php echo $pro['quest_id'] ?>" style="display: inline-block; float: left;" id="questiono" class="textarea no-border disabled" value="<?php echo $pro['quest_id'] ?>" oninput="autoResize(this)"><?php echo trim(strip_tags($dquestion)); ?></textarea>




<script>
function autoResize(textarea) {
  textarea.style.height = 'auto';
  textarea.style.height = textarea.scrollHeight + 'px';
  textarea.style.width = '100%'; // Set the width to 100% of the parent container
}

// Get all textarea elements with the 'textarea' class
var textareas = document.getElementsByClassName('textarea');

// Loop through each textarea and call the autoResize function
Array.from(textareas).forEach(function(textarea) {
  autoResize(textarea);
});
</script>





                                       <span>(<?php echo $pro['right_ans']?>Pt.)</span>
                                       </div>
                                       

                                       <div style="display: flex;">
                                       <?php if($pro['question_image'] !='' ):?>
                                        <img src="img/question/<?php echo $pro['question_image'];?>" onclick="enlargePhoto(this)" class="mx-5" width="400" height="150">
                                        <?php endif;?>

                                        <div class="editbtns mb-2" id="<?php echo $pro['quest_id']?>nu">
                                        <input name="image0" type="file" style="display: inline-block; size:small;" id="image0" class="">
                                         <span><?php echo $pro['question_image']; ?></span>
                                        </div>
                                       </div>
                                       

                                    </h5>
                                            
                            
                                        <hr>
                                        
                                        

                                           
                                           <div class=" row ml-1">
                                                <div class="container col-10 bg-light  choicedisable">
                                                    <?php $a = "A";
                                                          $no= 1; ?>

                                                    <?php foreach ($opti as $opo) :

                                                       
                                                    ?> 
                                                        <?php if (!empty($opo['ot'])) : ?>
                                                            <?php ?>

                                                            <?php if (password_verify($opo['opt_no'], $pro['quest_ans'])) : ?>
                                                               <h6 >
                                                               <?php if($opo['option_image'] !='' ):?>
                                                                  <img src="img/option/<?php echo $opo['option_image'];?>" onclick="enlargePhoto(this)" class="mx-5" width="400" height="150">
                                                                 <?php endif;?>
                                                               <b class="text-success"> 
                                                                <div style="display:flex;">
                                                                <span><?php echo $a . ') ' ?></span>
                                                                <textarea id="opt<?php echo $no;?>" name="<?php echo $pro['quest_id']?>" class="textuarea no-border orgichoice text-success disabled" title="Answer" value="<?php echo $opo['ot'] ?>" oninput="autoResize(this)"><?php echo trim(strip_tags($opo['ot'])); ?>
                                                                </textarea>

                                                                </div></b>
                                                            
                                                                <div class="editbtns mb-2" id="<?php echo $pro['quest_id']?>nu">
                                                                <input name="image<?php echo $no;?>" type="file" style="display: inline-block; size:small;" id="image<?php echo $no;?>" class="">
                                                                </div>
                                                            
                                                            </h6>
                                                                    
                                                                <?php else : ?>
                                                             <h6 >   
                                                             <?php if($opo['option_image'] !='' ):?>
                                                            <img src="img/option/<?php echo $opo['option_image'];?>" onclick="enlargePhoto(this)" class="mx-5" width="400" height="150">
                                                            <?php endif;?>
                                                             <div style="display:flex;">
                                                                <span><?php echo $a . ') ' ?></span>
                                                                <textarea id="opt<?php echo $no;?>" name="<?php echo $pro['quest_id']?>"  class="textuarea no-border orgichoice disabled "  value="<?php echo $opo['ot'] ?>" oninput="autoResize(this)"> <?php echo trim(strip_tags($opo['ot'])); ?> </textarea>
                                                                </div>

                                                                <div class="editbtns mb-2" id="<?php echo $pro['quest_id']?>nu">
                                                                 <input name="image<?php echo $no;?>" type="file" style="display: inline-block; size:small;" id="image<?php echo $no;?>" class="">
                                                                </div>
                                                            
                                                            </h6>
                                                              
                                                                <?php endif; ?>
                                                        <?php else : ?>
                                                            <span class="alert alert-danger">No Choice Available!</span>

                                                        <?php endif; ?>
                                                       

                                                    <?php $a++;
                                                          $no++;
                                                    endforeach; ?>

                                                </div>

                                                <div class="container col-2" >
                                                    <div class="mt-2" id="<?php echo $pro['quest_id']?>hidu">
                                                    <div style="display: flex;">
                                                        <button  onclick="edit(event,'<?php echo $pro['quest_id'] ?>')" title="Edit" value="<?php echo $pro['quest_id'] ?>" data-id="<?php echo $pro['exam_id'] ?>" class="quest_edit fa-regular fa-pen-to-square fa-2xl" style="color:#1c76ca; border:none;"></button>
                                                        <button title="Delete" id="questcdelete" data-id="<?php echo $pro['quest_id'] ?>" data-eid="<?php echo $pro['exam_id'] ?>" class="fa-regular fa-trash-can fa-2xl" style="color:#f41a1a;  border:none;"></button>
                                                    </div>
                                                    </div>
                                                    <div class="container editbtns mt-2 col" id="<?php echo $pro['quest_id']?>nu">
                                                    <div class="mt-2">
                                                    <div style="display: flex;">
                                                        <div class="col"><button  onclick="canclu(event, '<?php echo $pro['quest_id'] ?>')" value="<?php echo $pro['quest_id'] ?>" class="btn btn-sm btn-danger mb-2">Cancel</button></div>
                                                      <div class="col">  <button id="editsave" value="<?php echo $pro['quest_id'] ?>" class="btn btn-sm btn-success mb-2">Save</button></div>
                                                    </div>
                                                    </div>
                                                    <div class="mb-2">
                                                        <b style="display: inline-block; width: 50px;">Mark:</b> 
                                                        <input name="<?php echo $pro['quest_id']?>" type="number" style="display: inline-block; width: 70px;" id="mark" class="" value="<?php echo $pro['right_ans']?>">
                                                    </div>

                                                        <div class="mb-2"><div style="display: flex;"><b> Answer:  </b><select id="easot" class="form-select-sm">  
                                                            <?php $iu=1;while($i<=6) :?>
                                                               

                                                            <?php  if (password_verify($iu, $pro['quest_ans'])) :?>
                                                    <option value="<?php echo $iu;?>" selected disabled>Option_<?php echo $iu;?></option>
                                                               
                                                            <?php  break; endif;?>    
                                                            
                                                            <?php $iu++; endwhile;?>
                                                            <option value="1">Option_1</option>
                                                            <option value="2">Option_2</option>
                                                            <option value="3">Option_3</option>
                                                            <option value="4">Option_4</option>
                                                            <option value="5">Option_5</option>
                                                            <option value="6">Option_6</option>
                                                        </select></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                        </form>
                                    
                            
                <?php endforeach; ?>

                <?php
                            echo "<ul class='pagination justify-content-center'>";
                            if ($page > 1) {
                                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">&laquo;</a></li>';
                            } else {
                                echo '<li class="page-item disabled"><a class="page-link" disabled>&laquo;</a></li>';
                            }
                            for ($i = 1; $i <= $total_pages; $i++) {
                                $active_class = ($i == $page) ? 'active' : '';
                                echo "<li class='page-item " . $active_class . "' ><a class='page-link' href='?page=$i'>$i</a></li>";
                            }
                            if ($page < $total_pages) {
                                echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">&raquo;</a></li>';
                            } else {
                                echo '<li class="page-item disabled"><a class="page-link" disabled>&raquo;</a></li>';
                            }
                            echo "</ul>";
                ?>
            <?php else : ?>
                <div class="container alert alert-danger" role="alert mb-5 mt-2">
                    <h3 class="text-center">No question have been created yet!</h3>
                </div>
            <?php endif; ?>

 <!------------------>
 
 <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="oliveToast"  class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <button type="button" class="btn-close" onclick="window.location.reload()" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="outertoast-body">

                </div>
            </div>
        </div>
                </div>

                <!-----Endof Choose ------->
                <!-- Match-->

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                 <div id="openopenmatch">
                 
                </div>
                 <!------------------>
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="oliveToast"  class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <button type="button" class="btn-close" onclick="window.location.reload()" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="outertoast-body">

                </div>
            </div>
        </div>
<!--match edit modal-->
    <div class="modal fade" id="matchmatchedit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
      <div class="modal-content" id="nmatchruyan">

      </div>
    </div>
  </div>


                </div>
                <!------------>
                <!-- Blank-->
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    No blank

                </div>
                <!------------>
                <!-- Explanation-->
                <div class="tab-pane fade" id="nav-econtact" role="tabpanel" aria-labelledby="nav-econtact-tab">

                    No Explanation
                </div>

                <!------------>





                <div id="enlargedPhoto" class="enlarged-photo" onclick="closeEnlargedPhoto()">
            <img id="enlargedImg" src="">

            </div>

        </div>


        <!----------modal choose------------->
        <div class="modal fade" id="mainchoosemodal" aria-hidden="true" aria-labelledby="mainchoosemodalLabel" tabindex="-1">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mainchoosemodalLabel">Select Question Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.reload()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button class="btn btn-primary" data-bs-target="#choosemodal" data-bs-toggle="modal">Choice</button>
                            <button class="btn btn-primary" data-bs-target="#advancedchoosemodal" data-bs-toggle="modal">Choice(Advanced Editor)</button>
                            <button id="mmatch" class="btn btn-primary" data-bs-target="#matchmodal" data-bs-toggle="modal">Match</button>
                            <button class="btn btn-primary" disabled data-bs-target="#" data-bs-toggle="modal">Blank</button>
                            <button class="btn btn-primary" disabled data-bs-target="#" data-bs-toggle="modal">Explanation</button>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!----------modal choose end------------->





        <!----------modal choise start------------->
        <div class="modal fade" id="choosemodal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="choosemodalLabel2" tabindex="-1">
            <div class="modal-dialog  modal-lg modal-dialog-scrollable ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="choosemodalLabel2">Add Question </h5>
                        <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="form-group was-validated" method="POST" id="naddQuestion" action="#">
                            <div id="normalAddSuccess"></div>
                            <input type="hidden" class="form-control" name="lid" value=" ">
                            <div class="mb-1">


                            </div>
                            <div class="mb-1">
                                <label class="text-xs font-weight-bold  text-info mb-1">Mark for right answer</label>
                                <input type="number"  value="1" min="1" max="40" pattern="[1-9]|[1-3][0-9]|40" class="form-control" id="rm" name="rm" required placeholder="Enter mark for right answer">
                            </div>

                            <div class="mb-1">
                                <label class="text-xs font-weight-bold text-info mb-1">Question</label>
                                <textarea class="form-control" rows="" id="que" name="que" required placeholder="Enter the question"></textarea>
                            </div>
                            <div class="mb-1">
                                <label class="text-xs font-weight-bold text-info mb-1">option_1</label>
                                <input type="text" class="form-control" id="opt1" name="opt1" required placeholder="Enter option_1">
                            </div>
                            <div class="mb-1">
                                <label class="text-xs font-weight-bold text-info mb-1">option_2</label>
                                <input type="text" class="form-control" id="opt2" name="opt2" required placeholder="Enter option_2">
                            </div>
                            <div class="mb-1">
                                <label class="text-xs font-weight-bold text-info mb-1">option_3</label>
                                <input type="text" class="form-control" id="opt3" name="opt3" placeholder="Enter option_3">
                            </div>
                            <div class="mb-1">
                                <label class="text-xs font-weight-bold text-info mb-1">option_4</label>
                                <input type="text" class="form-control" id="opt4" name="opt4" placeholder="Enter option_4">
                            </div>
                            <div class="mb-1">
                                <label class="text-xs font-weight-bold text-info mb-1">option_5</label>
                                <input type="text" class="form-control" id="opt5" name="opt5" placeholder="Enter option_5">
                            </div>
                            <div class="mb-1">
                                <label class="text-xs font-weight-bold text-info mb-1">option_6</label>
                                <input type="text" class="form-control" id="opt6" name="opt6" placeholder="Enter option_5">
                            </div>
                            <div class="mb-1">
                                <label class="text-xs font-weight-bold text-info mb-1">Answer</label>
                                <select id="asot" name="asot" required class="form-control">
                                    <option value selected></option>
                                    <option value="1">option_1</option>
                                    <option value="2">option_2</option>
                                    <option value="3">option_3</option>
                                    <option value="4">option_4</option>
                                    <option value="5">option_5</option>
                                    <option value="6">option_6</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-target="#mainchoosemodal" data-bs-toggle="modal">Back to first</button>
                        <button name="" id="normalAdd" class="normalAdd btn btn-primary" value="">ADD</button>
                    </div>
                    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                        <div id="toastnormal"  class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body" id="toastnormalb">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!----------modal choise end------------->




        <!----------ADAVNCED modal choise start------------->
        <div class="modal fade" id="advancedchoosemodal" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="advancedchoosemodalLabel2" tabindex="-1">
            <div class="modal-dialog  modal-fullscreen ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="advancedchoosemodalLabel2">Add Question </h5>
                        <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="advquestionaddsuccess"></div>
                        <form class="form-group was-validated" method="POST" id="adaddQuestion" action="#" enctype="multipart/form-data">

                            <div class="col mb-1">

                                <?php

                                //$k = $_GET['ql'] ?? null;
                                // $ccid = $_POST['cid'] ?? $k;

                                ?>
                                <input type="hidden" class="form-control" name="lid" value="<?php //echo $ccid 
                                                                                            ?>">
                            </div>
                            <div class="mb-1">
                                <label class="text-xs font-weight-bold text-info mb-1">Mark for right answer</label>
                                <input type="number"  value="1" min="1" max="40" pattern="[1-9]|[1-3][0-9]|40" class="form-control" id="arm" name="rm" required placeholder="Enter mark for right answer">
                            </div>
                            <div class="mb-1">
                                <label class="fs-4 text-xs font-weight-bold text-info mb-1">Question</label><br>
                                <input type="file" name="image1" id="image1">
                                <textarea class="ckeditor form-control" rows="" id="aque" name="advaeditor" required placeholder="Enter the question"></textarea>
                            </div>
                            <div class="mb-1">
                                <label class="fs-4 text-xs font-weight-bold text-info mb-1">option_1</label><br>
                                <input type="file" name="image2" id="image2">
                                <textarea class="ckeditor form-control" rows="" id="aopt1" name="advaeditor" required placeholder="Enter option_1"></textarea>
                            </div>
                            <div class="mb-1">
                                <label class="fs-4 text-xs font-weight-bold text-info mb-1">option_2</label><br>
                                <input type="file" name="image3" id="image3">
                                <textarea class="ckeditor form-control" id="aopt2" name="advaeditor" required placeholder="Enter option_2"></textarea>
                            </div>
                            <div class="mb-1">
                                <label class="fs-4 text-xs font-weight-bold text-info mb-1">option_3</label><br>
                                <input type="file" name="image4" id="image4">
                                <textarea class="ckeditor form-control" id="aopt3" name="advaeditor" placeholder="Enter option_3"></textarea>
                            </div>
                            <div class="mb-1">
                                <label class="fs-4 text-xs font-weight-bold text-info mb-1">option_4</label><br>
                                <input type="file" name="image5" id="image5">
                                <textarea class="ckeditor form-control" id="aopt4" name="advaeditor" placeholder="Enter option_4"></textarea>
                            </div>
                            <div class="mb-1">
                                <label class="fs-4 text-xs font-weight-bold text-info mb-1">option_5</label><br>
                                <input type="file" name="image6" id="image6">
                                <textarea class="ckeditor form-control" id="aopt5" name="advaeditor" placeholder="Enter option_5"></textarea>
                            </div>
                            <div class="mb-1">
                                <label class="fs-4 text-xs font-weight-bold text-info mb-1">option_6</label><br>
                                <input type="file" name="image7" id="image7">
                                <textarea class="ckeditor form-control" id="aopt6" name="advaeditor" placeholder="Enter option_6"></textarea>
                            </div>
                            <div class="mb-1">
                                <label class="fs-4 text-xs font-weight-bold text-info mb-1">Answer</label>
                                <select id="aasot" name="ans" required class="form-control">
                                    <option value selected></option>
                                    <option value="1">option_1</option>
                                    <option value="2">option_2</option>
                                    <option value="3">option_3</option>
                                    <option value="4">option_4</option>
                                    <option value="5">option_5</option>
                                    <option value="6">option_6</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-target="#mainchoosemodal" data-bs-toggle="modal">Back to first</button>
                        <input type="button" id="advancedAdd" name="qsent" class="btn btn-primary" value="ADD">
                    </div>
                    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                        <div id="toastadva" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!----------advanced modal choise end------------->




        <!----------modal match start------------->
        <div class="modal fade" id="matchmodal" aria-hidden="true" aria-labelledby="matchmodalLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div id="faddmatch" class="modal-content">
                    
                </div>
            </div>
        </div>

        <!----------modal match end------------->


        <!----------modal blank start------------->
        <div class="modal fade" id="blankmodal" aria-hidden="true" aria-labelledby="matchmodalLabel2" tabindex="-1">
            <div class="modal-dialog  modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="matchmodalLabel2">Match</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Modal Blank
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-bs-target="#mainchoosemodal" data-bs-toggle="modal">Back to first</button>
                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Add</button>

                    </div>
                </div>
            </div>
        </div>

        <!----------modal blank end------------->


        <!----------modal explanation start------------->


        <!----------modal explantion end------------->




       </div>



        <!------------------------>

        <!----------modal--->

        
        <!------------------>
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="oliveToast"  class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <button type="button" class="btn-close" onclick="window.location.reload()" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="outertoast-body">

                </div>
            </div>
        </div>
        </div>

  </body>
</html>
   <script>
         var elements = document.getElementsByClassName('active');
        for (var i = 0; i < elements.length; i++) {
        var parentElement = elements[i].closest('.nav-link');
        if (parentElement) {
            parentElement.classList.remove('active');
        }}
        var anchor = document.querySelector('.nav-link.uexam');
        if (anchor) {
        anchor.classList.add('active');
        }
   </script>
     <script>
            function enlargePhoto(img) {
            var enlargedImg = document.getElementById('enlargedImg');
            enlargedImg.src = img.src;

            var enlargedPhoto = document.getElementById('enlargedPhoto');
            enlargedPhoto.style.display = 'flex';
            }

            function closeEnlargedPhoto() {
            var enlargedPhoto = document.getElementById('enlargedPhoto');
            enlargedPhoto.style.display = 'none';
            }

        function edit(event,questid) {
            event.preventDefault();
            const qid=questid;
            const textareas = document.querySelectorAll(`input[type="number"][name='${qid}'], textarea[name='${qid}']`);
            var elements = document.querySelectorAll('[id="' + qid + 'hidu"]');
            elements.forEach(function(element) {
            element.style.display = "none";
            });
            var elements = document.querySelectorAll('[id="' + qid + 'nu"]');
            elements.forEach(function(element) {
            element.classList.remove('editbtns');
            });

            textareas.forEach(textarea => {
            textarea.classList.remove("no-border");
            textarea.classList.add("border");
            textarea.classList.remove("disabled");
        });
      }
      function canclu(event, questid) {
            event.preventDefault();
            const qid=questid;
            const textareas = document.querySelectorAll(`input[type="number"][name='${qid}'], textarea[name='${qid}']`);
            var elements = document.querySelectorAll('[id="' + qid + 'hidu"]');
            elements.forEach(function(element) {
            element.style.display = "block";
            });
            var elements = document.querySelectorAll('[id="' + qid + 'nu"]');
            elements.forEach(function(element) {
            element.classList.add('editbtns');
            });
            textareas.forEach(textarea => {
            textarea.classList.add("no-border");
            textarea.classList.remove("border");
            textarea.classList.add("disabled");
        });
      }

     </script>
        <script src="ckeditor/ckeditor.js"></script>
        <script>
  $(document).ready(function() {
    $('.ckeditor').each(function() {
      CKEDITOR.replace($(this).attr('advaeditor'), {
        height: 'auto',
        extraAllowedContent: 'quillbot-extension-portal'
      });
    });
  });
</script>


        <script type="text/javascript">
            $(document).ready(function() {

                var catid = "<?php echo $cat_id; ?>";
                var examid = "<?php echo $exam_id; ?>";
                var creator = "<?php echo $u_name;?>";



                load_match_question();


                    function load_match_question() {
                        $.ajax({
                            url: "questionmodal.php",
                            method: "POST",
                            data: {
                                catid: catid,
                                examid: examid,
                                page: 'question',
                                action: 'matchopen'
                            },
                            success: function(data) {
                                $('#openopenmatch').html(data);

                            }
                        })
                    }


                    $(document).on('click', '.maquest', function(event) {
                    event.preventDefault();
                    var conf = confirm('Are you sure you want to delete this question? ');
                    var questid = $(this).attr('value');
                    var image = $(this).data('image');

                    if (conf == true) {

                        $.ajax({
                            url: "questionmodal.php",
                            method: "POST",
                            data: {
                                page: 'question',
                                action: 'matchcdelete',
                                image: image,
                                questid: questid,
                                catid: catid,
                                examid: examid
                            },
                            success: function(data) {
                                $('.toast-body').html(data);
                                $('.toast').addClass('toast-success').toast('show');
                                load_match_question();
                            }
                        })

                    } else {

                    }

                });

                $(document).on('click', '.machoice', function(event) {
                    event.preventDefault();
                    var conf = confirm('Are you sure you want to delete this question? ');
                    var questid = $(this).attr('value');
                    var image = $(this).data('image');
                    if (conf == true) {

                        $.ajax({
                            url: "questionmodal.php",
                            method: "POST",
                            data: {
                                page: 'question',
                                action: 'matchchoicedelete',
                                image: image,
                                questid: questid,
                                catid: catid,
                                examid: examid
                            },
                            success: function(data) {
                                $('.toast-body').html(data);
                                $('.toast').addClass('toast-success').toast('show');
                                load_match_question();
                            }
                        })

                    } else {

                    }

                });





                $(document).on('click', '#normalAdd', function() {
                    var gmark = document.forms["naddQuestion"]["rm"].value;
                    var question = document.forms["naddQuestion"]["que"].value;
                    var opt1 = document.forms["naddQuestion"]["opt1"].value;
                    var opt2 = document.forms["naddQuestion"]["opt2"].value;
                    var opt3 = document.forms["naddQuestion"]["opt3"].value;
                    var opt4 = document.forms["naddQuestion"]["opt4"].value;
                    var opt5 = document.forms["naddQuestion"]["opt5"].value;
                    var opt6 = document.forms["naddQuestion"]["opt6"].value;
                    var asot = document.forms["naddQuestion"]["asot"].value;

                    $.ajax({
                        url: "questionmodal.php",
                        method: "POST",
                        data: {
                            catid: catid,
                            examid: examid,
                            gmark: gmark,
                            question: question,
                            creator:creator,
                            opt1: opt1,
                            opt2: opt2,
                            opt3: opt3,
                            opt4: opt4,
                            opt5: opt5,
                            opt6: opt6,
                            asot: asot,
                            page: 'question',
                            action: 'addquestion'
                        },
                        success: function(data) {
                            $('#toastnormalb').html(data);
                            $('#toastnormal').addClass('toast-success').toast('show');
                        }
                    });
                });

                $(document).on('click', '#advancedAdd', function() {
                var agmark = document.forms["adaddQuestion"]["arm"].value;
                var aasot = document.forms["adaddQuestion"]["aasot"].value;

                var aque = CKEDITOR.instances["aque"].getData();
                var aopt1 = CKEDITOR.instances["aopt1"].getData();
                var aopt2 = CKEDITOR.instances["aopt2"].getData();
                var aopt3 = CKEDITOR.instances["aopt3"].getData();
                var aopt4 = CKEDITOR.instances["aopt4"].getData();
                var aopt5 = CKEDITOR.instances["aopt5"].getData();
                var aopt6 = CKEDITOR.instances["aopt6"].getData();
                
                var formData = new FormData();
                
                // Append images to FormData
                $.each($('input[type="file"]'), function(index, element) {
                    var files = element.files;
                    var name = $(element).attr('name');
                    
                    $.each(files, function(i, file) {
                    formData.append(name, file);
                    });
                });
                
                // Append data object as a field in formData
                
                formData.append('page', 'question');
                formData.append('creator', creator);
                formData.append('action', 'advaddquestion');
                formData.append('catid', catid);
                formData.append('examid', examid);
                formData.append('agmark', agmark);
                formData.append('aasot', aasot);
                formData.append('aque', aque);
                formData.append('aopt1', aopt1);
                formData.append('aopt2', aopt2);
                formData.append('aopt3', aopt3);
                formData.append('aopt4', aopt4);
                formData.append('aopt5', aopt5);
                formData.append('aopt6', aopt6);
                
                $.ajax({
                    url: "questionmodal.php",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                    $('.toast-body').html(data);
                    $('#toastadva').addClass('toast-success').toast('show');
                    }
                });
                });
                $(document).on('click', '#questcdelete', function(event) {
                    event.preventDefault();
                    var conf = confirm('Are you sure you want to delete this question? ');
                    var questid = $(this).data('id');
                    var examid = $(this).data('eid');
                    if (conf == true) {

                        $.ajax({
                            url: "questionmodal.php",
                            method: "POST",
                            data: {
                                page: 'question',
                                action: 'questcdelete',
                                questid: questid,
                                examid: examid
                            },
                            success: function(data) {
                                $('#outertoast-body').html(data);
                                $('#oliveToast').addClass('toast-success').toast('show');
                            }
                        })

                    } else {

                    }

                }); 

          $(document).on('click', '#mmatch', function() {

                    
                    $.ajax({
                        url: "questionmodal.php",
                        method: "POST",
                        data: {
                            catid: catid,
                            examid: examid,
                            page: 'question',
                            action: 'exam_load'
                        },
                        success: function(data) {
                            $('#faddmatch').html(data);

                        }
                    })

                });




                $(document).on('click', '#catag_b', function() {

                    
                    $.ajax({
                        url: "questionmodal.php",
                        method: "POST",
                        data: {
                            questid: questid,
                            examid: examid,
                            page: 'question',
                            action: 'exam_l'
                        },
                        success: function(data) {
                            $('#dashboard').html(data);

                        }
                    })

                });


                $(document).on('click', '#editsave', function(event) {
                    event.preventDefault();
                    var questid = $(this).attr('value');
                    var formii ="formm"+questid;
                    var formiin = document.forms[formii];
                   
                var formData = new FormData();
                formData.append('page', 'question');
                formData.append('action', 'editquestion');
                formData.append('catid', catid);
                formData.append('examid', examid);
                formData.append('questid', questid);


                formData.append('gmark', document.forms[formii]["mark"].value);
                formData.append('question', document.forms[formii]["questiono"].value);
                formData.append('opt1', document.forms[formii]["opt1"].value);
                formData.append('opt2', document.forms[formii]["opt2"].value);
                formData.append('asot', document.forms[formii]["easot"].value);


                    if (formiin.hasOwnProperty("opt3")) {
                        formData.append('opt3', document.forms[formii]["opt3"].value);
                    } else {
                        formData.append('opt3', '');
                    }
                    if (formiin.hasOwnProperty("opt4")) {
                        formData.append('opt4', document.forms[formii]["opt4"].value);
                    } else {
                        formData.append('opt4', '');
                    }
                    if (formiin.hasOwnProperty("opt5")) {
                        formData.append('opt5', document.forms[formii]["opt5"].value);
                    } else {
                        formData.append('opt5', '');
                    }
                    if (formiin.hasOwnProperty("opt6")) {
                        formData.append('opt6', document.forms[formii]["opt6"].value);
                    } else {
                        formData.append('opt6', '');
                    }

                    $.each($('#' + formii).find('input[type="file"]'), function(index, element) {
                        var files = element.files;
                        var name = $(element).attr('name');
                        
                        $.each(files, function(i, file) {
                            formData.append(name, file);
                        });
                    });




                    $.ajax({
                        url: "questionmodal.php",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                                $('#outertoast-body').html(data);
                                $('#oliveToast').addClass('toast-success').toast('show');
                        }
                    });
                });

            // matching qurestions start  addmatch

            $(document).on('click', '.addmatch', function() {
                event.preventDefault();
                var mvalue=  document.forms["matchingForm"]["mvalue"].value;
                if (mvalue == 0 || mvalue == '') {
  $('#match_status').html('<div class="alert alert-danger">Please fiil up the mark correctlly</div>');
      return;
    }
                var form = document.getElementById("matchingForm");
                var formData = new FormData(form);
                formData.append('page', 'question');
                formData.append('creator', creator);
                formData.append('action', 'matchadd');
                formData.append('catid', catid);
                formData.append('examid', examid);

            $.ajax({
                url: "questionmodal.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#matchingPairsContainer').html(data);
                    load_match_question();


                },
                error: function(data) {
                console.log(xhr.responseText);
                $('#match_status').html(data.message);
                //alert("An error occurred while submitting the form. Please try again.");
                }


            })

            });


            $(document).on('click', '.updatematch', function() {
                event.preventDefault();
                var mvalue=  document.forms["editmatchingForm"]["mvalue"].value;
                if (mvalue == 0 || mvalue == '') {
  $('#editmatch_status').html('<div class="alert alert-danger">Please fiil up the mark correctlly</div>');
      return;
    }


                var form = document.getElementById("editmatchingForm");
                var formData = new FormData(form);
                formData.append('page', 'question');
                 formData.append('creator', creator);
                formData.append('action', 'matchadd');
                formData.append('catid', catid);
                formData.append('examid', examid);
                formData.append('chkupdate', "imupdate");

            $.ajax({
                url: "questionmodal.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#editmatch_status').html(data);
                    load_match_question();


                },
                error: function(data) {
                console.log(xhr.responseText);
                $('#editmatch_status').html(data.message);
                //alert("An error occurred while submitting the form. Please try again.");
                }


            })

            });


            $(document).on('click', '.wamatchedit', function() {
            $.ajax({
            url: "questionmodal.php",
            method: "POST",
            data: {
                catid:catid,
                examid:examid,
                page: 'question',
                action: 'eeeditmatch'
            },
            success: function(data) {
                $('#nmatchruyan').html(data);
            }
            })
        });



           // matching question end

            });
        </script>



<?php
function decryptText($encryptedText)
{
    $key = 'zewerha megabit maeltu welelitu asirte we kliete';
    $encryptedText = base64_decode($encryptedText);
    $ivlen = openssl_cipher_iv_length($cipher = "AES-256-CBC");
    $iv = substr($encryptedText, 0, $ivlen);
    $cipherText = substr($encryptedText, $ivlen);
    return openssl_decrypt($cipherText, $cipher, $key, $options = 0, $iv);
}

function getArticles($db, $start, $limit, $cat_id, $exam_id)
{

    $fet = $db->prepare("SELECT * FROM question  WHERE cat_id=:cid AND exam_id=:eid AND quest_type=:qtype   LIMIT $start, $limit");
    $fet->bindValue(':cid', $cat_id);
    $fet->bindValue(':eid', $exam_id);
  

    $fet->bindValue(':qtype', 'choose');
    $fet->execute();
    $articles = $fet->fetchAll(PDO::FETCH_ASSOC);
    return $articles;
}


function getTotalPages($db, $limit,$cat_id, $exam_id)
{
    $stmt = $db->prepare("SELECT COUNT(*) FROM question  WHERE cat_id=:cid AND exam_id=:eid AND quest_type=:qtype  ");
    $stmt->bindValue(':cid', $cat_id);
    $stmt->bindValue(':eid', $exam_id);
    $stmt->bindValue(':qtype', 'choose');
    $stmt->execute();
    $total_records = $stmt->fetchColumn();
    $total_pages = ceil($total_records / $limit);
    return $total_pages;
}


?>