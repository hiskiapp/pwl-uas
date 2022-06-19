"use strict";
var KTDatatablesDataSourceAjaxServer = function () {

    var table = $('#kt_datatable').DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: `${HOST_URL}/admin/data/products`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                columnsDef: ['iteration', 'photo', 'name', 'category.name', 'stock', 'price', 'seen_total', 'updated_at', 'id'],
            },
        },
        columns: [{
            data: 'iteration'
        },
            {
                data: 'photo'
            },
            {
                data: 'name'
            },
            {
                data: 'category.name'
            },
            {
                data: 'stock'
            },
            {
                data: 'price'
            },
            {
                data: 'seen_total'
            },
            {
                data: 'updated_at'
            },
            {
                data: 'id',
                responsivePriority: -1
            },
        ],
        columnDefs: [
            {
                targets: 1,
                orderable: false,
                render: function (data, type, full, meta) {
                    return `<img src="${HOST_URL}/storage/${data}" alt="${data}" class="img-thumbnail" style="width: 48px;">`;
                }
            },
            {
                targets: 5,
                orderable: true,
                render: function (data, type, full, meta) {
                    return 'Rp '+data.toLocaleString();
                }
            },
            {
                targets: 6,
                orderable: true,
                render: function (data, type, full, meta) {
                    return data.toLocaleString();
                }
            },
            {
                targets: -1,
                title: 'Actions',
                orderable: false,
                render: function (data, type, full, meta) {
                    return `\
							<a href="${HOST_URL}/admin/products/${data}/edit" class="btn btn-sm btn-clean btn-icon" title="Edit">\
								<i class="la la-edit"></i>\
							</a>\
						`;
                },
            }, ],
    });

    return {
        init: function () {
            table;
        },
        reload: function () {
            table.ajax.reload();
        }
    };

}();

jQuery(document).ready(function () {
    KTDatatablesDataSourceAjaxServer.init();
});
