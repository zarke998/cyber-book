<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/config.php";

    function get_log_all(){
        $log = file(LOG_FILE);

        return $log;
    }
?>
