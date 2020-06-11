<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";

    function get_images_by_book($book_id){
        global $conn;

        try{
            $query = "SELECT * FROM book_images WHERE book_id=?";
            $stm = $conn->prepare($query);
            $stm->bindParam(1, $book_id);
            
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