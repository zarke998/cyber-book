<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/config/config.php";
    require_once ROOT."/models/pages.php";

    logConnection();

    try{
        $dbname = DBNAME;
        $host = SERVER;

        $conn = new PDO("mysql:host=$host;dbname=$dbname", USERNAME, PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }
    catch(Exception $e){
        echo "Error connecting to database.";
    }

    function logConnection(){
        $file = fopen(LOG_FILE, 'a');
        if($file){
            $date = date('Y-m-d H:i:s');

            if(strpos($_SERVER["PHP_SELF"],"index.php") === false) return;

            $page_id = 0;
            if(isset($_GET["page"]))
                $page_id = $_GET["page"];

            $page_name = str_replace(" ", "_", get_page_name($page_id));
            fwrite($file, "{$_SERVER["REQUEST_URI"]}\t$page_name\t{$_SERVER["REMOTE_ADDR"]}\t$date\n");
            fclose($file);
        }
    }
?>