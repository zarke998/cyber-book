<div id="admin-add-book-container" class="container">
    <h2 class="text-center my-4">Add book</h2>
    <form class="mx-auto my-5 w-50" action="#" method="post">
        <div class="form-group row align-items-center">
            <span class="col-4">Title</span>
            <input class="form-control col-8" type="text" name="bookTitle" />
        </div>
        <div class="form-group row align-items-center">
            <span class="col-4">Description</span>
            <textarea class="form-control col-8" type="text" name="bookDescription"></textarea>
        </div>
        <div class="form-group row align-items-center">
            <span class="col-4">Language</span>
            <div class="col-8 px-0 d-flex align-items-center book-prop-add">
                <input class="form-control" type="text" name="bookLanguageNew" placeholder="Add new language"/>
                <select name="bookLanguage">
                    <option value="0">Select language:</option>
                    <option value="1">English</option>
                </select>
                <i class="far fa-plus-square"></i>
            </div>
        </div>
        <div class="form-group row align-items-center">
            <span class="col-4">Author</span>
            <div class="col-8 px-0 d-flex align-items-center book-prop-add">
                <input class="form-control" type="text" name="bookAuthorNew" placeholder="Add new author" />
                <select name="bookAuthor">
                    <option value="0">Select author:</option>
                </select>
                <i class="far fa-plus-square"></i>
            </div>
        </div>
        <div class="form-group row align-items-center">
            <span class="col-4">Publisher</span>
            <div class="col-8 px-0 d-flex align-items-center book-prop-add">
                <input class="form-control" type="text" name="bookPublisherNew" placeholder="Add new publisher"/>
                <select name="bookPublisher">
                    <option value="0">Select publisher:</option>
                </select>
                <i class="far fa-plus-square"></i>
            </div>
        </div>
        <div class="form-group row align-items-center">
            <span class="col-4">Publish Date</span>
            <input class="form-control col-8" type="date" name="bookPublishDate"/>
        </div>
        <div class="form-group row align-items-center">
            <span class="col-4">Back Type</span>
            <div class="col-8 px-0 d-flex align-items-center book-prop-add">
                <input class="form-control" type="text" name="bookBackTypeNew" placeholder="Add new back type"/>
                <select name="bookBackType">
                    <option value="0">Select back type:</option>
                </select>
                <i class="far fa-plus-square"></i>
            </div>
        </div>
        <div class="form-group row align-items-center">
            <span class="col-4">Num. of pages</span>
            <input class="form-control col-8" type="text" name="bookNumOfPages" />
        </div>
        <div class="form-group row align-items-center">
            <span class="col-4">Critics rating</span>
            <input class="form-control col-8" type="text" name="bookCriticsRating" placeholder="(0.0 - 10.0)"/>
        </div>
        <div class="form-group row align-items-center">
            <span class="col-4">Price</span>
            <input class="form-control col-8" type="text" name="bookPrice" placeholder="Currency: dollar($)" />
        </div>
        <div class="form-group row align-items-center">
            <span class="col-4">Discount</span>
            <input class="form-control col-8" type="text" name="bookDiscount" placeholder="In percent - %" />
        </div>
        <div class="form-group row align-items-center">
            <span class="col-4">Cover image</span>
            <input class="col-8" type="file" name="bookCoverImage" />
        </div>
        <a id="admin-add-book-btn" href="#" class="btn header-btn w-100 mt-4">Add</a>
    </form>
</div>