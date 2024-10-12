<?php
include "teacher_header.php";

    $t_id = $_SESSION['tuid'];


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
    <div id="dashboard">
    <div class="text-center">
  <h3 class="welcome-text">Welcome to DKU Online Examination System</h3>
</div>

    </div>
    
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="oliveToast"  class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" id="outertoast-body">

                </div>
            </div>
        </div>
        </div>
 </main>
 </div>
</body>