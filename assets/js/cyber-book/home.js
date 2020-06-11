$(document).ready(function(){
    loadMostRecentTitles();

    $("#newsletterBtn").click(registerSubscriber);

    loadBestByCriticsTitles();
});

//Most recent titles
function loadMostRecentTitles(){
    $.ajax({
        url: "models/book/get_books_by_criteria.php",
        method: "GET",
        dataType: "json",
        data: {
            sortCrit: 1,
            limit: 8,
            offset: 0,
            getBooksByCriteria: true
        },
        success: function(data){
            populateMostRecentTitles(data);
        },
        error: function(xhr, errType, errMsg){
            var data = JSON.parse(xhr.responseText);
            
            alert(data.message);
        }
    });
}
function populateMostRecentTitles(books){
    let $container = $("#most-recent-titles");

    let content = ``;

    books.forEach(b => {
        content += `
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="single-product mb-60">
                <div class="product-img">
                    <img src="${b.cover_url}" alt="Book cover">
                </div>
                <div class="product-caption">
                    <h4><a href="#" data-id="${b.bookId}">${b.title}</a></h4>
                    <div class="price">
                        <ul>
                            ${getBookPricesTags(b)}
                        </ul>
                    </div>
                </div>
            </div>
        </div>`;
    });

    $container.html(content);
}
function getBookPricesTags(book){
    let tags = ``;
    if(book.discount == 0){
        tags+= `<li>$${book.price}</li>`;
    }
    else{
        var discounted = book.price - book.price * (book.discount / 100);
        discounted = floatTo2Decimals(discounted);

        tags+= `<li>$${discounted}</li>
                <li class="discount">$${book.price}</li>`;
    }

    return tags;
}

// Newsletter
function registerSubscriber(e){
    e.preventDefault();

    let $email = $("#newsletterEmail");
    let emailReg = /^[a-z]+[a-z\d]{2,}(\.[a-z\d]+)*@[a-z]{2,}(\.[a-z]{2,})+$/;

    if(!emailReg.test($email.val())){
        alert("Invalid email format. Email must start with a letter and contain only letters and numbers.");
        return;
    }

    $.ajax({
        url: "models/newsletter/register_subscriber.php",
        method: "POST",
        dataType: "json",
        data: {
            email: $email.val(),
            registerSubscriberBtn: true
        },
        success: function(data){
            alert(data.message);
            $("#newsletterEmail").val("");
        },
        error: function(xhr, errType, errMsg){
            var data = JSON.parse(xhr.responseText);
            alert(data.message);

            $("#newsletterEmail").val("");
        }
    });
}

//Best by critics
function loadBestByCriticsTitles(){
    $.ajax({
        url: "models/book/get_books_by_criteria.php",
        method: "GET",
        dataType: "json",
        data: {
            sortCrit: 5,
            limit: 6,
            offset: 0,
            getBooksByCriteria: true
        },
        success: function(data){
            populateBestByCriticsTitles(data);
        },
        error: function(xhr, errType, errMsg){
            var data = JSON.parse(xhr.responseText);
            
            alert(data.message);
        }
    });
}
function populateBestByCriticsTitles(books){
    let $container = $("#bestByCriticsContainer");

    let content = ``;

    books.forEach(b => {
        content+= `
        <div class="col-lg-2 col-sm-4 col-6 px-4 px-lg-2 mb-4 best-by-critics-item text-center">
            <img src="${b.cover_url}" alt="">
            <a href="#" data-id=${b.bookId}>${b.title}</a>
        </div>`;
    });

    $container.html(content);
}


function floatTo2Decimals(real){
    return Math.trunc(real*100)/100;
}