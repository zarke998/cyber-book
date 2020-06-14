var subtotal = 0;

$(document).ready(function(){
    $("#cart-info").hide();
    $("#clear-cart-btn").click(clearCart);
    updateCartIndicator();
    
    loadCartTable();
});

function loadCartTable(){

    if(!localStorage){
        alert("Your browser doesnt't support local storage.");
        return;
    }

    if(localStorage.getItem("cart") == null){
        $("#cart-info").show();
    }
    let cart = JSON.parse(localStorage.getItem("cart"));

    cart.forEach(bookId => {
        $.ajax({
            url: "models/book/get_book.php",
            method: "GET",
            dataType: "json",
            data: {
                id: bookId,
                lod_level: 2
            },
            success: function(book){
                addBookToTable(book);
                subtotal+= parseFloat((book.price - book.price * book.discount/100).toFixed(2));
                updateSubtotalTag(subtotal);
            },
            error: function(xhr, errType, errMsg){

            }
        })
    });
}

function addBookToTable(book){
    let $container = $("#cart-subtotal");

    let bookLayout = `
    <tr class="cart-item">
        <td>
            <div class="media">
                <div class="d-flex cart-book-image">
                    <img src="${book.cover_url}" alt="Book cover" />
                </div>
                <div class="media-body">
                    <p>${book.title}</p>
                </div>
            </div>
        </td>
        <td>
            <h5>$${book.price}</h5>
        </td>
        <td>
            <div class="product_count">
                <h5 class="text-center">${book.discount}%</h5>
            </div>
        </td>
        <td>
            <h5>$${book.price - book.price * book.discount/100}</h5>
        </td>
    </tr>`;

    $container.before(bookLayout);
}

function updateSubtotalTag(subtotal){
    $("#cart-subtotal-price").text(`$${subtotal}`);
}

function clearCart(){
    if(!localStorage || localStorage.getItem("cart") == null) return;

    localStorage.removeItem("cart");
    location.reload();
}
