<?php

add_action( 'woocommerce_before_add_to_cart_button', 'gift_btn', 0 );
function gift_btn(){
	echo "<a class='button wp-element-button gift-button gift-single-button' id='single-gift-btn'>Regalar</a>";
}



