<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/connection.php";
    include_once ROOT."/models/log/log.php";

    function get_criterias_by_area($area_name){
        global $conn;

        try{
            $query = "SELECT sort_criterias.id AS sort_id, sort_criterias.name AS sort_name, query FROM sort_criterias
                        INNER JOIN sort_area_items ON sort_area_items.item_id = sort_criterias.id
                        INNER JOIN sort_area ON sort_area.id = sort_area_items.area_id
                        WHERE sort_area.name = ?";
            $stm = $conn->prepare($query);
            $stm->bindParam(1, $area_name);
            
            if(!$stm->execute()){
                return null;
            }

            return $stm->fetchAll();
        }
        catch(Exception $e){
            log_error("Error fetching criterias by area. Exception: {$e->getMessage()}");
            return null;
        }
        
    }
?>