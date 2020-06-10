<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";

    function get_all_books(){
        global $conn;

        try{
            $query = "SELECT * FROM books";
            $stm = $conn->prepare($query);
            
            if(!$stm->execute()){
                return null;
            }

            return $stm->fetchAll();
        }
        catch(Exception $e){
            return null;
        }
        
    }
?>