<?php 
    if(!defined("ROOT"))
        define("ROOT",$_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";

    function activate_account($uid, $activation_key){
        global $conn;

        $query = "UPDATE users
                  SET activation_key = NULL, is_confirmed = 1
                  WHERE id=:id AND activation_key=:key";

        try{
            $stm = $conn->prepare($query);
            $stm->bindParam(":id",$uid);
            $stm->bindParam(":key", $activation_key);
            $stm->execute();
    
            if($stm->rowCount() > 0){
                return true;
            }
            else{
                return false;
            }
        }
        catch(Exception $e){
            return false;
        }
    }
?>