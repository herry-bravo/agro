<div class="modal fade bd-example-modal-sm" id="atpModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-white">Detail ATP Reply </h4>

                <button type="button" class="close border-0" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
            </div>
            <form class="form-horizontal" id="formData">
                <div class="modal-body"">
                <div class=" box-body">
                    </br>
                    <div class="row">
                        <div class="col-md-2 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="number">{{ trans('cruds.rcv.fields.orderno') }}</label>
                                <input type="text" class="form-control search_supplier_name" name="orderno" id="orderno" autocomplete="off" required>
                                <input type="hidden" class="form-control search_supplier_name" name="orderid" id="orderid" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="site">{{ trans('cruds.rcv.fields.rev') }}</label>
                                <input type="text" id="rev" name="reference" class="form-control" value="" placeholder="Aju/Invoice/BL.... etc." required>
                            </div>
                        </div>


                        <div class="col-md-2 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="rate">{{ trans('cruds.rcv.fields.etd') }}</label>
                                <input type="text" class="form-control datepicker " id="datepicker-3" name="etd" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-2 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="rate">{{ trans('cruds.rcv.fields.eta') }}</label>
                                <input type="text" class="form-control datepicker" id="datepicker-2" name="eta" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="rate">{{ trans('cruds.rcv.fields.comments') }}</label>
                                <input type="text" class="form-control" name="attribute1" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-1 col-12">
                            <div class="mb-0">
                                <label class="col-sm-0 control-label" for="rate"></label><br>
                                <button type="button" class="btn btn-info rounded-pill refreshAtp" id="refreshAtp"> <i data-feather="refresh-ccw"></i></button>
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                        </br>
                        <table id="atp-id" class=" table w-100 table-striped">
                            <thead>
                                <tr>
                                    <th class="text-start" style=" width=3%">#</th>
                                    <th class="text-center" style="width=3%">Line ID</th>
                                    <th class="text-center" style="width=74%">Product</th>
                                    <th class="text-center" style="width=10%">Planning Quantity</th>
                                    <th class="text-center" style="width=10%">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btnSave">Confirm</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
</div>
@push('script')
<script>
    $(document).ready(function() {
        document.getElementById('orderno').value = $('#order_number').val();
        document.getElementById('orderid').value = $('#header_id').val();


        //save data
        $("#formData").submit(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();
            var btn = $("#btnSave");
            btn.text('Processing...').attr('disabled', true);
            var postData = new FormData($('#formData')[0]);
            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , url: '{{url("admin/atp") }}'
                    , method: "POST"
                    , data: postData
                    , processData: false
                    , cache: false
                    , contentType: false
                    , dataType: 'json'
                })
                .done(function(resp) {
                    if (resp.success) {
                        $("#modalForm").modal("hide");
                        swal.fire("Info", resp.message, "success");
                        $('#atp-id').DataTable().ajax.reload();
                    } else {
                        swal.fire("Warning", resp.message, "warning");
                    }
                })
                .fail(function() {
                    swal.fire("Warning", 'Unable to process request at this moment', "warning");
                })
                .always(function() {
                    btn.text('Save');
                    btn.attr('disabled', false);
                });
        });
        //end save data

    });

    $('#refreshAtp').click(function() {
        $('#atp-id').DataTable().destroy();
        if (document.getElementById('rev').value === "") {
            var table = $('#atp-id').DataTable({
                "bServerSide": true
                , "bLengthChange": false
                , ajax: {
                    url: '{{url("search/po-atp") }}'
                    , type: "POST"
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , data: function(d) {
                        d.search['value'] = $('#header_id').val();
                        return d
                    }
                }
                , searching: false
                , responsive: true
                , columnDefs: [{
                        "targets": 3

                        , "class": "text-center"
                        , "render": function(data, type, row, meta) {
                            return `<input type="text" class="form-control text-end"  name="qty[]" value="${row.qty}" style="border-bottom: antiquewhite;" autocomplete="off" required>`
                        }
                    }, {

                        "targets": 1

                        , "class": "text-nowrap text-center"
                        , "render": function(data, type, row, meta) {
                            return row.id;
                        }
                    }
                    , {
                        "targets": 0

                        , "render": function(data, type, row, meta) {
                            return (`<input type="checkbox" class="form-check-input cb-child dt-checkboxes" name="line_number[]" id="${row.id}" value="${row.id}">
                        <input type="hidden" name="check[]" value="${row.id}">
                        <input type="hidden" name="inventory_item_id[]" value="${row.inventory_item_id}">
                        <input type="hidden" name="po_header_id[]" value="${row.po_header_id}">
                        <input type="hidden" name="description[]" value="${row.description}">
                        <input type="hidden" name="price[]" value="${row.price}">
                        `);
                        }
                    }
                    , {

                        "targets": 2

                        , "class": "text-nowrap"
                        , "render": function(data, type, row, meta) {
                            return row.product;
                        }
                    }
                    , {

                        "targets": 4

                        , "class": "text-end"
                        , "render": function(data, type, row, meta) {
                            return row.price;
                        }
                    }
                ]

            })
        } else {
            var table = $('#atp-id').DataTable({
                "bServerSide": true
                , "bLengthChange": false
                , ajax: {
                    url: '{{url("search/atp-data") }}'
                    , type: "POST"
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , data: function(d) {
                        d.search['value'] = $('#rev').val();
                        d.ordernumber = $('#order_number').val();
                        return d
                    }
                }
                , searching: false
                , responsive: true
                , columnDefs: [{
                        "targets": 3

                        , "class": "text-center"
                        , "render": function(data, type, row, meta) {
                            return `<input type="text" class="form-control text-end"  name="qty[]" value="${row.qty}" style="border-bottom: antiquewhite;" autocomplete="off" required>`
                        }
                    }, {

                        "targets": 1

                        , "class": "text-nowrap text-center"
                        , "render": function(data, type, row, meta) {
                            return row.id;
                        }
                    }
                    , {
                        "targets": 0

                        , "render": function(data, type, row, meta) {
                            return (`<input type="checkbox" class="form-check-input cb-child dt-checkboxes" name="line_number[]" id="${row.id}" value="${row.id}">
                        <input type="hidden" name="check[]" value="${row.id}">
                        <input type="hidden" name="inventory_item_id[]" value="${row.inventory_item_id}">
                        <input type="hidden" name="description[]" value="${row.description}">
                        <input type="hidden" name="po_header_id[]" value="${row.po_header_id}">
                        <input type="hidden" name="price[]" value="${row.price}">
                        `);
                        }
                    }
                    , {

                        "targets": 2

                        , "class": "text-nowrap"
                        , "render": function(data, type, row, meta) {
                            return row.product;
                        }
                    }
                    , {

                        "targets": 4

                        , "class": "text-end"
                        , "render": function(data, type, row, meta) {
                            return row.price;
                        }
                    }
                ]

            })

        }
        table.ajax.reload();
    });

</script>
@endpush
