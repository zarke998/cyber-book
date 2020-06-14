<?php 
    if(session_status() == PHP_SESSION_NONE)
        session_start();

    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    include_once ROOT."/models/pages.php";
    require_once ROOT."/models/online_tracker/get_online_users.php";
?>

<body>

<header>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
                    <?php 
                        if(!isset($_SESSION["user"])) : ?>
                            <div class="header-top top-bg hide-header-top">
                    <?php else: ?>
                        <div class="header-top top-bg">
                    <?php endif; ?>
                            <div class="container-fluid">
                                <div class="col-xl-12">
                                        <div class="row d-flex justify-content-end align-items-center">
                                            <div class="header-info-left d-flex d-none">
                                                <div class="flag d-none">
                                                    <img src="assets/img/icon/header_icon.png" alt="">
                                                </div>
                                                <div class="select-this d-none">
                                                    <form action="#">
                                                        <div class="select-itms">
                                                            <select name="select" id="select1">
                                                                <option value="">USA</option>
                                                                <option value="">SPN</option>
                                                                <option value="">CDA</option>
                                                                <option value="">USD</option>
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                                <ul class="contact-now d-none">     
                                                    <li>+777 2345 7886</li>
                                                </ul>
                                            </div>
                                            <div class="header-info-right d-none">
                                                <ul>                                          
                                                    <li><a href="login.html">My Account </a></li>
                                                    <li><a href="product_list.html">Wish List  </a></li>
                                                    <li><a href="cart.html">Shopping</a></li>
                                                    <li><a href="cart.html">Cart</a></li>
                                                    <li><a href="checkout.html">Checkout</a></li>
                                                </ul>
                                            </div>
                                            <?php 
                                                if(isset($_SESSION["user"])) : ?>
                                                    <span id="online-users-status"><i class="fas fa-circle mr-1"></i>Online users: <?=get_online_users()?></span>
                                            <?php endif;?>
                                        </div>
                                </div>
                            </div>
                        </div>

               <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                                <div class="logo">
                                  <a href="index.php"><img src="assets/img/logo2.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                                <!-- Main-menu -->
                                <div class="main-menu f-left ml-5 d-none d-lg-block">
                                    <nav>                                                
                                        <ul id="navigation">                                                                                                                                    
                                            <?php 
                                                require_once ROOT."/models/menu/select.php";
                                                if(isset($_SESSION["user"]) and $_SESSION["user"]->role_id == 1)
                                                    $menu = get_menu_by_name("header-admin");
                                                else
                                                    $menu = get_menu_by_name("header");

                                                if($menu != null)
                                                    foreach($menu as $menu_item): ?>
                                                        <li><a href="<?= $menu_item->href ?>"><?= $menu_item->item_name ?></a></li>
                                                    <?php endforeach; 
                                            ?>
                                            <?php 
                                                if(isset($_SESSION["user"])) : ?>
                                                    <li class="d-none cart-nav"><a href="index.php?page=<?=Pages::Cart?>">Cart</a></li>
                                                    <li class="d-none logout-nav"><a href="models/account/logout.php">Logout</a></li>
                                            <?php else: ?>

                                                    <li class="d-none cart-nav"><a href="index.php?page=<?=Pages::Cart?>">Cart</a></li>
                                                    <li class="d-none login-nav"><a href="index.php?page=<?=Pages::Login?>">Sign in</a></li>
                                                    <li class="d-none register-nav"><a href="index.php?page=<?=Pages::Register?>">Register</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div> 
                            <div id="cart-account-btns" class="col-xl-5 col-lg-3 col-md-3 col-sm-3 fix-card ">
                                <ul class="header-right f-right d-none d-lg-block d-flex justify-content-between">
                                        <div id="shopping-cart" class="shopping-card">
                                            <span>0</span>
                                            <a href="index.php?page=<?=Pages::Cart?>"><i class="fas fa-shopping-cart"></i></a>
                                        </div>
                                    </li>
                                    <?php
                                        if(isset($_SESSION["user"])) : ?>
                                            <li id="logout-btn" class="d-lg-block"> <a href="models/account/logout.php" class="btn header-btn">Logout</a></li>
                                        <?php else: ?>
                                            <li id="login-btn" class="d-lg-block"> <a href="index.php?page=<?= Pages::Login ?>" class="btn header-btn">Sign in</a></li>
                                            <li id="register-btn" class="d-lg-block"> <a href="index.php?page=<?= Pages::Register ?>" class="btn header-btn">Register</a></li>
                                        <?php endif; ?>
                                </ul>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
</header>