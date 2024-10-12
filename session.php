<?php 
        session_start();

			// Perform any necessary operations based on the page and action values
            session_destroy();
            header('Location: index');
            exit();

    ?>