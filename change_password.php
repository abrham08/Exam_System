<?php
include "dbc.php";
session_start();
if(isset($_POST['page']))
{
if($_POST['page'] == 'main')
	{
		if($_POST['action'] == 'stu_pass')
		{
             $uid = filter_var($_POST['user_id'], FILTER_SANITIZE_STRING);
             $Old_pass =  filter_var($_POST['old_pass'], FILTER_SANITIZE_STRING);
             $new_pass =  filter_var($_POST['new_password'], FILTER_SANITIZE_STRING);
             $conf_pass =  filter_var($_POST['conf_pass'], FILTER_SANITIZE_STRING);

             $fetch = $pdo->prepare('SELECT * FROM examinee WHERE uiid=:uiid');
             $fetch->bindValue(':uiid',$uid);
             $fetch->execute();
             $epart = $fetch->fetch(PDO::FETCH_ASSOC);

             $isValid = verifyPassword($Old_pass, $epart['password']);

             if ($isValid) {
                $password = password_hash($new_pass, PASSWORD_BCRYPT);

                $snewmy = $pdo->prepare("UPDATE examinee 
                SET password = :pass , rpass=:rpass WHERE uiid = :uiiid");
                $snewmy->bindValue(':uiiid',$uid);  
                $snewmy->bindValue(':pass',$password);     
                $snewmy->bindValue(':rpass',$new_pass);             
                $snewmy->execute();
                 
                echo '<div class="alert alert-success">The password is successfully changed.</div>
                <script>
                document.getElementById("schange_password").reset();
                </script>
                ';
             } else {
                 echo '<div class="alert alert-danger">Please enter the correct old password.</div>';
             }
             
             
             
             
             
             
             
             




        }
    }
}
function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}
?>