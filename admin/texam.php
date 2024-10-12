<?php
include "teacher_header.php";
$u_name = "MUL1257984";
$fetch = $pdo->prepare('SELECT user_id FROM account WHERE user_name=:uiid');
$fetch->bindValue(':uiid', $u_name);
$fetch->execute();
$show = $fetch->fetchAll(PDO::FETCH_ASSOC);
foreach ($show as $sh) {
    $t_id = $sh['user_id'];
}
?>
<body>
    <div id="dashboard">

    </div>
    <div class="shadow-lg p-3 mb-5 bg-body rounded">Larger shadow</div>
    

</body>