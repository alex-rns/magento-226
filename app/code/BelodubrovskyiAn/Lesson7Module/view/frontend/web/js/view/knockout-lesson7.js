define(
    [
        'jquery',
        'uiComponent',
        'ko',
        'BelodubrovskyiAn_Lesson7Module/js/model/rgb-model'
    ],
    function ($, Component, ko, rgbModel) {
        'use strict';

        let self;

        return Component.extend({
            myTimer: ko.observable(0),
            /**
             * Computed random color from rgbModel
             */
            randomColour: ko.computed(function () {
                //we are using the aliased rgbModel here giving us access to the RGB values
                return 'rgb(' + rgbModel.red() + ', ' + rgbModel.blue() + ', ' + rgbModel.green() + ')';
            }, this),
            /**
             * Initialize function
             */
            initialize: function () {
                self = this;
                this._super();
                //call the incrementTime function to run on intialize
                this.incrementTime();
                this.subscribeToTime();
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
            },
            /**
             * Subscribe to observable myTimer
             */
            subscribeToTime: function () {
                this.myTimer.subscribe(function () {
                    rgbModel.updateColour();
                });
            }
        });
    }
);
