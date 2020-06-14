<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";
    include_once ROOT."/models/log/log.php"; 

    function get_all_authors(){
        global $conn;

        try{
            $query = "SELECT * FROM authors";
            $stm = $conn->prepare($query);
            
            if(!$stm->execute()){
                return 0;
            }

            return $stm->fetchAll();
        }
        catch(Exception $e){
            log_error("Error fetching authors. Exception {$e->getMessage()}");
            return null;
        }
        
    }
?>