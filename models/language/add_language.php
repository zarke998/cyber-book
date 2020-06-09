<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";

    function add_language($name){
        global $conn;

        try{
            $query = "INSERT INTO languages 
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
            return 0;
        }
        
    }
?>