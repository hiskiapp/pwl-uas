"use strict";

var KTKBootstrapTouchspin = function () {
    var demos = function () {
        let stock = $('#stock').val();
        $('#touchpin_total_order').TouchSpin({
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary',

            min: 1,
            max: stock,
        });
    }

    return {
        // public functions
        init: function () {
            demos();
        }
    };
}();

jQuery(document).ready(function () {
    KTKBootstrapTouchspin.init();
});
