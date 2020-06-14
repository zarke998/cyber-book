<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/models/language/get_all.php";
    require_once ROOT."/models/author/get_all.php";
    require_once ROOT."/models/publisher/get_all.php";
    require_once ROOT."/models/back-type/get_all.php";
    require_once ROOT."/models/book/get_all.php";
    require_once ROOT."/models/category/get_all.php";
?>

<div id="admin-add-book-container" class="container-fluid admin-content-container">
    <h2 class="text-center my-4">Update book</h2>
    <div class="row mx-0">
        <form class="col-sm-8 offset-sm-2 px-1 col-md-6 offset-md-3" action="#" method="post">
            <div class="form-group row align-items-center">
                <span class="col-sm-4">Book to update: </span>
                <div class="col-sm-8 px-0 d-flex align-items-center book-prop-add">
                    <select name="bookId">
                        <option value="0">Select book:</option>
                        <?php 
                            $books = get_all_books(BOOK_TITLE_ONLY);

                            foreach($books as $b) : ?>
                                <option value="<?=$b->id?>"><?=$b->title?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <span class="col-sm-4">Title</span>
                <input class="form-control col-sm-8" type="text" name="bookTitle" />
            </div>
            <div class="form-group row align-items-center">
                <span class="col-sm-4">Description</span>
                <textarea class="form-control col-sm-8" type="text" name="bookDescription"></textarea>
            </div>
            <div class="form-group row align-items-center">
                <span class="col-sm-4">Category</span>
                <div class="col-sm-8 px-0 d-flex align-items-center book-prop-add">
                    <input class="form-control" type="text" name="bookCategoryNew" placeholder="Add new category" />
                    <select name="bookCategory">
                        <option value="0">Select category:</option>
                        <?php 
                            $categories = get_all_categories();

                            foreach($categories as $c) : ?>
                                <option value="<?=$c->id?>"><?=$c->name?></option>
                        <?php endforeach; ?>
                    </select>
                    <i class="far fa-plus-square"></i>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <span class="col-sm-4">Language</span>
                <div class="col-sm-8 px-0 d-flex align-items-center book-prop-add">
                    <input class="form-control" type="text" name="bookLanguageNew" placeholder="Add new language"/>
                    <select name="bookLanguage">
                        <option value="0">Select language:</option>
                        <?php 
                            $languages = get_all_languages();

                            foreach($languages as $l) : ?>
                                <option value="<?=$l->id?>"><?=$l->name?></option>
                        <?php endforeach; ?>
                    </select>
                    <i class="far fa-plus-square"></i>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <span class="col-sm-4">Author</span>
                <div class="col-sm-8 px-0 d-flex align-items-center book-prop-add">
                    <input class="form-control" type="text" name="bookAuthorNew" placeholder="Add new author" />
                    <select name="bookAuthor">
                        <option value="0">Select author:</option>
                        <?php 
                            $authors = get_all_authors();

                            foreach($authors as $a) : ?>
                                <option value="<?=$a->id?>"><?=$a->name?></option>
                        <?php endforeach; ?>
                    </select>
                    <i class="far fa-plus-square"></i>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <span class="col-sm-4">Publisher</span>
                <div class="col-sm-8 px-0 d-flex align-items-center book-prop-add">
                    <input class="form-control" type="text" name="bookPublisherNew" placeholder="Add new publisher"/>
                    <select name="bookPublisher">
                        <option value="0">Select publisher:</option>
                        <?php 
                            $publishers = get_all_publishers();

                            foreach($publishers as $p) : ?>
                                <option value="<?=$p->id?>"><?=$p->name?></option>
                        <?php endforeach; ?>
                    </select>
                    <i class="far fa-plus-square"></i>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <span class="col-sm-4">Publish Date</span>
                <input class="form-control col-sm-8" type="date" name="bookPublishDate"/>
            </div>
            <div class="form-group row align-items-center">
                <span class="col-sm-4">Back Type</span>
                <div class="col-sm-8 px-0 d-flex align-items-center book-prop-add">
                    <input class="form-control" type="text" name="bookBackTypeNew" placeholder="Add new back type"/>
                    <select name="bookBackType">
                        <option value="0">Select back type:</option>
                        <?php 
                            $back_types = get_all_back_types();

                            foreach($back_types as $bt) : ?>
                                <option value="<?=$bt->id?>"><?=$bt->name?></option>
                        <?php endforeach; ?>
                    </select>
                    <i class="far fa-plus-square"></i>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <span class="col-sm-4">Num. of pages</span>
                <input class="form-control col-sm-8" type="text" name="bookNumOfPages" />
            </div>
            <div class="form-group row align-items-center">
                <span class="col-sm-4">Critics rating</span>
                <input class="form-control col-sm-8" type="text" name="bookCriticsRating" placeholder="(0.0 - 10.0)"/>
            </div>
            <div class="form-group row align-items-center">
                <span class="col-sm-4">Price</span>
                <input class="form-control col-sm-8" type="text" name="bookPrice" placeholder="Currency: dollar($)" />
            </div>
            <div class="form-group row align-items-center">
                <span class="col-sm-4">Discount</span>
                <input class="form-control col-sm-8" type="text" name="bookDiscount" placeholder="In percent - %" />
            </div>
            <a id="admin-update-book-btn" href="#" class="btn header-btn w-100 mt-4">Update</a>
        </form>
    </div>
    
</div>