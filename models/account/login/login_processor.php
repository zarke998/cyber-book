<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(!defined("ROOT"))
        define("ROOT",$_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";

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
                http_response_code(401);
                $err_json = json_encode(["message" => "Password incorrect."]);
                return false;
            }

            $_SESSION["user"] = $user;
            return true;
        }
        catch(Exception $e){
            http_response_code(500);
            $err_json = json_encode(["message" => "Internal server error."]);
            return false;
        }
    }
?>