$(document).ready(function(){
    disableEmptyLinks();
    updateCartIndicator();
});

function updateCartIndicator(){
    let cart = JSON.parse(localStorage.getItem("cart"));
    if(!cart){
        cart = [];
    }

    $("#shopping-cart span").text(cart.length);
}
function disableEmptyLinks(){
    $("a[href='#']").click(function(e){
        e.preventDefault();
    });
}