<?php
include "registrar_header.php";


?>
<head>
    <style>
                .text-center {
  display: flex;
  justify-content: center;
  align-items: center;
}

.welcome-text {
  opacity: 0;
  transform: translateY(20px);
  animation: fadeAndSlide 1.5s forwards;
}

@keyframes fadeAndSlide {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}
    </style>
</head>
<body>
    <div id="regdashboard">

    </div>
    <div class="shadow-lg p-3 mb-5 bg-body rounded">
    <div class="text-center">
  <h3 class="welcome-text">Welcome to DKU Online Examination System</h3>
</div>
</div>
    

</body>
<script type="text/javascript">

$(document).ready(function () 
          {
      reg_dashboard();
      function reg_dashboard() {
            $.ajax({
                url: "modal.php",
                method: "POST",
                data: {
                    page: 'regHome',
                    action: 'reg_dashboard'
                },
                success: function(data) {
                    $('#regdashboard').html(data);

                }
            })
        }
    });
</script> 