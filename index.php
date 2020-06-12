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

    $admin_pages = [Pages::Admin, Pages::Admin_Add_Book, Pages::Admin_Update_Book, Pages::Admin_Delete_Book];

    switch($page_id){
        case Pages:: Home :
            $page_src = "views/home.php";
            $page_title = "Home";
            $main_intro_slider = true;
            $scripts[] = "/assets/js/cyber-book/home.js";
            break;
        case Pages::Shop :
            $page_src = "views/shop.php";
            $page_title = "Shop";
            $scripts[] = "/assets/js/cyber-book/shop.js";
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
            $page_src = "views/admin/admin.php";
            $page_title = "Admin";
            break;
        case Pages::Admin_Add_Book :
            $page_src = "views/admin/admin_add_book.php";
            $page_title = "Admin";
            $scripts[] = "/assets/js/cyber-book/admin-content.js";
            break;
        case Pages::Admin_Update_Book :
            $page_src = "views/admin/admin_update_book.php";
            $page_title = "Admin";
            $scripts[] = "/assets/js/cyber-book/admin-content.js";
            break;
        case Pages::Admin_Delete_Book :
            $page_src = "views/admin/admin_delete_book.php";
            $page_title = "Admin";
            $scripts[] = "/assets/js/cyber-book/admin-content.js";
            break;
        default : // 404
            $page_src = "views/error_page.php";
            $page_title = "Error";
            $error_title = "404 - Page not found.";
            $error_msg = "We are sorry, the page you are looking for doesn't exist.";
            break;
    }

    if(in_array($page_id, $admin_pages) and (!isset($_SESSION["user"]) or $_SESSION["user"]->role_id != 1)){
        $page_src = "views/error_page.php";
        $page_title = "Error";
        $error_title = "403 - Forbidden Access";
        $error_msg = "We are sorry, but this page is forbidden for non-admin users.";
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