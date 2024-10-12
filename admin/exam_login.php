<?php 
include "teacher_header.php";
if (isset($_SESSION['tuid'])) {
$current_date = date('Y-m-d');
$nd=0; 
$fetch=$pdo->prepare('SELECT * FROM assexam WHERE examiner = :uid AND  exam_date = :exam_date AND estatus=:estat');
    $fetch->bindValue(':uid',$_SESSION['tuid']);
    $fetch->bindValue(':exam_date',$current_date);
    $fetch->bindValue(':estat',1);
    $fetch->execute();
    $show=$fetch->fetchAll(PDO::FETCH_ASSOC);

?>

    <body>
        <?php if(count($show) > 0): ?> 
        <div class="container card text-center" style="width:600px ; margin-top:50px;">
            <div class="card-header">
                Select Course
            </div>
            <div class="card-body">
                <form method="POST" action="proctorPage">
                <select name="cat" class="form-select mb-5" required aria-label="Category">
                <?php foreach($show as $sho):  ?>
                    

            <?php    
            $enfetch=$pdo->prepare('SELECT cat_id FROM exam WHERE exam_id = :euid');
            $enfetch->bindValue(':euid',$sho['exam_id']);
            $enfetch->execute();
            $enshow=$enfetch->fetch(PDO::FETCH_ASSOC);

            $nfetch=$pdo->prepare('SELECT cat_name FROM category WHERE cat_id = :uid');
            $nfetch->bindValue(':uid',$enshow['cat_id']);
            $nfetch->execute();
            $nshow=$nfetch->fetch(PDO::FETCH_ASSOC);

            $dnfetch=$pdo->prepare('SELECT dep_name FROM department WHERE dep_id = :duid');
            $dnfetch->bindValue(':duid',$sho['assigned_Department']);
            $dnfetch->execute();
            $dnshow=$dnfetch->fetch(PDO::FETCH_ASSOC);
             $combinedValue = $sho['exam_id'] . '_' . $sho['assigned_Department']; 
             $option['value']=$combinedValue;

             $query = "SELECT CONCAT(exam_date, ' ', start_time) AS datetime_combined , assigned_group  FROM assexam WHERE assigned_Department=:catid AND exam_id=:examid";

             $nstmt = $pdo->prepare($query);
             $nstmt->bindValue(':catid', $sho['assigned_Department']);
             $nstmt->bindValue(':examid', $sho['exam_id']);
             $nstmt->execute();

             // Fetch the result
             $nnresult = $nstmt->fetch(PDO::FETCH_ASSOC);

             // Retrieve the combined datetime value
             $combinedDateTime = $nnresult['datetime_combined'];

             $targetDateTime = $combinedDateTime;

             // Convert the target date and time to GMT+3 with 12-hour format
             $target = new DateTime($targetDateTime, new DateTimeZone('Etc/GMT+3'));
             $target->setTimeZone(new DateTimeZone('Etc/GMT+3'));
             $targetDateTimeFormatted = $target->format('Y-m-d h:i:s A');
             
             // Get the current date and time in GMT+3 with 12-hour format
             date_default_timezone_set('Etc/GMT+3');
             $currentDateTime = date('Y-m-d h:i:s A');
             
             // Calculate the remaining time in seconds
             $remainingTime = $target->getTimestamp() - strtotime($currentDateTime);  
             $remainingTime -= 300;  
                              if ($remainingTime < 0) {
                                $remainingTime = 0;
                            }                              
                      ?>
                        <?php


                        
                            echo '<option value="'.$combinedValue.'" id="option_' . $option['value'] . '" disabled>
                            
                            
                            
                            </option>';
                        

                        echo '<script>';
                        
                            echo 'var remainingTime_' . $option['value'] . ' = ' . $remainingTime . ';';
                            echo 'var optionElement_' . $option['value'] . ' = document.getElementById("option_' . $option['value'] . '");';

                            echo 'function updateCounter_' . $option['value'] . '() {';
                            echo '  var hours = Math.floor(remainingTime_' . $option['value'] . ' / 3600);';
                            echo '  var minutes = Math.floor((remainingTime_' . $option['value'] . ' % 3600) / 60);';
                            echo '  var seconds = remainingTime_' . $option['value'] . ' % 60;';

                            echo '  optionElement_' . $option['value'] . '.textContent = "'.$nshow['cat_name'].' '.'for'.' '.$nnresult['assigned_group'].' '.  $dnshow['dep_name'].' " + "Start in" + " " + hours + "h : " + minutes + "m : " + seconds + "s";';

                            echo '  if (remainingTime_' . $option['value'] . ' <= 0) {';
                            echo '    optionElement_' . $option['value'] . '.removeAttribute("disabled");';
                            echo '  optionElement_' . $option['value'] . '.textContent = "'.$nshow['cat_name'].' '.'for'.' '.  $dnshow['dep_name'].' ";';
                            echo '    clearInterval(interval_' . $option['value'] . ');';
                            echo '  } else {';
                            echo '    remainingTime_' . $option['value'] . '--;';
                            echo '  }';
                            echo '}';

                            echo 'var interval_' . $option['value'] . ' = setInterval(updateCounter_' . $option['value'] . ', 1000);';
                        
                        echo '</script>';




























                        // echo '<option value="option_value" id="option_id" disabled>Option</option>';

                        // echo '<script>';
                        // echo 'var remainingTime = ' . $remainingTime . ';';
                        // echo 'var optionElement = document.getElementById("option_id");';

                        // echo 'function activateOption() {';
                        // echo '  optionElement.removeAttribute("disabled");';
                        // echo '  optionElement.selected = true;';
                        // echo '  clearInterval(interval);';
                        // echo '}';

                        // echo 'var interval = setInterval(function() {';
                        // echo '  if (remainingTime <= 0) {';
                        // echo '    activateOption();';
                        // echo '  } else {';
                        // echo '    remainingTime--;';
                        // echo '  }';
                        // echo '}, 1000);';
                        // echo '</script>';

                        ?>
             










                    
                <!-- <option value="<?php echo $combinedValue ?>"><?php echo $nshow['cat_name'].' '.'for'.' '.$nnresult['assigned_group'].' '.  $dnshow['dep_name']; ?></option> -->
                <?php  endforeach; ?>
                </select>
                <button type="submit" name="cati" class="btn btn-primary">Proctor</button>
                </form>
            </div>
            <div class="card-footer text-muted">
               DKU OES
            </div>
            </div>
            <?php else: ?> 
                <div class="alert alert-danger">No active exam is available</div>
            <?php endif; ?> 
            </main>
          </div>
    </body>
<script>
    var elements = document.getElementsByClassName('active');
        for (var i = 0; i < elements.length; i++) {
        var parentElement = elements[i].closest('.nav-link');
        if (parentElement) {
            parentElement.classList.remove('active');
        }}
        var anchor = document.querySelector('a.nav-link.propro');
        if (anchor) {
        anchor.classList.add('active');
        }
</script>
<?php 
}else{
  header("Location: ../index.php");
  exit();
}
 ?>