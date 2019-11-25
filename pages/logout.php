<?php
    if (session_status() == null) {
        session_start();
    }
    session_destroy();
    header("Location: index.php");
?>