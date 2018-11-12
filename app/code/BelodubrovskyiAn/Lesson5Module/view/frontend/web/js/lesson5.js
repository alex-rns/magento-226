define(['jquery', 'Magento_Ui/js/modal/modal'], function ($, modal) {
    var mageJsComponent = function()
    {
        var options = {
            type: 'popup',
            responsive: true,
            innerScroll: true,
            title: '',
            buttons: [{
                text: $.mage.__('Close'),
                class: '',
                click: function () {
                    this.closeModal();
                }
            }]
        };
        var popup = modal(options, $('#dealer-registration'));
        $("#click-dealer-registration").on('click', function () {
            $("#dealer-registration").modal("openModal");
        });
    };
    return mageJsComponent;
});