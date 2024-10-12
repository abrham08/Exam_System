<?php

include "mainHeader.php";
$fetch = $pdo->prepare('SELECT * FROM notice WHERE   type=:type AND cat=:cat  ORDER BY date DESC ');
$fetch->bindValue(':type', '1');
$fetch->bindValue(':cat', '1');
$fetch->execute();
$photo = $fetch->fetchAll(PDO::FETCH_ASSOC);




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $uid = random();
  $date = date('d-m-y H:i:s');
  // $photo= '';
  $video = '';
  $doc = '';
  $stat = 0;

  if (isset($_POST['enter'])) {
    $descr = $_POST['notice'];
    $no = $_POST['no'];
    $type = $_POST['type'];
    $cat = $_POST['cat'];
    $tit = $_POST['title'];
    $cstat = 1;


    $stat = 0;


    $file = $_FILES['file'] ?? null;

    if ($type == 1) {
      if ($file && $file['tmp_name']) {
        $photop = 'img/notice/img/' . $file['name'];
        move_uploaded_file($file['tmp_name'], $photop);
      }
    }
    if ($type == 2) {
      if ($file && $file['tmp_name']) {
        $photop = 'img/notice/video/' . $file['name'];
        move_uploaded_file($file['tmp_name'], $photop);
      }
    }
    if ($type == 3) {
      if ($file && $file['tmp_name']) {
        $photop = 'img/notice/document/' . $file['name'];
        move_uploaded_file($file['tmp_name'], $photop);
      }
    }



    $cfetch = $pdo->prepare("SELECT COUNT(*) AS notice FROM notice WHERE nid=:nid");
    $cfetch->bindValue(':nid', $uid);
    $cfetch->execute();
    $prof = $cfetch->fetchAll(PDO::FETCH_ASSOC);
    if (count($prof) > 0) {
      $uid = random() . "#";
    }

    $sttmt = $pdo->prepare("INSERT INTO notice(nid,type,cat,cstat,no,notice,title,description,stat,date)
    VALUES (:nid,:type,:cat,:cstat,:no,:notice,:title,:description,:stat,:date)");
    $sttmt->bindValue(':nid', $uid);
    $sttmt->bindValue(':type', $type);
    $sttmt->bindValue(':cat', $cat);
    $sttmt->bindValue(':cstat', $cstat);
    $sttmt->bindValue(':no', $no);
    $sttmt->bindValue(':notice', $photop);
    $sttmt->bindValue(':title', $tit);
    $sttmt->bindValue(':description', $descr);
    $sttmt->bindValue(':stat', $stat);
    $sttmt->bindValue(':date', $date);
    $sttmt->execute();
    //header('location: home.php?q=' .$uid. ' && n='.$notice. ' && nl='.$no. '');



  }
}



?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    .minu:hover {
      transition: 0.81s;
      transform: scale(1.3);
    }
  </style>
  <title>Super</title>
</head>

<body>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
    <h5 class="h5">Notice</h5>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
      </div>

    </div>

  </div>

  <div class="container view ml-0">
    <div class="tab-container container">
      <div class="tab-header container">


        <div class="container big btn-sm">
          <button type="button" class="btn btn-sm btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#postmodal">
            Add Post
          </button>
        </div>
      </div>
      <div class="tab-body container ml-0">
        <div class="tab-content active container" id="notice" style="color: black ;">
          <!---->
          <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Text
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse <!--show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">

                  <?php
                  $sql = "SELECT * FROM notice WHERE type=:idat";
                  $ustmt = $pdo->prepare($sql);
                  $ustmt->bindValue(':idat', 0);
                  $ustmt->execute();
                  $userd = $ustmt->fetchAll(PDO::FETCH_ASSOC);
                  $cc = count($userd);
                  ?>
                  <div class="mb-1" style="display: flex;">
                    <h5><?php echo $cc ?> notice is already posted</h5><button class="detext mx-2 btn-sm btn btn-danger">Delete</button>
                  </div>
                  <textarea class="ckeditor form-control" id="aopt6" name="advaeditor" rows="6" style="width: 930px ;" placeholder="Type Here!"></textarea>
                  <button style="background-color: #db14c1; width: auto;display: block; margin: 0 auto;" class="loginbtn grd text-white btn btn-succes ">Post</button>

                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Photo
                </button>
                <!--
                  <?php $i = 1;
                  $j = 1;
                  foreach ($photo as $pho) : ?>
                  <?php if ($pho['stat'] == 1) : ?>
                              <span class="doc badge rounded-pill bg-success">ON</span>
                              <?php echo $pho['title']; ?>
                              <div class="form-check form-switch">
                                <input class="doc form-check-input" name="check" data-id="<?php echo $pho['nid']; ?>" value="0" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
                                
                              </div>
                            <?php endif; ?>
                            <?php if ($pho['stat'] == 0) : ?>
                              <span class="badge rounded-pill bg-danger">OFF</span>
                              <?php echo $pho['title']; ?>
                              <div class="form-check form-switch">
                                <input class="doc form-check-input" name="check" data-id="<?php echo $pho['nid']; ?>"  value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                
                              </div>
                            <?php endif; ?>
                  <?php endforeach; ?>--->
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <table>
                    <tr>

                      <?php $i = 1;
                      $j = 1;
                      foreach ($photo as $pho) : ?>
                        <?php if ($i == $j + 3) : ?>
                    <tr></tr>
                  <?php $j = $j + 3;
                        endif; ?>
                  <td>
                    <div class="  card text-center mb-3" style="width: 310px; height: 250px;">
                      <div class="card-header" id="ruyan">
                        <?php if ($pho['stat'] == 1) : ?>
                          <span class="doc badge rounded-pill bg-success">ON</span>
                          <?php echo $pho['title']; ?>
                          <button type="submit" name="qdelete" class="del badge  bg-danger" style="border:none;" value="<?php echo $pho['nid']; ?>">Delete</button>
                          <div class="form-check form-switch">
                            <input class="doc form-check-input" name="check" data-id="<?php echo $pho['nid']; ?>" value="0" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>

                          </div>
                        <?php endif; ?>
                        <?php if ($pho['stat'] == 0) : ?>
                          <span class="badge rounded-pill bg-danger">OFF</span>
                          <?php echo $pho['title']; ?>
                          <button type="button" name="qdelete" class="del badge  bg-danger" style="border:none;" value="<?php echo $pho['nid']; ?>">Delete</button>
                          <div class="form-check form-switch">
                            <input class="doc form-check-input" name="check" data-id="<?php echo $pho['nid']; ?>" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault">

                          </div>
                        <?php endif; ?>

                      </div>
                      <div class="card-body">
                        <img src="<?php echo $pho['notice']; ?>" class="minu" alt="no image found" style="width: 200px; height: 135px;">
                      </div>
                      <!--<div class="card-footer text-muted">
                            2 days ago
                          </div>-->
                    </div>
                  </td>

                <?php $i = $i + 1;
                      endforeach; ?>
                </tr>

                  </table>

                  <!--  <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                          <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                          </div>
                          <div class="carousel-inner">
                            <div class="carousel-item active" data-bs-interval="10000">
                              <img src="img/1.png" class="d-block " style="width: 930px;height: 400px;" alt="No image found!">
                              <div class="carousel-caption d-none d-md-block">
                                <h5>ASTC</h5>
                                
                              </div>
                            </div>
                            <div class="carousel-item" data-bs-interval="2000">
                            <img src="img/2.jpg" class="d-block " style="width: 930px;height: 400px;" alt="No image found!">
                              <div class="carousel-caption d-none d-md-block">
                                <h5>ASTC</h5>
                                
                              </div>
                            </div>
                            <div class="carousel-item">
                            <img src="img/3.png" class="d-block " style="width: 930px;height: 400px;" alt="No image found!">
                              <div class="carousel-caption d-none d-md-block">
                                <h5>ASTC</h5>
                                
                              </div>
                            </div>
                          </div>
                          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                          </button>
                          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                          </button>
                        </div>-->
                </div>
              </div>
            </div>



          </div>
          <!---->
        </div>
        <div class="tab-content container " id="criteria" style="color: black ;">
          <!---------------->

        </div>

      </div>
    </div>
  </div>



  <!------



        ------>
  <div class="modal fade" id="postmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>
        <div class="modal-body">
          <form class="was-validated" method="POST" action="#" enctype="multipart/form-data">
            <div class="form signup">
              <div class="form-check form-switch">
                <!-- <input class="form-check-input" name="check" value="1" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">OFF/ON</label> -->
              </div>
              <div class=" row g-3">
                <div class="col mb-1">
                  <label>Post Type</label>
                  <div class="mb-1">
                    <select class="form-select" name="type" required aria-label="Type">
                      <option></option>
                      <option value="1" selected>Photo</option>
                      <option value="2">Video</option>
                      <option value="3">Audio</option>
                      <option value="4">Document</option>
                    </select>
                    <div class="invalid-feedback">Please, select type of post</div>
                  </div>
                </div>
                <div class="col mb-1">
                  <label>Category</label>
                  <div class="mb-1">
                    <select class="form-select" name="cat" required aria-label="Type">

                      <option value="1" selected>Notice</option>

                    </select>
                    <div class="invalid-feedback">Please, select type of post</div>
                  </div>
                </div>
                <div class="mb-1">
                  <input type="file" name="file" class="form-control" aria-label="file example" required>
                  <div class="invalid-feedback">Please,give input</div>
                </div>
                <div class="col mb-1">
                  <label>Post number</label>
                  <input type="text" class="form-control" name="no" required placeholder="Enter notice no ">
                  <div class="invalid-feedback">Please enter notice no</div>
                </div>
                <div class="col mb-1">
                  <label>Title</label>
                  <input type="text" class="form-control" name="title" required placeholder="Enter notice title ">
                  <div class="invalid-feedback">Please enter notice no</div>
                </div>
              </div>
              <div class=" row g-3">
                <div class="col mb-1">
                  <label>Description(optional)</label>
                  <textarea class="form-control" cols="5" name="notice" placeholder="Enter description "></textarea>
                  <div class="invalid-feedback">Please enter description</div>
                </div>
                <div class="mb-1">
                  <button class="btn btn-primary" type="submit" name="enter"> post</button>
                </div>
          </form>
        </div>
      </div>

    </div>
  </div>
  </div>
  </div>
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <button type="button" onclick="window.location.reload()" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">

      </div>
    </div>
  </div>
  <div id="deldel"></div>
  <script>
    var elements = document.getElementsByClassName('active');
    for (var i = 0; i < elements.length; i++) {
      var parentElement = elements[i].closest('.nav-link');
      if (parentElement) {
        parentElement.classList.remove('active');
      }
    }
    var anchor = document.querySelector('a.nav-link.homie');
    if (anchor) {
      anchor.classList.add('active');
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
      $(document).on('click', '.del', function() {
        event.preventDefault();
        var cudo = $(this).val();
        $.ajax({
          url: "mainmodal.php",
          method: "POST",
          data: {
            cudo: cudo,
            page: 'home',
            action: 'del'
          },
          success: function(data) {
            $('.toast-body').html(data);
            $('.toast').addClass('toast-success').toast('show');
          }
        })
      });

      $(document).on('click', '.detext', function() {
        event.preventDefault();
        $.ajax({
          url: "mainmodal.php",
          method: "POST",
          data: {
            page: 'home',
            action: 'deltext'
          },
          success: function(data) {
            $('.toast-body').html(data);
            $('.toast').addClass('toast-success').toast('show');
          }
        })
      });



      $(document).on('click', '.doc', function() {
        event.preventDefault();
        var cudo = $(this).val();
        var id = $(this).data('id');
        $.ajax({
          url: "mainmodal.php",
          method: "POST",
          data: {
            cudo: cudo,
            id: id,
            page: 'home',
            action: 'modall'
          },
          success: function(data) {
            $('.toast-body').html(data);
            $('.toast').addClass('toast-success').toast('show');
          }
        })
      })



      $(document).on('click', '.loginbtn', function() {
        event.preventDefault();
        var aopt6 = CKEDITOR.instances["aopt6"].getData();
        var data = {
          aopt6: aopt6
        };
        $.ajax({
          url: "mainmodal.php",
          method: "POST",
          data: {
            data: data,
            page: 'home',
            action: 'tpost'
          },
          success: function(data) {
            $('.toast-body').html(data);
            $('.toast').addClass('toast-success').toast('show');

          }
        });
      });

















    });
  </script>

  <script>
    var elements = document.getElementsByClassName('active');
    for (var i = 0; i < elements.length; i++) {
      var parentElement = elements[i].closest('.nav-link');
      if (parentElement) {
        parentElement.classList.remove('active');
      }
    }
    var anchor = document.querySelector('a.nav-link.mdash');
    if (anchor) {
      anchor.classList.add('active');
    }
  </script>
  <script>
    // Set the timer to 3 minutes
    var timer = setTimeout(function() {
      // Redirect to the logout page
      window.location.href = 'session.php';
    }, 15 * 60 * 1000);

    // Reset the timer on any activity
    document.addEventListener('mousemove', function() {
      clearTimeout(timer);
      timer = setTimeout(function() {
        window.location.href = 'session.php';
      }, 15 * 60 * 1000);
    });
    window.onunload = function() {
      window.location.href = 'session.php';
    };
  </script>
</body>

</html>
<?php

function random()
{
  $char = '@0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str = '';
  for ($i = 0; $i < 5; $i++) {
    $index = rand(0, strlen($char) - 1);
    $str  .= $char[$index];
  }
  return $str;
}


?>