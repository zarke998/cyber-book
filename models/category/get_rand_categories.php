<?php

    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";

    function get_rand_categories($limit){
        try{
            global $conn;

            $query = "SELECT * FROM categories ORDER BY rand() LIMIT :limit";
            $stm = $conn->prepare($query);
            $stm->bindParam(":limit", $limit, PDO::PARAM_INT);
            
            if(!$stm->execute()){
                return null;
            }
    
            return $stm->fetchAll();
        }
        catch(Exception $e){
            echo $e->getMessage();
            return null;
        }
    }
    
?>