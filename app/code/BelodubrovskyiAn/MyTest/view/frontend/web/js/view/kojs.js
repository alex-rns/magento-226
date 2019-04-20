define(
    [
        'jquery',
        'ko',
        'uiComponent'
    ],
    function ($, ko, component) {
        'use strict';

        return component.extend({
            firstName: ko.observable(),
            lastName: ko.observable(),
            isVis: ko.observable(),

            /**
             * Сombines firstName and lastName, return fullName
             */
            initialize: function () {
                this._super();
                this.fullName = ko.pureComputed(function () {
                    return this.firstName() + ' ' + this.lastName();
                }, this);
                this.isVisible = ko.pureComputed(function () {
                    return Boolean(this.firstName() || this.lastName());
                }, this);
                this.isChecked = ko.pureComputed(function () {
                    return this.isVis();
                }, this);
            },
            defaults: {
                template: 'BelodubrovskyiAn_MyTest/kotmpl'
            }
        });
    }
);
