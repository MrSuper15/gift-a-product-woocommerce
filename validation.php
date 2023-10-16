<?php

if($gift){
    if($_POST['is_gift'] === "1"){
        /**
         * Validate fields values
         */
        function jf_gift_validation( $passed, $product_id, $quantity, $variation_id=null ) {
        if(empty($_POST['gift-name-field'])) {
        $passed = false;
        wc_add_notice( __( 'El nombre del destinatario es obligatorio para regalos.', 'jf-plugin' ), 'error' );
        }
        if(empty($_POST['gift-email-field'])) {
        $passed = false;
        wc_add_notice( __( 'El correo electrónico del destinatario es obligatorio para regalos.', 'jf-plugin' ), 'error' );
        }
        return $passed;
        }
        add_filter( 'woocommerce_add_to_cart_validation', 'jf_gift_validation', 10, 4 );

        /**
         * Add custom cart item data
         */
        function gift_card_metadata( $cart_item_data, $product_id, $variation_id ) {
            if( isset( $_POST['gift-name-field'] ) && isset( $_POST['gift-email-field'] ) ) {
            $cart_item_data['gift_N_field'] = sanitize_text_field( $_POST['gift-name-field'] );
            $cart_item_data['gift_E_field'] = sanitize_text_field( $_POST['gift-email-field'] );
            $cart_item_data['gift_C_field'] = sanitize_text_field( $_POST['gift-city-field'] );
            }
            if( isset( $_POST['gift-message-field'] ) ) {
                $cart_item_data['gift_M_field'] = sanitize_text_field( $_POST['gift-message-field'] );
            }
            
            return $cart_item_data;
        }
        add_filter( 'woocommerce_add_cart_item_data', 'gift_card_metadata', 10, 3 );
    }
}



