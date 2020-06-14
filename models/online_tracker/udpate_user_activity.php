<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";
    include_once ROOT."/models/log/log.php";

    function update_user_activity($id){
        global $conn;

        try{
            $current_time = date("Y-m-d H:i:s");

            $query = "UPDATE users
                    SET last_activity=?
                    WHERE id=?";
            $stm = $conn->prepare($query);
            $stm->bindParam(1, $current_time);
            $stm->bindParam(2, $id);

            if(!$stm->execute()){
                return false;
            }

            return true;
        }
        catch(Exception $e){
            log_error("Error updating user activity. Exception {$e->getMessage()}");
            return false;
        }
    }
?>
