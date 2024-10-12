<?php

include "dbc.php";
include "header.php";

// if (isset($_SESSION['uiid']) && isset($_SESSION['fname'])) {

$fetch = $pdo->prepare('SELECT * FROM category WHERE college=:collg ORDER BY cat_name ASC');
$fetch->bindValue(':collg', $_SESSION['hdepid']);
$fetch->execute();
$cat = $fetch->fetchAll(PDO::FETCH_ASSOC);

$dfetcsh = $pdo->prepare('SELECT * FROM department WHERE dep_id=:depid ');
$dfetcsh->bindValue(':depid', $_SESSION['hdepid']);
$dfetcsh->execute();
$depart = $dfetcsh->fetch(PDO::FETCH_ASSOC);

$dfetch = $pdo->prepare('SELECT * FROM department ORDER BY dep_name ');
$dfetch->execute();
$departs = $dfetch->fetchAll(PDO::FETCH_ASSOC);

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
        <h5 class="h5">Course</h5>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addmodal"> Add Category</button>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#catmodal">Assign Department</button>
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
              <h5 class="modal-title" id="exampleModalLabel">Assign Category</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <form class="form-group was-validated" id="addcat" method="POST" action="#">
                <div class="mb-1" id="success"></div>

                <div class="row">
                  <div class="col-5 mb-1">
                    <label>Category</label>
                    <select id="catid" name="catid" class="form-select" required aria-label="type">
                      <option value>
                        </option>
                        <?php foreach ($cat as $ccmb) :  ?>
                          <option value="<?php echo $ccmb['cat_id'] ?>" data-id = "<?php echo $ccmb['college'] ?>"><?php echo $ccmb['cat_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Please, select the category</div>
                  </div>
                  <div class="col-7 mb-1">
                    <label>Department</label>
                    <select id="cdep" name="cdep" class="form-select" required aria-label="type">
                      <option value></option>
                      <?php foreach ($departs as $dep) :  ?>
                        <option value="<?php echo $dep['dep_id'] ?>"><?php echo $dep['dep_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Please, select the department</div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-7">
                    <label>Target Group</label>
                    <div class="form-check">
                      <input class="form-check-input" name="myRadioGroup" required type="checkbox" value="Regular" id="flexCheckDefault1">
                      <label class=" mb-2" for="flexCheckDefault1">
                        Regular
                      </label></br>
                      <input class="form-check-input" name="myRadioGroup" required type="checkbox" value="Extension" id="flexCheckDefault2">
                      <label class=" mb-2" for="flexCheckDefault2">
                        Extension
                      </label></br>
                      <input class="form-check-input" name="myRadioGroup" required type="checkbox" value="Summer" id="flexCheckDefault3">
                      <label class=" mb-2" for="flexCheckDefaul3">
                        Summer
                      </label>
                    </div>
                  </div>

                  <div class="col-5">
                    <label>Target Year</label>
                    <select id="cyira" name="cyira" class="form-select" required aria-label="type">
                      <option value></option>
                      <option value="1">1<sup>st</sup> Year</option>
                      <option value="2">2<sup>nd</sup> Year</option>
                      <option value="3">3<sup>rd</sup> Year</option>
                      <option value="4">4<sup>th</sup> Year</option>
                      <option value="5">5<sup>th</sup> Year</option>
                      <option value="6">6<sup>th</sup> Year</option>
                    </select>
                    <div class="invalid-feedback">Please, select the correct year </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                  <input type="button" name="sent" class="addi btn btn-primary" value="ADD">
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
              <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <form class="form-group was-validated" id="finaladdcat" method="POST" action="#">
                <div class="mb-1" id="addsuccess"></div>
                <div class="mb-1">
                  <label>Name</label>
                  <input type="text" class="form-control" value="" id="cname" name="cname" required placeholder="Enter category name">
                </div>
                <div class="mb-1">
                  <label>Category Code</label>
                  <input type="text" class="form-control" id="caco" name="caco" required placeholder="Enter category code">
                </div>
                <div class=" mb-1">
                  <label>Program</label>
                  <select id="strm" name="strm" class="form-select" required aria-label="stype">
                    <option value></option>
                    <option value="Degree">Degree</option>
                    <option value="Masters">Masters</option>
                    <option value="Phd" disabled >Phd</option>
                  </select>
                </div>
                <div class=" mb-1">
                  <label>Department</label>
                  <select id="coltype" name="coltype" class="form-select" required aria-label="taype">
                    
                      <option selected value="<?php echo $depart['dep_id']; ?>"><?php echo $depart['dep_name']; ?></option>
                  </select>
                  
                </div>
                <div class=" mb-1">
                  <label>Type</label>
                  <select id="cctyped" name="cctyped" class="form-select" required aria-label="type">
                    <option value></option>
                    <option value="Course">Course</option>
                    <option value="COC">COC</option>
                    <option value="Other">Other</option>
                  </select>
                  
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
              <button class="accordion-button collapsed btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $ca['cat_id'] ?>panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                <?php echo $ca['cat_name'] ?>
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

              <div class="row mb-1">

                <div class="col">
                  <h7><label for="" class="col-form-label col-form-label-sm">
                      <h5>Category Name:</h5> <?php echo $ca['cat_name'] ?>
                    </label></h7>



                </div>
                <div class="col">

                  <h7><label for="" class="col-form-label col-form-label-sm">
                      <h5>Category Type:</h5> <?php echo $ca['cat_type'] ?>
                    </label></h7>
                </div>
              </div>
              <div class="row mb-1">
                <div class="col">

                  <h7><label for="" class="col-form-label col-form-label-sm">
                      <h5>Category Code:</h5> <?php echo $ca['cat_code'] ?>
                    </label></h7>
                </div>
                <div class="col">

                  <h7><label for="" class="col-form-label col-form-label-sm">
                      <h5>Category ID:</h5> <?php echo $ca['cat_id'] ?>
                    </label></h7>
                </div>
              </div>
              <?php

                $fetdch = $pdo->prepare('SELECT DISTINCT * FROM asscategory WHERE cat_id=:catimp GROUP BY Department');
                $fetdch->bindValue(':catimp', $ca['cat_id']);
                $fetdch->execute();
                $catdep = $fetdch->fetchAll(PDO::FETCH_ASSOC);





              if (count($catdep) > 0) :
              ?>

                <!------------->
                <div class="table table-responsive table-bordered table-striped container">

                  <table class="table table-striped table-hover container table-hover">
                    <tr class="table-info">
                      <th id="tempo" class="table-info">Assigned Department</th>
                      <th class="table-info">Group</th>
                      <th class="table-info">Year</th>
                      <th class="table-info">Action</th>

                    </tr>
                    <tbody>
                      <?php foreach ($catdep as $cap) : //$ui=$ca['cat_p']; 
                      
                      $dfetdch = $pdo->prepare('SELECT * FROM department WHERE dep_id=:catimp');
                      $dfetdch->bindValue(':catimp', $cap['Department']);
                      $dfetdch->execute();
                      $dcatdep = $dfetdch->fetch(PDO::FETCH_ASSOC);
                     
                        $dnames = $dcatdep['dep_name'];
                     
                      
                        // $mfetdch = $pdo->prepare('SELECT assigned_year,Department, GROUP_CONCAT(DISTINCT  assigned_group) AS mycol_group FROM course WHERE cat_id=:catimp AND Department=:depus GROUP BY Department,assigned_year');
                        // $mfetdch->bindValue(':catimp', $cap['cat_id']);
                        // $mfetdch->bindValue(':depus', $cap['Department']);
                        // $mfetdch->execute();
                        // $mcatdep = $mfetdch->fetchAll(PDO::FETCH_ASSOC);
                        
                        $mfetdch = $pdo->prepare('
                        SELECT Department, assigned_year, GROUP_CONCAT(DISTINCT assigned_group) AS other_column_group
                        FROM (
                            SELECT Department, assigned_year, assigned_group
                            FROM course
                            WHERE cat_id = :catimp AND Department = :depus
                            GROUP BY Department, assigned_year, assigned_group
                        ) AS subquery
                        GROUP BY Department, assigned_year');
                    $mfetdch->bindValue(':catimp', $cap['cat_id']);
                    $mfetdch->bindValue(':depus', $cap['Department']);
                    $mfetdch->execute();
                    $mcatdep = $mfetdch->fetchAll(PDO::FETCH_ASSOC);

                  
                                              
                      ?>




         <?php foreach ($mcatdep as $scap) : ?>


                        <tr class="">
                          <?php

                          ?>

                          <td><?php echo $dnames ?></td>
                          <td>

                            <?php
                            
                              echo $scap['other_column_group'] . ',';
                            
                            ?>

                          </td>
                          <td><?php
                              
                                echo $scap['assigned_year'];
                                
                              

                              ?></td>

                          <td>



                            <button data-bs-target="#editmodal" data-bs-toggle="modal" name="edit" id="rugant" value="<?php echo $ca['cat_id'] ?>" class="rugant btn btn-sm btn-outline-info" data-year="<?php echo $scap['assigned_year']?>" data-id="<?php echo $cap['Department'] ?>">Edit</button>

                            <button name="edit" value="<?php echo $ca['cat_id'] ?>" class="cdelete btn btn-sm btn-outline-danger" id="depadelete" data-year="<?php echo $scap['assigned_year']?>" data-id="<?php echo $cap['Department'] ?>">Delete</button>

                            </form>
                          </td>
                        </tr>
                        <?php endforeach; ?>






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
        var dep_year = $(this).data('year');
          //addcourse
        $.ajax({
          url: "adminmodal.php",
          method: "POST",
          data: {
            cudo: cudo,
            dep_id: dep_id,
            dep_year: dep_year,
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
          url: "adminmodal.php",
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
        var pattern = /^[a-zA-Z ]+$/;

var fname=  document.forms["finaladdcat"]["cname"].value;

if (!pattern.test(fname)) {
$('#addsuccess').html('<div class="alert alert-danger">Invalid input. Only text is allowed.</div>');
    return;
  }
        var cname = document.forms["finaladdcat"]["cname"].value;
        var cid = document.forms["finaladdcat"]["caco"].value;
        var ctype = document.forms["finaladdcat"]["cctyped"].value;
        var strm = document.forms["finaladdcat"]["strm"].value;
        var coltype = document.forms["finaladdcat"]["coltype"].value;
        $.ajax({
          url: "adminmodal.php",
          method: "POST",
          data: {
            page: 'registrar',
            action: 'add',
            cid: cid,
            cname: cname,
            ctype: ctype,
            strm: strm,
            coltype: coltype
          },
          success: function(data) {
            $('#addsuccess').html(data);
          }
        })
      });
      $(document).on('click', '.addi', function() {


        var cgroup = getRadioValues();
        
        var cid = document.forms["addcat"]["catid"].value;
        var depa = document.forms["addcat"]["cdep"].value;
        var yera = document.forms["addcat"]["cyira"].value;
        var selectedOption = document.forms["addcat"]["catid"].options[document.forms["addcat"]["catid"].selectedIndex];
        var truedep = selectedOption.getAttribute("data-id");

        $.ajax({
          url: "adminmodal.php",
          method: "POST",
          data: {
            page: 'registrar',
            action: 'assignadd',
            cgroup: cgroup,
            truedep: truedep,
            depa: depa,
            yera: yera,
            cid: cid,
          },
          success: function(data) {
            $('#success').html(data);
          }
        })

        function getRadioValues() {
          var radioButtons = document.getElementsByName("myRadioGroup");
          var values = [];
          for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].checked) {
              values.push(radioButtons[i].value);
            }
          }
          return values;
        }

      });


      $(document).on('click', '#uppdate', function() {

        var ucgroup = ggetRadioValues();
        var umain_p = document.forms["cupdate"]["ucatid"].value;
        var udepa = document.forms["cupdate"]["ucdep"].value;
        var uyera = document.forms["cupdate"]["ucyira"].value;
        var oyear = document.forms["cupdate"]["oyear"].value;
        var odepart = document.forms["cupdate"]["odepart"].value;

        $.ajax({
          url: "adminmodal.php",
          method: "POST",
          data: {
            page: 'registrar',
            action: 'cuupdate',
            umain_p: umain_p,
            ucgroup: ucgroup,
            udepa: udepa,
            uyera: uyera,
            oyear,oyear,
            odepart:odepart

          },
          success: function(data) {
            $('#success_update').html(data);
          }
        })

      });


      $(document).on('click', '#biguppdate', function() {
        var pattern = /^[a-zA-Z ]+$/;

var fname=  document.forms["bigcupdate"]["bigucname"].value;

if (!pattern.test(fname)) {
$('#success_updatebig').html('<div class="alert alert-danger">Invalid input. Only text is allowed.</div>');
    return;
  }
        var bumain_p = document.forms["bigcupdate"]["bigcat_id"].value;
        var bucname = document.forms["bigcupdate"]["bigucname"].value;
        var bucid = document.forms["bigcupdate"]["bigucaco"].value;
        var coltype = document.forms["bigcupdate"]["coltype"].value;
        var strm = document.forms["bigcupdate"]["strm"].value;
        var buctype = document.forms["bigcupdate"]["biguctype"].value;

        $.ajax({
          url: "adminmodal.php",
          method: "POST",
          data: {
            page: 'registrar',
            action: 'bigcuupdate',
            bumain_p: bumain_p,
            bucname: bucname,
            coltype: coltype,
            strm: strm,
            bucid: bucid,
            buctype: buctype

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
        //var deldepart = $(this).data('delid');
        var dep_year = $(this).data('year');

        if (conf == true) {

          $.ajax({
            url: "adminmodal.php",
            method: "POST",
            data: {
              page: 'registrar',
              action: 'cdelete',
              dcid: dcid,
              depart: depart,
              dep_year:dep_year
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
            url: "adminmodal.php",
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