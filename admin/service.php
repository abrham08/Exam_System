<?php
include "dbc.php";
include "header.php";

// if (isset($_SESSION['huid']) && isset($_SESSION['hdepid'])) {
  $uid=$_SESSION['huid'];
  if($_SERVER['REQUEST_METHOD']=='POST'){

  }

  $depart = $_SESSION['hdepid'];


?>
<body>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-1 mb-1 border-bottom">
    <h5 class="h5">Additional Services</h5>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        <button  type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#InformationproModalalert"> Generate Account</button>
      </div>

    </div>
  </div>

  <div id="InformationproModalalert" class="modal modal-edu-general fullwidth-popup-InformationproModal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Account Report</h5>
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
    var elements = document.getElementsByClassName('active');
      for (var i = 0; i < elements.length; i++) {
      var parentElement = elements[i].closest('.nav-link');
      if (parentElement) {
        parentElement.classList.remove('active');
    }}
    var anchor = document.querySelector('a.nav-link.serv');
    if (anchor) {
      anchor.classList.add('active');
    }

  </script>
</body>
<script>
 $(document).ready(function() {

var depart = "<?php echo $depart; ?>";
var head = "<?php echo  $uid;?>";
$(document).on('click', '#hgenerate', function() {
                event.preventDefault();
                
                var format=  document.forms["reportgenerarion"]["format"].value;
                var strm=  document.forms["reportgenerarion"]["strm"].value;
                var syear=  document.forms["reportgenerarion"]["syear"].value;            
                if (format == '' || strm == '' || syear == '') {
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
                url: "temp_pass.php",
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
