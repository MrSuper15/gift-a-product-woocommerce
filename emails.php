<?php
/*
* Enviar el correo electronico de regalo a la persona recipiente
*/

function gift_completed_email($order_id){
    $order = wc_get_order( $order_id );
    $order_items = $order->get_items();
    // Hacer un loop de los datos del producto que interesan.
    foreach ( $order_items as $item ) {
        $product = $item->get_product();
        $giftEmail = $item->get_meta( 'Correo', true );
        $variables = array();

		$variables["product_name"] = $product->get_name(); 
        $variables["city"] = $item->get_meta( 'Sede', true );
        $variables["to"] = $item->get_meta( 'Para', true );
        $variables["from"] = $order->get_billing_first_name() . ' ' . $order->get_billing_last_name();
        $variables["message"] = $item->get_meta( 'Mensaje', true );
        $variables["barcode"] = "";
        if(function_exists('WC_Order_Barcodes')) {
            require('barcode.php');
        } else {
            $variables["barcode"] .= "<p style='font-weight:700;text-align: center;'>El número de tu pedido es $order_id</p>";
        }

        $template = file_get_contents(JF_DIR . "email-template.php");

        echo $template;

        foreach($variables as $key => $value)
        {
            $template = str_replace('{{ '.$key.' }}', $value, $template);
        }

        if(!empty($giftEmail)){
            $to = $giftEmail;
            $subject = '¡Recibiste un regalo! | Sesderma Skin Center';
            $headers = array('Content-Type: text/html; charset=UTF-8', 'From: Centro Wellnes <adminwellness@centrowellnessdrserrano.com>');
            wp_mail( $to, $subject, $template, $headers );
        }
        
    }
    }

add_action( 'woocommerce_order_status_completed', 'gift_completed_email');