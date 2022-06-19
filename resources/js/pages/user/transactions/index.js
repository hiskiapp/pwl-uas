"use strict";
var KTDatatablesSearchOptionsAdvancedSearch = function () {

    $.fn.dataTable.Api.register('column().title()', function () {
        return $(this.header()).text().trim();
    });

    var table = $('#kt_datatable').DataTable({
        responsive: true,
        // Pagination settings
        dom: `<'row'<'col-sm-12'tr>>
        <'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
        // read more: https://datatables.net/examples/basic_init/dom.html

        lengthMenu: [5, 10, 25, 50],

        order: [],

        pageLength: 10,

        language: {
            'lengthMenu': 'Display _MENU_',
        },

        searchDelay: 500,
        processing: true,
        serverSide: true,

        ajax: {
            url: `${HOST_URL}/data/transactions`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                // parameters for custom backend script demo
                columnsDef: [
                    'code', 'total_price', 'total_item', 'payment_method.name', 'status', 'created_at', 'id'
                ],
            },
        },
        columns: [{
            data: 'code'
            },
            {
                data: 'total_price'
            },
            {
                data: 'total_item'
            },
            {
                data: 'payment_method.name'
            },
            {
                data: 'status'
            },
            {
                data: 'created_at'
            },
            {
                data: 'id',
                responsivePriority: -1
            },
        ],

        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;

                switch (column.title()) {
                    case 'Payment':
                        column.data().unique().sort().each(function (d, j) {
                            $('.datatable-input[data-col-index="3"]')
                                .append('<option value="' + d + '">' + d +
                                    '</option>');
                        });
                        break;

                    case 'Status':
                        var status = {
                            'Waiting Payment': {
                                'title': 'Waiting Payment',
                                'class': 'label-light-secondary'
                            },
                            'Shipping': {
                                'title': 'Shipping',
                                'class': ' label-light-warning'
                            },
                            'Done': {
                                'title': 'Done',
                                'class': ' label-light-success'
                            },
                            'Failed': {
                                'title': 'Failed',
                                'class': ' label-light-danger'
                            },
                        };
                        column.data().unique().sort().each(function (d, j) {
                            $('.datatable-input[data-col-index="4"]')
                                .append('<option value="' + d + '">' +
                                    status[d].title + '</option>');
                        });
                        break;
                }
            });
        },

        columnDefs: [{
            targets: -1,
            title: 'Actions',
            orderable: false,
            render: function (data, type, full, meta) {
                let action = `<a href="${HOST_URL}/transactions/${full.code}" class="btn btn-sm btn-clean btn-icon" title="Detail"><i class="la la-list"></i></a>`;

                return action;
            },
        },
            {
                targets: 4,
                render: function (data, type, full, meta) {
                    var status = {
                        'Waiting Payment': {
                            'title': 'Waiting Payment',
                            'class': 'label-light-secondary'
                        },
                        'Shipping': {
                            'title': 'Shipping',
                            'class': ' label-light-warning'
                        },
                        'Done': {
                            'title': 'Done',
                            'class': ' label-light-success'
                        },
                        'Failed': {
                            'title': 'Failed',
                            'class': ' label-light-danger'
                        },
                    };

                    if (typeof status[data] === 'undefined') {
                        return data;
                    }

                    return '<span class="label label-lg font-weight-bold' + status[data]
                        .class + ' label-inline">' + status[data].title + '</span>';
                },
            },
            {
                targets: 1,
                render: function (data, type, full, meta) {
                    return 'Rp' + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
                },
            },
            {
                targets: 2,
                render: function (data, type, full, meta) {
                    return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
                },
            },
        ],
    });

    var filter = function () {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        table.column($(this).data('col-index')).search(val ? val : '', false, false).draw();
    };

    var asdasd = function (value, index) {
        var val = $.fn.dataTable.util.escapeRegex(value);
        table.column(index).search(val ? val : '', false, true);
    };

    $('#kt_search').on('click', function (e) {
        e.preventDefault();
        var params = {};
        $('.datatable-input').each(function () {
            var i = $(this).data('col-index');
            if (params[i]) {
                params[i] += '|' + $(this).val();
            } else {
                params[i] = $(this).val();
            }
        });
        $.each(params, function (i, val) {
            // apply search params to datatable
            table.column(i).search(val ? val : '', false, false);
        });
        table.table().draw();
    });

    $('#kt_reset').on('click', function (e) {
        e.preventDefault();
        $('.datatable-input').each(function () {
            $(this).val('');
            table.column($(this).data('col-index')).search('', false, false);
        });
        table.table().draw();
    });

    $('#kt_datepicker').datepicker({
        todayHighlight: true,
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>',
        },
    });

    return {
        //main function to initiate the module
        init: function () {
            table;
        },
        reload: function () {
            table.ajax.reload();
        }
    };

}();

jQuery(document).ready(function () {
    KTDatatablesSearchOptionsAdvancedSearch.init();
});
