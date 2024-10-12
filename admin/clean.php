<?php
    include "dbc.php";
    if (isset($_POST['aclean'])){

$st=$pdo->prepare('DELETE FROM user');
        $st->execute();
        header("Location: trash.php");
    }
    if (isset($_POST['bclean'])){

        $st=$pdo->prepare('DELETE FROM result');
                $st->execute();
                
        $st=$pdo->prepare('DELETE FROM discipline');
        $st->execute();
                header("Location: trash.php");
            }
if (isset($_POST['rclean'])){

        $st=$pdo->prepare('DELETE FROM final_result');
        $st->execute();
        
        header("Location: trash.php");
    }
    if (isset($_POST['dclean'])){

        $st=$pdo->prepare('DELETE FROM temporary');
                $st->execute();
                header("Location: trash.php");
    }
?>