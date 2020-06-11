$(document).ready(function(){
    loadMostRecentTitles();
});

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
    $container = $("#most-recent-titles");

    var content = ``;

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
    var tags = ``;
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

function floatTo2Decimals(real){
    return Math.trunc(real*100)/100;
}