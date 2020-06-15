<?php 
    
    function getHead($title){
        return '
        <!doctype html>
        <html class="no-js" lang="zxx">
            <head>
                <meta charset="utf-8">
                <meta http-equiv="x-ua-compatible" content="ie=edge">
                <title>'.$title.'</title>
                <meta name="author" content="Andrej Zarkovski">
                <meta name="keywords" content="book, store, online bookstore, cheap, modern">
                <meta name="description" content="Online book store. Here you can find the most modern books to read, and never be out of touch with the reading culture. Find the books that you want and need for very low prices.">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="manifest" href="site.webmanifest">
                <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
        
                <!-- CSS here -->
                    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
                    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
                    <link rel="stylesheet" href="/assets/css/flaticon.css">
                    <link rel="stylesheet" href="/assets/css/slicknav.css">
                    <link rel="stylesheet" href="/assets/css/animate.min.css">
                    <link rel="stylesheet" href="/assets/css/magnific-popup.css">
                    <link rel="stylesheet" href="/assets/css/fontawesome-all.min.css">
                    <link rel="stylesheet" href="/assets/css/themify-icons.css">
                    <link rel="stylesheet" href="/assets/css/slick.css">
                    <link rel="stylesheet" href="/assets/css/nice-select.css">
                    <link rel="stylesheet" href="/assets/css/style.css">
                    <link rel="stylesheet" href="/assets/css/main.css">
           </head>';
        }

?>