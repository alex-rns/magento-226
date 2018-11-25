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
            randomColour: ko.observable('rgb(0, 0, 0)'),
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
                this.myTimer.subscribe(function (newValue) {
                    console.log(newValue);
                    self.updateTimerTextColour();
                });
            },
            /**
             * Generating a random number
             */
            randomNumber: function () {
                return Math.floor((Math.random() * 255) + 1);
            },
            /**
             * Generating a random colour
             */
            updateTimerTextColour: function () {
                //define RGB values
                let red = self.randomNumber(),
                    blue = self.randomNumber(),
                    green = self.randomNumber();
                self.randomColour('rgb(' + red + ', ' + blue + ', ' + green + ')');
            }
        });
    }
);
