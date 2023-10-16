<?php
/**
 * Display custom item data in the cart
 */
function display_giftMetadata_cart( $item_data, $cart_item_data ) {
if( isset( $cart_item_data['gift_N_field'] ) ) {
$item_data[] = array(
'key' => __( 'Regalo para', 'jf-plugin' ),
'value' => wc_clean( $cart_item_data['gift_N_field'] )
);
}
if( isset( $cart_item_data['gift_E_field'] ) ) {
$item_data[] = array(
'key' => __( 'Correo', 'jf-plugin' ),
'value' => wc_clean( $cart_item_data['gift_E_field'] )
);
}
if( isset( $cart_item_data['gift_C_field'] ) ) {
    $item_data[] = array(
    'key' => __( 'Sede', 'jf-plugin' ),
    'value' => wc_clean( $cart_item_data['gift_C_field'] )
    );
    }
 return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'display_giftMetadata_cart', 10, 2 );

/**
 * Add custom meta to order
 */
function display_giftMetadata_order( $item, $cart_item_key, $values, $order ) {
    if( isset( $values['gift_N_field'] ) ) {
    $item->add_meta_data(
    __( 'Para', 'jf-plugin' ),
    $values['gift_N_field'],
    true
    );
    $item->add_meta_data(
    __( 'Correo', 'jf-plugin' ),
    $values['gift_E_field'],
    true
    );
    $item->add_meta_data(
    __( 'Mensaje', 'jf-plugin' ),
    $values['gift_M_field'],
    true
    );
    $item->add_meta_data(
        __( 'Sede', 'jf-plugin' ),
        $values['gift_C_field'],
        true
        );
    }
   }
   add_action( 'woocommerce_checkout_create_order_line_item', 'display_giftMetadata_order', 10, 4 );

   
/**
 * Add custom cart item data to emails
 */
function display_giftMetadata_email( $product_name, $item ) {
    if( isset( $item['gift_N_field'] ) ) {
    $product_name .= sprintf(
    '<ul><li>%s: %s</li></ul>',
    __( 'Regalo para', 'jf-plugin' ),
    esc_html( $item['gift_N_field'] )
    );
    }
    if( isset( $item['gift_E_field'] ) ) {
    $product_name .= sprintf(
    '<ul><li>%s: %s</li></ul>',
    __( 'Regalo para', 'jf-plugin' ),
    esc_html( $item['gift_E_field'] )
    );
    }
    if( isset( $item['gift_C_field'] ) ) {
        $product_name .= sprintf(
        '<ul><li>%s: %s</li></ul>',
        __( 'Sede', 'jf-plugin' ),
        esc_html( $item['gift_C_field'] )
        );
        }
    return $product_name;
   }
   
   add_filter( 'woocommerce_order_item_name', 'display_giftMetadata_email', 10, 2 );