<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.js')); ?>"></script>
<?php $__env->stopPush(); ?>
    <?php $__env->startSection('breadcrumbs'); ?>
    <a href="<?php echo e(route('admin.asset.index')); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.assetMng.title')); ?></a>
    <a href="<?php echo e(route('admin.asset.index')); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.assetMng.title_singular')); ?></a>
    <a href="" class="breadcrumbs__item active">Create</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>

                    <br>
                    <div class="card-body">
                        <form action="<?php echo e(route('admin.asset.store')); ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">

                                <div class="col-md-12 col-12">
                                    <div class="mb-3">
                                        <div class="form-group row">
                                            <div class="col-sm-5">
                                                <label class="control-label label-primary" for="number"><b >Asset Name</b></label>
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="d-flex justify-content-between mt-2">
                                                    <div></div>
                                                    <div><button type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#modify">
                                                        <i data-feather="settings" class="font-medium-3"></i></button>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    


                                    <div class="mb-2">
                                        <div class="form-group row">
                                            <label class="col-sm-1 control-label"for="number"><?php echo e(trans('cruds.assetMng.category')); ?></label>
                                            <input type="hidden" name="method" id="method" value="" class="form-control">
                                            <input type="hidden" name="method_time" id="method_time" value="" class="form-control">
                                            <input type="hidden" name="prorata" id="method" value="prorata" class="form-control">
                                            <input type="hidden" name="method_progress_factor" id="method_progress_factor" value="" class="form-control">
                                            <input type="hidden" name="method_end" id="method_end" value="" class="form-control">
                                            <input type="hidden" name="state" id="" value="open" class="form-control">
                                            <input type="hidden" name="active" id="" value="True" class="form-control">
                                            <div class="col-sm-4">
                                                <select name="category_id" id="category" class="form-control select2" onChange="get_category(this.options[this.selectedIndex].value)" required>
                                                    <option hidden selected></option>
                                                    <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($row->id); ?>"><?php echo e($row->type); ?> - <?php echo e($row->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-2"></div>
                                            <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.assetMng.field.currency')); ?></label>
                                            <div class="col-sm-4">
                                                <select name="currency_id" id="journal" class="form-control select2" required>
                                                    <option hidden selected></option>
                                                    <?php $__currentLoopData = $curr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($row->currency_code); ?>"><?php echo e($row->currency_code); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-group row ">
                                            <label class="col-sm-1 control-label"for="number"><?php echo e(trans('cruds.assetMng.field.reference')); ?></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="" class="form-control">
                                            </div>
                                            <div class="col-sm-2"></div>
                                            <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.assetMng.field.comp')); ?></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="company_id" class="form-control">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-group row ">
                                            <label class="col-sm-1 control-label"for="number"><?php echo e(trans('cruds.assetMng.field.date')); ?></label>
                                            <div class="col-sm-4">
                                                <input type="date" id="datepicker-1" name="create_date" value="" class="form-control datepicker" autocomplete="off" required>
                                            </div>
                                            <div class="col-sm-2"></div>
                                            <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.assetMng.field.gross')); ?></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="" class="form-control currency_asset residual  text-end"id="gross" placeholder="0.00" value="0.00">
                                                <input type="hidden" name="value" class="form-control  text-end"id="gross1" placeholder="0.00" value="0.00">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="form-group row ">
                                            <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.assetMng.field.invoice')); ?></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="invoice_id" class="form-control">
                                            </div>
                                            <div class="col-sm-2"></div>
                                            <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.assetMng.field.salvage')); ?></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="" class="form-control currency_asset residual  text-end" id="salvage" placeholder="0.00" value="0.00">
                                                <input type="hidden" name="salvage_value" class="form-control   text-end" id="salvage1" placeholder="0.00" value="0.00">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-group row ">
                                            <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.assetMng.field.vendor')); ?></label>
                                            <div class="col-sm-4">
                                                <input type="text" name="" class="form-control">
                                            </div>
                                            <div class="col-sm-2"></div>
                                            <label class="col-sm-1 control-label" for="number"><?php echo e(trans('cruds.assetMng.field.residual')); ?></label>
                                            <div class="col-sm-4">
                                                <input type="text" hidden name="" id="residual_1" value="0" class="form-control">
                                                <input type="text" hidden name="" id="depr" value="" class="form-control">
                                                <label class="form-control text-end" id="residual_2" for="number">0.00</label>
                                            </div>

                                        </div>
                                    </div>

                                    <hr class="mb-3">

                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active btn btn-light" id="nav-ap-tab"data-bs-toggle="tab" data-bs-target="#nav-ap" type="button"role="tab" aria-controls="nav-ap" aria-selected="true">
                                                <span class="bs-stepper-box"><i data-feather="file-text" class="font-medium-3"></i></span>
                                                <span class="bs-stepper-label"><span class="bs-stepper-title">Depreciation Board</span></span>
                                            </button>
                                            <button class="nav-link btn btn-light" id="nav-ap-det-tab"data-bs-toggle="tab" data-bs-target="#nav-ap-det" type="button"role="tab" aria-controls="nav-ap-det" aria-selected="false">
                                                <span class="bs-stepper-box"><i data-feather="dollar-sign" class="font-medium-3"></i></span>
                                                <span class="bs-stepper-label"><span class="bs-stepper-title">Depreciation Informations</span></span>
                                            </button>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        
                                        <div class="tab-pane fade show active" id="nav-ap" role="tabpanel"
                                            aria-labelledby="nav-ap-tab">
                                            <div class="box-body scrollx tableFixHead"
                                                style="height: 380px;overflow: scroll;">
                                                <table class="table table-fixed table-borderless">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center"><?php echo e(trans('cruds.assetMng.field.depr_date')); ?></th>
                                                            <th class="text-center"><?php echo e(trans('cruds.assetMng.field.cumulative')); ?></th>
                                                            <th class="text-center"><?php echo e(trans('cruds.assetMng.field.depr')); ?></th>
                                                            <th class="text-center"><?php echo e(trans('cruds.assetMng.field.residual')); ?></th>
                                                            <th class="text-center"><?php echo e(trans('cruds.assetMng.field.linked')); ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="asset_container">
                                                        <tr class="tr_input1">
                                                            <td><label class="form-control" for="number">&nbsp;</label></td>
                                                            <td><label class="form-control" for="number">&nbsp;</label></td>
                                                            <td><label class="form-control" for="number">&nbsp;</label></td>
                                                            <td><label class="form-control" for="number">&nbsp;</label></td>
                                                            <td><label class="form-control" for="number">&nbsp;</label></td>
                                                        </tr>
                                                        <tr class="tr_input"></tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade show " id="nav-ap-det" role="tabpanel"aria-labelledby="nav-ap-det-tab">
                                            <div class="box-body scrollx tableFixHead"style="height: 380px;">

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="d-flex justify-content-between mt-2">
                                        <button type="reset" class="btn btn-danger pull-left">Reset</button>
                                        <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
                                    </div>
                                </div>
                                <?php echo $__env->make('admin.asset.modify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </form> <!-- /.box-body -->
                    </div>
                </div>
            </div>
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            , }
        });

        $(".currency_asset").on("input", function (e){
            var id =this.id;
            // console.log(id)
            $("#"+id).on({
                input: function () {
                    let input_val = $(this).val();
                    input_val = numberToCurrency(input_val);
                    $(this).val(input_val);
                },

                blur: function () {
                    let input_val = $(this).val();
                    input_val = numberToCurrency(input_val, true, true);
                    $(this).val(input_val);
                }
            });
        });


        var numberToCurrency = function (input_val, fixed = false, blur = false) {
            // don't validate empty input
            if (!input_val) {
                return "";
            }

            if (blur) {
                if (input_val === "" || input_val == 0) { return 0; }
            }

            if (input_val.length == 1) {
                return parseInt(input_val);
            }

            input_val = '' + input_val;

            let negative = '';
            if (input_val.substr(0, 1) == '-') {
                negative = '-';
            }
            // check for decimal
            if (input_val.indexOf(".") >= 0) {
                // get position of first decimal
                // this prevents multiple decimals from
                // being entered
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = left_side.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                if (fixed && right_side.length > 3) {
                    right_side = parseFloat(0 + right_side).toFixed(2);
                    right_side = right_side.substr(1, right_side.length);
                }

                // validate right side
                right_side = right_side.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

                // Limit decimal to only 2 digits
                if (right_side.length > 2) {
                    right_side = right_side.substring(0, 2);
                }

                if (blur && parseInt(right_side) == 0) {
                    right_side = '';
                }

                // join number by .
                // input_val = left_side + "." + right_side;

                if (blur && right_side.length < 1) {
                    input_val = left_side;
                } else {
                    input_val = left_side + "." + right_side;
                }
            } else {
                // no decimal entered
                // add commas to number
                // remove all non-digits
                input_val = input_val.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            if (input_val.length > 1 && input_val.substr(0, 1) == '0' && input_val.substr(0, 2) != '0.') {
                input_val = input_val.substr(1, input_val.length);
            } else if (input_val.substr(0, 2) == '0,') {
                input_val = input_val.substr(2, input_val.length);
            }

            return negative + input_val;
        };

        $(".residual").on("input", function (e){
            var gross = parseInt($('#gross').val().replace(/[^0-9\.-]+/g,""));
            var salvage = parseInt($('#salvage').val().replace(/[^0-9\.-]+/g,""));

            var residual = gross - salvage;
            $("#residual_1").val(residual);
            $("#gross1").val(gross);
            $("#salvage1").val(salvage);
            // console.log(residual)

            residual = residual.toLocaleString({ symbol: '', decimal: ',', separator: '' });
            $("#residual_2").text(residual);

            depreciation();
        });

        function get_category(value){
            $.ajax({
                url: '/search/asset-category',
                type: 'get',
                data: { value: value },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    var method_number = response['method_number'];
                    var method_period = response['method_period'];
                    var method_progress_factor = response['method_progress_factor'];
                    var prorata = response['prorata'];
                    var method = response['method'];
                    var method_time = response['method_time'];
                    var method_end = response['method_end'];
                    $("#method_number").val(method_number);
                    $("#method_period").val(method_period);
                    $("#method_progress_factor").val(method_progress_factor);
                    $("#prorata").val(prorata);
                    $("#method").val(method);
                    $("#method_time").val(method_time);
                    $("#method_end").val(method_end);
                    period();

                }
            });
        }

        function period(){

            var method_number =  $("#method_number").val();
            var method_period =  $("#method_period").val();

            $('.tr_input1').closest('tr').remove();
            $('.tr_input').closest('tr').remove();

            for(var i=0; i<method_number;){
                var depr_date = moment().add((method_period*i), 'months').format('L');
                i++;
                $('.asset_container').append('<tr class="tr_input">\
                                <td><label class="form-control" for="number">'+depr_date+'</label>\
                                    <input type="text" hidden name="depreciation_date[]" class="form-control  text-end" value="'+depr_date+'">\
                                </td>\
                                <td><label class="form-control text-end cumulative" id="cumulative_'+i+'" for="number">0.00</label>\
                                    <input type="hidden" name="amount[]" class="form-control  text-end" id="cumulative1_'+i+'">\
                                </td>\
                                <td><label class="form-control text-end depr" for="number">0.00</label>\
                                    <input type="hidden" name="depreciated_value[]" class="form-control  text-end" id="depr_'+i+'">\
                                </td>\
                                <td><label class="form-control text-end" id="ress_'+i+'" for="number">0.00</label>\
                                    <input type="hidden" name="remaining_value[]" class="form-control  text-end" id="ress1_'+i+'">\
                                </td>\
                                <td><label class="form-control" for="number">&nbsp;</label></td>\
                            </tr>');
            }
            depreciation();
        }

        function depreciation(){

            var residual = $("#residual_1").val();
            var number = $("#method_number").val();
            var depr = residual / number;

            $("#depr").val(depr);
            $(".depr").text(depr.toLocaleString({ symbol: '', decimal: ',', separator: '' }))
            // console.log(depr)
            cumulative();

        }

        function cumulative(){
            var cum = document.getElementsByClassName("cumulative");
            // console.log(cum)

            var residual = parseInt($("#residual_1").val());
            var depr = parseInt($("#depr").val());

            for (var i = 1; i <= cum.length;i++) {

                var nextDepr = depr*i;
                residual = residual-depr;

                $("#depr_"+i).val(depr);
                $("#cumulative1_"+i).val(nextDepr);
                $("#cumulative_"+i).text(nextDepr.toLocaleString({ symbol: '', decimal: ',', separator: '' }));
                $("#ress1_"+i).val(residual);
                $("#ress_"+i).text(residual.toLocaleString({ symbol: '', decimal: ',', separator: '' }));
            }
        }

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/asset/create.blade.php ENDPATH**/ ?>