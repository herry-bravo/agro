
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/charts/apexcharts.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/pages/dashboard-ecommerce.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/charts/chart-apex.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
    <div class="row match-height">
        <!-- Sales Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0 pt-1">
                    <div class="avatar bg-light-info p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="shopping-cart" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder mt-1"><?php echo e('Sales'); ?></h2>
                    <p class="card-text"><?php echo e(__('messages.title.sales')); ?></p>
                </div>
                <div id="product-chart"></div>
            </div>
        </div>
        <!-- Sales Chart Card ends -->

        <!-- Shipment Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0 pt-1">
                    <div class="avatar bg-light-success p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="truck" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder mt-1"><?php echo e('Shipment'); ?></h2>
                    <p class="card-text"><?php echo e(__('messages.title.shipment')); ?></p>
                </div>
                <div id="sales-chart"></div>
            </div>
        </div>
        <!-- Shipment Chart Card ends -->

        <!-- On Hand Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0 pt-1">
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="package" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder mt-1"><?php echo e('Onhand Stock'); ?></h2>
                    <p class="card-text"><?php echo e(__('messages.title.finishg')); ?></p>
                </div>
                <div id="suplier-chart"></div>
            </div>
        </div>
        <!-- On Hand Chart Card ends -->

        <!-- Material Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header flex-column align-items-start pb-0 pt-1">
                    <div class="avatar bg-light-danger p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather="tool" class="font-medium-5"></i>
                        </div>
                    </div>
                    <h2 class="fw-bolder mt-1"><?php echo e('Material'); ?></h2>
                    <p class="card-text"><?php echo e(__('messages.title.mtrls')); ?></p>
                </div>
                <div id="customer-chart"></div>
            </div>
        </div>
        <!-- Material Chart Card ends -->
    </div>
    <!-- Revenue Report Card -->
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="col-lg-12 col-12">
                        <div class="card card-revenue-budget">
                            <div class="row mx-0">
                                <div class="col-md-8 col-12 revenue-report-wrapper">
                                    <div class="d-sm-flex justify-content-between align-items-center mb-3">
                                        <h4 class="card-title mb-50 mb-sm-0"><?php echo e(__('messages.chart.title')); ?></h4>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center me-2">
                                                <span class="bullet bullet-primary font-small-3 me-50 cursor-pointer"></span>
                                                <span><?php echo e(__('messages.chart.earning')); ?></span>
                                            </div>
                                            <div class="d-flex align-items-center ms-75">
                                                <span class="bullet bullet-warning font-small-3 me-50 cursor-pointer"></span>
                                                <span><?php echo e(__('messages.chart.expense')); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="revenue-report-chart"></div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Revenue Report Card -->

    <!-- Company Table Card -->
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="col-lg-12 col-12">
                        <div class="card card-company-table">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table" id="table-mtl-trx" class="w-100">
                                        <thead>
                                            <tr>
                                                <th>Company</th>
                                                <th>Category</th>
                                                <th>Views</th>
                                                <th>Date</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Company Table Card -->


</section>
<!-- Dashboard Analytics end -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
    $(document).ready(function() {
        //  $.fn.dataTable.ext.errMode = 'none';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#table-mtl-trx').DataTable({
             ajax: {
                url: '<?php echo e(url("search/mtl-trx-report")); ?>'
                , type: "GET"
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , data: function(d) {
                    return d
                }
            }
            , responsive: false
            , searching: true
            , displayLength: 15
            , dom: '<"d-flex justify-content-between row mt-1"\
                        <"col-sm-12 col-md-6"l>\
                        <"col-sm-12 col-md-3">\
                        <"col-sm-12 col-md-3"f>\
                    t>'
            , columns: [ {
                    data: 'transaction_source_name'
                    , className: "text-start"
                }, {
                    data: 'description'
                    , className: "text-start"
                }, {
                    data: 'subinventory_code'
                    , className: "text-center"
                }, {
                    data: 'transaction_date'
                    , className: "text-end"
                }, {
                    data: 'transaction_quantity'
                    , className: "text-end"
                }
            ]});
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/home/index.blade.php ENDPATH**/ ?>