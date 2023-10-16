<?php
/**
 * Add a custom text input field to the product page
 */

add_action( 'woocommerce_before_add_to_cart_button', 'jf_gift_function' );
function jf_gift_function() {
    // código para determinar en qué ciudad es el tratamiento
    global $post;
        $terms = get_the_terms( $post->ID, 'product_cat' );
        $categoriesForGift = array();
        foreach ($terms as $term) {
            $product_cat_name = $term->name;
            array_push($categoriesForGift, $product_cat_name);
        }
        echo "<script>console.log(" . json_encode($categoriesForGift) . ");</script>";
        if(in_array("Tratamientos en Madrid", $categoriesForGift)) {
            $categoriesForGift = "Madrid";
        } else if(in_array("Tratamientos en Valencia", $categoriesForGift)){
            $categoriesForGift = "Valencia";
        } else {
            $categoriesForGift = "A consultar";
        }
        echo "<script>console.log('La sede que será guardada es:" . json_encode($categoriesForGift) . "');</script>";
    // fin del código para determinar en qué ciudad es el tratamiento 
    ?>
    <div class="gift-field-wrap">
    <div class="gift-close-btn">
        <a id="gift-close-btn" class="gift-single-button">
            <img src="<?php echo plugin_dir_url(__FILE__) .'style/close.svg' ?>" alt="close btn" width="15">
        </a>
    </div>
    <input type="hidden" name="is_gift" id="is_gift" value="0">
    <div class="gift-group">
        <label for="gift-name-field"><?php _e( 'Nombre de quien lo recibe', 'jf-plugin' ); ?> <abbr class="required" title="obligatorio">*</abbr></label>
        <input type="text" name='gift-name-field' id='gift-name-field' value='' class="gift-input">
    </div>
    <div class="gift-group">
        <label for="gift-email-field"><?php _e( 'Correo de quien lo recibe', 'jf-plugin' ); ?> <abbr class="required" title="obligatorio">*</abbr></label>
        <input type="email" name='gift-email-field' id='gift-email-field' value='' class="gift-input">
    </div>
    <div class="gift-group no-bottom">
        <label for="gift-message-field"><?php _e( 'Mensaje que le quieras dejar', 'jf-plugin' ); ?></label>
        <textarea name='gift-message-field' id='gift-message-field' placeholder="Opcional" class="gift-input gift-textarea" rows="1" cols="40"></textarea>
    </div>
    <input type="hidden" name="gift-city-field" value="<?php echo $categoriesForGift ?>" class="city-input" readonly/>
    <div class="info-wrap">
        <img src="<?php echo plugin_dir_url(__FILE__) .'style/info.svg' ?>" alt="close btn" width="20">
        <p>Rellena los datos de tu destinatario y luego añade el regalo al carrito.</p>
    </div>
    </div>
    <?php 
    }

require_once(JF_DIR . "validation.php");
