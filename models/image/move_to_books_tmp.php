<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    function move_to_books_tmp($tmp_file_name, $extension){
        $time = hrtime(true);
        $tmp_path = ROOT."/assets/images/books/tmp/".$time.".$extension";

        move_uploaded_file($tmp_file_name, $tmp_path);

        return $tmp_path;
    }
?>