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
            red: ko.observable(0),
            blue: ko.observable(0),
            green: ko.observable(0),
            /**
             * Initialize function
             */
            initialize: function () {
                self = this;
                this._super();
                //call the incrementTime function to run on intialize
                this.incrementTime();
                this.subscribeToTime();
                this.randomColour = ko.computed(function () {
                    //return the random colour value
                    return 'rgb(' + this.red() + ', ' + this.blue() + ', ' + this.green() + ')';
                }, this);
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
             * Updating color depending on the generated number
             */
            updateTimerTextColour: function () {
                //define RGB values
                this.red(self.randomNumber());
                this.blue(self.randomNumber());
                this.green(self.randomNumber());
            }
        });
    }
);
