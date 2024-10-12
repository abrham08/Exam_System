<?php

include "registrar_header.php";

$dfetch = $pdo->prepare('SELECT * FROM department ORDER BY dep_name ASC');
$dfetch->execute();
$depart = $dfetch->fetchAll(PDO::FETCH_ASSOC);

$sfetdch = $pdo->prepare('SELECT * FROM examinee WHERE examinee_type=:catimp AND reg_by=:reg_by ORDER BY fname ASC');
$sfetdch->bindValue(':reg_by', $_SESSION['ruid'] );
$sfetdch->bindValue(':catimp', 'Student');
$sfetdch->execute();
$stulist = $sfetdch->fetchAll(PDO::FETCH_ASSOC);
?>
<head>
  <style>
.spinner-container {
  position: relative;
}

.spinner {
  width: 40px;
  height: 40px;
  border: 13px solid #ccc;
  border-top-color: #333;
  border-radius: 50%;
  animation: spin 2s linear infinite;
  display: none;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

  </style>
</head>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
        <h5 class="h5">Student</h5>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#uploadmainu"> Add Student</button>
          </div>

        </div>
      </div>

    <div  id="regdashboard">

        <div class="table table-responsive table-bordered table-striped container-fluid">
        <!-- <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#studentModal">
            Add Student
          </button> -->
            <table class="table table-striped table-hover container table-hover">
                <tbody>
                    <tr class="table-info">
                        <th  class="table-info">No.</th>
                        <th id="tempo" class="table-info">Full Name</th>
                        <th class="table-info">Gender</th>
                        <th class="table-info">Department</th>

                        <th class="table-info">Group</th>

                        <!-- <th class="table-info">Phone</th> -->
                        <th class="table-info">Email</th>
                        <th class="table-info">Status</th>
                        <th  class="table-info">Action</th>

                    </tr>

                    <?php $no=1; foreach ($stulist as $stu) :

                        $dsfetdch = $pdo->prepare('SELECT department.dep_name as depname, college.col_name as colname
                        FROM department JOIN college ON department.col_id = college.col_id WHERE department.dep_id=:depid');
                        $dsfetdch->bindValue(':depid', $stu['Department']);
                        $dsfetdch->execute();
                        $dstulist = $dsfetdch->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($dstulist as $boname) {
                            $dep_name = $boname['depname'] ?? null;
                            $colname = $boname['colname'] ?? null;
                        }
                    ?>


                        <tr class=""  data-id="<?php echo $stu['uiid'] ?>">


                            <td><?php echo  $no ; ?></td>
                            <td class="col-4"><?php echo $stu['fname'] . ' ' . $stu['lname'] . ' ' . $stu['gname']  ?></td>
                            <td><?php echo $stu['gender'] ?></td>
                            <td class="col-3"><?php echo $dep_name ?? null;   ?></td>

                            <td><?php echo $stu['ex_group'] ?></td>

                            <!-- <td><?php echo $stu['phone'] ?></td> -->
                            <td>
                            <?php if( $stu['email_stat'] == 1):?>
                              <span title="Email has been sent" class="d-inline-block bg-success rounded-circle p-1"></span>
                            <?php endif;?>

                            <?php if( $stu['email_stat'] == 0):?>
                              <span title="The email is not sent" class="d-inline-block bg-danger rounded-circle p-1"></span>  
                            <?php endif;?>
                            <?php echo $stu['email'] ?>
                          
                          </td>
                            <?php if ($stu['sttatus'] == 1) :  ?>
                <td>


                  <div class="dropdown">
                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="<?php echo $stu['uiid']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                         Active
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="<?php echo $stu['uiid'];?>">
                      <li>
                        <button class="dropdown-item bg-danger text-white btn btn-sm btn-danger" id="ban" value="<?php echo $stu['uiid'];?>"> Ban</button>
                      </li>
                    </ul>
                  </div>
                </td>
              <?php else : ?>
                <td>
                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="<?php echo $stu['uiid']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                         Baned
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="<?php echo $stu['uiid']; ?>">
                      <li>
                        <button class="dropdown-item bg-success text-white btn btn-sm btn-success" id="activ" value="<?php echo $stu['uiid'];?>"> Activate</button>
                      </li>
                    </ul>
                  </div>
                </td>
              <?php endif; ?>
                            <td>

               
                            <div style="display: flex;">
  <button type="button" id="update_student" title="Edit" class="rugant fa fa-edit" value="<?php echo $stu['uiid']; ?>" style="border: none; color: skyblue; margin-right: 3%;" data-bs-toggle="modal" data-bs-target="#editstudentModal"></button>

  <button type="submit" title="Delete" id="user_delete" name="qdelete" value="<?php echo $stu['uiid'] ?>" class="fa fa-trash" style="border: none; color: red;"></button>

  <button type="button" title="Resend Confirmation" id="send_again" class="rugant fa fa-envelope" value="<?php echo $stu['uiid']; ?>" style="border: none; color: skyblue; margin-right: 3%;"></button>
  <button type="button" title="Deatail Information" id="use_detail"  value="<?php echo $stu['uiid'] ?>" class="fa fa-circle-info" style="border: none;color: #195fd7;" data-bs-toggle="modal" data-bs-target="#editstudentModal"></button>
</div>

             
                            </td>


                        </tr>

                    <?php $no++; endforeach; ?>
                </tbody>
            </table>


        </div>
    </div>


    
    <!----modal-->
    <!-- Button trigger modal -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="uploadmainu" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel">Choose Upload Option</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="d-flex flex-column align-items-center gap-3">
  <button class="btn btn-primary" data-bs-target="#studentModal" data-bs-toggle="modal">Add Manually</button>
  <button class="btn btn-primary" data-bs-target="#excelupload" data-bs-toggle="modal">Upload Excel</button>
</div>


      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!---Excel Upload -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"  id="excelupload" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Upload from Excel</h5>
        <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <form class="form-group was-validated" id="uaddnewStudent" method="POST" enctype="multipart/form-data" action="#">

      <div class="mb-1" id="uaddStudentsuccess"></div>
      <div id="uuaddStudentsuccess" class="spinner-container">
        <div class="spinner"></div>
      </div>

      <div class="col mb-1">
          <label class="fs-4 mb-2">Department</label>
          <input type="hidden" value="<?php echo $_SESSION['ruid'];?>" name="creator" id="creator">
          <select id="edepari" name="edepari" class="form-select" required aria-label="type">
              <option value></option>
              <?php foreach ($depart as $dep) :  ?>
                  <option value="<?php echo $dep['dep_id'] ?>"><?php echo $dep['dep_name'] ?></option>
              <?php endforeach; ?>
          </select>
       </div>
      <label class="fs-4 mb-2" for="fileInput">Choose the Excel File</label>
      <input accept=".xlsx, .xls" class="form-control" type="file" name="fileInput" id="fileInput" required>
      </form>

      <div class="accordion" id="myAccordion">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
    <button class="accordion-button collapsed text-center" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
  <b class="mx-5">How to Upload the Excel?</b>
</button>


    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#myAccordion">
      <div class="accordion-body">
      <h4>Upload Excel File Instructions</h4>

          <ul>
            <li>
              <h5>Step 1: Prepare the Excel file like a pro!</h5>
              <ul>
                <li>
                  <span class="fs-5">1.1 First prepare the Excel like in the following picture</span></br>
                  <img src="img/sample.png" width="600px" height="250px" alt="No Picture Found">
                </li>
                <li>
                  <span class="fs-5">1.2 Filing number order for the first column is not mandatory but it must be empty or fill up by number order</span>
                </li>
                <li>
                  <span class="fs-5">1.3 Cross check the Excel and click the upload button</span>
                </li>
                <li>
                  <span class="fs-5">1.4 If there is no error it shows a success message else gives an error message for fixation</span>
                </li>
              </ul>
            </li>
            <li>
              <h5>Step 2: Await the grand reveal!</h5>
              <ul>
                <li>
                  <span class="fs-5">2.1 If all goes well and there are no errors to dampen the mood, brace yourself for the sweet taste of success as a delightful message appears, confirming your upload was a triumph</span>
                </li>
                <li>
                  <span class="fs-5">2.2 However, in the unlikely event that errors are detected, fear not! Our vigilant system will promptly present you with an error message, designed to guide you towards swift and effective troubleshooting.</span>
                </li>
              </ul>
            </li>
          </ul>
      </div>
    </div>
  </div>
</div>

      
      
      
      
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-target="#uploadmainu" data-bs-toggle="modal">Back to first</button>
        <input type="button" id="uostudent_add" name="sent" class="uaddstudent btn btn-primary" value="Upload">
      </div>
    </div>
  </div>
</div>
<!---Excel Upload End-->
    <!-- Modal -->
    <div class="modal fade"  id="studentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
                    <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-group was-validated" id="addnewStudent" method="POST" enctype="multipart/form-data" action="#">
                        <div class="mb-1" id="addStudentsuccess"></div>
                        <div class="row">
                            <div class="col  mb-1">
                                <label class="form-check-label" for="">First Name</label>
                                <input type="text" class="form-control" placeholder="First Name" id="fname" required>
                            </div>
                            <div class="col  mb-1">
                                <label class="form-check-label" for="">Middle Name</label>
                                <input type="text" class="form-control" placeholder="Middle Name" id="mname" required>
                            </div>
                            <div class="col  mb-1">
                                <label class="form-check-label" for="">Last Name</label>
                                <input type="text" class="form-control" placeholder="Last Name" id="lname" required>
                            </div>



                        </div>

                        <div class="row">
                            <div class="col mb-1">
                                <label>Gender</label>
                                <select id="genderi" name="catid" class="form-select" required aria-label="type">
                                    <option value> </option>

                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>

                                </select>
                            </div>
                            <div class="col mb-1">
                                <label>Department</label>
                                <select id="depari" name="cdep" class="form-select" required aria-label="type">
                                    <option value></option>
                                    <?php foreach ($depart as $dep) :  ?>
                                        <option value="<?php echo $dep['dep_id'] ?>"><?php echo $dep['dep_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col mb-1">
                                <label>Program</label>
                                <select id="sstrm" name="sstrm" class="form-select" required aria-label="stype">
                                    <option value></option>
                                    <option selected ="Degree">Degree</option>
                                    <option value="Masters">Masters</option>
                                    <option value="Phd" disabled>Phd</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">


                            <input id="stype" name="catid" class="form-control" type="hidden" value="Student">

                            <div class="col">
                                <label>Group</label>
                                <select id="typet" name="catid" class="form-select" required aria-label="type">
                                    <option value> </option>
                                    <option value="Regular">Regular</option>
                                    <option value="Extension">Extension</option>
                                    <option value="Summer">Summer</option>
                                </select>
                            </div>

                            <div class="col">
                                <label>Year</label>
                                <select id="syira" name="cyira" class="form-select" required aria-label="type">
                                    <option value> </option>
                                    <option value="1">1<sup>st</sup> Year</option>
                                    <option value="2">2<sup>nd</sup> Year</option>
                                    <option value="3">3<sup>rd</sup> Year</option>
                                    <option selected ="4">4<sup>th</sup> Year</option>
                                    <option value="5">5<sup>th</sup> Year</option>
                                    <option value="6">6<sup>th</sup> Year</option>

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col  mb-1">
                                <label class="form-check-label" for="">Phone Number( Optional)</label>
                                <input type="number" class="form-control" placeholder="Phone Number" id="sphoni" >
                            </div>
                            <div class="col  mb-1">
                                <label class="form-check-label" for="">Email ( Optional)</label>
                                <input type="email" class="form-control" placeholder="Email" id="semaili" >
                            </div>

                        </div>
                        <div class="  mb-1">
                            <label class="form-check-label" for="">Photo ( Optional)</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept=".jpg,.jpeg,.png,.gif,.webp"  >
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-target="#uploadmainu" data-bs-toggle="modal">Back to first</button>
                            <button type="button" onclick="window.location.reload()" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <input type="button" id="ostudent_add" name="sent" class="addstudent btn btn-primary" value="ADD">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </main>
  </div>
</div>
<!-- Tosts -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
      <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
          <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">

        </div>
      </div>
    </div>
<!-- Modal -->
<div class="modal fade"  id="editstudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div id="editustudent" class="modal-content">

            </div>
        </div>
    <!----->
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
var anchor = document.querySelector('.nav-link.stdudk');
if (anchor) {
  anchor.classList.add('active');
}

  </script>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        //reg_dashboard();

        function reg_dashboard() {
            $.ajax({
                url: "modal.php",
                method: "POST",
                data: {
                    page: 'regHome',
                    action: 'reg_dashboard'
                },
                success: function(data) {
                    $('#egdashboard').html(data);

                }
            })
        }



        $(document).on('click', '.uaddstudent', function() {
          event.preventDefault();

            
          var fname=  document.forms["uaddnewStudent"]["edepari"].value;

          if (fname == '') {
            $('#uaddStudentsuccess').html('<div class="alert alert-danger">Please select the department</div>');
                return;
              }
              var fileInput = $('#fileInput')[0];
              var file = fileInput.files[0];
              if (!file) {
                $('#uaddStudentsuccess').html('<div class="alert alert-danger">Please select the excel file</div>');
                return;
              }
              // Validate the file extension
              var allowedExtensions = ["xls", "xlsx"];
              var fileExtension = file.name.split('.').pop().toLowerCase();

              if (!allowedExtensions.includes(fileExtension) ) {
                $('#uaddStudentsuccess').html('<div class="alert alert-danger">The file format should be "xls" or "xlsx" format</div>');
                return;
              }
               

                var form = document.getElementById("uaddnewStudent");
                var formData = new FormData(form);
                formData.append('page', 'student');
                formData.append('action', 'uaddnewStudent');
                formData.append('file', $('#fileInput')[0].files[0]);

                var button = document.getElementById("uostudent_add");
                button.disabled = true;
                  
                var spinnerContainer = document.getElementById("uuaddStudentsuccess");
                var spinner = spinnerContainer.querySelector(".spinner");
                
                spinnerContainer.style.display = "block";
                spinner.style.display = "block";
                
                $('#uuaddStudentsuccess').show();

                        

                        $.ajax({
                          url: 'modal.php',
                          type: 'POST',
                          data: formData,
                          processData: false,
                          contentType: false,
                          success: function(data) {
                            spinnerContainer.style.display = "none";
                            spinner.style.display = "none";
                            $('#uaddStudentsuccess').html(data);
                              button.disabled = false;
                          },


                });
            });





        $(document).on('click', '.addstudent', function() {
          var pattern = /^[a-zA-Z]+$/;
          var ppattern = /^\d{10}$/;

          var creator = "<?php echo $_SESSION['ruid'];?>";

          var fname=  document.forms["addnewStudent"]["fname"].value;
          var mname=  document.forms["addnewStudent"]["mname"].value;
          var lname=  document.forms["addnewStudent"]["lname"].value;
          var phone=  document.forms["addnewStudent"]["sphoni"].value;
          if (!pattern.test(fname) || !pattern.test(mname) || !pattern.test(lname)) {
            $('#addStudentsuccess').html('<div class="alert alert-danger">Invalid input. Only text is allowed.</div>');
                return;
              }

            //   if (!ppattern.test(phone)) {
            // $('#addStudentsuccess').html('<div class="alert alert-danger">Invalid input. Phone number should be number with 10 digits </div>');
            //     return;
            //   }
                var formData = new FormData();
                formData.append('page', 'student');
                formData.append('action', 'addStudent');
                formData.append('creator', creator);
                formData.append('fname', document.forms["addnewStudent"]["fname"].value);
                formData.append('mname', document.forms["addnewStudent"]["mname"].value);
                formData.append('lname', document.forms["addnewStudent"]["lname"].value);
                formData.append('genderi', document.forms["addnewStudent"]["genderi"].value);
                formData.append('depari', document.forms["addnewStudent"]["depari"].value);
                formData.append('program', document.forms["addnewStudent"]["sstrm"].value);
                formData.append('typet', document.forms["addnewStudent"]["typet"].value);
                formData.append('stype', document.forms["addnewStudent"]["stype"].value);
                formData.append('syira', document.forms["addnewStudent"]["syira"].value);
                formData.append('sphoni', document.forms["addnewStudent"]["sphoni"].value);
                formData.append('semaili', document.forms["addnewStudent"]["semaili"].value);
                formData.append('photo', document.forms["addnewStudent"]["photo"].files[0]);

                var button = document.getElementById("ostudent_add");
                button.disabled = true;

                $.ajax({
                    url: "modal.php",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#addStudentsuccess').html(data);
                        button.disabled = false;
                    }
                });
            });

            $(document).on('click', '.editstudent', function() {
              var pattern = /^[a-zA-Z]+$/;
          var ppattern = /^\d{10}$/;
          var fname=  document.forms["editStudent"]["fname"].value;
          var mname=  document.forms["editStudent"]["mname"].value;
          var lname=  document.forms["editStudent"]["lname"].value;
          var phone=  document.forms["editStudent"]["sphoni"].value;
          if (!pattern.test(fname) || !pattern.test(mname) || !pattern.test(lname)) {
            $('#editStudentsuccess').html('<div class="alert alert-danger">Invalid input. Only text is allowed.</div>');
                return;
              }

            //   if (!ppattern.test(phone)) {
            // $('#editStudentsuccess').html('<div class="alert alert-danger">Invalid input. Phone number should be number with 10 digits </div>');
            //     return;
            //   }
                var formData = new FormData();
                formData.append('page', 'student');
                formData.append('action', 'final_stud_upd');
                formData.append('uid', document.forms["editStudent"]["uid"].value);
                formData.append('fname', document.forms["editStudent"]["fname"].value);
                formData.append('mname', document.forms["editStudent"]["mname"].value);
                formData.append('lname', document.forms["editStudent"]["lname"].value);
                formData.append('genderi', document.forms["editStudent"]["genderi"].value);
                formData.append('depari', document.forms["editStudent"]["depari"].value);
                formData.append('program', document.forms["editStudent"]["sstrm"].value);
                formData.append('typet', document.forms["editStudent"]["typet"].value);
                formData.append('stype', document.forms["editStudent"]["stype"].value);
                formData.append('syira', document.forms["editStudent"]["syira"].value);
                formData.append('sphoni', document.forms["editStudent"]["sphoni"].value);
                formData.append('semaili', document.forms["editStudent"]["semaili"].value);
                formData.append('photop', document.forms["editStudent"]["photop"].value);
                formData.append('photo', document.forms["editStudent"]["photo"].files[0]);

                $.ajax({
                    url: "modal.php",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#editStudentsuccess').html(data);
                    }
                });
            });


            $(document).on('click', '#update_student', function() {
            var cudo = $(this).val();
            $.ajax({
            url: "modal.php",
            method: "POST",
            data: {
                cudo: cudo,
                page: 'student',
                action: 'update_student'
            },
            success: function(data) {
                $('#editustudent').html(data);
            }
            })
        });

        $(document).on('click', '#use_detail', function() {
        var cudo = $(this).val();
        $.ajax({
          url: "modal.php",
          method: "POST",
          data: {
            cudo: cudo,
            page: 'student',
            action: 'sdetail'
          },
          success: function(data) {
            $('#editustudent').html(data);
          }
        })
      });


      $(document).on('click', '#send_again', function() {
        var uid = $(this).val();
        var button = document.getElementById("send_again");
        button.disabled = true;

          $.ajax({
            url: "modal.php",
            method: "POST",
            data: {
              page: 'student',
              action: 'send_again',
              uid: uid
            },
            success: function(data) {
              $('.toast-body').html(data);
              $('.toast').addClass('toast-success').toast('show');
              button.disabled = false;
            }
          })



      });

      $(document).on('click', '#activ', function() {
            var uid =  $(this).attr('value');
          $.ajax({
            url: "modal.php",
            method: "POST",
            data: {
              uid: uid,
              page: 'student',
              action: 'activ'
            },
            success: function(data) {
              $('#activ').html(data);
            }
          })
          });

          

          $(document).on('click', '#ban', function() {
            var uid =  $(this).attr('value');
          $.ajax({
            url: "modal.php",
            method: "POST",
            data: {
              uid:uid,
              page: 'student',
              action: 'ban'
            },
            success: function(data) {
              $('#ban').html(data);
            }
          })
          });



      $(document).on('click', '#user_delete', function() {
        var conf = confirm('Are you sure you want to delete this student? ');
        var uid = $(this).val();
        if (conf == true) {

          $.ajax({
            url: "modal.php",
            method: "POST",
            data: {
              page: 'student',
              action: 'deletehead',
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



    });
</script>