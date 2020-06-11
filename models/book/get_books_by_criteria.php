<?php
    header("Content-Type: application/json");

    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/models/image/resize_image.php";
    require_once ROOT."/config/connection.php";
    require_once ROOT."/models/utilities/json_utilities.php";
    

    try{

        if(!isset($_GET["getBooksByCriteria"])){
            output_json_message("Incomplete input data.", 400);
            exit;
        }


#region Query Building
        $sortCrit = "";
        if(isset($_GET["sortCrit"])){
            switch($_GET["sortCrit"]){
                case 1:
                    $sortCrit = "ORDER BY publish_date DESC ";
                    break;
                case 2:
                    $sortCrit = "ORDER BY publish_date ASC ";
                    break;
                case 3:
                    $sortCrit = "ORDER BY price ASC ";
                    break;
                case 4:
                    $sortCrit = "ORDER BY price DESC ";
                    break;
                case 5:
                    $sortCrit = "ORDER BY critics_rating DESC ";
                    break;
                case 6:
                    $sortCrit = "ORDER BY critics_rating ASC ";
                    break;
                default:
                    $sortCrit = "";
                    break;

            }
        }
        
        $limit = $_GET["limit"];
        $offset = $_GET["offset"];

        $searchQuery = "";
        if(isset($_GET["search"])){
            $searchQuery = "AND INSTR(title,:search) > 0 ";
        }

        $categoriesFilter = "";
        if(isset($_GET["categories"]) and $_GET["categories"] != null){
            $categories = $_GET["categories"];

            $categoriesFilter = "AND category_id IN(:category0";
            for($i = 1; $i < count($categories); $i++){
                $categoriesFilter.= ",:category$i";
            }
            $categoriesFilter.= ") ";
        }

        $languagesFilter = "";
        if(isset($_GET["languages"]) and $_GET["languages"] != null){
            $languages = $_GET["languages"];

            $languagesFilter = "AND language_id IN(:language0";
            for($i = 1; $i < count($languages); $i++){
                $languagesFilter.= ",:language$i";
            }
            $languagesFilter.= ") ";
        }

        $authorsFilter = "";
        if(isset($_GET["authors"]) and $_GET["authors"] != null){
            $authors = $_GET["authors"];

            $authorsFilter = "AND author_id IN(:author0";
            for($i = 1; $i < count($authors); $i++){
                $authorsFilter.= ",:author$i";
            }
            $authorsFilter.= ") ";
        }

        $publishersFilter = "";
        if(isset($_GET["publishers"]) and $_GET["publishers"] != null){
            $publishers = $_GET["publishers"];

            $publishersFilter = "AND publisher_id IN(:publisher0";
            for($i = 1; $i < count($publishers); $i++){
                $publishersFilter.= ",:publisher$i";
            }
            $publishersFilter.= ") ";
        }

        $backTypesFilter = "";
        if(isset($_GET["backTypes"]) and $_GET["backTypes"] != null){
            $backTypes = $_GET["backTypes"];

            $backTypesFilter = "AND back_type_id IN(:backType0";
            for($i = 1; $i < count($backTypes); $i++){
                $backTypesFilter.= ",:backType$i";
            }
            $backTypesFilter.= ") ";
        }

#endregion
        $query = "SELECT books.id AS bookId, title, description, publish_date, num_of_pages, critics_rating, price, discount, language_id, back_type_id, author_id, publisher_id, category_id, book_images.href AS cover_url FROM books
                    INNER JOIN book_images ON book_images.book_id = books.id

                WHERE book_images.lod_level = ".IMAGE_SIZE_MEDIUM." $searchQuery $authorsFilter $languagesFilter $publishersFilter $backTypesFilter $categoriesFilter
                $sortCrit
                LIMIT :limit OFFSET :offset;";


        
        $stm = $conn->prepare($query);
        
#region Bind params
        $stm->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stm->bindParam(":offset", $offset, PDO::PARAM_INT);

        if($searchQuery != ""){
            $stm->bindParam(":search", $searchQuery);
        }

        if(isset($_GET["categories"]) and $_GET["categories"] != null){
            $categories = $_GET["categories"];

            $stm->bindParam(":category0", $categories[0]);
            for($i = 1; $i < count($categories); $i++){
                $stm->bindParam(":category$i", $categories[$i]);
            }
        }

        if(isset($_GET["languages"]) and $_GET["languages"] != null){
            $languages = $_GET["languages"];

            $stm->bindParam(":language0", $languages[0]);
            for($i = 1; $i < count($languages); $i++){
                $stm->bindParam(":language$i", $languages[$i]);
            }
        }
        
        if(isset($_GET["authors"]) and $_GET["authors"] != null){
            $authors = $_GET["authors"];

            $stm->bindParam(":author0", $authors[0]);
            for($i = 1; $i < count($authors); $i++){
                $stm->bindParam(":author$i", $authors[$i]);
            }
        }

        if(isset($_GET["publishers"]) and $_GET["publishers"] != null){
            $publishers = $_GET["publishers"];

            $stm->bindParam(":publisher0", $publishers[0]);
            for($i = 1; $i < count($publishers); $i++){
                $stm->bindParam(":publisher$i", $publishers[$i]);
            }
        }

        if(isset($_GET["backTypes"]) and $_GET["backTypes"] != null){
            $backTypes = $_GET["backTypes"];

            $stm->bindParam(":backType0", $backTypes[0]);
            for($i = 1; $i < count($backTypes); $i++){
                $stm->bindParam(":backType$i", $backTypes[$i]);
            }
        }
#endRegion

        if(!$stm->execute()){
            output_json_message("Internal server error", 500);
            exit;
        }

        echo json_encode($stm->fetchAll());
    }
    catch(Exception $e){
        output_json_message("Internal server error", 500);
        exit;
    }
?>