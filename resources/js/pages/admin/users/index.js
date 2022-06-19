"use strict";
var KTDatatablesDataSourceAjaxServer = function () {

    var table = $('#kt_datatable').DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: `${HOST_URL}/admin/data/users`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                columnsDef: ['iteration', 'name', 'email', 'created_at', 'id'],
            },
        },
        columns: [{
                data: 'iteration'
            },
            {
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: 'created_at'
            },
            {
                data: 'id',
                responsivePriority: -1
            },
        ],
        columnDefs: [{
            targets: -1,
            title: 'Actions',
            orderable: false,
            render: function (data, type, full, meta) {
                return `\
                            <a href="${HOST_URL}/admin/users/${data}" class="btn btn-sm btn-clean btn-icon" title="Detail" data-id="${data}">\
								<i class="la la-eye"></i>\
							</a>\
							<a href="${HOST_URL}/admin/users/${data}/edit" class="btn btn-sm btn-clean btn-icon" title="Edit">\
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
