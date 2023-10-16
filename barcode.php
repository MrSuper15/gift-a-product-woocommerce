<?php 
 /* 
 * Print barcode in recipient email
 */
$barcode = WC_Order_Barcodes()->display_barcode( $order->get_id());
$barcode_text = get_post_meta( $order_id, '_barcode_text', true );
$barcode_url =  trailingslashit( get_site_url() ) . '?wc_barcode=' . $order_id;
$barcode = '<img src="' . esc_url( trailingslashit( get_site_url() ) . '?wc_barcode=' . $order_id ) . '" title="' . __( 'Barcode', 'woocommerce-order-barcodes' ) . '" alt="' . __( 'Barcode', 'woocommerce-order-barcodes' ) . '" style="display:inline;border:0;" /><br/><span style="color:black;font-family:monospace;">' . $barcode_text . '</span>';

$variables["barcode"] .= "<p style='text-align: center; color:white; font-weight: 700;'>". $barcode ."</p>";
        