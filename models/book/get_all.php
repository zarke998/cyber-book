<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";

    define("BOOK_FULL_INFO", 0);
    define("BOOK_TITLE_ONLY", 1);

    function get_all_books($fetch_type = BOOK_FULL_INFO){
        global $conn;

        switch($fetch_type){
            case BOOK_TITLE_ONLY:
                $query = "SELECT id, title FROM books";
                break;
            default: // BOOK_FULL_INFO
                $query = "SELECT * FROM books";
                break;
        }
        

        try{
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