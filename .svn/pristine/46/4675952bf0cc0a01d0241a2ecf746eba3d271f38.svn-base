/**
 * DataTables Basic
 */

$(function () {
    'use strict';

    var dt_basic_table = $('.datatable'),
        dt_date_table = $('.dt-date'),
        dt_complex_header_table = $('.dt-complex-header'),
        dt_row_grouping_table = $('.dt-row-grouping'),
        dt_multilingual_table = $('.dt-multilingual'),
        assetPath = '../../../app-assets/';

    if ($('body').attr('data-framework') === 'laravel') {
        assetPath = $('body').attr('data-asset-path');
    }

    // DataTable with buttons
    // --------------------------------------------------------------------
	//---------------------------



	$("#head-cb").on('click',function(){
		var isChecked=$("#head-cb").prop('checked')
		$('.dt-checkboxes').prop('checked',isChecked)
		if(isChecked==true){
			$("#allselect").prop('disabled',false)
	}
	})
	$("#table tbody").on('click','.dt-checkboxes',function(){
		if($(this).prop('checked')!= true){
			$("#head-cb").prop('checked',false)
			$(".arrow-right-circle").prop('disabled',true)
		}
		if($(this).prop('checked')== true){
			$(".arrow-right-circle").prop('disabled',false)
		}
	})

    if (dt_basic_table.length) {
        var dt_basic = dt_basic_table.DataTable({
            columnDefs: [{
                // For Checkboxes
                targets: 0,
                orderable: true,
                responsivePriority: 3,
                render: function (data, type, full, meta) {
                    return (
                        '<div class="form-check"> <input class="form-check-input dt-checkboxes" type="checkbox" name="lines[]" value="'+data+'" id="checkbox' +
                        data+
                        '" /><label class="form-check-label" for="checkbox' +
                        data +
                        '"></label></div>'
                    );
                },
               // checkboxes: {
                 //   selectAllRender: '<div class="form-check"> <input class="form-check-input" type="checkbox" value="" id="checkboxSelectAll" /><label class="form-check-label" for="checkboxSelectAll"></label></div>'
                //}
            }, ],
            order: [
                [1, 'asc']
            ],
            responsive: false,
            scrollY: true,
            dom: '<"card-header border-bottom"\
                        <"head-label">\
                        <"dt-action-buttons text-end">\
                    >\
                    <"d-flex justify-content-between row mt-1"\
                        <"col-sm-12 col-md-7"Bl>\
                        <"col-sm-12 col-md-2"f>\
                        <"col-sm-12 col-md-2"p>\
                    t>',
            displayLength: 25,
            lengthMenu: [10, 25, 50, 75, 100],
            buttons: [{
                    extend: 'print',
                    text: feather.icons['printer'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Print',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    text: feather.icons['file-text'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Csv',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    text: feather.icons['file'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Excel',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    text: feather.icons['clipboard'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Pdf',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'copy',
                    text: feather.icons['copy'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Copy',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    text: feather.icons['eye'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Colvis',
                    className: '',
                },
            ],
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            }
        });

    }

    // Flat Date picker
    if (dt_date_table.length) {
        dt_date_table.flatpickr({
            monthSelectorType: 'static',
            dateFormat: 'd/m/Y'
        });
    }

    // Add New record
    // ? Remove/Update this code as per your requirements ?
    var count = 101;


    // Delete Record
    $('.datatables-basic tbody').on('click', '.delete-record', function () {
        dt_basic.row($(this).parents('tr')).remove().draw();
    });

    // Complex Header DataTable
    // --------------------------------------------------------------------

    if (dt_complex_header_table.length) {
        var dt_complex = dt_complex_header_table.DataTable({
            ajax: assetPath + 'data/table-datatable.json',
            columns: [{
                    data: 'full_name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'city'
                },
                {
                    data: 'post'
                },
                {
                    data: 'salary'
                },
                {
                    data: 'status'
                },
                {
                    data: ''
                }
            ],
            columnDefs: [{
                    // Label
                    targets: -2,
                    render: function (data, type, full, meta) {
                        var $status_number = full['status'];
                        var $status = {
                            1: {
                                title: 'Current',
                                class: 'badge-light-primary'
                            },
                            2: {
                                title: 'Professional',
                                class: ' badge-light-success'
                            },
                            3: {
                                title: 'Rejected',
                                class: ' badge-light-danger'
                            },
                            4: {
                                title: 'Resigned',
                                class: ' badge-light-warning'
                            },
                            5: {
                                title: 'Applied',
                                class: ' badge-light-info'
                            }
                        };
                        if (typeof $status[$status_number] === 'undefined') {
                            return data;
                        }
                        return (
                            '<span class="badge rounded-pill ' +
                            $status[$status_number].class +
                            '">' +
                            $status[$status_number].title +
                            '</span>'
                        );
                    }
                },
                {
                    // Actions
                    targets: -1,
                    title: 'Actions',
                    orderable: true,
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="d-inline-flex">' +
                            '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
                            feather.icons['more-vertical'].toSvg({
                                class: 'font-small-4'
                            }) +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-end">' +
                            '<a href="javascript:;" class="dropdown-item">' +
                            feather.icons['file-text'].toSvg({
                                class: 'me-50 font-small-4'
                            }) +
                            'Details</a>' +
                            '<a href="javascript:;" class="dropdown-item">' +
                            feather.icons['archive'].toSvg({
                                class: 'me-50 font-small-4'
                            }) +
                            'Archive</a>' +
                            '<a href="javascript:;" class="dropdown-item delete-record">' +
                            feather.icons['trash-2'].toSvg({
                                class: 'me-50 font-small-4'
                            }) +
                            'Delete</a>' +
                            '</div>' +
                            '</div>' +
                            '<a href="javascript:;" class="item-edit">' +
                            feather.icons['edit'].toSvg({
                                class: 'font-small-4'
                            }) +
                            '</a>'
                        );
                    }
                }
            ],
            dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            }
        });
    }

    // Row Grouping
    // --------------------------------------------------------------------

    var groupColumn = 2;
    if (dt_row_grouping_table.length) {
        var groupingTable = dt_row_grouping_table.DataTable({
            ajax: assetPath + 'data/table-datatable.json',
            columns: [{
                    data: 'responsive_id'
                },
                {
                    data: 'full_name'
                },
                {
                    data: 'post'
                },
                {
                    data: 'email'
                },
                {
                    data: 'city'
                },
                {
                    data: 'start_date'
                },
                {
                    data: 'salary'
                },
                {
                    data: 'status'
                },
                {
                    data: ''
                }
            ],
            columnDefs: [{
                    // For Responsive
                    className: 'control',
                    orderable: true,
                    targets: 0
                },
                {
                    visible: false,
                    targets: groupColumn
                },
                {
                    // Label
                    targets: -2,
                    render: function (data, type, full, meta) {
                        var $status_number = full['status'];
                        var $status = {
                            1: {
                                title: 'Current',
                                class: 'badge-light-primary'
                            },
                            2: {
                                title: 'Professional',
                                class: ' badge-light-success'
                            },
                            3: {
                                title: 'Rejected',
                                class: ' badge-light-danger'
                            },
                            4: {
                                title: 'Resigned',
                                class: ' badge-light-warning'
                            },
                            5: {
                                title: 'Applied',
                                class: ' badge-light-info'
                            }
                        };
                        if (typeof $status[$status_number] === 'undefined') {
                            return data;
                        }
                        return (
                            '<span class="badge rounded-pill ' +
                            $status[$status_number].class +
                            '">' +
                            $status[$status_number].title +
                            '</span>'
                        );
                    }
                },
                {
                    // Actions
                    targets: -1,
                    title: 'Actions',
                    orderable: true,
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="d-inline-flex">' +
                            '<a class="pe-1 dropdown-toggle hide-arrow text-primary" data-bs-toggle="dropdown">' +
                            feather.icons['more-vertical'].toSvg({
                                class: 'font-small-4'
                            }) +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-end">' +
                            '<a href="javascript:;" class="dropdown-item">' +
                            feather.icons['file-text'].toSvg({
                                class: 'me-50 font-small-4'
                            }) +
                            'Details</a>' +
                            '<a href="javascript:;" class="dropdown-item">' +
                            feather.icons['archive'].toSvg({
                                class: 'me-50 font-small-4'
                            }) +
                            'Archive</a>' +
                            '<a href="javascript:;" class="dropdown-item delete-record">' +
                            feather.icons['trash-2'].toSvg({
                                class: 'me-50 font-small-4'
                            }) +
                            'Delete</a>' +
                            '</div>' +
                            '</div>' +
                            '<a href="javascript:;" class="item-edit">' +
                            feather.icons['edit'].toSvg({
                                class: 'font-small-4'
                            }) +
                            '</a>'
                        );
                    }
                }
            ],
            order: [
                [groupColumn, 'desc']
            ],
            dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            drawCallback: function (settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;

                api
                    .column(groupColumn, {
                        page: 'current'
                    })
                    .data()
                    .each(function (group, i) {
                        if (last !== group) {
                            $(rows)
                                .eq(i)
                                .before('<tr class="group"><td colspan="8">' + group + '</td></tr>');

                            last = group;
                        }
                    });
            },
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details of ' + data['full_name'];
                        }
                    }),
                    type: 'column',
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                ?
                                '<tr data-dt-row="' +
                                col.rowIdx +
                                '" data-dt-column="' +
                                col.columnIndex +
                                '">' +
                                '<td>' +
                                col.title +
                                ':' +
                                '</td> ' +
                                '<td>' +
                                col.data +
                                '</td>' +
                                '</tr>' :
                                '';
                        }).join('');

                        return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
                    }
                }
            },
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            }
        });

        // Order by the grouping
        $('.dt-row-grouping tbody').on('click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                groupingTable.order([groupColumn, 'desc']).draw();
            } else {
                groupingTable.order([groupColumn, 'asc']).draw();
            }
        });
    }

    // Multilingual DataTable
    // --------------------------------------------------------------------


	var date = new Date();
	var currentDate = date.toISOString().substring(0,10);
	var currentTime = date.toISOString().substring(11,16);
	if(document.getElementById("datePicker")){
	document.getElementById("datePicker").valueAsDate = new Date()
	}
    $('#table tr').on('click', function() {
        $(this).toggleClass('selected');
    });
});
