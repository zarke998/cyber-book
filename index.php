<?php
    include "models/pages.php";

    $page_src;
    $page_title;
    $main_intro_slider = false;

    if(isset($_GET["page"]))
        $page_id = $_GET["page"];

    switch($page_id){
        default:
            $page_src = "views/home.php";
            $page_title = "CyberBook | Home";
            $main_intro_slider = true;
    }
    

    include "views/fixed/head.php";
    echo getHead($page_title);


    include "views/fixed/header.php";

    if($main_intro_slider)
        include "views/fixed/main_intro_slider.php";
    else
        include "views/fixed/main_intro.php";

    include $page_src;
    include "views/fixed/footer.php"
?>