<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/models/sort/get_criterias_by_area.php";
    
    require_once ROOT."/models/category/get_all.php";
    require_once ROOT."/models/language/get_all.php";
    require_once ROOT."/models/author/get_all.php";
    require_once ROOT."/models/publisher/get_all.php";
    require_once ROOT."/models/back-type/get_all.php";
?>

<div id="shop-main">
<section class="latest-product-area latest-padding">
    <div class="row px-4">
        <div class="col-9">
            <div class="container-fluid">
                <div id="shop-upper-controls" class="row product-btn d-flex justify-content-between">
                    <div class="select-this d-flex">
                        <div class="featured">
                            <span>Sort by: </span>
                        </div>
                        <form action="#">
                            <div class="select-itms ml-2">
                                <select name="select" id="sort-select">
                                    <?php 
                                        $sort_criterias = get_criterias_by_area("shop_sort");

                                        foreach($sort_criterias as $crit) : ?>
                                            <option value="<?= $crit->sort_id ?>"><?= $crit->sort_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </form>
                    </div>
                    <nav aria-label="Pagination">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link page-link-arrow" href="#" data-increment="-1" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <div class="pagination-pages d-flex">
                                
                            </div>
                            <li class="page-item">
                                <a class="page-link page-link-arrow" href="#" data-increment="1" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Nav Card -->
                <div class="tab-content" id="nav-tabContent">
                    <!-- card one -->
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div id="shop-container" class="row">
                            <div class="col-lg-3 col-sm-4 col-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                        <img src="assets/images/book-cover-1.jpg" alt="">
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                        <h4><a href="#">Green Dress with details</a></h4>
                                        <div class="price">
                                            <ul>
                                                <li>$40.00</li>
                                                <li class="discount">$60.00</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-4 col-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                        <img src="assets/images/book-cover-1.jpg" alt="">
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                        <h4><a href="#">Green Dress with details</a></h4>
                                        <div class="price">
                                            <ul>
                                                <li>$40.00</li>
                                                <li class="discount">$60.00</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-4 col-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                        <img src="assets/images/book-cover-1.jpg" alt="">
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                        <h4><a href="#">Green Dress with details</a></h4>
                                        <div class="price">
                                            <ul>
                                                <li>$40.00</li>
                                                <li class="discount">$60.00</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-4 col-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                        <img src="assets/images/book-cover-1.jpg" alt="">
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                        <h4><a href="#">Green Dress with details</a></h4>
                                        <div class="price">
                                            <ul>
                                                <li>$40.00</li>
                                                <li class="discount">$60.00</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-4 col-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                        <img src="assets/images/book-cover-1.jpg" alt="">
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                        <h4><a href="#">Green Dress with details</a></h4>
                                        <div class="price">
                                            <ul>
                                                <li>$40.00</li>
                                                <li class="discount">$60.00</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-4 col-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                        <img src="assets/images/book-cover-1.jpg" alt="">
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                        <h4><a href="#">Green Dress with details</a></h4>
                                        <div class="price">
                                            <ul>
                                                <li>$40.00</li>
                                                <li class="discount">$60.00</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-4 col-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                        <img src="assets/images/book-cover-1.jpg" alt="">
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                        <h4><a href="#">Green Dress with details</a></h4>
                                        <div class="price">
                                            <ul>
                                                <li>$40.00</li>
                                                <li class="discount">$60.00</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-4 col-6">
                                <div class="single-product mb-60">
                                    <div class="product-img">
                                        <img src="assets/images/book-cover-1.jpg" alt="">
                                    </div>
                                    <div class="product-caption">
                                        <div class="product-ratting">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star low-star"></i>
                                            <i class="far fa-star low-star"></i>
                                        </div>
                                        <h4><a href="#">Green Dress with details</a></h4>
                                        <div class="price">
                                            <ul>
                                                <li>$40.00</li>
                                                <li class="discount">$60.00</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <nav aria-label="Pagination">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link page-link-arrow" href="#" data-increment="-1" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>

                            <div class="pagination-pages d-flex">
                                
                            </div>

                            <li class="page-item">
                                <a class="page-link page-link-arrow" href="#" data-increment="1" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="models/public/books_cheapest_excel_export.php" class="btn header-btn d-inline-block mx-auto mt-5">Download cheapest books excel</a>
                </div>
                <!-- End Nav Card -->
            </div>
        </div>
        <div class="col-3 pr-4 shop-filters">
            <div class="shop-filter d-flex flex-column align-items-end">
                <h4>Category</h4>
                <ul>
                    <?php 
                        $categories = get_all_categories();
                        
                        foreach($categories as $c) : ?>
                            <li class="d-flex align-items-center">
                                <input type="checkbox" class="shop-category mr-2" name="shop-categories[]" value="<?= $c->id ?>" />
                                <span><?= $c->name ?></span>
                            </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="shop-filter d-flex flex-column align-items-end">
                <h4>Language</h4>
                <ul>
                    <?php 
                        $languages = get_all_languages();
                        
                        foreach($languages as $l) : ?>
                            <li class="d-flex align-items-center">
                                <input type="checkbox" class="shop-category mr-2" name="shop-languages[]" value="<?= $l->id ?>" />
                                <span><?= $l->name ?></span>
                            </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="shop-filter d-flex flex-column align-items-end">
                <h4>Author</h4>
                <ul>
                    <?php 
                        $authors = get_all_authors();
                        
                        foreach($authors as $a) : ?>
                            <li class="d-flex align-items-center">
                                <input type="checkbox" class="shop-category mr-2" name="shop-authors[]" value="<?= $a->id ?>" />
                                <span><?= $a->name ?></span>
                            </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="shop-filter d-flex flex-column align-items-end">
                <h4>Publisher</h4>
                <ul>
                    <?php 
                        $publishers = get_all_publishers();
                        
                        foreach($publishers as $p) : ?>
                            <li class="d-flex align-items-center">
                                <input type="checkbox" class="shop-category mr-2" name="shop-publishers[]" value="<?= $p->id ?>" />
                                <span><?= $p->name ?></span>
                            </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="shop-filter d-flex flex-column align-items-end">
                <h4>Back type</h4>
                <ul>
                    <?php 
                        $back_types = get_all_back_types();
                        
                        foreach($back_types as $bt) : ?>
                            <li class="d-flex align-items-center">
                                <input type="checkbox" class="shop-category mr-2" name="shop-back-types[]" value="<?= $bt->id ?>" />
                                <span><?= $bt->name ?></span>
                            </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php
    include ROOT."/views/fixed/bullet_points.php";
?>
</div>
