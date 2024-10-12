<?php 
session_start();

if (isset($_SESSION['uiid']) && isset($_SESSION['fname'])) {
    include "dbc.php";  
    $i=$_GET['q'] ?? null;
    $name=$_GET['n'] ?? null;
?>          
 <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<script src="js/bootstrap.min.js"></script>
    <style>
        body{
            background-color:rgb(192,192,192) ;
        }
    </style>
    
    <title>Menu</title>
  </head>           
     <body> 
        
                <nav class="navbar navbar-dark bg-dark">
                <div class="container">
                    <h1  class="text-white h4 navi">Bahirdar ICT Icubation Center</h1>
                </div>
                
                </nav>
            
            <div style="margin-top:10% ; text-align:center;" class="card mb-3 container" >
            
                
                
                <div class="card-body container">
                   
                    <h3 class="card-title"> Hello, <b style="color:rgb(32,178,170);text-transform: capitalize ;"><?php echo $_SESSION['fname']; ?></b> You successfully add <h2 style="color:Green ;"> <?php echo $name?></h2> as new admin  </h3><br>
                    <h5>Please, click her to view his profile <br><br> <a href="viewadmin.php" class="btn btn-xl btn-outline-info">HERE</a></h5>
                    

                
                </div>
           
            </div>
     </body> 
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>