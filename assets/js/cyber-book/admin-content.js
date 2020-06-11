$(document).ready(function(){
    //Book add
    $(".book-prop-add i").click(togglePropertyInputType);
    $("#admin-add-book-btn").click(addBook);

    //Book update
    $("select[name='bookId']").change(getBook);
    $("#admin-update-book-btn").click(updateBook);

    //Delete book
    $("#admin-delete-book-btn").click(deleteBook);
});

function togglePropertyInputType(){
    var $parent = $(this).parent();

    $parent.find("input").toggle();
    $parent.find("input").val("");

    $parent.find("select").toggle();
}
function addBook(e){
    e.preventDefault();

    var $title = $("input[name='bookTitle']");

    var $description = $("textarea[name='bookDescription']");

    var $languageNew = $("input[name='bookLanguageNew']");
    var $languageId = $("select[name='bookLanguage']");

    var $authorNew = $("input[name='bookAuthorNew']");
    var $authorId = $("select[name='bookAuthor']");

    var $publisherNew = $("input[name='bookPublisherNew']");
    var $publisherId = $("select[name='bookPublisher']");

    var $publishDate = $("input[name='bookPublishDate']");
    
    var $backTypeNew = $("input[name='bookBackTypeNew']");
    var $backTypeId = $("select[name='bookBackType']");

    var $numOfPages = $("input[name='bookNumOfPages']");
    
    var $criticsRating = $("input[name='bookCriticsRating']");

    var $price = $("input[name='bookPrice']");

    var $discount = $("input[name='bookDiscount']");

    var $coverImage = $("input[name='bookCoverImage']");

    if($title.val() == "" || $description.val() == "" || $numOfPages.val() == "" || $criticsRating.val() == "" || $price.val() == "" || $discount.val() == "" || $publishDate.val() == ""){
        alert("Please fill in the empty fields.");
        return;
    }

    if($languageId.is(":visible") && $languageId.val() == "0"){
        alert("Please select a language.");
        return;
    }
    else if($languageNew.is(":visible") && $languageNew.val() == ""){
        alert("Please fill in a new language.");
        return;
    }

    if($authorId.is(":visible") && $authorId.val() == "0"){
        alert("Please select an author.");
        return;
    }
    else if($authorNew.is(":visible") && $authorNew.val() == ""){
        alert("Please fill in new author.");
        return;
    }

    if($publisherId.is(":visible") && $publisherId.val() == "0"){
        alert("Please select a publisher.");
        return;
    }
    else if($publisherNew.is(":visible") && $publisherNew.val() == ""){
        alert("Please fill a new publisher.");
        return;
    }

    if($backTypeId.is(":visible") && $backTypeId.val() == "0"){
        alert("Please select a back type.");
        return;
    }
    else if($backTypeNew.is(":visible") && $backTypeNew.val() == ""){
        alert("Please fill in a new back type.");
        return;
    }

    var pagesNum = Number($numOfPages.val());
    if(isNaN(pagesNum) || pagesNum < 1 || countDecimals(pagesNum) > 0){
        alert("Pages number must be a whole positive number.");
        return;
    }

    var criticsRating = Number($criticsRating.val());
    if(isNaN(criticsRating) || criticsRating < 0 || criticsRating > 10 || countDecimals(criticsRating) != 1){
        alert("Critics rating must be between 0.0 and 10.0, and must contain 1 decimal.");
        return;
    }

    var bookPrice = Number($price.val());
    if(isNaN(bookPrice) || bookPrice <= 0 || countDecimals(bookPrice) > 2){
        alert("Book price can only contain 2 decimals max, and must be greater than 0.");
        return;
    }

    var bookDiscount = Number($discount.val());
    if(isNaN(bookDiscount) || bookDiscount < 0 || bookDiscount > 100 || countDecimals(bookDiscount) > 2){
        alert("Book discount can only contain 2 decimals max.");
        return;
    }

    if($coverImage.val() == ""){
        alert("Please select a cover image.");
        return;
    }

    var imageExtensions = ["image/jpeg", "image/png"];
    if(!imageExtensions.includes($coverImage.get(0).files[0].type) || $coverImage.get(0).files[0].size > 500000){
        alert("Cover image must be png or jpg, and less than 500KB.");
        return;
    }


    var formData = new FormData();

    formData.append("bookTitle", $title.val());

    formData.append("bookDescription", $description.val());

    formData.append("bookLanguage", $languageId.val());
    formData.append("bookLanguageNew", $languageNew.val());

    formData.append("bookAuthor", $authorId.val());
    formData.append("bookAuthorNew", $authorNew.val());

    formData.append("bookPublisher", $publisherId.val());
    formData.append("bookPublisherNew", $publisherNew.val());

    formData.append("bookPublishDate", $publishDate.val());

    formData.append("bookBackType", $backTypeId.val());
    formData.append("bookBackTypeNew", $backTypeNew.val());

    formData.append("bookNumOfPages", $numOfPages.val());

    formData.append("bookCriticsRating", $criticsRating.val());

    formData.append("bookPrice", $price.val());

    formData.append("bookDiscount", $discount.val());

    formData.append("bookCoverImage", $coverImage.get(0).files[0]);

    formData.append("addBookBtn", true);

    $.ajax({
        url: "models/book/add_book.php",
        method: "POST",
        dataType: "json",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
            alert(data.message);
            location.reload();
        },
        error: function(xhr, errType, errMsg){
            var data = JSON.parse(xhr.responseText);
            
            alert(data.message);
        }
    });
}
function getBook(){
    var bookId = $("select[name='bookId']").val();

    if(bookId == 0)
        return;

    $.ajax({
        url: "models/book/get_book.php",
        method: "GET",
        dataType: "json",
        data: {
            id: bookId
        },
        success: function(data){
            populateUpdateFields(data);
        },
        error: function(xhr, errType, errMsg){
            var data = JSON.parse(xhr.responseText);
            
            alert(data.message);
        }
    });
}

function populateUpdateFields(book){
    $("input[name='bookTitle']").val(book.title);
    
    $("textarea[name='bookDescription']").val(book.description);

    $("select[name='bookLanguage']").val(book.language_id);

    $("select[name='bookAuthor']").val(book.author_id);

    $("select[name='bookPublisher']").val(book.publisher_id);

    $("input[name='bookPublishDate']").val(book.publish_date);
    
    $("select[name='bookBackType']").val(book.back_type_id);

    $("input[name='bookNumOfPages']").val(book.num_of_pages);
    
    $("input[name='bookCriticsRating']").val(book.critics_rating);

    $("input[name='bookPrice']").val(book.price);

    $("input[name='bookDiscount']").val(book.discount);
}
function updateBook(e){
    e.preventDefault();

    var $id = $("select[name='bookId']");

    var $title = $("input[name='bookTitle']");

    var $description = $("textarea[name='bookDescription']");

    var $languageNew = $("input[name='bookLanguageNew']");
    var $languageId = $("select[name='bookLanguage']");

    var $authorNew = $("input[name='bookAuthorNew']");
    var $authorId = $("select[name='bookAuthor']");

    var $publisherNew = $("input[name='bookPublisherNew']");
    var $publisherId = $("select[name='bookPublisher']");

    var $publishDate = $("input[name='bookPublishDate']");
    
    var $backTypeNew = $("input[name='bookBackTypeNew']");
    var $backTypeId = $("select[name='bookBackType']");

    var $numOfPages = $("input[name='bookNumOfPages']");
    
    var $criticsRating = $("input[name='bookCriticsRating']");

    var $price = $("input[name='bookPrice']");

    var $discount = $("input[name='bookDiscount']");

    if($id.val() == 0){
        alert("Please select a book to update.");
        return;
    }

    if($title.val() == "" || $description.val() == "" || $numOfPages.val() == "" || $criticsRating.val() == "" || $price.val() == "" || $discount.val() == "" || $publishDate.val() == ""){
        alert("Please fill in the empty fields.");
        return;
    }

    if($languageId.is(":visible") && $languageId.val() == "0"){
        alert("Please select a language.");
        return;
    }
    else if($languageNew.is(":visible") && $languageNew.val() == ""){
        alert("Please fill in a new language.");
        return;
    }

    if($authorId.is(":visible") && $authorId.val() == "0"){
        alert("Please select an author.");
        return;
    }
    else if($authorNew.is(":visible") && $authorNew.val() == ""){
        alert("Please fill in new author.");
        return;
    }

    if($publisherId.is(":visible") && $publisherId.val() == "0"){
        alert("Please select a publisher.");
        return;
    }
    else if($publisherNew.is(":visible") && $publisherNew.val() == ""){
        alert("Please fill a new publisher.");
        return;
    }

    if($backTypeId.is(":visible") && $backTypeId.val() == "0"){
        alert("Please select a back type.");
        return;
    }
    else if($backTypeNew.is(":visible") && $backTypeNew.val() == ""){
        alert("Please fill in a new back type.");
        return;
    }

    var pagesNum = Number($numOfPages.val());
    if(isNaN(pagesNum) || pagesNum < 1 || countDecimals(pagesNum) > 0){
        alert("Pages number must be a whole positive number.");
        return;
    }

    var criticsRating = Number($criticsRating.val());
    if(isNaN(criticsRating) || criticsRating < 0 || criticsRating > 10 || countDecimals(criticsRating) != 1){
        alert("Critics rating must be between 0.0 and 10.0, and must contain 1 decimal.");
        return;
    }

    var bookPrice = Number($price.val());
    if(isNaN(bookPrice) || bookPrice <= 0 || countDecimals(bookPrice) > 2){
        alert("Book price can only contain 2 decimals max, and must be greater than 0.");
        return;
    }

    var bookDiscount = Number($discount.val());
    if(isNaN(bookDiscount) || bookDiscount < 0 || bookDiscount > 100 || countDecimals(bookDiscount) > 2){
        alert("Book discount can only contain 2 decimals max.");
        return;
    }


    var formData = new FormData();

    formData.append("bookId", $id.val());

    formData.append("bookTitle", $title.val());

    formData.append("bookDescription", $description.val());

    formData.append("bookLanguage", $languageId.val());
    formData.append("bookLanguageNew", $languageNew.val());

    formData.append("bookAuthor", $authorId.val());
    formData.append("bookAuthorNew", $authorNew.val());

    formData.append("bookPublisher", $publisherId.val());
    formData.append("bookPublisherNew", $publisherNew.val());

    formData.append("bookPublishDate", $publishDate.val());

    formData.append("bookBackType", $backTypeId.val());
    formData.append("bookBackTypeNew", $backTypeNew.val());

    formData.append("bookNumOfPages", $numOfPages.val());

    formData.append("bookCriticsRating", $criticsRating.val());

    formData.append("bookPrice", $price.val());

    formData.append("bookDiscount", $discount.val());

    formData.append("updateBookBtn", true);

    $.ajax({
        url: "models/book/update_book.php",
        method: "POST",
        dataType: "json",
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
            alert(data.message);
            location.reload();
        },
        error: function(xhr, errType, errMsg){
            var data = JSON.parse(xhr.responseText);
            
            alert(data.message);
        }
    });

}
function deleteBook(e){
    
    e.preventDefault();

    var $id = $("select[name='bookId']");

    if($id.val() == 0){
        alert("Please select a book to delete.");
        return;
    }

    var formData = new FormData();

    formData.append("bookId", $id.val());

    formData.append("deleteBookBtn", true);

    $.ajax({
        url: "models/book/delete_book.php",
        method: "POST",
        dataType: "json",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data){
            alert(data.message);
            location.reload();
        },
        error: function(xhr, errType, errMsg){
            var data = JSON.parse(xhr.responseText);
            
            alert(data.message);
        }
    });


}
function countDecimals(number){
    var stringNum = number.toString();

    var splitted = stringNum.split(".");

    if(splitted.length == 2)
        return splitted[1].length;
    else
        return 0;
}