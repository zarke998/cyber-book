<?php

    if(!defined("ROOT"))
        define("ROOT",$_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";
    include_once ROOT."/models/log/log.php";

    function set_user_online_status($id, $is_online){
        global $conn;

        try{
            $query = "UPDATE users
                    SET is_online=?
                    WHERE id=?";
            $stm = $conn->prepare($query);
            $stm->bindParam(1,$is_online, PDO::PARAM_INT);
            $stm->bindParam(2,$id, PDO::PARAM_INT);
            
            if(!$stm->execute()){
                return false;
            }

            return true;
        }
        catch(Exception $e){
            log_error("Error updating user online status. Exception: {$e->getMessage()}");
            return false;
        }
    }
?>