<?php 
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(!defined("ROOT"))
        define("ROOT",$_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";
    require_once ROOT."/models/image/get_images_by_book.php";
    
    header("Content-Type: application/json");

    if(!isset($_SESSION["user"]) or $_SESSION["user"]->role_id != 1 or !isset($_POST["deleteBookBtn"])){
        http_response_code(403);
        echo json_encode(["message" => "Access forbidden."]);
        exit;
    }

#region POST variables
    $id = $_POST["bookId"];
#endregion  

    try{
        $query = "DELETE FROM books WHERE id=?";
        $stm = $conn->prepare($query);
        $stm->bindParam(1, $id);

        // Delete images
        $images = get_images_by_book($id);
        foreach($images as $i){
            $path = ROOT.$i->href;
            unlink($path);
        }

        if(!$stm->execute()){
            output_json("Internal server error.", 500);
            exit;
        }
#endregion
        
        output_json("Book deleted successfuly.", 200);
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