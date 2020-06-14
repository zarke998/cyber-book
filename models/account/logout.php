<?php 
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(!defined("ROOT"))
        define("ROOT",$_SERVER["DOCUMENT_ROOT"]);   

    require_once ROOT."/models/online_tracker/set_user_online_status.php";

    if(isset($_SESSION["user"])){
        set_user_online_status($_SESSION["user"]->id, false);

        session_unset();
        session_destroy();
    }

    header("Location: /index.php");
?>