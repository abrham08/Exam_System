<?php
include "hr_header.php";

$dfetch = $pdo->prepare('SELECT * FROM category WHERE cat_type=:catimp AND stat=:stat ORDER BY cat_name ASC');
$dfetch->bindValue(':catimp', 'HR');
$dfetch->bindValue(':stat', '1');
$dfetch->execute();
$depart = $dfetch->fetchAll(PDO::FETCH_ASSOC);

$sfetdch = $pdo->prepare('SELECT * FROM examinee WHERE examinee_type=:catimp  ORDER BY fname ASC');
$sfetdch->bindValue(':catimp', 'Applicant');
$sfetdch->execute();
$stulist = $sfetdch->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
        <h5 class="h5">Candidates</h5>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#studentModal"> Add Candidate</button>
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
                        <th id="tempo" class="table-info">Full Name</th>
                        <th class="table-info">Gender</th>
                        <th class="table-info">Job Title</th>
                        
                        <th class="table-info">Email</th>
                        <th class="table-info">Status</th>
                        <th  class="table-info">Action</th>

                    </tr>

                    <?php foreach ($stulist as $stu) :

                        $dsfetdch = $pdo->prepare('SELECT cat_name 
                        FROM category  WHERE cat_id=:depid');
                        $dsfetdch->bindValue(':depid', $stu['job_cat']);
                        $dsfetdch->execute();
                        $dstulist = $dsfetdch->fetch(PDO::FETCH_ASSOC);
                       
                            $ll = $dstulist['cat_name'] ?? null;
                        
                    ?>


                        <tr class=""  data-id="<?php echo $stu['uiid'] ?>">



                            <td class="col-4"><?php echo $stu['fname'] . ' ' . $stu['lname'] . ' ' . $stu['gname']  ?></td>
                            <td><?php echo $stu['gender'] ?></td>
                            <td class="col-3"><?php echo $ll;   ?></td>
                            <td class="col-3">
                            <?php if( $stu['email_stat'] == 1):?>
                              <span title="Email has been sent" class="d-inline-block bg-success rounded-circle p-1"></span>
                            <?php endif;?>

                            <?php if( $stu['email_stat'] == 0):?>
                              <span title="The email is not sent" class="d-inline-block bg-danger rounded-circle p-1"></span>  
                            <?php endif;?>
                            <?php echo $stu['email'] ?>
                          
                          </td>
                <?php if ($stu['vstatus'] == 0) :  ?>
                <td>


                  <div class="dropdown">
                    <button class="btn btn-warning text-dark btn-sm dropdown-toggle" type="button" id="<?php echo $stu['uiid']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                         Pending...
                    </button>
                    <ul class="dropdown-menu" style="width: 100px;" aria-labelledby="<?php echo $stu['uiid'];?>">
                    <li>
                        <button class="dropdown-item bg-success mb-1 text-white btn btn-sm btn-success" id="activ" value="<?php echo $stu['uiid'];?>"> Accept</button>
                      </li>
                      <li>
                        <button class="dropdown-item bg-danger text-white btn btn-sm btn-danger" id="ban" value="<?php echo $stu['uiid'];?>"> Reject</button>
                      </li>
                    </ul>
                  </div>
                </td>
                <?php elseif ($stu['vstatus'] == 1) :  ?>
                <td>


                  <div class="dropdown">
                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="<?php echo $stu['uiid']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                         Accepted
                    </button>
                    <ul class="dropdown-menu" style="width: 70px;" aria-labelledby="<?php echo $stu['uiid'];?>">
                    
                      <li>
                        <button class="dropdown-item bg-danger text-white btn btn-sm btn-danger" id="ban" value="<?php echo $stu['uiid'];?>"> Reject</button>
                      </li>
                    </ul>
                  </div>
                </td>
              <?php else : ?>
                <td>
                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="<?php echo $stu['uiid']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                         Rejected
                    </button>
                    <ul class="dropdown-menu" style="width: 70px;" aria-labelledby="<?php echo $stu['uiid']; ?>">
                      <li>
                        <button class="dropdown-item bg-success text-white btn btn-sm btn-success" id="activ" value="<?php echo $stu['uiid'];?>"> Accept</button>
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

                    <?php endforeach; ?>
                </tbody>
            </table>


        </div>
    </div>


    
    <!----modal-->
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade"  id="studentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Candidate</h5>
                    <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-group was-validated" id="addnewStudent" method="POST" enctype="multipart/form-data" action="#">
                        <div class="mb-1" id="addStudentsuccess"></div>
                        <div class="row">
                            <div class="col  mb-1">
                                <label class="form-check-label" for="">First Name</label>
                                <input type="text" class="form-control" placeholder="First Name" id="fname" name="fname" required>
                            </div>
                            <div class="col  mb-1">
                                <label class="form-check-label" for="">Middle Name</label>
                                <input type="text" class="form-control" placeholder="Middle Name" id="mname" name="mname" required>
                            </div>
                            <div class="col  mb-1">
                                <label class="form-check-label" for="">Last Name</label>
                                <input type="text" class="form-control" placeholder="Last Name" id="lname" name="lname" required>
                            </div>



                        </div>

                        <div class="row">
                            <div class="col mb-1">
                                <label>Gender</label>
                                <select id="genderi" name="genderi" class="form-select" required aria-label="type">
                                    <option value> </option>

                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>

                                </select>
                            </div>
                            <div class="col mb-1">
                                <label>Job Category</label>
                                <select id="depari" name="depari" class="form-select" required aria-label="type">
                                    <option selected disabled></option>
                                    <?php foreach ($depart as $dep) :  ?>
                                        <option value="<?php echo $dep['cat_id'] ?>"><?php echo $dep['cat_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col mb-1">
                            <label>Nationality</label>
                                <select id="nationality" name="nationality" class="form-select" required aria-label="type">
                                    <option value="Ethopian" selected>Ethopian</option>
                                    <option value="Sudaneez">Sudaneez</option>
                                    <option value="French">French</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Indiaan">India</option>

                                </select>
                                
                            </div>
                        </div>
                        <div class="row">


                            <input id="stype" name="stype" class="form-control" type="hidden" value="Student">

                            <div class="col">
                                <label>Field Of Study</label>
                                <input type="text" class="form-control" placeholder="Field of Study" name="fstudy" id="fstudy" required>                              
                            </div>

                            <div class="col">
                            <label>Educational Background</label>
                                <select id="ebackground" name="ebackground" class="form-select" required aria-label="stype">
                                    <option value></option>
                                    <option value="Grade 12 completed">Grade 12 completed</option>
                                    <option value="Level-I completed">Level-I completed</option>
                                    <option value="Level-II completed">Level-II completed</option>
                                    <option value="Level-III completed">Level-III completed</option>
                                    <option value="Level-IV completed">Level-IV completed</option>
                                    <option value="Level-V completed">Level-V completed</option>
                                    <option value="BA/BSc/First degree graduate">BA/BSc/First degree graduate</option>
                                    <option value="Masters/Second degree graduate">Masters/Second degree graduate</option>
                                    <option value="Masters/Second degree graduate">PHD/Third degree graduate</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col  mb-1">
                                <label class="form-check-label" for="">Phone Number</label>
                                <input type="number" class="form-control" placeholder="Phone Number" name="sphoni" id="sphoni" required>
                            </div>
                            <div class="col  mb-1">
                                <label class="form-check-label" for="">Alternative Phone Number(Optional)</label>
                                <input type="number" class="form-control" placeholder="Alternative Phone Number" name="ophoni" id="ophoni" required>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col  mb-1">
                                <label class="form-check-label" for="">Physical Location(City)</label>
                                <input type="text" class="form-control" placeholder="Physical Location" name="plocation" id="plocation" required>
                            </div>
                            <div class="col  mb-1">
                                <label class="form-check-label" for="">Email</label>
                                <input type="email" class="form-control" placeholder="Personal Email" name="semaili" id="semaili" required>
                            </div>

                        </div>

                        <div class="  mb-1">
                            <label class="form-check-label" for="">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept=".jpg,.jpeg,.png,.gif,.webp"  required>
                        </div>
                        <div class="  mb-1">
                            <label class="form-check-label" for="">Renewed Kebele Id/Passport</label>
                            <input type="file" class="form-control" id="kebeleid" name="kebeleid" accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.PDF,.doc,.docx"  required>
                        </div>
                        <div class="  mb-1">
                            <label class="form-check-label" for="">Educational certificates and Birth certificate</label>
                            <input type="file" class="form-control" id="dodoc" name="dodoc" accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.PDF,.doc,.docx"  required>
                        </div>

                        <div class="modal-footer">
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
var anchor = document.querySelector('.nav-link.tichurs');
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
                url: "hrmodal.php",
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

        $(document).on('click', '.addstudent', function() {
          var pattern = /^[a-zA-Z]+$/;
          var ppattern = /^\d{10}$/;

          var fname=  document.forms["addnewStudent"]["fname"].value;
          var mname=  document.forms["addnewStudent"]["mname"].value;
          var lname=  document.forms["addnewStudent"]["lname"].value;
          var phone=  document.forms["addnewStudent"]["sphoni"].value;
          if (!pattern.test(fname) || !pattern.test(mname) || !pattern.test(lname)) {
            $('#addStudentsuccess').html('<div class="alert alert-danger">Invalid input. Only text is allowed.</div>');
                return;
              }

              if (!ppattern.test(phone)) {
            $('#addStudentsuccess').html('<div class="alert alert-danger">Invalid input. Phone number should be number with 10 digits </div>');
                return;
              }
              var form = document.getElementById("addnewStudent");
              var formData = new FormData(form);
                formData.append('page', 'student');
                formData.append('action', 'addStudent');

                var button = document.getElementById("ostudent_add");
                button.disabled = true;

                event.preventDefault();

                $.ajax({
                    url: "hrmodal.php",
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

              if (!ppattern.test(phone)) {
            $('#editStudentsuccess').html('<div class="alert alert-danger">Invalid input. Phone number should be number with 10 digits </div>');
                return;
              }

              var form = document.getElementById("editStudent");
              var formData = new FormData(form);

                formData.append('page', 'student');
                formData.append('action', 'final_stud_upd');
                
                $.ajax({
                    url: "hrmodal.php",
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
            url: "hrmodal.php",
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
          url: "hrmodal.php",
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
       

          $.ajax({
            url: "hrmodal.php",
            method: "POST",
            data: {
              page: 'student',
              action: 'send_again',
              uid: uid
            },
            success: function(data) {
              $('.toast-body').html(data);
              $('.toast').addClass('toast-success').toast('show');
            }
          })



      });

      $(document).on('click', '#activ', function() {
            var uid =  $(this).attr('value');
          $.ajax({
            url: "hrmodal.php",
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
            url: "hrmodal.php",
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
            url: "hrmodal.php",
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