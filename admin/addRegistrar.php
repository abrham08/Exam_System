<?php
//session_start();
include "mainHeader.php";
$uid = 'dku467';

$fetch = $pdo->prepare('SELECT * FROM account WHERE  user_type=:teach ');
$fetch->bindValue(':teach', 'Registrar');
$fetch->execute();
$cat = $fetch->fetchAll(PDO::FETCH_ASSOC);


?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Registrar</title>
</head>

<body>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
    <h5 class="h5">Registrar</h5>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#invmodal"> Add Registrar </button>
      </div>

    </div>
  </div>

  <div class="table table-bordered table-striped">

    <div class="container">
      <table class="table table-striped table-hover container table-hover">
        <tr class="table-info">
          <th class="table-info">Full Name</th>
          <th class="table-info">Phone</th>
          <th class="table-info">Email </th>
          <th class="table-info">Status </th>
          <th class="table-info" style="width: auto;"> Action </th>
        </tr>
        <tbody>
          <?php foreach ($cat as $ca) :
          ?>
            <tr class="">
              <td><?php echo $ca['title'] . ' ' . $ca['fname'] . ' ' . $ca['lname'] . ' ' . $ca['gname'] ?></td>
              <td><?php echo $ca['phone'] ?></td>

              <td>
                <?php if( $ca['email_stat'] == 1):?>
                  <span title="Email has been sent" class="d-inline-block bg-success rounded-circle p-1"></span>
                <?php endif;?>

                <?php if( $ca['email_stat'] == 0):?>
                  <span title="The email is not sent" class="d-inline-block bg-danger rounded-circle p-1"></span>  
                <?php endif;?>
                <?php echo $ca['email'] ?>
              </td>
              <?php if ($ca['status'] == 1) :  ?>
                <td>


                  <div class="dropdown">
                    <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="<?php echo $ca['user_id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                         Active
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="<?php echo $ca['user_id'];?>">
                      <li>
                        <button class="dropdown-item bg-danger text-white btn btn-sm btn-danger" id="ban" value="<?php echo $ca['user_id'];?>"> Ban</button>
                      </li>
                    </ul>
                  </div>
                </td>
              <?php else : ?>
                <td>
                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="<?php echo $ca['user_id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                         Baned
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="<?php echo $ca['user_id']; ?>">
                      <li>
                        <button class="dropdown-item bg-success text-white btn btn-sm btn-success" id="activ" value="<?php echo $ca['user_id'];?>"> Activate</button>
                      </li>
                    </ul>
                  </div>
                </td>
              <?php endif; ?>

              <td>
                <button type="button" title="Edit" class="rugant fa  fa-edit border-0" value="<?php echo $ca['user_id']; ?>" style="color:skyblue;margin-right:3%;" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></button>
                
              <button type="submit" title="Delete" id="user_delete" name="qdelete" value="<?php echo $ca['user_id'] ?>" class='border-0 fa fa-trash' style='color:red'></button>
 
                <button type="button" title="Resend Confirmation" id="send_again" class="border-0 rugant fa  fa-envelope" value="<?php echo $ca['user_id']; ?>" style="color:blue;margin-right:3%;"></button>
              </td>
            </tr>
          <?php endforeach;
          ?>
        </tbody>
      </table>
    </div>
  </div>
  </div>
  <div class="modal fade" id="invmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content modal-lg">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Registrar</h5>
          <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>
        <div class="modal-body">
          <div class="form signup">
            <form class="was-validated" method="POST" id="addins" action="#"  enctype="multipart/form-data">
              <div class="mb-1" id="addInsSuccess"></div>
              <div class=" row ">
                <div class="col mb-1">
                  <label>Title</label>
                  <select id="title" name="title" class="form-select" required aria-label="stype">
                    <option value></option>
                    <option value="Mr.">Mr.</option>
                    <option value="Ms.">Ms.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Dr.">Dr.</option>
                    <option value="Professor">Professor</option>
                  </select>

                </div>
                <div class="col mb-1">
                  <label>First Name</label>
                  <input type="text" id="fname" class="form-control" name="fname" required placeholder="First Name ">

                </div>
                <div class=" col mb-1">
                  <label>Middle Name</label>
                  <input type="text" id="mname" class="form-control" name="mname" required placeholder="Middle Name ">

                </div>
                <div class=" col mb-1">
                  <label>Last Name</label>
                  <input type="text" id="lname" class="form-control" name="lname" required placeholder="Last Name ">
                </div>
              </div>
              <div class="row">
                <div class="col mb-1">
                  <label>Phone Number</label>
                  <input type="number" class="form-control" maximum="10" id="phone" name="phone" required placeholder="Enter your phone number ">
                </div>
                <div class="col mb-1">
                  <label>Email</label>
                  <input type="Email" class="form-control" maximum="10" id="email" name="email" required placeholder="Enter your phone number ">
                </div>
              </div>
              <div class=" mb-1">
                <label>Photo</label>
                <input type="File" class="form-control" id="photo" accept=".jpg,.jpeg,.png,.gif,.webp" name="photo" required placeholder="Enter your email account ">
              </div>
              <div class="modal-footer">
                <button type="button" onclick="window.location.reload()" class="caca btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button class="addinstructor btn btn-primary" id="addinstructor" type="button" name="enter"> ADD</button>
              </div>
            </form>
          </div>
        </div>
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
  <!-- Edit Modal -->
  <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content modal-lg" id="ruyan">

      </div>
    </div>
  </div>
              </main>
              </div>
              <script>
    // Set the timer to 3 minutes
    var timer = setTimeout(function() {
      // Redirect to the logout page
      window.location.href = 'session.php';
    }, 5 * 60 * 1000);

    // Reset the timer on any activity
    document.addEventListener('mousemove', function() {
      clearTimeout(timer);
      timer = setTimeout(function() {
        window.location.href = 'session.php';
      }, 5 * 60 * 1000);
    });
    window.onunload = function() {
      window.location.href = 'session.php';
    };
  </script>
  <script src="js/main.js"></script>
  <script>
    $(document).ready(function() {

      $(document).on('click', '.rugant', function() {
        var uid =  $(this).attr('value');
        $.ajax({
          url: "mainmodal.php",
          method: "POST",
          data: {
            uid:uid,
            page: 'addRegistrar',
            action: 'editHead'
          },
          success: function(data) {
            $('#ruyan').html(data);
          }
        })
      });

      $(document).on('click', '#activ', function() {
            var uid =  $(this).attr('value');
          $.ajax({
            url: "mainmodal.php",
            method: "POST",
            data: {
              uid: uid,
              page: 'addRegistrar',
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
            url: "mainmodal.php",
            method: "POST",
            data: {
              uid:uid,
              page: 'addRegistrar',
              action: 'ban'
            },
            success: function(data) {
              $('#ban').html(data);
            }
          })
          });

      $(document).on('click', '#addinstructor', function() {
        var pattern = /^[a-zA-Z]+$/;
          var ppattern = /^\d{10}$/;

          var fname=  document.forms["addins"]["fname"].value;
          var mname=  document.forms["addins"]["mname"].value;
          var lname=  document.forms["addins"]["lname"].value;
          var phone=  document.forms["addins"]["phone"].value;
          if (!pattern.test(fname) || !pattern.test(mname) || !pattern.test(lname)) {
            $('#addInsSuccess').html('<div class="alert alert-danger">Invalid input. Only text is allowed.</div>');
                return;
              }

              if (!ppattern.test(phone)) {
            $('#addInsSuccess').html('<div class="alert alert-danger">Invalid input. Phone number should be number with 10 digits </div>');
                return;
              }


        var formData = new FormData();
    formData.append('page', 'addRegistrar');
    formData.append('action', 'addinss');
    formData.append('title', document.forms["addins"]["title"].value);
    formData.append('fname', document.forms["addins"]["fname"].value);
    formData.append('mname', document.forms["addins"]["mname"].value);
    formData.append('lname', document.forms["addins"]["lname"].value);
    formData.append('phone', document.forms["addins"]["phone"].value);
    formData.append('email', document.forms["addins"]["email"].value);
    formData.append('photo', document.forms["addins"]["photo"].files[0]);

        $.ajax({
          url: "mainmodal.php",
          method: "POST",
            data: formData,
            contentType: false,
            processData: false,
          success: function(data) {
            $('#addInsSuccess').html(data);
          }
        })
      });


      $(document).on('click', '#updateinstructor', function() {
        var pattern = /^[a-zA-Z]+$/;
          var ppattern = /^\d{10}$/;

          var fname=  document.forms["updins"]["fname"].value;
          var mname=  document.forms["updins"]["mname"].value;
          var lname=  document.forms["updins"]["lname"].value;
          var phone=  document.forms["updins"]["phone"].value;
          if (!pattern.test(fname) || !pattern.test(mname) || !pattern.test(lname)) {
            $('#updInsSuccess').html('<div class="alert alert-danger">Invalid input. Only text is allowed.</div>');
                return;
              }

              if (!ppattern.test(phone)) {
            $('#updInsSuccess').html('<div class="alert alert-danger">Invalid input. Phone number should be number with 10 digits </div>');
                return;
              }

var formData = new FormData();
formData.append('page', 'addRegistrar');
formData.append('action', 'updinss');
formData.append('title', document.forms["updins"]["title"].value);
formData.append('fname', document.forms["updins"]["fname"].value);
formData.append('mname', document.forms["updins"]["mname"].value);
formData.append('uid', document.forms["updins"]["uid"].value);
formData.append('lname', document.forms["updins"]["lname"].value);
formData.append('phone', document.forms["updins"]["phone"].value);
formData.append('email', document.forms["updins"]["email"].value);
formData.append('photop', document.forms["updins"]["photop"].value);
formData.append('photo', document.forms["updins"]["photo"].files[0]);

$.ajax({
  url: "mainmodal.php",
  method: "POST",
    data: formData,
    contentType: false,
    processData: false,
  success: function(data) {
    $('#updInsSuccess').html(data);
  }
})
});




$(document).on('click', '#user_delete', function() {
        var conf = confirm('Are you sure you want to delete this category? ');
        var uid = $(this).val();
        if (conf == true) {

          $.ajax({
            url: "mainmodal.php",
            method: "POST",
            data: {
              page: 'addRegistrar',
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



      $(document).on('click', '#send_again', function() {
        var uid = $(this).val();
       

          $.ajax({
            url: "mainmodal.php",
            method: "POST",
            data: {
              page: 'addRegistrar',
              action: 'send_again',
              uid: uid
            },
            success: function(data) {
              $('.toast-body').html(data);
              $('.toast').addClass('toast-success').toast('show');
            }
          })



      });








    });
  </script>
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
var anchor = document.querySelector('a.nav-link.addRegistrar');
if (anchor) {
  anchor.classList.add('active');
}

  </script>
</body>

</html>



<?php
// }else{
//      header("Location: index.php");
//      exit();
// }
?>
