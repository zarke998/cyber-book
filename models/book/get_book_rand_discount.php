<?php

    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/models/image/resize_image.php";
    require_once ROOT."/config/connection.php";

    include_once ROOT."/models/log/log.php";

    function get_book_rand_discount(){
        try{
            global $conn;

            $query = "SELECT *
                     FROM (
                         SELECT books.id AS bookId, title, description, publish_date, num_of_pages, critics_rating, price, discount, language_id, back_type_id, author_id, publisher_id, book_images.href AS cover_url FROM books 
                         INNER JOIN book_images ON books.id = book_images.book_id
                         WHERE lod_level = ?
                         ORDER BY discount DESC 
                         LIMIT 10) AS x 
                     ORDER BY rand() 
                     LIMIT 1";
            $stm = $conn->prepare($query);
            $stm->bindValue(1, IMAGE_SIZE_BIG);
            
            if(!$stm->execute()){
                return null;
            }
    
            return $stm->fetch();
        }
        catch(Exception $e){

            log_error("Error updating book. Exception {$e->getMessage()}");
            return null;
            exit;
        }
    }
    
?>