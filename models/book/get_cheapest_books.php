<?php    
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";

    function get_cheapest_books($limit){
        global $conn;

        try{
            $query = "SELECT title, num_of_pages, price, discount, (books.price - (books.price * books.discount/100)) AS total_price FROM books
                        ORDER BY (books.price - (books.price * books.discount/100)) ASC
                        LIMIT ?";
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $stm = $conn->prepare($query);
            $stm->bindParam(1, $limit, PDO::PARAM_INT);
            
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