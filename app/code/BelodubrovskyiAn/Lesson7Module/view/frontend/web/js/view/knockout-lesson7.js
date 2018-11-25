define(
    [
        'jquery',
        'uiComponent',
        'ko'
    ],
    function ($, Component, ko) {
        'use strict';

        return Component.extend({
            myTimer: ko.observable(0),

            /**
             * Template function
             */
            initialize: function () {
                this._super();
            }
        });
    }
);
