<?php
include "dbc.php";
session_start();
if(isset($_POST['page']))
{
if($_POST['page'] == 'back')
	{
		if($_POST['action'] == 'head_pass' )
		{
             $uid = filter_var($_POST['user_id'], FILTER_SANITIZE_STRING);
             $Old_pass =  filter_var($_POST['old_pass'], FILTER_SANITIZE_STRING);
             $new_pass =  filter_var($_POST['new_password'], FILTER_SANITIZE_STRING);
             $conf_pass =  filter_var($_POST['conf_pass'], FILTER_SANITIZE_STRING);

             $fetch = $pdo->prepare('SELECT * FROM account WHERE user_id=:uiid');
             $fetch->bindValue(':uiid',$uid);
             $fetch->execute();
             $epart = $fetch->fetch(PDO::FETCH_ASSOC);

             $isValid = verifyPassword($Old_pass, $epart['password']);

             if ($isValid) {
                $password = password_hash($new_pass, PASSWORD_BCRYPT);

                $snewmy = $pdo->prepare("UPDATE account 
                SET password = :pass WHERE user_id = :uiiid");
                $snewmy->bindValue(':uiiid',$uid);  
                $snewmy->bindValue(':pass',$password);         
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