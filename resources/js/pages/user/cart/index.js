"use strict";

var TouchpinTotalOrder = function () {
    var main = function () {
        $('.btn-minus').click(function() {
            let productId = $(this).data('product-id');
            let stock = $(this).data('stock');
            let totalOrder = $(`[data-product-id="${productId}"].text-total-order:first`).text();
            if(totalOrder > 1) {
                totalOrder--;
                $.ajax({
                    url: `${HOST_URL}/cart/update`,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        _method: 'PATCH',
                        product_id: productId,
                        total_order: totalOrder,
                    },
                    success: function (data) {
                        if (data.status === 'success') {
                            $(`[data-product-id="${productId}"].text-total-order`).text(totalOrder);
                            $(`[data-product-id="${productId}"].text-total-price`).text(`Rp${data.total_price.toLocaleString()}`);
                            $('.text-subtotal').text(`Rp${data.subtotal.toLocaleString()}`);
                        }
                    }
                });
            }
        });
        $('.btn-plus').click(function() {
            let productId = $(this).data('product-id');
            let stock = $(this).data('stock');
            let totalOrder = $(`[data-product-id="${productId}"].text-total-order:first`).text();
            if (totalOrder < stock) {
                totalOrder++;
                $.ajax({
                    url: `${HOST_URL}/cart/update`,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        _method: 'PATCH',
                        product_id: productId,
                        total_order: totalOrder,
                    },
                    success: function (data) {
                        if (data.status === 'success') {
                            $(`[data-product-id="${productId}"].text-total-order`).text(totalOrder);
                            $(`[data-product-id="${productId}"].text-total-price`).text(`Rp${data.total_price.toLocaleString()}`);
                            $('.text-subtotal').text(`Rp${data.subtotal.toLocaleString()}`);
                        }
                    }
                });
            }else{
                toastr.error('Stock is not enough');
            }
        });
    }

    return {
        // public functions
        init: function () {
            main();
        }
    };
}();

jQuery(document).ready(function () {
    TouchpinTotalOrder.init();
});
