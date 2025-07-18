<div class="modal fade bd-example-modal-sm" id="rcv_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-white"><?php echo e(trans('cruds.vendor.title')); ?></h4>

                <button type="button" class="close border-0" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
            </div>

            <div class="modal-body"">
                <div class=" box-body">
                <table id="table_rcv_det" class=" table table-striped w-100 " data-source="data-source">
                    <thead>
                        <tr>
                            <th class="text-start">Packing Slip </th>
                            <th class="text-start">Item</th>
                            <th class="text-end">Receive Qty</th>
                            <th class="text-end">GL Date</th>
                            <th class="text-end">GRN</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
</div>
</div>
<?php $__env->startPush('script'); ?>
<script>
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#table_rcv_det').DataTable({
            "bServerSide": true
            , ajax: {
                url: '<?php echo e(url("search/rcv-report")); ?>'
                , type: "POST"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    d.search['value'] = $('#header_id').val();
                    return d
                }
            }
            , responsive: true
            , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-8"Bl><"col-sm-12 col-md-4"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
            , displayLength: 10
            , "lengthMenu": [
                [10, 25, 50, -1]
                , [10, 25, 50, "All"]
            ]
            , columns: [{
                data: 'packing_slip'
            }, {
                data: 'item_code'
            }, {
                data: 'quantity_received'
                , class: 'text-end'

            }, {
                data: 'gl_date'
                , class: 'text-end'

            }, {
                data: 'grn'
                , class: 'text-end'
            }]

        })

    });

</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/purchase/rcv-src.blade.php ENDPATH**/ ?>