<?php
    header("Content-Type: application/json");
    
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/models/mailer/send_mail.php";
    require_once ROOT."/models/utilities/json_utilities.php";
    include_once ROOT."/models/log/log.php";
    

    if(!isset($_POST["contactBtn"])){
        http_response_code(403);
        echo json_encode(["message" => "Access forbidden."]);
        exit;
    }

    $message = $_POST["message"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];

    if(strlen($message) < 20 || strlen($message) >  100){
        output_json_message("Server message: Message must be at least 20 chars long, and shorter than 100 characters.", 406); // 406 - Not acceptable
        exit;
    }

    if(!preg_match("/^[A-Z][a-z]{2,}$/", $name)){
        output_json_message("Name must start with an uppercase letter and follow with lowercase letters.", 406); // 406 - Not acceptable
        exit;
    }

    if(!preg_match("/^[a-z]+[a-z\d]{2,}(\.[a-z\d]+)*@[a-z]{2,}(\.[a-z]{2,})+$/", $email)){
        output_json_message("Server message: Email must contain only lowercase letters and numbers and dots(.)", 406); // 406 - Not acceptable
        exit;
    }

    if(!preg_match("/^[A-Z]/", $subject)){
        output_json_message("Subject must start with an uppercase letter.", 406); // 406 - Not acceptable
        exit;
    }

    try{
        if(send_mail("cyber.book123@gmail.com","$name - $subject", $message . " Sender mail: $email")){
            output_json_message("Message sent successfuly.", 200);
            exit;
        }
        else{
            output_json_message("Error sending message.", 500);
            exit;    
        }
    }
    catch(Exception $e){
        output_json_message("Internal server error.", 500);

        log_error("Error sending contact form data. Exception: {$e->getMessage()}");
        exit;
    }
    
    
?>