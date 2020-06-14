<?php
    if(!defined("ROOT"))
        define("ROOT",$_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";
    require_once ROOT."/models/pages.php";
    require_once ROOT."/models/mailer/send_mail.php";

    include_once ROOT."/models/log/log.php"; 

    function register($email, $password, &$err_json = null){
        global $conn;

        if(!preg_match("/^[a-z]+[a-z\d]{2,}(\.[a-z\d]+)*@[a-z]{2,}(\.[a-z]{2,})+$/", $email)){
            http_response_code(422); // 422 - Unprocessable entity
            $err_json = json_encode(["message" => "Server message: Email must contain only lowercase letters and numbers and dots(.)"]);
            return false;
        }
        else if(!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)){
            http_response_code(422); // 422 - Unprocessable entity
            $err_json = json_encode(["message" => "Server message: Password must contain one lowercase, uppercase letter and a number. And must be at least 8 characters long."]);
            return false;
        }
        

        try{
            if(checkUserRegistered($email)){
                http_response_code(409); // 409 - Conflict
                $err_json = json_encode(["message" => "User already registered."]);
                return false;
            }

            $emailSlashed = addslashes($email);
            $password = password_hash($password, PASSWORD_DEFAULT);
            $activation_key = bin2hex(random_bytes(16));

            $query = "INSERT INTO users(id,email,password, activation_key, is_confirmed, role_id)
                                VALUES(NULL, :email, :password, :activation_key, :is_confirmed, :role_id)";
            $stm = $conn->prepare($query);
            $stm->bindParam(":email", $emailSlashed);
            $stm->bindParam(":password", $password);
            $stm->bindParam(":activation_key", $activation_key);
            $stm->bindValue(":is_confirmed", false, PDO::PARAM_BOOL);
            $stm->bindValue(":role_id", 2, PDO::PARAM_INT); // User role


            if(!$stm->execute()){
                http_response_code(500);
                $err_json = json_encode(["message" => "SERVER ERROR: Error registering user."]);
                return false;
            }
            $uid = $conn->lastInsertId();


            // Send activation link
            $regiserPage = Pages::Register;
            $mailBody = '<h2>Please activate your account by clicking on the link below.</h2>
                        <p>Click here: <a href="localhost/index.php?page='.$regiserPage.'&uid='.$uid.'&activation_key='.$activation_key.'"> activation link.</a>';
            $send_error = "";
            if(send_mail($email, "CyberBook - Account activation",$mailBody, $send_error)){
                return true;
            }
            else{
                $err_json = json_encode(["message" => "Error sending activation link. Try resending activation key."]);
                // log $send_error
                return false;
            }


        }
        catch(Exception $e){
            http_response_code(500);
            $err_json = json_encode(["message" => "SERVER ERROR: Error registering user."]);

            log_error("Error registering user. Exception {$e->getMessage()}");
            return false;
        }
    }

    function checkUserRegistered($email){
        global $conn;

        $email = addslashes($email);

        $query = "SELECT * FROM users WHERE email=:email";
        $stm = $conn->prepare($query);
        $stm->bindParam(":email", $email);

        $stm->execute();
        if($stm->rowCount() > 0)
            return true;

        return false;
    }
?>