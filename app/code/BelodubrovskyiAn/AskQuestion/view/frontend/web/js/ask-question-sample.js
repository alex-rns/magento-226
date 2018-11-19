define([
    'jquery',
    'Magento_Ui/js/modal/alert',
    'mage/translate',
    'jquery/ui'
], function ($, alert) {
    'use strict';

    $.widget('geekhub.askQuestionSample', {
        options: {
            action: ''
        },

        /** @inheritdoc */
        _create: function () {
            $(this.element).submit(this.submitForm.bind(this));
        },

        /**
         * Submit a form to the server
         */
        submitForm: function () {
            if (!this.validateForm()) {
                return;
            }

            alert({
                title: $.mage.__('Success'),
                content: $.mage.__('Thank you')
            });
        },

        /**
         * Validate a form
         * @returns {bool}
         */
        validateForm: function () {
            return true;
        }
    });

    return $.geekhub.askQuestionSample;
});
