var shopListLimit = 8;

var searchFilter = "";

var categoryIds = null;
var languageIds = null;
var authorIds = null;
var publisherIds = null;
var backTypeIds = null;
var sortCriteriaId = 0;

var offsetValue = 0;

var pagesNumber;
var currentPage = 1;

$(document).ready(function(){
    loadBooks(searchFilter, categoryIds, languageIds, authorIds, publisherIds, backTypeIds, sortCriteriaId, shopListLimit, offsetValue);
    
});

function loadBooks(searchFilter, categoryIds, languageIds, authorIds, publisherIds, backTypeIds, sortCriteriaId,  limitValue, offsetValue){

    $.ajax({
        url: "models/book/get_books_by_criteria.php",
        method: "GET",
        dataType: "json",
        data: {
            search: searchFilter,
            categories: categoryIds,
            languages: languageIds,
            authors: authorIds,
            publishers: publisherIds,
            backTypes: backTypeIds,
            sortCrit: sortCriteriaId,
            sortArea: "shop_sort",
            limit: limitValue,
            offset: offsetValue,
            getBooksByCriteria: true
        },
        success: function(data){
            populateShopList(data.query_result);

            initializePagination(data.query_count);
            $(".page-link").off("click", loadPageIndex);
            $(".page-link").on("click", loadPageIndex);

            updatePaginationHighlight(currentPage);
        },
        error: function(xhr,errType,errMsg){
            var errJson = JSON.parse(xhr.responseText);
            alert(errJson.message);
        }
    });
}
function initializePagination(totalBooksFiltered){
    let $container = $(".pagination-pages");

    let content = "";

    pagesNumber = Math.ceil(totalBooksFiltered / shopListLimit);

    content += `<li class="page-item active"><a class="page-link" href="#">1</a></li>`
    for(let i = 1; i < pagesNumber; i++){
        content += `<li class="page-item"><a class="page-link" href="#">${i + 1}</a></li>`;
    }

    $container.html(content);

}
function populateShopList(books){
    let $container = $("#shop-container");

    let content = "";

    books.forEach(b => {
        content += `
        <div class="col-lg-3 col-sm-4 col-6">
            <div class="single-product mb-60">
                <div class="product-img">
                    <img src="${b.cover_url}" alt="Book cover">
                </div>
                <div class="product-caption">
                    <div class="product-ratting">
                        <!-- <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star low-star"></i>
                        <i class="far fa-star low-star"></i> -->
                    </div>
                    <h4><a href="#" data-id="${b.bookId}">${b.title}</a></h4>
                    <div class="price">
                        <ul>
                            ${getPricesTags(b)}
                        </ul>
                    </div>
                </div>
            </div>
        </div>`;
    });

    $container.html(content);

    function getPricesTags(book){
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
}

function loadPageIndex(e){
    e.preventDefault();

    let nextPageIndex;

    if($(this).hasClass("page-link-arrow")){
        let increment = parseInt($(this).data("increment"));

        nextPageIndex = currentPage + increment;

        if(nextPageIndex < 1 || nextPageIndex > pagesNumber){
            return;
        }
    }
    else{
        nextPageIndex = parseInt($(this).text());
    }
    
    offsetValue = (nextPageIndex - 1) * shopListLimit;

    loadBooks(searchFilter, categoryIds, languageIds, authorIds, publisherIds, backTypeIds, sortCriteriaId, shopListLimit, offsetValue);

    currentPage = nextPageIndex;
}

function updatePaginationHighlight(page){
    $(".page-item").removeClass("active");

    $(`.page-link:contains(${page})`).parent().addClass("active");
}

function floatTo2Decimals(real){
    return Math.trunc(real*100)/100;
}