<?php
    if(!defined("ROOT"))
        define("ROOT",$_SERVER["DOCUMENT_ROOT"]);

        require_once ROOT."/models/pages.php";
?>

<main>

        <!-- Category Area Start-->
        <section class="category-area section-padding30">
            <div class="container-fluid">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center mb-85">
                            <h2>Shop by Category</h2>
                        </div>
                    </div>
                </div>
                <div id="main-shop-categories" class="row justify-content-center">
                    <?php 
                        require_once ROOT."/models/category/get_rand_categories.php";
                        require_once ROOT."/models/utilities/shuffled_number_array.php";
                        $categories_rand = get_rand_categories(3);

                        $array_rand = generate_shuffled_number_array(3);

                        for($i = 0; $i < 3; $i++): ?>
                            <div class="col-xl-4 col-lg-6">
                                <div class="single-category mb-30">
                                    <div class="category-img category-random" data-id="<?=$categories_rand[$array_rand[$i]]->id?>">
                                        <a href="index.php?page=<?=Pages::Shop?>">
                                            <img src="/assets/images/category-wallpapers/wallpaper-<?=$array_rand[$i] + 1?>.jpg" alt="Category wallpaper">
                                            <div class="category-caption">
                                                <h2 class="text-stroke-black-1 mr-3"><?=$categories_rand[$array_rand[$i]]->name?></h2>
                                            </div>
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                        <?php endfor; ?>
                </div>
            </div>
        </section>
        <!-- Category Area End-->
        <!-- Latest Products Start -->
        <section class="latest-product-area pb-3">
            <div class="container-fluid px-4 px-md-5">
                <div class="row product-btn d-flex align-items-end">
                    <!-- Section Tittle -->
                    <div class="col-12">
                        <div class="section-tittle mb-30">
                            <h2>Most Recent Titles</h2>
                        </div>
                    </div>
                </div>
                <!-- Nav Card -->
                <div class="tab-content" id="nav-tabContent">
                    <!-- card one -->
                    <div class="most-popular-titles tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div id="most-recent-titles" class="row justify-content-center">
                        </div>
                    </div>
                </div>
                <!-- End Nav Card -->
            </div>
        </section>
        <!-- Latest Products End -->
        <!-- Latest Offers Start -->
        <div class="latest-wrapper lf-padding">
            <div id="newsletter-area" class="latest-area latest-height d-flex align-items-center">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-5 col-lg-5 col-md-6 offset-xl-1 offset-lg-1">
                            <div class="latest-caption">
                                <h2 class="text-stroke-white-1">Get Our<br>Latest Offers News</h2>
                                <p>Subscribe to the newsletter</p>
                            </div>
                        </div>
                         <div class="col-xl-5 col-lg-5 col-md-6 ">
                            <div class="latest-subscribe">
                                <form id="newsletterControls" action="#">
                                    <input id="newsletterEmail" type="email" placeholder="Your email here">
                                    <button id="newsletterBtn">Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Latest Offers End -->
        <?php
            include ROOT."/views/fixed/bullet_points.php";
        ?>
        <!-- Gallery Start-->
        <div id="best-by-critics">
            <div class="section-tittle mb-30 ml-4">
                <h2>Best by critics</h2>
            </div>
            <div id="bestByCriticsContainer" class="row mx-0 px-4 justify-content-center latest-product-area">
                <div class="col-lg-2 col-sm-4 col-6 px-4 px-lg-2 mb-4 best-by-critics-item text-center">
                    <img src="assets/images/book-cover-1.jpg" alt="">
                    <a href="#">Green Dress with details</a>
                </div> 
                <div class="col-lg-2 col-sm-4 col-6 px-4 px-lg-2 mb-4 best-by-critics-item">
                    <img src="assets/images/book-cover-1.jpg" alt="">
                </div> 
                <div class="col-lg-2 col-sm-4 col-6 px-4 px-lg-2 mb-4 best-by-critics-item">
                    <img src="assets/images/book-cover-1.jpg" alt="">
                </div> 
                <div class="col-lg-2 col-sm-4 col-6 px-4 px-lg-2 mb-4 best-by-critics-item">
                    <img src="assets/images/book-cover-1.jpg" alt="">
                </div> 
                <div class="col-lg-2 col-sm-4 col-6 px-4 px-lg-2 mb-4 best-by-critics-item">
                    <img src="assets/images/book-cover-1.jpg" alt="">
                </div> 
                <div class="col-lg-2 col-sm-4 col-6 px-4 px-lg-2 mb-4 best-by-critics-item">
                    <img src="assets/images/book-cover-1.jpg" alt="">
                </div> 
            </div>
        </div>
        <!-- Gallery End-->

    </main>