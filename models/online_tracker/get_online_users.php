<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";
    include_once ROOT."/models/log/log.php";

    function get_online_users(){
        global $conn;

        try{
            $query = "SELECT COUNT(*) as online_users FROM users WHERE TIMESTAMPDIFF(MINUTE, last_activity, CURRENT_TIMESTAMP) < 5 AND is_online=1";
            $stm = $conn->prepare($query);

            if(!$stm->execute()){
                return -1;
            }

            return $stm->fetch()->online_users;
        }
        catch(Exception $e){
            log_error("Error fetching online user count. Exception: {$e->getMessage()}");
            return -1;
        }
    }
?>
