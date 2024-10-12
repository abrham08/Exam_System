<?php

include "dbc.php";
include "registrar_header.php";

// if (isset($_SESSION['uiid']) && isset($_SESSION['fname'])) {

$fetch = $pdo->prepare('SELECT * FROM college ORDER BY col_name ASC');
$fetch->execute();
$cat = $fetch->fetchAll(PDO::FETCH_ASSOC);

$dfetch = $pdo->prepare('SELECT * FROM department ORDER BY dep_name ASC');
$dfetch->execute();
$depart = $dfetch->fetchAll(PDO::FETCH_ASSOC);

// $colfetch = $pdo->prepare('SELECT * FROM college ORDER BY col_name ASC');
// $colfetch->execute();
// $colf = $colfetch->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
        <h5 class="h5">Department & College</h5>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#collegeModal"> Add College</button>

            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#depaModal"> Add Department</button>
        </div>

        </div>
      </div>

    <div  id="regdashboard">





            <div class="shadow-lg rounded-5 row align-items-md-stretch">

      <div class="shadow-lg col-md-6">
        <div class=" h-100 p-5 text-bg-light rounded-5">
          <h5>Colleges</h5>
          <p>
          <div class="table table-responsive table-bordered table-striped container-fluid">
            <table class="table table-striped table-hover container table-hover">
                <tbody>
                    <tr class="table-info">

                        <th class="table-info">Department Name</th>
                        <th class="table-info">Action</th>

                    </tr>
                    <?php foreach ($cat as $stu) :?>
                    <tr>
                    <td><?php echo $stu['col_name'] ?></td>
                    <td>

               
                    <div style="display: flex;">
                    <button type="button" id="update_college" title="Edit" class="rugant fa fa-edit" value="<?php echo $stu['col_id']; ?>" style="border: none; color: skyblue; margin-right: 3%;" data-bs-toggle="modal" data-bs-target="#editdepaModal"></button>

                    <button type="submit" title="Delete" id="college_delete" name="qdelete" value="<?php echo $stu['col_id'] ?>" class="fa fa-trash" style="border: none; color: red;"></button>

                    </div>

     
                    </td>


                </tr>

            <?php endforeach; ?>




                </tbody>
            </table>
          </div>

          </p>
        </div>
      </div>


      <div class="shadow-lg col-md-6 ">
        <div class=" h-100 p-5 bg-light border rounded-5">
          <h5>Departments</h5>
          <p>
          <div class="table table-responsive table-bordered table-striped container-fluid">
            <table class="table table-striped table-hover container table-hover">
                <tbody>
                    <tr class="table-info">

                        <th class="table-info">Department Name</th>
                        <th class="table-info">Action</th>

                    </tr>
                    <?php foreach ($depart as $stu) :?>
                    <tr>
                    <td><?php echo $stu['dep_name'] ?></td>
                    <td>

               
                    <div style="display: flex;">
                    <button type="button" id="update_depa" title="Edit" class="rugant fa fa-edit" value="<?php echo $stu['dep_id']; ?>" style="border: none; color: skyblue; margin-right: 3%;" data-bs-toggle="modal" data-bs-target="#editdepaModal"></button>

                    <button type="submit" title="Delete" id="depa_delete" name="qdelete" value="<?php echo $stu['dep_id'] ?>" class="fa fa-trash" style="border: none; color: red;"></button>

                    </div>

     
                    </td>


                </tr>

            <?php endforeach; ?>




                </tbody>
            </table>
          </div>

          </p>
        </div>
      </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="collegeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add College</h5>
        <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form class="form-group was-validated" id="finaladdcol" method="POST" action="#">
          <div class="mb-1" id="colsuccess"></div>
          <div class="mb-1">
            <label>College Name</label>
            <input type="text" class="form-control" value="" id="cname" name="cname" required placeholder="Enter college name">
          </div>

          <div class=" mb-1">
            <label>Stream</label>
            <select id="stream" name="stream" class="form-select" required aria-label="type">
              <option value></option>
              <option value="NS">Natural Science</option>
              <option value="SC">Social Science</option>
            </select>
            
          </div>

      </div>

      <div class="modal-footer">
        <button type="button" onclick="window.location.reload()" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <input type="button" name="sent" class="finalcoll btn btn-primary" value="ADD">
      </div>
      </form>
    </div>


  </div>
</div>




<!------>








<!-- Modal -->
<div class="modal fade" id="depaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
        <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form class="form-group was-validated" id="finaladddepa" method="POST" action="#">
          <div class="mb-1" id="depasuccess"></div>
          <div class="mb-1">
            <label>Name</label>
            <input type="text" class="form-control" value="" id="dname" name="dname" required placeholder="Enter department name">
          </div>

          <div class=" mb-1">
            <label>College</label>
            <select id="coltype" name="coltype" class="form-select" required aria-label="taype">
              <option value></option>
              <?php foreach ($cat as $colfep) :  ?>
                <option value="<?php echo $colfep['col_id'] ?>"><?php echo $colfep['col_name'] ?></option>
              <?php endforeach; ?>
            </select>
            
          </div>

      </div>

      <div class="modal-footer">
        <button type="button" onclick="window.location.reload()" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        <input type="button" name="sent" class="finaldepa btn btn-primary" value="ADD">
      </div>
      </form>
    </div>


  </div>
</div>


      <!------>
      <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
      <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">

        </div>
      </div>
    </div>

<!----modal-->
<div class="modal fade" id="editdepaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div id="editdepcollege" class="modal-content">

    </div>
  </div>
<script>
    var elements = document.getElementsByClassName('active');
   for (var i = 0; i < elements.length; i++) {
  var parentElement = elements[i].closest('.nav-link');
  if (parentElement) {
    parentElement.classList.remove('active');
}}
var anchor = document.querySelector('a.nav-link.depapacoll');
if (anchor) {
  anchor.classList.add('active');
}

  </script>
  <script type="text/javascript">
    $(document).ready(function() {

$(document).on('click', '.finalcoll', function() {
  var pattern = /^[a-zA-Z ]+$/;
      

          var fname=  document.forms["finaladdcol"]["cname"].value;

          if (!pattern.test(fname)) {
            $('#colsuccess').html('<div class="alert alert-danger">Invalid input. Only text is allowed.</div>');
                return;
              }
var cname = document.forms["finaladdcol"]["cname"].value;
var stream = document.forms["finaladdcol"]["stream"].value;
$.ajax({
  url: "modal.php",
  method: "POST",
  data: {
    page: 'depCollege',
    action: 'addcollege',
    stream: stream,
    cname: cname

  },
  success: function(data) {
    $('#colsuccess').html(data);
  }
})
});

$(document).on('click', '.finaldepa', function() {

  var pattern = /^[a-zA-Z ]+$/;

  var fname=  document.forms["finaladddepa"]["cname"].value;

if (!pattern.test(fname)) {
  $('#depasuccess').html('<div class="alert alert-danger">Invalid input. Only text is allowed.</div>');
      return;
    }
var dname = document.forms["finaladddepa"]["dname"].value;
var cid = document.forms["finaladddepa"]["coltype"].value;
$.ajax({
  url: "modal.php",
  method: "POST",
  data: {
    page: 'depCollege',
    action: 'adddepa',
    cid: cid,
    dname: dname

  },
  success: function(data) {
    $('#depasuccess').html(data);
  }
})
});







$(document).on('click', '.efinalcoll', function() {
  var pattern = /^[a-zA-Z ]+$/;

  var fname=  document.forms["efinaladdcol"]["cname"].value;

if (!pattern.test(fname)) {
  $('#ecolsuccess').html('<div class="alert alert-danger">Invalid input. Only text is allowed.</div>');
      return;
    }
var cname = document.forms["efinaladdcol"]["cname"].value;
var stream = document.forms["efinaladdcol"]["stream"].value;
var uid = document.forms["efinaladdcol"]["uid"].value;
$.ajax({
  url: "modal.php",
  method: "POST",
  data: {
    page: 'depCollege',
    action: 'eaddcollege',
    stream: stream,
    cname: cname,
    uid:uid

  },
  success: function(data) {
    $('#ecolsuccess').html(data);
  }
})
});

$(document).on('click', '.efinaldepa', function() {
  var pattern = /^[a-zA-Z ]+$/;

  var fname=  document.forms["efinaladddepa"]["dname"].value;

if (!pattern.test(fname)) {
  $('#edepasuccess').html('<div class="alert alert-danger">Invalid input. Only text is allowed.</div>');
      return;
    }
var cna
var dname = document.forms["efinaladddepa"]["dname"].value;
var cid = document.forms["efinaladddepa"]["coltype"].value;
var uid = document.forms["efinaladddepa"]["uid"].value;
$.ajax({
  url: "modal.php",
  method: "POST",
  data: {
    page: 'depCollege',
    action: 'eadddepa',
    cid: cid,
    dname: dname,
    uid:uid
  },
  success: function(data) {
    $('#edepasuccess').html(data);
  }
})
});













$(document).on('click', '#college_delete', function() {
        var conf = confirm('Are you sure you want to delete this college? ');
        var uid = $(this).val();
        if (conf == true) {

          $.ajax({
            url: "modal.php",
            method: "POST",
            data: {
              page: 'depCollege',
              action: 'college_delete',
              uid: uid
            },
            success: function(data) {
              $('.toast-body').html(data);
              $('.toast').addClass('toast-success').toast('show');
            }
          })

        } else {

        }

      });

      $(document).on('click', '#depa_delete', function() {
        var conf = confirm('Are you sure you want to delete this department? ');
        var uid = $(this).val();
        if (conf == true) {

          $.ajax({
            url: "modal.php",
            method: "POST",
            data: {
              page: 'depCollege',
              action: 'depa_delete',
              uid: uid
            },
            success: function(data) {
              $('.toast-body').html(data);
              $('.toast').addClass('toast-success').toast('show');
            }
          })

        } else {

        }

      });

      $(document).on('click', '#update_college', function() {
        var uid = $(this).val();


          $.ajax({
            url: "modal.php",
            method: "POST",
            data: {
              page: 'depCollege',
              action: 'col_edit',
              uid: uid
            },
            success: function(data) {
              $('#editdepcollege').html(data);
            }
          })


      });



      $(document).on('click', '#update_depa', function() {
        var uid = $(this).val();

          $.ajax({
            url: "modal.php",
            method: "POST",
            data: {
              page: 'depCollege',
              action: 'depa_edit',
              uid: uid
            },
            success: function(data) {
              $('#editdepcollege').html(data);
            }
          })


      });



});
  </script>
