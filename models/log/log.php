<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/config.php";

    function log_cyber_book($message, $file_path = LOG_FILE){        
        $file = fopen($file_path, 'a');
        if($file){
            fwrite($file, $message);
            fclose($file);
            return true;
        }
        return false;        
    }

    function log_error($err_message){
        $date = date("Y-m-d H:i:s");
        log_cyber_book("$date\t$err_message\n", LOG_FILE_ERROR);
    }
?>
