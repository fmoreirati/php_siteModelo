<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    session_destroy();
    //header("Location: index.php");
    echo '<script> location.replace("/"); </script>';
?>