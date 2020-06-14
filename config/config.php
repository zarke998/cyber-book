<?php
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);  

    define("BASE_URL", "localhost");

    define("ENV_FILE", ROOT."/config/.env");
    define("LOG_FILE", ROOT."/data/log.txt");
    define("SEPARATOR", "&");

    //DB Credentials
    define("SERVER", env("SERVER"));
    define("DBNAME", env("DBNAME"));
    define("USERNAME", env("USERNAME"));
    define("PASSWORD", env("PASSWORD"));
    
    //Mail credentials
    define("MAIL_USERNAME", env("MAIL_USERNAME"));
    define("MAIL_PASSWORD", env("MAIL_PASSWORD"));

    define("TOTAL_PAGES_NUMBER", 10);

    function env($key){
        $keyValuePairs = file(ENV_FILE);
        foreach($keyValuePairs as $pair){
            if(trim($pair) == "") continue;

            $data = explode("=", $pair);
            if($data[0] == $key)
                if(count($data) == 2)
                    return trim($data[1]);
                else
                    return "";
        }
    }
?>