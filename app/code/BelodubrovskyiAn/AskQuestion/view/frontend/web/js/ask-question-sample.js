define([
    'jquery',
    'geekhubValidationAlert',
    'jquery/ui'
], function ($, validationAlert) {
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
                validationAlert();

                return;
            }
        },

        /**
         * Validate a form
         * @returns {bool}
         */
        validateForm: function () {
            return $(this.element).validation().valid();
        }
    });

    return $.geekhub.askQuestionSample;
});
