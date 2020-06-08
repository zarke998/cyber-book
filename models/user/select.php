<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";

    function get_user_by_email($email){
        global $conn;

        $emailSlashed = addslashes($email);

        $query = "SELECT * FROM users WHERE email=?";
        $stm = $conn->prepare($query);
        $stm->bindParam(1, $emailSlashed);
        $stm->execute();

        $user = $stm->fetch();
        if(!$user){
            return null;
        }
        return $user;
    }
?>