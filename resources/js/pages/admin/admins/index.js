"use strict";
var KTDatatablesDataSourceAjaxServer = function () {

    var table = $('#kt_datatable').DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        ajax: {
            url: `${HOST_URL}/admin/data/admins`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                columnsDef: ['iteration', 'name', 'email', 'updated_at', 'id'],
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
                data: 'updated_at'
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
                return `<a href="${HOST_URL}/admin/admins/${data}/edit" class="btn btn-sm btn-clean btn-icon" title="Edit"><i class="la la-edit"></i></a>`;
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
