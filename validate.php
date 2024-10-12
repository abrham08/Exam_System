<?php 

include "dbc.php";
session_start(); 
if (isset($_POST['page'])) {
    if ($_POST['page'] == 'index') {
        if ($_POST['action'] == 'login') {

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['pass']);
    $uname = filter_var($uname, FILTER_SANITIZE_STRING);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    
	if (empty($uname)) {
		$response = array(
            'success' => false,
            'redirects' => '<div id="usualert" class="alert alert-danger">Username is required
            <script>
            $("#usualert").alert();
            setTimeout(function() {
            $("#usualert").alert("close");
              }, 20000);
            
            </script></div>'
          );
          
          echo json_encode($response);
	    exit();
	}else if(empty($pass)){
        $response = array(
            'success' => false,
            'redirects' => '<div id="usualert" class="alert alert-danger">Password is required
            <script>
            $("#usualert").alert();
            setTimeout(function() {
            $("#usualert").alert("close");
              }, 20000);
            
            </script></div>'
          );
          
          echo json_encode($response);
	    exit();
	}else{

                $stmt1 = $pdo->prepare("SELECT * FROM account WHERE user_name = :una");
                $stmt1->bindValue(':una', $uname);
                $stmt1->execute();
                $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

                $stmt2 = $pdo->prepare("SELECT * FROM examinee WHERE user_name = :unam");
                $stmt2->bindValue(':unam', $uname);
                $stmt2->execute();
                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

                // If the username and password are found in table1, validate the password using bcrypt
                if ($row1 && password_verify($pass, $row1['password'])) {
                    // Set the session variables and redirect to page1
                    
                    if($row1['user_type'] == 'Teacher'){
                        $_SESSION['tuid'] = $row1['user_id'];
                        $response = array(
                            'success' => true,
                            'redirect' => 'admin/t_dashboard'
                          );
                          
                          echo json_encode($response);
                    }
                    elseif($row1['user_type'] == 'Head'){
                        $_SESSION['huid'] = $row1['user_id'];
                        $_SESSION['hdepid'] = $row1['Department'];
                        $response = array(
                            'success' => true,
                            'redirect' => 'admin/home'
                          );
                          
                          echo json_encode($response);
                    }
                    
                    elseif($row1['user_type'] == 'Registrar'){
                        $_SESSION['ruid'] = $row1['user_id'];
                        $response = array(
                            'success' => true,
                            'redirect' => 'admin/regHome'
                          );
                          
                          echo json_encode($response);
                    }
                    elseif($row1['user_type'] == 'HR'){
                        $_SESSION['hruid'] = $row1['user_id'];
                        $response = array(
                            'success' => true,
                            'redirect' => 'admin/HRHome'
                          );
                          
                          echo json_encode($response);
                    }
                    elseif($row1['user_type'] == 'Super'){
                        $_SESSION['suid'] = $row1['user_id'];
                        $response = array(
                            'success' => true,
                            'redirect' => 'admin/mainDashboard'
                          );
                          
                          echo json_encode($response);
                    }
                    else{
                        $response = array(
                            'success' => true,
                            'redirect' => 'index'
                          );
                          
                          echo json_encode($response);;
                    }
                    
                    exit();
                }

                // If the username and password are found in table2, validate the password using bcrypt
                if ($row2 && password_verify($pass, $row2['password'])) {
                    
                    $_SESSION['stuid'] = $row2['uiid'];
                    //header("Location: main");
                    $response = array(
                        'success' => true,
                        'redirect' => 'main'
                      );
                      
                      echo json_encode($response);

                    exit();
                }

                // If the username and password are not found in either table, redirect to the login page with an error message
                $_SESSION['error'] = "Invalid username or password";
                $response = array(
                    'success' => false,
                    'redirects' => '<div id="usualert" class="alert alert-danger">Incorect User name or password
                    <script>
                    document.getElementById("loglog").reset();
                    $("#usualert").alert();
                    setTimeout(function() {
                    $("#usualert").alert("close");
                      }, 4000);
                    
                    </script></div>'
                  );
                  
                  echo json_encode($response);
              
                exit();
        
      
	}
}
}
	
}else{
	header("Location: index");
	exit();
}

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}