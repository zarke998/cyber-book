<?php
    if(session_status() == PHP_SESSION_NONE)
        session_start();    

    ob_start();
    include "models/pages.php";

    $website_name = "CyberBook";

    $page_id = Pages::Home;
    $page_src;
    $page_title;

    $main_intro_slider = false;
    
    $scripts = ["/assets/js/cyber-book/main.js"];

    if(isset($_GET["page"]))
        $page_id = $_GET["page"];

    // $admin_pages = [Pages::Admin, Pages::Admin_Add_Book, Pages::Admin_Update_Book, Pages::Admin_Delete_Book];

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
            $scripts[] = "/assets/js/cyber-book/login.js";
            break;
        case Pages::Register :
            $page_src = "views/register.php";
            $page_title = "Register";
            $scripts[] = "/assets/js/cyber-book/register.js";
            break;
        case Pages::Admin :

            if(isset($_SESSION["user"]) and $_SESSION["user"]->role_id == 1){
                $page_src = "views/admin/admin.php";
                $page_title = "Admin";
            }
            else{
                $page_src = "views/error_page.php";
                $page_title = "Error";
                $error_title = "403 - Forbidden Access";
                $error_msg = "We are sorry, but this page is forbidden for non-admin users.";
            }
            break;
        default : // Pages::Home:
            $page_src = "views/home.php";
            $page_title = "Home";
            $main_intro_slider = true;
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