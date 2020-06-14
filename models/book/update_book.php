<?php 
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(!defined("ROOT"))
        define("ROOT",$_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";

    require_once ROOT."/models/language/add_language.php";
    require_once ROOT."/models/author/add_author.php";
    require_once ROOT."/models/publisher/add_publisher.php";
    require_once ROOT."/models/back-type/add_back_type.php";

    include_once ROOT."/models/log/log.php";
    
    header("Content-Type: application/json");

    if(!isset($_SESSION["user"]) or $_SESSION["user"]->role_id != 1 or !isset($_POST["updateBookBtn"])){
        http_response_code(403);
        echo json_encode(["message" => "Access forbidden."]);
        exit;
    }

#region POST variables
    $id = $_POST["bookId"];

    $title = $_POST["bookTitle"];

    $description = $_POST["bookDescription"];

    $categoryNew = $_POST["bookCategoryNew"];
    $categoryId = $_POST["bookCategory"];

    $languageNew = $_POST["bookLanguageNew"];
    $languageId = $_POST["bookLanguage"];

    $authorNew = $_POST["bookAuthorNew"];
    $authorId = $_POST["bookAuthor"];

    $publisherNew = $_POST["bookPublisherNew"];
    $publisherId = $_POST["bookPublisher"];

    $publishDate = $_POST["bookPublishDate"];
    
    $backTypeNew = $_POST["bookBackTypeNew"];
    $backTypeId = $_POST["bookBackType"];

    $numOfPages = $_POST["bookNumOfPages"];
    
    $criticsRating = $_POST["bookCriticsRating"];

    $price = $_POST["bookPrice"];

    $discount = $_POST["bookDiscount"];
#endregion

#region variable validation
    if($categoryNew != ""){
        $categoryId = add_category($categoryNew);

        if($categoryId == 0){
            output_json("Internal server error.", 500);
            exit;
        }
    }

    if($languageNew != ""){
        $languageId = add_language($languageNew);
    
        if($languageId == 0){
            output_json("Internal server error.", 500);
            exit;
        }
    }

    if($authorNew != ""){
        $authorId = add_author($authorNew);

        if($authorId == 0){
            output_json("Internal server error.", 500);
            exit;
        }
    }

    if($publisherNew != ""){
        $publisherId = add_publisher($publisherNew);

        if($publisherId == 0){
            output_json("Internal server error.", 500);
            exit;
        }
    }

    if($backTypeNew != ""){
        $backTypeId = add_back_type($backTypeNew);

        if($backTypeId == 0){
            output_json("Internal server error.", 500);
            exit;
        }
    }
#endregion
    

    try{
        $query = "UPDATE books
                SET 
                    title = ?, 
                    description = ?, 
                    publish_date = ?, 
                    num_of_pages = ?, 
                    critics_rating = ?, 
                    price = ?, 
                    discount = ?, 
                    language_id = ?, 
                    back_type_id = ?, 
                    author_id = ?, 
                    publisher_id = ?,
                    category_id = ?
                WHERE id=?";
        $stm = $conn->prepare($query);
        $stm->bindParam(1, $title);
        $stm->bindParam(2, $description);
        $stm->bindParam(3, $publishDate);
        $stm->bindParam(4, $numOfPages);
        $stm->bindParam(5, $criticsRating);
        $stm->bindParam(6, $price);
        $stm->bindParam(7, $discount);
        $stm->bindParam(8, $languageId);
        $stm->bindParam(9, $backTypeId);
        $stm->bindParam(10, $authorId);
        $stm->bindParam(11, $publisherId);
        $stm->bindParam(12, $categoryId);
        $stm->bindParam(13, $id);

        if(!$stm->execute()){
            output_json("Internal server error.", 500);
            exit;
        }
#endregion
        
        output_json("Book updated successfuly.", 200);
        exit;
    }
    catch(Exception $e){
        output_json("Internal server error.", 500);

        log_error("Error updating book. Exception {$e->getMessage()}");
        exit;
    }

    

    function output_json($message, $status_code){
        http_response_code($status_code);
        echo json_encode(["message" => $message]);
    }
?>