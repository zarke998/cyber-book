<?php
    ob_start();
    include "models/pages.php";

    $website_name = "CyberBook";

    $page_id = Pages::Home;
    $page_src;
    $page_title;

    $main_intro_slider = false;
    
    $scripts = [];

    if(isset($_GET["page"]))
        $page_id = $_GET["page"];

    switch($page_id){
        case Pages::Shop :
            $page_src = "views/shop.php";
            $page_title = "Shop";
            break;
        case Pages::Contact :
            $page_src = "views/contact.php";
            $page_title = "Contact";
            break;
        case Pages::About :
            $page_src = "views/about.php";
            $page_title = "About";
            break;            
        case Pages::Login :
            $page_src = "views/login.php";
            $page_title = "Login";
            $scripts = ["/assets/js/cyber-book/login.js"];
            break;
        case Pages::Register :
            $page_src = "views/register.php";
            $page_title = "Register";
            $scripts = ["/assets/js/cyber-book/register.js"];
            break;
        default : // Pages::Home:
            $page_src = "views/home.php";
            $page_title = "Home";
            $main_intro_slider = true;
            $scripts = [];
            break;
    }
    

    include "views/fixed/head.php";
    echo getHead($website_name." | ".$page_title);


    include "views/fixed/header.php";

    if($main_intro_slider)
        include "views/fixed/main_intro_slider.php";
    else
    { 
        include "views/fixed/main_intro.php";
        echo getMainIntro($page_title);
    }


    include $page_src;

    include "views/fixed/footer.php";
    echo getFooter($scripts);

    ob_end_flush();
?>