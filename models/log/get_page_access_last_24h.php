<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/config.php";
    require_once ROOT."/models/pages.php";

    function get_page_access_last_24h(){
        $log = file(LOG_FILE);

        $pages_access_count = [];
        for($i = 0; $i < TOTAL_PAGES_NUMBER; $i++)
            $pages_access_count[get_page_name($i)] = 0;

        $current_time = time();
        foreach($log as $line){
            $splitted_line = explode("\t", trim($line));
            $page_name = str_replace("_"," ", $splitted_line[1]);

            if($page_name == "") continue;

            $date_accessed = strtotime($splitted_line[3]);
            if($current_time - $date_accessed < 86400) // sekundi u danu
                $pages_access_count[$page_name]++;
        }

        return $pages_access_count;
    }
?>
