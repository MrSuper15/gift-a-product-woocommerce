var giftBtn = jQuery('#single-gift-btn');
var addToCart = jQuery('.single_add_to_cart_button');

jQuery('.gift-single-button').on('click', function() {
    var hiddenField = jQuery('#is_gift'),
    val = hiddenField.val();

    hiddenField.val(val === "1" ? "0" : "1");

    var cardGift = jQuery(".gift-field-wrap");
    cardGift.toggle("show");
    
    giftBtn.toggleClass("hidden");
});
