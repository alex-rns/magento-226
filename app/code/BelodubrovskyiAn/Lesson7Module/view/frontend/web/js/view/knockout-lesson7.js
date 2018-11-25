define(
    [
        'jquery',
        'uiComponent',
        'ko'
    ],
    function ($, Component, ko) {
        'use strict';

        let self;

        return Component.extend({
            myTimer: ko.observable(0),
            /**
             * Initialize function
             */
            initialize: function () {
                self = this;
                this._super();
                //call the incrementTime function to run on intialize
                this.incrementTime();
            },
            /**
             * Increment myTimer every second
             */
            incrementTime: function () {
                let t = 0;
                setInterval(function () {
                    t++;
                    self.myTimer(t);
                }, 1000);
            }
        });
    }
);
