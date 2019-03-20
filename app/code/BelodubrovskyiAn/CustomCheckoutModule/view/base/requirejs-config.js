var config = {
    'config': {
        'mixins': {
            'Magento_Checkout/js/view/shipping': {
                'BelodubrovskyiAn_CustomCheckoutModule/js/view/shipping-payment-mixin': true
            },
            'Magento_Checkout/js/view/payment': {
                'BelodubrovskyiAn_CustomCheckoutModule/js/view/shipping-payment-mixin': true
            }
        }
    }
};
