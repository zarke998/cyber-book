<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/models/pages.php";
    require_once ROOT."/models/book/get_book_rand_discount.php";

    $book_rand_discount = get_book_rand_discount();
?>

<div class="slider-area ">
            <!-- Mobile Menu -->
            <div class="slider-active">
                <div id="main-intro-slider" class="single-slider slider-height" data-background="assets/img/hero/h1_hero.jpg">
                    <div class="container">
                        <div class="row d-flex justify-content-between pt-8 pb-5">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-none d-md-block">
                                <div id="main-intro-slider-image" class="hero__img" data-animation="fadeIn" data-delay=".4s">
                                    <img src="<?=$book_rand_discount->cover_url?>" alt="">
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-8 mt-5">
                                <div id="main-intro-slider-info" class="hero__caption">
                                    <span data-animation="fadeInRight" data-delay=".4s"><?=$book_rand_discount->discount?>% Discount</span>
                                    <h1 class="text-stroke-black-2"data-animation="fadeInRight" data-delay=".6s"><?=$book_rand_discount->title?></h1>
                                    <p class="mt-5" data-animation="fadeInRight" data-delay=".8s"><?=$book_rand_discount->description?></p>
                                    <!-- Hero-btn -->
                                    <div class="hero__btn" data-animation="fadeInRight" data-delay="1s">
                                        <a href="index.php?page=<?=Pages::Shop?>" class="btn hero-btn">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="single-slider slider-height" data-background="assets/img/hero/h1_hero.jpg">
                    <div class="container">
                        <div class="row d-flex align-items-center justify-content-between">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-none d-md-block">
                                <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                                    <img src="assets/img/hero/hero_man.png" alt="">
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-8">
                                <div class="hero__caption">
                                    <span data-animation="fadeInRight" data-delay=".4s">60% Discount</span>
                                    <h1 data-animation="fadeInRight" data-delay=".6s">Winter <br> Collection</h1>
                                    <p data-animation="fadeInRight" data-delay=".8s">Best Cloth Collection By 2020!</p>
                                     Hero-btn 
                                    <div class="hero__btn" data-animation="fadeInRight" data-delay="1s">
                                        <a href="industries.html" class="btn hero-btn">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>