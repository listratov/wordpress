jQuery(document).ready(function () {

    jQuery('.wcqb_button').prop('disabled',true);

    jQuery('#billing_first_name').keyup(function(){
        var billing_email =  jQuery('#billing_email').val();
        jQuery('.wcqb_button').prop('disabled', (this.value == "" || billing_email == "") ? true : false);
    });
    jQuery('#billing_email').keyup(function(){
        var billing_first_name =  jQuery('#billing_first_name').val();
        jQuery('.wcqb_button').prop('disabled', (this.value == "" || billing_first_name  == "") ? true : false);
    });

    jQuery('.wcqb_button').click(function () {
            var product_id = jQuery(this).attr('data-product-id');
        var product_type = jQuery(this).attr('data-product-type');
        var selected = jQuery('form.cart input#wc_quick_buy_hook_' + product_id);
        var productform = selected.parent();
        productform.append('<input type="hidden" value="true" name="quick_buy" />');
        var submit_btn = productform.find('[type="submit"]');
        var is_disabled = submit_btn.is(':disabled');

        if ( is_disabled ) {
            jQuery('html, body').animate({
                scrollTop: submit_btn.offset().top - 200
            }, 900);
        } else {

            jQuery.post('?add-to-cart=' + product_id, function() {
                jQuery('form.checkout.woocommerce-checkout').find('[type="submit"]').click();

            });



          //  productform.find('[type="submit"]').click();
        }

    });

    jQuery('form.cart').change(function () {
        var is_submit_disabled = jQuery(this).find('[type="submit"]').is(':disabled');
        if ( is_submit_disabled ) {
            jQuery('.wcqb_button').attr('disabled', 'disable');
        } else {
            jQuery('.wcqb_button').removeAttr('disabled');
        }
    })

});