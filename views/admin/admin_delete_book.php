<?php 
    if(!defined("ROOT"))
        define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

    require_once ROOT."/models/book/get_all.php";
?>

<div id="admin-delete-book-container" class="container admin-content-container">
    <h2 class="text-center my-4">Delete book</h2>
    <form class="mx-auto my-5 w-50" action="#" method="post">
        <div class="form-group row align-items-center mx-0">
            <span class="col-4">Book to delete: </span>
            <div class="col-8 px-0 d-flex align-items-center book-prop-add">
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
        <a id="admin-delete-book-btn" href="#" class="btn header-btn w-100 mt-4">Delete</a>
    </form>
</div>