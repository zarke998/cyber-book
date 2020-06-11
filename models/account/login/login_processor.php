<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(!defined("ROOT"))
        define("ROOT",$_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";
    require_once ROOT."/models/mailer/send_mail.php";

    function login($email, $password, &$err_json){
        global $conn;

        $emailSlashed = addslashes($email);
        $query = "SELECT * FROM users
                    WHERE email=? AND is_confirmed = 1";

        try{
            $stm = $conn->prepare($query);
            $stm->bindParam(1,$emailSlashed);
            $stm->execute();

            if($stm->rowCount() == 0){
                http_response_code(401);
                $err_json = json_encode(["message" => "User not registered."]);
                return false;
            }

            $user = $stm->fetch();

            if(!password_verify($password, $user->password)){

                $mail_body = "<h4>Failed to login to CyberBook. <br> Reason: Password incorrect. </h4>";
                send_mail($user->email, "CyberBook - Login failed", $mail_body);

                http_response_code(401);
                $err_json = json_encode(["message" => "Password incorrect."]);
                return false;
            }

            $_SESSION["user"] = $user;
            return true;
        }
        catch(Exception $e){
            $mail_body = "<h4>Failed to login to CyberBook. <br> Reason: Internal server error. </h4>";
            send_mail($user->email, "CyberBook - Login failed", $mail_body);

            http_response_code(500);
            $err_json = json_encode(["message" => "Internal server error."]);
            return false;
        }
    }
?>