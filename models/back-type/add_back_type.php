<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";
    include_once ROOT."/models/log/log.php"; 

    function add_back_type($name){
        global $conn;

        try{
            $query = "INSERT INTO back_types 
            VALUES(NULL, ?)";
            $stm = $conn->prepare($query);
            $stm->bindParam(1, $name);
            
            if(!$stm->execute()){
                return 0;
            }

            $id = $conn->lastInsertId();
            return $id;

        }
        catch(Exception $e){
            log_error("Error adding back type. Exception {$e->getMessage()}");
            return 0;
        }
        
    }
?>