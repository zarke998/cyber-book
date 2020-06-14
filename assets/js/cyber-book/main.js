$(document).ready(function(){
    $("a[href='#']").click(function(e){
        e.preventDefault();
    });

    updateCartIndicator();
});

function updateCartIndicator(){
    let cart = JSON.parse(localStorage.getItem("cart"));
    if(!cart){
        cart = [];
    }

    $("#shopping-cart span").text(cart.length);
}