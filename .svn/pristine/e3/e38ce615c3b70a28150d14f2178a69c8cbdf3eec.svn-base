<div class="modal fade" id="poModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-white">Good Receipt Notes</h4>
                <button type="button" class="close border-0" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
            </div>

            <div class="modal-body" style="padding: 0rem 0rem;">
                <div class="box-body p-2 ">
                    <table data-toggle="table_grn" id="table_grn" class="table  table-hover w-100 ">
                        <thead>
                            <tr>
                                <th class="text-start"><input type="checkbox" class='form-check-input dt-checkboxes' id="head-cb"></th>
                                <th class="text-start">GRN</th>
                                <th class="text-start">Purchase Order</th>
                                <th class="text-start">Vendor Code </th>
                                <th class="text-start">Vendor </th>
                                <th class="text-start">Packing Slip</th>
                                <th class="text-start">Currency</th>
                                <th class="text-start">Amount</th>
                                <th class="text-start">GL Date</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-primary pull-right " id="addGrn-line" data-bs-dismiss="modal">
                            <i data-feather="corner-down-right" class="font-medium-3"></i> Submit</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('script')
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var modal = $('#poModal');
        modal.find('.btn-secondary').on('click', function() {
            modal.modal('hide');
        });
        $("#addGrn-line").click(function() {
            $id = $("#invoice_id").val();
            var colnum = 0;
            console.log($id);

            var invoice_num = $("#invoice_num").val();

            if (invoice_num == '') {
                swal.fire("Info", "Invoice  Fields is Required", "alert");
                return;
            }

            idGrn = [];
            $(".cb-child:checked").each(function() {
                idGrn.push($(this).attr('data-id'));
            })
            // console.log(idGrn)
            $.ajax({
                method: 'POST'
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '{{url("search/store-ap") }}'
                , data: {
                    idGrn: idGrn
                    , invoice_num: $("#invoice_num").val()
                    , invoice_id: $("#invoice_id").val()
                    , invoice_amount: $("#invoice_amount").val()
                    , datepicker1: $("#datepicker-1").val()
                    , datepicker2: $("#datepicker-2").val()
                    , datepicker3: $("#datepicker-3").val()
                    , vendor_id: $("#vendor_id").val()
                    , terms_id: $("#terms_id").val()
                    , customer_currency: $("#customer_currency").val()
                    , invoice_type_lookup_code: $("#invoice_type_lookup_code").val()
                }
                , success: function(response) {
                    // console.log(idGrn);
                    window.location.href = "" + response[0]['invoice_id'] + "/edit";

                    if ($id == 0) {

                        $("#poModal").modal("hide");

                        var index = $('#tableAP tbody tr').length + 1; //row count
                        console.log(index)
                        document.getElementById('invoice_num2').value = invoice_num;
                        var subtotal = 0;

                        var len = response.length;
                        console.log(response)


                    } else {
                        window.location.reload();
                    }
                }
                , error: function(response) {

                    swal.fire("Info", "Data Not Match", "alert");

                }

            });


        });
    });

</script>
@endpush
