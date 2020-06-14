<?php
    header("Content-Type: application/json");
    
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/config.php";
    require_once ROOT."/models/pages.php";
    require_once ROOT."/config/connection.php";
    require_once ROOT."/models/mailer/send_mail.php";
    require_once ROOT."/models/user/select.php";

    include_once ROOT."/models/log/log.php";
    

    if(!isset($_POST["email"])){
        http_response_code(400);
        echo json_encode(["message" => "Incomplete input data."]);
        exit;
    }

    $email = $_POST["email"];
    if(!preg_match("/^[a-z]+[a-z\d]{2,}(\.[a-z\d]+)*@[a-z]{2,}(\.[a-z]{2,})+$/", $email)){
        http_response_code(422); // 422 - Unprocessable entity

        header("Content-Type: application/json");
        echo json_encode(["message" => "Server message: Email must contain only lowercase letters and numbers and dots(.)"]);
        exit;
    }

    try{
        $user = get_user_by_email($email);
        if($user == null){
            http_response_code(400);
            echo json_encode(["message" => "You have not registered yet."]);
            exit;
        }

        $emailSlashed = addslashes($email);
        $activation_key = bin2hex(random_bytes(16));

        $query = "UPDATE users
                    SET activation_key = :activation_key
                    WHERE id=:id AND is_confirmed = 0";
        $stm = $conn->prepare($query);
        $stm->bindParam(":id",$user->id);
        $stm->bindParam(":activation_key",$activation_key);
        $stm->execute();

        if($stm->rowCount() > 0){
            $regiserPage = Pages::Register;
            $mailBody = '<h2>Please activate your account by clicking on the link below.</h2>
                        <p>Click here: <a href="'.BASE_URL.'/index.php?page='.$regiserPage.'&uid='.$user->id.'&activation_key='.$activation_key.'"> activation link.</a>';
            $send_error = "";
            if(send_mail($email, "CyberBook - Activation key (resend)", $mailBody, $send_error)){
                http_response_code(200);
                echo json_encode(["message" => "Activation link sent."]);
                exit;
            }
            else{
                http_response_code(500);
                echo json_encode(["message" => "SERVER ERROR: Error sending mail."]);
                exit;
            }
        }
        else{
            http_response_code(200);
            echo json_encode(["message" => "You have already registered."]);
            exit;
        }
    }
    catch(Exception $e){
        http_response_code(500);
        echo json_encode(["message" => "Internal server error."]);

        log_error("Error resending activation link. Exception: {$e->getMessage()}");
        exit;
    }
    
    
?>