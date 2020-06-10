<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";

    function add_image($book_id, $href, $lod_level){
        global $conn;

        try{
            $query = "INSERT INTO book_images(book_id, href, lod_level)
            VALUES(?, ?, ?)";
            $stm = $conn->prepare($query);
            $stm->bindParam(1, $book_id);
            $stm->bindParam(2, $href);
            $stm->bindParam(3, $lod_level);
            
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