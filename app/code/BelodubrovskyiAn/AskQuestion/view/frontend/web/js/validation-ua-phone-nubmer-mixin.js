define([
    'jquery'
], function ($) {
    'use_strict';

    return function () {
        $.validator.addMethod(
            'validation-ua-phone-number',
            function (phoneNumber) {
                if (phoneNumber.match(/^((\+?3)?8)?0\d{9}$/)) {
                    return true;
                }
            },
            $.mage.__('Please write ukrainian mobile phone number')
        );
    };
});
