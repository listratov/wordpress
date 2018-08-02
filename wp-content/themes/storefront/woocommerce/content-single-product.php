<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */


global $product;

defined('ABSPATH') || exit;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>

    <?php
    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    do_action('woocommerce_before_single_product_summary');
    ?>

    <div class="summary entry-summary">
        <?php
        /**
         * Hook: woocommerce_single_product_summary.
         *
         * @hooked woocommerce_template_single_title - 5
         * @hooked woocommerce_template_single_rating - 10
         * @hooked woocommerce_template_single_price - 10
         * @hooked woocommerce_template_single_excerpt - 20
         * @hooked woocommerce_template_single_add_to_cart - 30
         * @hooked woocommerce_template_single_meta - 40
         * @hooked woocommerce_template_single_sharing - 50
         * @hooked WC_Structured_Data::generate_product_data() - 60
         */
        do_action('woocommerce_single_product_summary');
        ?>
    </div>
    <div class="summary entry-summary desc">
        <?php echo $product->get_short_description(); ?>
    </div>
    <form name="checkout" method="post" class="checkout woocommerce-checkout"
          action="<?php echo wc_get_checkout_url(); ?>"
          enctype="multipart/form-data" novalidate="novalidate">


        <input type="text" class="input-text " name="billing_first_name" id="billing_first_name" placeholder="Имя"
               value=""
               required="required"

               autocomplete="given-name">

        <input type="email" class="input-text" name="billing_email" id="billing_email" placeholder="E-mail" value=""
               required="required"
               autocomplete="email username">

        <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>

        <?php echo wp_referer_field(true); ?>

        <input id="payment_method_paybear" type="radio" class="input-radio"
               name="payment_method" value="paybear" checked="checked" data-order_button_text="" style="display: none;">

        <?php echo do_shortcode('[wc_quick_buy  label="Продолжить"]'); ?>

        <button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order"
                value="Подтвердить заказ"
                style="display: none"
                data-value="Подтвердить заказ">Подтвердить заказ
        </button>
    </form>


    <!--	--><?php
    //		/**
    //		 * Hook: woocommerce_after_single_product_summary.
    //		 *
    //		 * @hooked woocommerce_output_product_data_tabs - 10
    //		 * @hooked woocommerce_upsell_display - 15
    //		 * @hooked woocommerce_output_related_products - 20
    //		 */
    //		do_action( 'woocommerce_after_single_product_summary' );
    //	?>
</div>


<style>
    header,
    footer,
    .by-vendor-name,
    .cart,
    .product_meta,
    .storefront-breadcrumb {
        display: none;
    }

    div.product {

        width: 50%;
        margin: 0 auto;
        margin-top: 15%;
    }

    .single-product div.product p.price {
        margin: 0 !important;
    }

    .product.type-product {
        width: 300px;
        text-align: center;
        background-color: white;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 10px 0px, rgba(0, 0, 0, 0.1) 0px 1px 2px 0px;
        border-radius: 12px 12px 10px 10px;
        margin: auto;
    }

    .woocommerce-product-details__short-description {
        display: none;
    }

    .summary.entry-summary.desc {
        display: block;
        width: 100% !important;
        margin: 5px !important;
        padding: 10px !important;
    }

    input#billing_first_name,
    input#billing_email {
        margin: 7px;
    }
</style>

<?php do_action('woocommerce_after_single_product'); ?>
