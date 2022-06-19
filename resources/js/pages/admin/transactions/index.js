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
            url: `${HOST_URL}/admin/data/transactions`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                // parameters for custom backend script demo
                columnsDef: [
                    'code', 'user.name', 'total_price', 'total_item', 'payment_method.name', 'status', 'created_at', 'id'
                ],
            },
        },
        columns: [{
            data: 'code'
        },
            {
                data: 'user.name'
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
                            $('.datatable-input[data-col-index="4"]')
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
                            'Success': {
                                'title': 'Success',
                                'class': ' label-light-success'
                            },
                            'Failed': {
                                'title': 'Failed',
                                'class': ' label-light-danger'
                            },
                        };
                        column.data().unique().sort().each(function (d, j) {
                            $('.datatable-input[data-col-index="5"]')
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
                let action = `<a href="${HOST_URL}/admin/transactions/${data}" class="btn btn-sm btn-clean btn-icon" title="Detail"><i class="la la-list"></i></a>`;
                action += `\
                <div class="dropdown dropdown-inline">\
                <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">\
                <i class="la la-cog"></i>\
                </a>\
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
                <ul class="nav nav-hoverable flex-column">\
                <li class="nav-item"><a class="nav-link btn-waiting" data-id="${data}" href="#"><i class="nav-icon la la-calendar-times"></i><span class="nav-text">Waiting Payment</span></a></li>\
                <li class="nav-item"><a class="nav-link btn-shipping" data-id="${data}" href="#"><i class="nav-icon la la-shipping-fast"></i><span class="nav-text">Shipping</span></a></li>\
                <li class="nav-item"><a class="nav-link btn-done" data-id="${data}" href="#"><i class="nav-icon la la-check-circle-o"></i><span class="nav-text">Done</span></a></li>\
                <li class="nav-item"><a class="nav-link btn-failed" data-id="${data}" href="#"><i class="nav-icon la la-angle-double-down"></i><span class="nav-text">Failed</span></a></li>\
                </ul>\
                </div>\
                </div>\
                `;

                return action;
            },
        },
            {
                targets: 5,
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
                targets: 2,
                render: function (data, type, full, meta) {
                    return 'Rp' + data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
                },
            },
            {
                targets: 3,
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

    $(document).on('click', '.btn-waiting', function (e) {
        let id = $(this).attr('data-id');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, waiting it!"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: `${HOST_URL}/admin/transactions/${id}/waiting`,
                    type: 'POST',
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.fire("Success!",
                            "This transaction has set to waiting!", "info");
                        KTDatatablesSearchOptionsAdvancedSearch.reload();
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });

    $(document).on('click', '.btn-shipping', function (e) {
        let id = $(this).attr('data-id');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, shipping it!"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: `${HOST_URL}/admin/transactions/${id}/shipping`,
                    type: 'POST',
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.fire("Success!",
                            "This transaction has been shipping!", "warning");
                        KTDatatablesSearchOptionsAdvancedSearch.reload();
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });

    $(document).on('click', '.btn-done', function (e) {
        let id = $(this).attr('data-id');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, done it!"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: `${HOST_URL}/admin/transactions/${id}/done`,
                    type: 'POST',
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.fire("Success!",
                            "This transaction has been done!", "success");
                        KTDatatablesSearchOptionsAdvancedSearch.reload();
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });

    $(document).on('click', '.btn-failed', function (e) {
        let id = $(this).attr('data-id');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, failed it!"
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: `${HOST_URL}/admin/transactions/${id}/failed`,
                    type: 'POST',
                    dataType: "JSON",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        Swal.fire("Success!", "This transaction has been failed!",
                            "error");
                        KTDatatablesSearchOptionsAdvancedSearch.reload();
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });

});
