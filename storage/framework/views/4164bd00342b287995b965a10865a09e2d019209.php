<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="card">
        <form action="<?php echo e(route("admin.arAuto.store")); ?>" method="POST" enctype="multipart/form-data">
            <?php echo e(csrf_field()); ?>

            <div class="card-header">
                <h6 class="card-title">
                    <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.aReceivable.title')); ?> </a>
                    <a href="<?php echo e(route("admin.arAuto.index")); ?>" class="breadcrumbs__item"> Auto Invoice </a>
                </h6>

                <div class="d-flex justify-content-center bd-highlight bg-light inline">
                    <div class="p-25 bd-highlight mt-50" style="font-weight: bold;">
                        Action :
                    </div>
                    <div class="p-25 bd-highlight">
                        <button type='button' class="form-control btn btn-info arrow-right-circle auto" id="allselect"> Auto Invoince</button>
                    </div>
                </div>

                <div>&nbsp;&nbsp;</div>
            </div>
            <?php echo $__env->make('admin.arAuto.invoiceType', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table id="dataDelivery" class="table table-bordered table-striped w-100">
                            <thead>
                                <tr style="text-align: center;">
                                    <th style="text-center">
                                        <input class="form-check-input item_check text-end" id="filtercheck" type="checkbox" value="" />
                                    </th>
                                    <th scope="col">
                                        <?php echo e(trans('cruds.Delivery.table.no_barang')); ?>

                                    </th>
                                    <th scope="col">
                                        <?php echo e(trans('cruds.Delivery.table.cname')); ?>

                                    </th>
                                    <th scope="col">
                                        <?php echo e(trans('cruds.Delivery.table.shipto')); ?>

                                    </th>
                                    <th scope="col">
                                        <?php echo e(trans('cruds.Delivery.table.sj')); ?>

                                    </th>
                                    <th scope="col">
                                        <?php echo e(trans('cruds.Delivery.table.note')); ?>

                                    </th>
                                    <th scope="col">
                                        <?php echo e(trans('cruds.Delivery.table.curenci')); ?>

                                    </th>
                                    <th scope="col">
                                        <?php echo e(trans('cruds.Delivery.table.ft')); ?>

                                    </th>
                                    <th scope="col">
                                        <?php echo e(trans('cruds.Delivery.table.satuan')); ?>

                                    </th>
                                    <th scope="col">
                                        <?php echo e(trans('cruds.Delivery.table.dt')); ?>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('script'); ?>
    <script>
        $(document).ready(function() {
            $('#div1').hide();
            $('input[type=radio][name=options]').change(function() {
                if (this.value == '2') {
                    $('#div1').slideToggle();
                } else if (this.value == '1') {
                    $('#div1').slideUp();
                }
            });
        });
        
        $('#head-cb').on('click', function (e) {
            if ($(this).is(':checked', true)) {
                $(".item_check").prop('checked', true);
            } else {
                $(".item_check").prop('checked', false);
            }
        });
        $(document).on('click', '.auto', function() {
            var cb = $(".cb-child:checked");
            const radioBtn = $("#gridRadios1");
            radioBtn.prop("checked", true);
            $('#div1').hide();
            
            if (cb.length > 0){
                $('#demoModal').modal('show');                
                const radioBtn2 = $("#gridRadios2");
                
                if(cb.length > 1){                    
                    radioBtn2.prop("disabled", true);
                    $('#view').hide();
                }else{
                    radioBtn2.prop("disabled", false);
                    $('#view').show();
                }
            }else{
                alert("Please select data");
            }
        });

        $(document).on('click', '.completion_filter', function() {
            var min = $("#min").val();
            var max = $("#max").val();
            console.log(min);
            console.log(max);
            $('#modalFilter').modal('hide');
            $('#completionTable').DataTable().ajax.reload()
        });
        $(document).ready(function() {
            var table = $('#dataDelivery').DataTable({
                "bDestroy": true
                , "lengthMenu": [
                    [10, 25, 'All']
                    , [10, 25, 'All']
                ],

                searching: true
                , displayLength: 15
                , responsive: false
                , scrollX: true
                , dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">>\
                        <"d-flex justify-content-between row mt-1"<"col-sm-12 col-md-6"Bl><"col-sm-12 col-md-2"f><"col-sm-12 col-md-2"p>t>'
                , buttons: [{
                        text: feather.icons['printer'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Print'
                        , className: 'print'
                        , attr: {
                            id: 'print'
                        }
                    }

                    , {
                        extend: 'excel'
                        , text: feather.icons['file'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Excel'
                        , className: ''
                        , exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        text: feather.icons['filter'].toSvg({
                            class: 'font-small-4 me-50 '
                        }) + 'Filter'
                        , className: 'btn-warning'
                        , action: function(e, node, config) {
                            $('#modalFilter').modal('show')
                        }
                    , },
                    {
                        extend: 'colvis'
                        , text: feather.icons['eye'].toSvg({
                            class: 'font-small-4 me-50'
                        }) + 'Colvis'
                        , className: ''
                    , }
                , ]
                , ajax: {
                    url: '<?php echo e(url("search/delivery-closed")); ?>'
                    , type: "GET"
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , data: function(d) {
                        d.min = $("#min").val();
                        d.max = $("#max").val();
                        return d
                    }
                , }
                , columnDefs: [{
                        "targets": 0
                        , render: function(data, type, row, index) {
                            var info = `<input type="checkbox" style="margin-left:20px;" class="form-check-input cb-child item_check text-center" name="lines[]" id="${row.id}" value="${row.id}"> `;

                            return info;
                        }
                    }
                    , {
                        "targets": 1
                        , "render": function(data, type, row, meta) {
                            return row.id;
                        }
                    }
                    , {
                        "targets": 2
                        , "render": function(data, type, row, meta) {
                            return row.customer_name;
                        }
                    }
                    , {
                        "targets": 3
                        , "render": function(data, type, row, meta) {
                            return row.site;
                        }
                    }
                    , {
                        "targets": 4
                        , "render": function(data, type, row, meta) {
                            return row.delivery_note;
                        }
                    }
                    , {
                        "targets": 5
                        , "render": function(data, type, row, meta) {
                            return row.note;
                        }
                    }
                    , {
                        "targets": 6
                        , "class": "text-center"
                        , "render": function(data, type, row, meta) {
                            return row.currency;
                        }
                    }
                    , {
                        "targets": 7
                        , "render": function(data, type, row, meta) {
                            return row.term;
                        }
                    }
                    , {
                        "targets": 8
                        , "render": function(data, type, row, meta) {
                            return row.qty;
                        }
                    }

                    , {
                        "targets": 9
                        , "class": "text-center"
                        , "render": function(data, type, row, meta) {
                            return row.shipment_date;
                        }
                    }
                , ]
                , language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;'
                        , next: '&nbsp;'
                    }
                }

            })

        });
    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/arAuto/index.blade.php ENDPATH**/ ?>