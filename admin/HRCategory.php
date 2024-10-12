<?php

include "dbc.php";
include "hr_header.php";

// if (isset($_SESSION['uiid']) && isset($_SESSION['fname'])) {

$fetch = $pdo->prepare('SELECT * FROM category WHERE cat_type=:ctype ORDER BY cat_name ASC');
$fetch->bindValue(':ctype', 'HR');
$fetch->execute();
$cat = $fetch->fetchAll(PDO::FETCH_ASSOC);

$dfetch = $pdo->prepare('SELECT * FROM department ORDER BY dep_name ASC');
$dfetch->execute();
$depart = $dfetch->fetchAll(PDO::FETCH_ASSOC);

// $colfetch = $pdo->prepare('SELECT * FROM college ORDER BY col_name ASC');
// $colfetch->execute();
// $colf = $colfetch->fetchAll(PDO::FETCH_ASSOC);
?>
<html lang="en">

<head>

  <title>Registrar</title>

  <style>
    /* Add shadow on hover */
    .table-hover tbody tr:hover {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
  </style>
</head>

<body >
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
        <h5 class="h5">Job</h5>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addmodal"> Add Job</button>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#catmodal">Request Exam</button>
          </div>

        </div>
      </div>

  <div class="container big">
    <div class="container view">

      <!-- Modal -->
      <div class="modal fade" id="catmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Request Exam</h5>
              <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <form class="form-group was-validated" id="addcat" method="POST" action="#">
                <div class="mb-1" id="success"></div>

                <div class="row">
                  <div class="col-5 mb-1">
                    <label class="fs-5" >Job Title</label>
                    <select id="catid" name="catid" class="form-select" required aria-label="type">
                      <option value>
                        </option>
                        <?php foreach ($cat as $ccmb) :  ?>
                          <option value="<?php echo $ccmb['cat_id'] ?>" data-id = "<?php echo $ccmb['college'] ?>"><?php echo $ccmb['cat_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Please, select the Job title</div>
                  </div>
                  <div class="col-7 mb-1">
                    <label class="fs-5" >Department</label>
                    <select id="cdep" name="cdep" class="form-select" required aria-label="type">
                      <option value></option>
                      <?php foreach ($depart as $dep) :  ?>
                        <option value="<?php echo $dep['dep_id'] ?>"><?php echo $dep['dep_name'] ?></option>
                      <?php endforeach; ?>
                      <option value="all">All</option>
                    </select>
                    <div class="invalid-feedback">Please, select the department</div>
                  </div>
                </div>
               

                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                  <input type="button" name="sent" class="addi btn btn-primary" value="Request">
                </div>
              </form>
            </div>


          </div>
        </div>
      </div>
    </div>
      <!---- add category-->

      <!-- Modal -->
      <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add JOb</h5>
              <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <form class="form-group was-validated" id="finaladdcat" method="POST" action="#">
                <div class="mb-1" id="addsuccess"></div>
                <div class="mb-1">
                  <label class="fs-5" >Job Title</label>
                  <input type="text" class="form-control" value="" id="cname" name="cname" required placeholder="Enter job title">
                </div>
                <div class="mb-1">
                  <label class="fs-5">Apply Limit</label>
                  <input type="number" class="form-control" min="1" id="alimit" name="alimit" required placeholder="Enter apply limit">
                </div>
                <div class=" mb-1">
                  <label class="fs-5">Required Candidate</label>
                  <input type="number" class="form-control"  min="1" id="rlimit" name="rlimit" required placeholder="Enter Required candidate number">

                </div>
                <div class=" mb-1">
                    <div class="row">
                        <div class="col">
                        <label class="fs-5">Exam_Date</label>
                        <input type="date" class="form-control" id="edate" name="edate" required placeholder="Enter exam date">
                        </div>
                        <div class="col">
                        <label class="fs-5">Exam_Time</label>
                        <input type="time" class="form-control" id="etime" name="etime" required placeholder="Enter exam time">
                        </div>
                    </div>   
                </div>
                <div class="row">
                    
                <div class="col mb-1">
                  <label class="fs-5">Type</label>
                  <select id="cctyped" name="cctyped" class="form-select" required aria-label="type">
                    <option selected value="HR">HR</option>
                  </select>
                  
                </div>
                <div class="col mb-1">
            <label class="fs-5" >Status</label>
              <select id="stati" name="stati" value=" " class="form-select" required aria-label="type">
              <option selected disabled></option>
              <option value="1" ><span class="d-inline-block bg-success rounded-circle p-1"></span> Activate</option> 
              <option value="0" ><span class="d-inline-block bg-danger rounded-circle p-1"></span> Deactivate</option>
              </select>
            </div>
                </div>


            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
              <input type="button" name="sent" class="finaladdi btn btn-primary" value="ADD">
            </div>
            </form>
          </div>


        </div>
      </div>
    



    <!------>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
      <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">

        </div>
      </div>
    </div>
    <?php foreach ($cat as $ca) :
    ?>
      <div class="accordion mb-2 shadow-sm  mb-2 " id="accordionPanelsStayOpenExample">

        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
            <div style="display: flex; align-items: center;">
              <button class="accordion-button collapsed btn-sm fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $ca['cat_id'] ?>panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                <?php echo $ca['cat_name'] ?>


                <span class="position-absolute top-50 end-50 translate-middle-y">

						<?php if($ca['stat'] == 1):?>
							Status: <span class="badge badge-sm rounded-pill bg-success">Activated</span>
						<?php else:?>
							Status: <span class="badge badge-sm rounded-pill bg-danger">Deactivated</span>

						<?php endif;?>
						
						
					</span>



              </button>

              <form style="margin-left: 10px;">
                <button data-bs-target="#editmodalbig" type="button" data-bs-toggle="modal" name="editter" id="migrugant" value="<?php echo $ca['cat_id'] ?>"
                 class="bbrugantbig btn btn-sm btn-outline-info mt-2 " data-id="<?php //echo $ca['cat_id']?>" >Edit</button>
              </form>

              <form id="cdelte" method="POST" style="margin-left: 10px;">
                
                <button type="button" id="bigcdelete" name="bigcdelete" value="<?php echo $ca['cat_id']?>" 
                class="cdelete btn btn-sm btn-outline-danger mt-2">Delete</button>
              </form>
            </div>
          </h2>

          <div id="<?php echo $ca['cat_id'] ?>panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
            <div class="accordion-body">
            <div class="mx-4">

              <div class="row mb-1">

                <div class="col">
                  <h7><label for="" class="col-form-label col-form-label-sm">
                      <h5>Job Title:</h5> <?php echo $ca['cat_name'] ?>
                    </label></h7>



                </div>
                <div class="col">
                <h7><label for="" class="col-form-label col-form-label-sm">
                      <h5>Job ID:</h5> <?php echo $ca['cat_id'] ?>
                    </label></h7>
                </div>
              </div>
              <div class="row mb-1">

                <div class="col">
                <h7><label for="" class="col-form-label col-form-label-sm">
                    <h5>Exam Date:</h5> <?php
                    if($ca['exam_date'] !=''){
                    echo $ca['exam_date']; }
                    else{
                        echo'<span class="badge rounded-pill bg-danger">Not Set</span>';
                    }
                    
                    ?>
                    </label></h7>



                </div>
                <div class="col">
                <h7><label for="" class="col-form-label col-form-label-sm">
                    <h5>Exam Time:</h5> <?php
                    
                    if($ca['start_time'] !=''){
                        $startTime = $ca['start_time'];
                        $formattedTime = date("h:i A", strtotime($startTime));
                        $q_output='<span>'.$formattedTime.' (Local Time)</span>';
                        echo $q_output;
                    
                    
                    }
                        else{
                            echo'<span class="badge rounded-pill bg-danger">Not Set</span>';
                        }
                    
                    ?>
                    </label></h7>
                </div>
                </div>
            </div>
              
              <?php
              $fetdch = $pdo->prepare('SELECT * FROM asscategory WHERE cat_id=:catimp');
              $fetdch->bindValue(':catimp', $ca['cat_id']);
              $fetdch->execute();
              $catdep = $fetdch->fetchAll(PDO::FETCH_ASSOC);




              if (count($catdep) > 0) :
              ?>

                <!------------->
                <div class="table table-responsive table-bordered table-striped container">

                  <table class="table table-striped table-hover container table-hover">
                    <tr class="table-info">
                      <th id="tempo" class="table-info">Requested Departments</th>
                      <th class="table-info">Status</th>
                      <th class="table-info">Action</th>

                    </tr>
                    <tbody>
                      <?php foreach ($catdep as $cap) : //$ui=$ca['cat_p']; 
                      ?>
                        <tr class="">
                          <?php
                          $dfetdch = $pdo->prepare('SELECT * FROM department WHERE dep_id=:catimp');
                          $dfetdch->bindValue(':catimp', $cap['Department']);
                          $dfetdch->execute();
                          $dcatdep = $dfetdch->fetchAll(PDO::FETCH_ASSOC);
                          foreach ($dcatdep as $dname) {
                            $dnames = $dname['dep_name'];
                          }
                          ?>

                          <td><?php echo $dnames ?></td>
                          
                          <td>
                         <?php if($ca['dep_stat'] == 1):?>
                            <span class="badge rounded-pill bg-success">Accepted</span>
                        <?php elseif($ca['dep_stat'] == 2):?>
                            <span class="badge rounded-pill bg-danger">Rejected</span>
                        <?php else:?>
                            <span class="badge rounded-pill bg-warning text-dark">Pending...</span>
                        <?php endif;?>

                          </td>

                          <td>



                            <button data-bs-target="#editmodal" data-bs-toggle="modal" name="edit" id="rugant" value="<?php echo $ca['cat_id'] ?>" class="rugant btn btn-sm btn-outline-info" data-id="<?php echo $cap['Department'] ?>">Edit</button>

                            <button name="edit" value="<?php echo $ca['cat_id'] ?>" class="cdelete btn btn-sm btn-outline-danger" id="depadelete" data-id="<?php echo $cap['Department'] ?>">Delete</button>

                            </form>
                          </td>
                        </tr>

                      <?php endforeach; ?>
                    </tbody>
                  </table>

                </div>
              <?php else : ?>

                <p class="text-center alert alert-danger mt-3 mb-2">No department has been assigned yet.</p>


                <!------->
              <?php endif; ?>

            </div>
          </div>
        </div>

      </div>
    <?php endforeach; ?>






    <!-- Edit Modal -->

    <div class="modal fade" id="editmodal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div id="ruyan" class="modal-content">
        </div>
      </div>
    </div>

    <div class="modal fade" id="editmodalbig" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div id="bruyanbig" class="modal-content">
        </div>
      </div>
    </div>


    </div>

    <script>
    $(document).ready(function() {
      $('.dropdown-toggle').dropdown();
    });
  </script>
  <script>
    var elements = document.getElementsByClassName('active');
   for (var i = 0; i < elements.length; i++) {
  var parentElement = elements[i].closest('.nav-link');
  if (parentElement) {
    parentElement.classList.remove('active');
}}
var anchor = document.querySelector('.nav-link.caticati');
if (anchor) {
  anchor.classList.add('active');
}

  </script>
</body>

  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', '.rugant', function() {
        var cudo = $(this).val();
        var dep_id = $(this).data('id');
          //addcourse
        $.ajax({
          url: "hrmodal.php",
          method: "POST",
          data: {
            cudo: cudo,
            dep_id: dep_id,
            page: 'registrar',
            action: 'modall'
          },
          success: function(data) {
            $('#ruyan').html(data);
          }
        })
      });

      $(document).on('click', '.bbrugantbig', function() {
        var cudo = $(this).val();
        $.ajax({
          url: "hrmodal.php",
          method: "POST",
          data: {
            cudo: cudo,
            page: 'registrar',
            action: 'modallbig'
          },
          success: function(data) {
            $('#bruyanbig').html(data);
          }
        })
      });

      $(document).on('click', '.finaladdi', function() {
        var pattern = /^[a-zA-Z]+$/;
        var npattern = /^[0-9]+$/;
var fname=  document.forms["finaladdcat"]["cname"].value;

if (!pattern.test(fname)) {
$('#addsuccess').html('<div class="alert alert-danger">Invalid input. Only text is allowed.</div>');
    return;
  }
        var cname = document.forms["finaladdcat"]["cname"].value;
        var alimit = document.forms["finaladdcat"]["alimit"].value;
        var rlimit = document.forms["finaladdcat"]["rlimit"].value;
        var edate = document.forms["finaladdcat"]["edate"].value;
        var etime = document.forms["finaladdcat"]["etime"].value;
        var cctyped = document.forms["finaladdcat"]["cctyped"].value;
        var stati = document.forms["finaladdcat"]["stati"].value;

        if (alimit < rlimit){
   $('#addsuccess').html('<div class="alert alert-danger">Required limit can not exceed apply limit</div>');
    return; 
        }

        if (!npattern.test(alimit) || !npattern.test(rlimit) ) {
  $('#addsuccess').html('<div class="alert alert-danger">Only  numbers are allowed</div>');
      return;
    }

        $.ajax({
          url: "hrmodal.php",
          method: "POST",
          data: {
            page: 'registrar',
            action: 'add',
            alimit: alimit,
            cname: cname,
            rlimit: rlimit,
            edate: edate,
            etime: etime,
            cctyped: cctyped,
            stati:stati
          },
          success: function(data) {
            $('#addsuccess').html(data);
          }
        })
      });
      $(document).on('click', '.addi', function() {


        
        var cid = document.forms["addcat"]["catid"].value;
        var depa = document.forms["addcat"]["cdep"].value;

        $.ajax({
          url: "hrmodal.php",
          method: "POST",
          data: {
            page: 'registrar',
            action: 'assignadd',
            depa: depa,
            cid: cid,
          },
          success: function(data) {
            $('#success').html(data);
          }
        })

        

      });


      $(document).on('click', '#uppdate', function() {

        var umain_p = document.forms["cupdate"]["ucatid"].value;
        var udepa = document.forms["cupdate"]["ucdep"].value;
        var asnum = document.forms["cupdate"]["asnum"].value;
        var conum = document.forms["cupdate"]["conum"].value;
        $.ajax({
          url: "hrmodal.php",
          method: "POST",
          data: {
            page: 'registrar',
            action: 'cuupdate',
            umain_p: umain_p,
            udepa: udepa,
            asnum: asnum,
            conum: conum

          },
          success: function(data) {
            $('#success_update').html(data);
          }
        })

      });


      $(document).on('click', '#biguppdate', function() {
        var pattern = /^[a-zA-Z]+$/;
        var npattern = /^[0-9]+$/;
var fname=  document.forms["bigcupdate"]["bigucname"].value;

if (!pattern.test(fname)) {
$('#success_updatebig').html('<div class="alert alert-danger">Invalid input. Only text is allowed.</div>');
    return;
  }
        var bumain_p = document.forms["bigcupdate"]["bigcat_id"].value;
        var bucname = document.forms["bigcupdate"]["bigucname"].value;
        var bigalimit = document.forms["bigcupdate"]["bigalimit"].value;
        var bigrlimit = document.forms["bigcupdate"]["bigrlimit"].value;
        var bigedate = document.forms["bigcupdate"]["bigedate"].value;
        var bigetime = document.forms["bigcupdate"]["bigetime"].value;
        var bigstati = document.forms["bigcupdate"]["bigstati"].value;

        if (bigalimit < bigrlimit){
   $('#success_updatebig').html('<div class="alert alert-danger">Required limit can not exceed apply limit</div>');
    return; 
        }
        if (!npattern.test(bigalimit) || !npattern.test(bigrlimit) ) {
  $('#success_updatebig').html('<div class="alert alert-danger">Only  numbers are allowed</div>');
      return;
    }
        $.ajax({
          url: "hrmodal.php",
          method: "POST",
          data: {
            page: 'registrar',
            action: 'bigcuupdate',
            bumain_p: bumain_p,
            bucname: bucname,

            bigalimit: bigalimit,
            bigrlimit: bigrlimit,
            bigedate: bigedate,
            bigetime: bigetime,
            bigstati:bigstati

          },
          success: function(data) {
            $('#success_updatebig').html(data);
          }
        })

      });

      $(document).on('click', '#depadelete', function() {
        var conf = confirm('Are you sure you want to delete this category? ');
        var dcid = $(this).val();
        var depart = $(this).data('id');
        var deldepart = $(this).data('delid');
        if (conf == true) {

          $.ajax({
            url: "hrmodal.php",
            method: "POST",
            data: {
              page: 'registrar',
              action: 'cdelete',
              dcid: dcid,
              depart: depart
            },
            success: function(data) {
              $('.toast-body').html(data);
              $('.toast').addClass('toast-success').toast('show');
            }
          })

        } else {

        }

      });

      $(document).on('click', '#bigcdelete', function() {
        var conf = confirm('Are you sure you want to delete this category? ');
        var mdcid = $(this).val();
        if (conf == true) {

          $.ajax({
            url: "hrmodal.php",
            method: "POST",
            data: {
              page: 'registrar',
              action: 'bbigcdelete',
              mdcid: mdcid
            },
            success: function(data) {
              $('.toast-body').html(data);
              $('.toast').addClass('toast-success').toast('show');
            }
          })

        } else {

        }

      });

      function ggetRadioValues() {
        var radioButtons = document.getElementsByName("myupRadioGroup");
        var values = [];
        for (var i = 0; i < radioButtons.length; i++) {
          if (radioButtons[i].checked) {
            values.push(radioButtons[i].value);
          }
        }
        return values;
      }
    });
  </script>



</html>

<?php

// }else{
//      header("Location: index.php");
//      exit();
// }
?>