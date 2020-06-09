<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";

    function get_menu_by_name($name){
        global $conn;

        try{
            $query = "SELECT menu_items.name AS item_name, href FROM menus
            INNER JOIN menu_items ON menus.id = menu_items.menu_id
            WHERE menus.name = ?
            ORDER BY order_index";
            $stm = $conn->prepare($query);
            $stm->bindParam(1, $name);
            $stm->execute();

            return $stm->fetchAll();
        }
        catch(Exception $e){
            return null;
        }
    }
?>