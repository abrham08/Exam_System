<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Hostname
    $host = "localhost";

    // Username
    $user = "root";

    // Password
    $pass = "";

    // Database Name
    $db   = "ict";

    // Establish database connection
    $con = new mysqli($host, $user, $pass, $db);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
$conn = mysqli_connect("localhost","root","","ict");
$pdo=new PDO('mysql:host=localhost;dbname=ict', 'root', '');
$pdo->setAttribute(PDO :: ATTR_ERRMODE,PDO :: ERRMODE_EXCEPTION);

?>