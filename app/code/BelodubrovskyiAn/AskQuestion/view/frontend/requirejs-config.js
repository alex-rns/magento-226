var config = {
    map: {
        '*': {
            askQuestionSample: 'BelodubrovskyiAn_AskQuestion/js/ask-question-sample',
            geekhubValidationAlert: 'BelodubrovskyiAn_AskQuestion/js/validation-alert'
        }
    },
    config: {
        mixins: {
            'mage/validation': {
                'BelodubrovskyiAn_AskQuestion/js/validation-ua-phone-nubmer-mixin': true
            }
        }
    }

};
