define(
    [
        'uiComponent'
    ],
    function (component) {
        'use strict';

        return component.extend({
            sometext: 'Text in template',
            defaults: {
                template: 'BelodubrovskyiAn_Lesson10Module/lesson10_template'
            }
        });
    }
);
