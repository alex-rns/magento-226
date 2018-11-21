define([
    'jquery',
    'geekhubValidationAlert',
    'Magento_Ui/js/modal/alert',
    'mage/translate',
    'mage/cookies',
    'jquery/ui'
], function ($, validationAlert, alert) {
    'use strict';

    $.widget('geekhub.askQuestionSample', {
        options: {
            cookieName: 'ask_question'
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

            var formData = new FormData($(this.element).get(0));

            formData.append('form_key', $.mage.cookies.get('form_key'));

            if(!$.mage.cookies.get('ask_question') === true) {
                $.ajax({
                    url: $(this.element).attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    type: 'post',
                    dataType: 'json',
                    context: this
                })
                    .done(function (response) {
                        alert({
                            title: response.status,
                            content: response.message
                        });

                        if (response.status === 'Success') {
                            // can use this cookie to prevent from sending requests too often
                            $.mage.cookies.set(this.options.cookieName, true, {
                                lifetime: 120
                            });
                        }
                    })
                    .fail(function (error) {
                        console.log(JSON.stringify(error));
                        alert({
                            title: $.mage.__('Error'),
                            content: $.mage.__('Your request can not be submitted.' +
                                ' Please, contact us directly via email' +
                                ' or prone to get your Sample.')
                        });
                    });
            } else {
                alert({
                    title: $.mage.__('Error'),
                    content: $.mage.__('Please wait two minutes before resending question.')
                });
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
