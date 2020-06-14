<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/config.php";
    require_once ROOT."/models/pages.php";
    require_once ROOT."/models/log/log.php";

    function get_page_access_percentages(){
        $log = file(LOG_FILE);
        $total_access_count = count($log);

        $pages_access_count = [];
        for($i = 0; $i < TOTAL_PAGES_NUMBER; $i++)
            $pages_access_count[get_page_name($i)] = 0;


        foreach($log as $line){
            $splitted_line = explode("\t", trim($line));
            $page_name = str_replace("_"," ", $splitted_line[1]);
            
            if($page_name == "") continue;
            $pages_access_count[$page_name]++;
        }

        foreach($pages_access_count as $key => $value){
            if($value != 0)
                $percentage = round(($value / $total_access_count), 2) * 100;
            else
                $percentage = 0;

            $pages_access_count[$key] = $percentage;
        }

        return $pages_access_count;
    }
?>
