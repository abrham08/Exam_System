<?php
session_start();
if (isset($_SESSION['stuid'])) {
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if the button value is set
  if(isset($_POST['ask'])){
    $_SESSION['cat_id'] = $_POST['cido'] ?? null;
    $_SESSION['exam_id'] =$_POST['exido'] ?? null;
    $_SESSION['etype'] = $_POST['etype'] ?? null;
   }
  
}

// Redirect to another page while preserving the session values
header('Location: instruction');
exit();
?>
<?php } else {
  echo "<script>
                var conf = confirm('Access Denied! ');
            if(conf == true){

                window.location='index'; 
              
            }
                    else{
                        window.location='index'; 

              }
          
          </script>";
} ?>