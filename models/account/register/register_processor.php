<?php
    if(!defined("ROOT"))
        define("ROOT",$_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";

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

            $email = addslashes($email);
            $password = password_hash($password, PASSWORD_DEFAULT);
            $activation_key = bin2hex(random_bytes(16));

            $query = "INSERT INTO users(id,email,password, activation_key, is_confirmed, role_id)
                                VALUES(NULL, :email, :password, :activation_key, :is_confirmed, :role_id)";
            $stm = $conn->prepare($query);
            $stm->bindParam(":email", $email);
            $stm->bindParam(":password", $password);
            $stm->bindParam(":activation_key", $activation_key);
            $stm->bindValue(":is_confirmed", true, PDO::PARAM_BOOL);
            $stm->bindValue(":role_id", 2, PDO::PARAM_INT); // User role


            if(!$stm->execute()){
                http_response_code(500);
                $err_json = json_encode(["message" => "SERVER ERROR: Error registering user."]);
                return false;
            }

            return true;
        }
        catch(Exception $e){
            http_response_code(500);
            $err_json = json_encode(["message" => "SERVER ERROR: Error registering user."]);
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