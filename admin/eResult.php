<?php
include "dbc.php";
include "header.php";

// if (isset($_SESSION['huid']) && isset($_SESSION['hdepid'])) {
  $uid=$_SESSION['huid'];
  if($_SERVER['REQUEST_METHOD']=='POST'){

  }

  $depart = $_SESSION['hdepid'];
?>
<head>  <style>
    /* Add shadow on hover */
    .table-hover tbody tr:hover {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
  </style></head>
<body>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
    <h5 class="h5">Result</h5>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
      <form id="pagination-form">
        <label for="page-limit">Items per page:</label>
        <select name="page-limit" id="page-limit">
            <option value="7">7</option>
            <option value="14">14</option>
            <option value="21">21</option>
            <option value="50">50</option>
        </select>
        </form>
        

      </div>

    </div>

</div>
<script>
 $(document).ready(function() {
     $('#page-limit').on('change', function() {
         $('#pagination-form').submit();
     });
 });
</script>
<?php

$limit = isset($_GET['page-limit']) ? $_GET['page-limit'] : 7;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
$prof = getArticles($pdo, $start, $limit, $depart);
$total_pages = getTotalPages($pdo, $limit,$depart);




?>
  
<?php if (count($prof) > 0): ?>
  
  
  <div class="mb-2 mx-2 d-flex justify-content-start">
  <button data-bs-toggle="modal" data-bs-target="#InformationproModalalert" class="btn btn-sm btn-primary me-2" >Report</button>
  <button class="btn btn-sm btn-primary" onclick="printu()">Print</button>
</div>

<div id="InformationproModalalert" class="modal modal-edu-general fullwidth-popup-InformationproModal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Report Generation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                                    <div class="modal-body">
              <form class="form-group was-validated" id="reportgenerarion" method="POST" action="#">
                <div class="mb-1" id="generatesuccess"></div>

                <div class=" mb-1">
                  <label class="fs-5 mb-1">Format</label>
                  <select id="format" name="format" class="form-select" required aria-label="stype">
                    <option  disabled></option>
                    <option selected value="PDF">PDF</option>
                    <option disabled value="Excel">Excel</option>
                  </select>
                </div>
                
                <div class=" mb-1">
                  <label class="fs-5 mb-1">Stream</label>
                  <select id="strm" name="strm" class="form-select" required aria-label="stype">
                    <option selected disabled></option>
                    <option value="Regular">Regular</option>
                    <option value="Extension">Extension</option>
                    <option value="Summer">Summer</option>
                    <option value="*">All</option>
                  </select>
                </div>
                <div class=" mb-1">
                  <label class="fs-5 mb-1">Year</label>
                  <select id="syear" name="syear" class="form-select" required aria-label="stype">
                    <option selected disabled></option>
                    <option value="1">1<sup>st</sup> Year</option>
                      <option value="2">2<sup>nd</sup> Year</option>
                      <option value="3">3<sup>rd</sup> Year</option>
                      <option value="4">4<sup>th</sup> Year</option>
                      <option value="5">5<sup>th</sup> Year</option>
                      <option value="6">6<sup>th</sup> Year</option>
                  </select>
                </div>
                <div class=" mb-1">
                  <?php
                  $fetch = $pdo->prepare('SELECT * FROM category WHERE college=:collg ORDER BY cat_name ASC');
                  $fetch->bindValue(':collg', $depart);
                  $fetch->execute();
                  $departt = $fetch->fetchAll(PDO::FETCH_ASSOC);

                  $gfetch = $pdo->prepare('SELECT * FROM exam WHERE creator_dep=:collg ORDER BY exam_name ASC');
                  $gfetch->bindValue(':collg', $depart);
                  $gfetch->execute();
                  $gdepartt = $gfetch->fetchAll(PDO::FETCH_ASSOC);
                  
                  ?>
                  <label class="fs-5 mb-1">Category/Course</label>
                  <select id="catego" name="catego" class="form-select" required aria-label="taype">
                    <option selected disabled></option>
                    <?php foreach ($departt as $colfep) :  ?>
                      <option value="<?php echo $colfep['cat_id'] ?>"><?php echo $colfep['cat_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  
                </div>
                <div class=" mb-1">
                  <label class="fs-5 mb-1">Exam Name</label>
                  <select id="ename" name="ename" class="form-select" required aria-label="type">
                  <option selected disabled></option>
                    <?php foreach ($gdepartt as $gcolfep) :  ?>
                      <option value="<?php echo $gcolfep['exam_id'] ?>"><?php echo $gcolfep['exam_name'] ?></option>
                    <?php endforeach; ?>
                  </select>
                  
                </div>


                                    </div>
                                    <div class="modal-footer info-md">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button id="hgenerate" class="btn btn-warning">Generate</button>
                                    </div>
                    </form>
                                </div>
                            </div>
</div>

                            <script>
                                function printu() {
                                    window.print();
                                }
                            </script>
    <div class="table table-responsive table-bordered table-striped container">

<table class="table table-striped table-hover container table-hover">
  <tr class="table-info">
    <th id="tempo" class="table-info">Course</th>
    <th class="table-info">Full Name</th>
    <th class="table-info">Result</th>
    <th class="table-info">Decision</th>

  </tr>
  <tbody>

<?php foreach ($prof as $pf):
    
    $sfet = $pdo->prepare("SELECT * FROM examinee  WHERE uiid=:cid AND Department=:depa ORDER BY fname ASC ");
    $sfet->bindValue(':cid', $pf['uid']);
    $sfet->bindValue(':depa', $depart);
    $sfet->execute();
    $sarticles = $sfet->fetchALL(PDO::FETCH_ASSOC);
    
    foreach($sarticles as $art):
        
    ?>

     <?php if($art['Department'] == $depart):?>
   
        <?php
        $dfetdch = $pdo->prepare('SELECT cat_name FROM category WHERE cat_id=:catimp');
        $dfetdch->bindValue(':catimp', $pf['cat_id']);
        $dfetdch->execute();
        $dcatdep = $dfetdch->fetch(PDO::FETCH_ASSOC);
        ?>
     <tr class="">
        <td><?php echo $dcatdep['cat_name'] ?></td>
        <td><?php echo $art['fname'].' '.$art['lname'] ?></td>
       <td><?php echo $pf['result'].'%' ?></td>
       <td>
       <?php if($pf['result'] >= 50):?>
        <div class="badge badge-sm rounded-pill bg-success">Passed</div>

       <?php else:?> 
        <div class=" badge badge-sm rounded-pill bg-danger">Failled</div>
        <?php endif;?>
       </td>


                        

</tr>

    <?php endif;?>

         <?php endforeach;?>
        
         <?php endforeach;?>
         </tbody>
</table>
    </div>
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
                    <h5 class="text-center">No student have been any result!</h5>
                </div>
            <?php endif; ?>



<script>
    var elements = document.getElementsByClassName('active');
      for (var i = 0; i < elements.length; i++) {
      var parentElement = elements[i].closest('.nav-link');
      if (parentElement) {
        parentElement.classList.remove('active');
    }}
    var anchor = document.querySelector('a.nav-link.resulti');
    if (anchor) {
      anchor.classList.add('active');
    }

  </script>
<script>
 $(document).ready(function() {

var depart = "<?php echo $depart; ?>";
var head = "<?php echo  $uid;?>";
$(document).on('click', '#hgenerate', function() {
                event.preventDefault();
                
                var format=  document.forms["reportgenerarion"]["format"].value;
                var strm=  document.forms["reportgenerarion"]["strm"].value;
                var syear=  document.forms["reportgenerarion"]["syear"].value;
                var catego=  document.forms["reportgenerarion"]["catego"].value;
                var ename=  document.forms["reportgenerarion"]["ename"].value;             
                if (format == '' || strm == '' || syear == '' || catego == '' || ename == '') {
  $('#generatesuccess').html('<div class="alert alert-danger">Please fiil up the form correctlly</div>');
      return;
    }
                var form = document.getElementById("reportgenerarion");
                var formData = new FormData(form);
                formData.append('page', 'eResult');
                formData.append('action', 'repogen');
                formData.append('depart', depart);
                formData.append('head', head);

            $.ajax({
                url: "head_report.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#generatesuccess').html(data);
                    

                }
                

            })

            });

          });
</script>





</body>
<?php
function getArticles($db, $start, $limit)
{

    $fet = $db->prepare("SELECT * FROM final_result ORDER BY result DESC   LIMIT $start, $limit  ");
    $fet->execute();
    $articles = $fet->fetchAll(PDO::FETCH_ASSOC);
    return $articles;
}

function getTotalPages($db, $limit)
{
    $stmt = $db->prepare("SELECT COUNT(*) FROM final_result");
    $stmt->execute();
    $total_records = $stmt->fetchColumn();
    $total_pages = ceil($total_records / $limit);
    return $total_pages;
}

?>