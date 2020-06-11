<?php 
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(!defined("ROOT"))
        define("ROOT",$_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";

    require_once ROOT."/models/category/add_category.php";
    require_once ROOT."/models/language/add_language.php";
    require_once ROOT."/models/author/add_author.php";
    require_once ROOT."/models/publisher/add_publisher.php";
    require_once ROOT."/models/back-type/add_back_type.php";

    require_once ROOT."/models/image/resize_image.php";
    require_once ROOT."/models/image/move_to_books_tmp.php";
    require_once ROOT."/models/image/add_image.php";
    require_once ROOT."/models/image/functions.php";
    
    header("Content-Type: application/json");

    if(!isset($_SESSION["user"]) or $_SESSION["user"]->role_id != 1 or !isset($_POST["addBookBtn"])){
        http_response_code(403);
        echo json_encode(["message" => "Access forbidden."]);
        exit;
    }

#region POST variables
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

    $coverImage = $_FILES["bookCoverImage"];
#endregion

#region variable validation
    if($coverImage["size"] > 500000){
        output_json("Image can not be bigger than 500KB.", 413); // 413 - Payload too large
        exit;
    }
    else if(!in_array($coverImage["type"], ["image/png", "image/jpeg"])){
        output_json("Image must be jpg or png.", 406); // 406 - Not acceptable
        exit;
    }

    if($languageNew != ""){
        $languageId = add_language($languageNew);
    
        if($languageId == 0){
            output_json("Internal server error.", 500);
            exit;
        }
    }

    if($categoryNew != ""){
        $categoryId = add_category($categoryNew);
    
        if($categoryId == 0){
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
        $query = "INSERT INTO books(title, description, publish_date, num_of_pages, critics_rating, price, discount, language_id, back_type_id, author_id, publisher_id, category_id)
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
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

        if(!$stm->execute()){
            output_json("Internal server error.", 500);
            exit;
        }

        $bookId = $conn->lastInsertId();

#region Generate thumbnails

        $extension = get_extension_from_mime($coverImage["type"]);

        $image_tmp_path = move_to_books_tmp($coverImage["tmp_name"],$extension);
        $image_tmp = image_by_extension($image_tmp_path, $extension);

        // Thumb paths
        $thumbTime = hrtime(true);

        $href_small = "/assets/images/books/small/$thumbTime.$extension";
        $href_medium = "/assets/images/books/medium/$thumbTime.$extension";
        $href_big = "/assets/images/books/big/$thumbTime.$extension";

        $image_small_path = ROOT.$href_small;
        $image_medium_path = ROOT.$href_medium;
        $image_big_path = ROOT.$href_big;

        //Resize images
        $image_small = resize_image($image_tmp, IMAGE_SIZE_SMALL);
        $image_medium = resize_image($image_tmp, IMAGE_SIZE_MEDIUM);
        $image_big = resize_image($image_tmp, IMAGE_SIZE_BIG);
        
        // Save
        image_save_by_extension($image_small, $image_small_path, $extension);
        image_save_by_extension($image_medium, $image_medium_path, $extension);
        image_save_by_extension($image_big, $image_big_path, $extension);

        //Insert into database
        add_image($bookId, $href_small, IMAGE_SIZE_SMALL);
        add_image($bookId, $href_medium, IMAGE_SIZE_MEDIUM);
        add_image($bookId, $href_big, IMAGE_SIZE_BIG);


        imagedestroy($image_small);
        imagedestroy($image_medium);
        imagedestroy($image_big);

        unlink($image_tmp_path);

#endregion
        
        output_json("Book added successfuly.", 200);
        exit;
    }
    catch(Exception $e){
        output_json("Internal server error.", 500);
        exit;
    }

    

    function output_json($message, $status_code){
        http_response_code($status_code);
        echo json_encode(["message" => $message]);
    }
?>