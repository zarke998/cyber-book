<?php 
    header("Content-Type: application/json");

    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";
    require_once ROOT."/models/mailer/send_mail.php";
    require_once ROOT."/models/utilities/json_utilities.php";

    if(!isset($_POST["registerSubscriberBtn"])){
        output_json_message("Access forbidden.", 403);
        exit;
    }

    $email = $_POST["email"];

    if(!preg_match("/^[a-z]+[a-z\d]{2,}(\.[a-z\d]+)*@[a-z]{2,}(\.[a-z]{2,})+$/", $email)){
        output_json_message("Server message: Email must contain only lowercase letters and numbers and dots(.)", 406); // 406 - Not acceptable
        exit;
    }

    if(checkIfSubscriberExists($email)){
        output_json_message("You have already subscribed for newsletter.", 409); // 409 - Conflict
        exit;
    }

    try{
        $query = "INSERT INTO newsletter_subscribers
                    VALUES(NULL, ?)";
        $stm = $conn->prepare($query);
        $stm->bindParam(1, $email);
        
        if(!$stm->execute()){
            output_json_message("Internal server error", 500);
            exit;
        }

        $mail_body = "<h4>Thank you for subscribing to our newsletter.</h4>";
        send_mail($email, "CyberBook - Newsletter subscription", $mail_body);

        output_json_message("You have subscribed successfuly", 200);
        exit;
    }
    catch(Exception $e){
        output_json_message("Internal server error", 500);
        exit;
    }

    function checkIfSubscriberExists($email){
        global $conn;

        try{
            $query = "SELECT * FROM newsletter_subscribers
                        WHERE email=?";
            $stm = $conn->prepare($query);
            $stm->bindParam(1,$email);
            
            if(!$stm->execute()){
                return false;
            }

            return $stm->rowCount() > 0;

        }
        catch(Exception $e){
            return false;
        }
    }
?>