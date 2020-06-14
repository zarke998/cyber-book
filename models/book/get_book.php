<?php
    header("Content-Type: application/json");

    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/models/image/resize_image.php";
    require_once ROOT."/config/connection.php";
    require_once ROOT."/models/utilities/json_utilities.php";

    include_once ROOT."/models/log/log.php";

    if(!isset($_GET["id"])){
        echo json_encode(["message" => "Book id not set."]);
        exit;
    }
    $id = $_GET["id"];

    try{
        $query = "SELECT books.id AS bookId, title, description, publish_date, num_of_pages, critics_rating, price, discount, language_id, back_type_id, author_id, publisher_id, category_id, book_images.href AS cover_url FROM books
                    INNER JOIN book_images ON book_images.book_id = books.id
                -- INNER JOIN authors ON books.author_id = authors.id
                -- INNER JOIN publishers ON books.publisher_id = publisher.id
                -- INNER JOIN languages ON books.language_id = languages.id
                -- INNER JOIN back_types ON books.back_type_id = back_types.id
                WHERE books.id=? AND book_images.lod_level = ".IMAGE_SIZE_MEDIUM;
        $stm = $conn->prepare($query);
        $stm->bindParam(1, $id);
        
        if(!$stm->execute()){
            output_json_message("Internal server error", 500);
            exit;
        }

        echo json_encode($stm->fetch());
    }
    catch(Exception $e){
        output_json_message("Internal server error", 500);
        
        log_error("Error getting book by id. Exception {$e->getMessage()}");
        exit;
    }
?>