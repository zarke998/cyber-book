<?php 
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(isset($_SESSION["user"])){
        session_unset();
        session_destroy();
    }

    header("Location: /index.php");
?>