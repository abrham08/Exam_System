<?php
include "dbc.php";

$dfetch = $pdo->prepare('SELECT * FROM category WHERE cat_type=:catimp AND stat=:stat ORDER BY cat_name ASC');
$dfetch->bindValue(':catimp', 'HR');
$dfetch->bindValue(':stat', '1');
$dfetch->execute();
$depart = $dfetch->fetchAll(PDO::FETCH_ASSOC);

?>
<head>
<link rel="stylesheet" href="css/registration.css?v=<?php echo time(); ?>">
<link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <link href="admin/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="admin/css/fontawesome.min.css" rel="stylesheet" type="text/css">
</head>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 col-sm-10 col-md-10 col-lg-6 col-xl-5 text-center p-2 mt-3 mb-2" style="width:800px;">
            <div class="card px-0 pt-2 pb-0 mt-0 mb-3 shadow-lg p-3 mb-5 bg-body rounded" >
                <h2 id="heading">Register</h2>
                <form id="msform" class="form-group was-validated p-3">
                <div class="mb-1" id="addStudentsuccess"></div>
 
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Personal Info</strong></li>
                        <li id="personal"><strong>Contact Info</strong></li>
                        <li id="edu"><strong>Educational Background</strong></li>
                        <li id="payment"><strong>Document</strong></li>
                        <li id="agree"><strong>Agreement</strong></li>
                        <li id="confirm"><strong>Finish</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> <br> <!-- fieldsets -->

                    <!-- Personal Information -->
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Personal Information:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 1 - 6</h2>
                                </div>
                            </div> 
                            
                            <div class="row">
                            <div class="col mb-1">

                             <label class="fieldlabels">First Name: *</label>
                             <input  pattern="[A-Za-z]{1,40}" title="Please enter only letters (maximum 40 characters)"  type="text" class="form-control" placeholder="First Name" id="fname" name="fname" required>
                            </div>
                             <div class="col mb-1">

                              <label class="fieldlabels">Middle Name: *</label> 
                              <input  pattern="[A-Za-z]{1,40}" title="Please enter only letters (maximum 40 characters)" type="text" class="form-control" placeholder="Middle Name" id="mname" name="mname" required>
                             </div>
                              <div class="col mb-1">

                               <label class="fieldlabels">Last Name: *</label> 
                               <input  pattern="[A-Za-z]{1,40}" title="Please enter only letters (maximum 40 characters)" type="text" class="form-control" placeholder="Last Name" id="lname" name="lname" required>
                              </div>
                            </div>
                               <div class="row">
                            <div class="col mb-1">
                                <label class="fieldlabels">Gender</label>
                                <select id="genderi" name="genderi" class="form-select" required aria-label="type">
                                    <option selected disabled> </option>

                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>

                                </select>
                            </div>
                            <div class="col mb-1">
                            <label class="fieldlabels">Nationality</label>
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
                            <div class="col mb-1">
                                <label class="fieldlabels">Age</label>
                                <input  pattern="[8-9]|[1-9][0-9]|1[0-4][0-9]|150" title="Please enter a number between 8 and 150" type="number" min="5" class="form-control" placeholder="Age" id="age" name="age" required>
 
                            </div>
                            <div class="col mb-1">
                            <label class="fieldlabels">Birth Date</label>
                            <input type="date"  class="form-control" placeholder="First Name" id="bdate" name="bdate" required>                 
                            </div>
                        </div>
                            
                            
                        </div>

                        <input id="first_btn" type="button" class=" action-button" value="Next" />
                        <input type="hidden" id="auto_add_add" name="next" class="next action-button" value="Next" />

                    </fieldset>
                    <!-- Address -->

                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Contact Information:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 2 - 6</h2>
                                </div>
                            </div> 
                            
                            <div class="row">
                            <div class="col  mb-1">
                                <label class="fieldlabels form-check-label" for="">Phone Number</label>
                                <input type="number" pattern="^\d{10}$" class="form-control" placeholder="Phone Number" name="sphoni" id="sphoni" required>
                            </div>
                            <div class="col  mb-1">
                                <label class="fieldlabels form-check-label" for="">Alternative Phone Number(Optional)</label>
                                <input pattern="^\d{10}$"type="number" class="form-control" placeholder="Alternative Phone Number" name="ophoni" id="ophoni" >
                            </div>

                        </div>

                        <div class="row">
                            <div class="col  mb-1">
                                <label class="fieldlabels form-check-label" for="">Physical Location(City)</label>
                                <input type="text" class="form-control" placeholder="Physical Location" name="plocation" id="plocation" required>
                            </div>
                            <div class="col  mb-1">
                                <label class="fieldlabels form-check-label" for="">Email</label>
                                <input  type="email" class="form-control" placeholder="Personal Email" name="semaili" id="semaili" required>
                            </div>

                        </div>
                        </div>
                         <input id="second_btn" type="button" class="next action-button" value="Next" />
                         <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                         <input type="hidden" id="auto_add_add" name="next" class="next action-button" value="Next" />

                        </fieldset>
                    <!-- EducationalHNy0a12aCsTllGBaackground -->
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Educational Background:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 3 - 6</h2>
                                </div>
                            </div> 
                            
                          <label class="fieldlabels">Job Category</label>
                                <select id="depari" name="depari" class="form-select" required aria-label="type">
                                    <option selected disabled></option>
                                    <?php foreach ($depart as $dep) :  ?>
                                        <option value="<?php echo $dep['cat_id'] ?>"><?php echo $dep['cat_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="row">


                                <input id="stype" name="stype" class="form-control" type="hidden" value="Student">

                                <div class="col">
                                    <label class="fieldlabels">Field Of Study</label>
                                    <input  pattern="[A-Za-z ]{1,80}" type="text" class="form-control" placeholder="Field of Study" name="fstudy" id="fstudy" required>                              
                                </div>

                                <div class="col">
                                <label class="fieldlabels">Educational Background</label>
                                    <select id="ebackground" name="ebackground" class="form-select" required aria-label="stype">
                                        <option selected disabled></option>
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
                            
                        </div> <input id="third_btn" type="button" name="next" class="next action-button" value="Next" />
                         <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <!-- Document -->

                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Document Upload:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 4 - 6</h2>
                                </div>
                            </div>

                            <div class="  mb-1">
                            <label class="fieldlabels form-check-label" for="">Photo</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept=".jpg,.jpeg,.png,.gif,.webp"  required>
                        </div>
                        <div class="  mb-1">
                            <label class="fieldlabels form-check-label" for="">Renewed Kebele Id/Passport</label>
                            <input type="file" class="form-control" id="kebeleid" name="kebeleid" accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.PDF,.doc,.docx"  required>
                        </div>
                        <div class="  mb-1">
                            <label class="fieldlabels form-check-label" for="">Educational certificates / Birth certificate</label>
                            <input type="file" class="form-control" id="dodoc" name="dodoc" accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.PDF,.doc,.docx"  required>
                        </div>


                              </div> <input id="fourth_btn" type="button" name="next" class="next action-button" value="Next" />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <!-- Agreement -->

                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">General Conditions:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 5 - 6</h2>
                                </div>
                            </div> 
                            <div class="card p-2 shadow-lg p-3 mb-3 bg-body rounded">
                                <p>
                                I certify that the statements made by me in answer of the foregoing questions are true,
                                 complete and correct to the best of my knowledge and belief.
                                  I understand that any misrepresentation or material omission made on this form or other document
                                   requested by DKU liable to termination or dismissal 
                                </p>
                            </div>

                  </div> <input type="button" id="ostudent_add" name="next" class="addstudent  action-button" value="Agree & Register" /> 
                   <input type="hidden" id="auto_add_add" name="next" class="next action-button" value="Next" />
                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <!-- Finish -->
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Finish:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 6 - 6</h2>
                                </div>
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                            <div class="row justify-content-center">
                                <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                            </div> <br><br>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <h5 class="purple-text text-center">You Have Successfully Registered!</h5>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="js/registration.js"></script>
<script type="text/javascript">
    $(document).ready(function() {



        $(document).on('click', '#first_btn', function() {
          var pattern = /^[a-zA-Z]+$/;
          var ppattern = /^[0-9]+$/;


          var fname=  document.forms["msform"]["fname"].value;
          var mname=  document.forms["msform"]["mname"].value;
          var lname=  document.forms["msform"]["lname"].value;
          var phone=  document.forms["msform"]["age"].value;
          var genderi=  document.forms["msform"]["genderi"].value;
          var bdate=  document.forms["msform"]["bdate"].value;

          if (!pattern.test(fname) || !pattern.test(mname) || !pattern.test(lname)) {
            $('#addStudentsuccess').html('<div class="alert alert-danger ">Invalid input. Only text is allowed.</div>');

                var div = $('#addStudentsuccess .alert');
                div.addClass('shake');

                setTimeout(function() {
                div.hide();
                }, 2000);
                return;
              }

              else if(!ppattern.test(phone)) {
                
            $('#addStudentsuccess').html('<div class="alert alert-danger ">Please fill up the age correctlly!</div>');

                var div = $('#addStudentsuccess .alert');
                div.addClass('shake');

                setTimeout(function() {
                div.hide();
                }, 2000);



                return;
              }
              else if(genderi == ' ' || bdate == '' ) {
            $('#addStudentsuccess').html('<div class="alert alert-danger ">Please fill up the age or gender correctlly!</div>');

                var div = $('#addStudentsuccess .alert');
                div.addClass('shake');

                setTimeout(function() {
                div.hide();
                }, 2000);
                return;
              }
              else{
                var button = document.getElementById("auto_add_add");
                button.click();

              }
            });

    $(document).on('click', '#second_btn', function() {
                var pattern = /^0\d{0,9}$/;
                var ppattern =  /^[\w.-]+@[\w-]+\.[\w.-]+$/;
                var opattern= /^(0\d{0,9})?$|^$/;




          var sphoni=  document.forms["msform"]["sphoni"].value;
          var semaili=  document.forms["msform"]["semaili"].value;
          var ophoni=  document.forms["msform"]["ophoni"].value;


          if (!pattern.test(sphoni)) {
            $('#addStudentsuccess').html('<div class="alert alert-danger ">Maximum 10 numbers, starting with 0 should make up the phone number!</div>');

                var div = $('#addStudentsuccess .alert');
                div.addClass('shake');

                setTimeout(function() {
                div.hide();
                }, 2000);
                return;
              }

              else if(!ppattern.test(semaili)) {
                
            $('#addStudentsuccess').html('<div class="alert alert-danger ">Please fill up the email correctlly!</div>');

                var div = $('#addStudentsuccess .alert');
                div.addClass('shake');

                setTimeout(function() {
                div.hide();
                }, 2000);

                return;
              }
              else if(!opattern.test(ophoni)) {
            $('#addStudentsuccess').html('<div class="alert alert-danger ">Maximum 10 numbers, starting with 0 should make up the phone number!</div>');

                var div = $('#addStudentsuccess .alert');
                div.addClass('shake');

                setTimeout(function() {
                div.hide();
                }, 2000);
                return;
              }
              else{
                var button = document.getElementById("auto_add_add");
                button.click();

              }
            });


        $(document).on('click', '.addstudent', function() {
          var pattern = /^[a-zA-Z]+$/;
          var ppattern = /^\d{10}$/;

          var fname=  document.forms["msform"]["fname"].value;
          var mname=  document.forms["msform"]["mname"].value;
          var lname=  document.forms["msform"]["lname"].value;
          var phone=  document.forms["msform"]["sphoni"].value;
          if (!pattern.test(fname) || !pattern.test(mname) || !pattern.test(lname)) {
            $('#addStudentsuccess').html('<div class="alert alert-danger">Invalid input. Only text is allowed.</div>');
                return;
              }

              if (!ppattern.test(phone)) {
            $('#addStudentsuccess').html('<div class="alert alert-danger">Invalid input. Phone number should be number with 10 digits </div>');
                return;
              }
              var form = document.getElementById("msform");
              var formData = new FormData(form);
                formData.append('page', 'student');
                formData.append('action', 'addStudent');

                var button = document.getElementById("ostudent_add");
                button.disabled = true;

                event.preventDefault();
                var button = document.getElementById("ostudent_add");
                button.disabled = true;

                $.ajax({
                    url: "register.php",
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

            

        });
</script>