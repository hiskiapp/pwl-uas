"use strict";
var KTDatatablesDataSourceAjaxServer = function () {

    var table = $('#kt_datatable').DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: `${HOST_URL}/admin/data/payment-methods`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                columnsDef: ['iteration', 'icon', 'name', 'account_number', 'account_owner', 'updated_at', 'id'],
            },
        },
        columns: [{
            data: 'iteration'
        },
            {
                data: 'icon'
            },
            {
                data: 'name'
            },
            {
                data: 'account_number'
            },
            {
                data: 'account_owner'
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
            targets: -1,
            title: 'Actions',
            orderable: false,
            render: function (data, type, full, meta) {
                return `\
							<a href="${HOST_URL}/admin/payment-methods/${data}/edit" class="btn btn-sm btn-clean btn-icon" title="Edit">\
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
