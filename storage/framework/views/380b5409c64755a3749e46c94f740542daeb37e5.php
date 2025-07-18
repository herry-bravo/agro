
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/forms/wizard/bs-stepper.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-validation.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-wizard.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/vendors/js/forms/wizard/bs-stepper.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/forms/form-wizard.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/currency.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<a href="#" class="breadcrumbs__item">Reports</a>
<a href="#" class="breadcrumbs__item active">Standard Report</a>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- Modern Horizontal Wizard -->
<section class="modern-horizontal-wizard">

    <div class="bs-stepper wizard-modern modern-wizard-example">
        <div class="bs-stepper-header">
            <div class="step" data-target="#step1" role="tab" id="step1-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">
                        <i data-feather="file-text" class="font-medium-3"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Business Overview</span>
                        <span class="bs-stepper-subtitle">Management Report</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step" data-target="#step2" role="tab" id="step2-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">
                        <i data-feather="info" class="font-medium-3"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">TAX</span>
                        <span class="bs-stepper-subtitle">Tax Details Info</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step" data-target="#step3" role="tab" id="step3-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">
                        <i data-feather="link" class="font-medium-3"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Sales</span>
                        <span class="bs-stepper-subtitle">Sales Order</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step" data-target="#step4" role="tab" id="step4-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">
                        <i data-feather="link" class="font-medium-3"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Purchase</span>
                        <span class="bs-stepper-subtitle">Purchase Reports</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step" data-target="#step5" role="tab" id="step5-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">
                        <i data-feather="link" class="font-medium-3"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Inventory</span>
                        <span class="bs-stepper-subtitle">Purchase Reports</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step" data-target="#step6" role="tab" id="step6-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">
                        <i data-feather="link" class="font-medium-3"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Production</span>
                        <span class="bs-stepper-subtitle">Production Reports</span>
                    </span>
                </button>
            </div>
            <div class="line">
                <i data-feather="chevron-right" class="font-medium-2"></i>
            </div>
            <div class="step" data-target="#step7" role="tab" id="step7-trigger">
                <button type="button" class="step-trigger">
                    <span class="bs-stepper-box">
                        <i data-feather="link" class="font-medium-3"></i>
                    </span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Accounting</span>
                        <span class="bs-stepper-subtitle">Accounting Reports</span>
                    </span>
                </button>
            </div>
        </div>
        <div class="bs-stepper-content">
            <div id="step1" class="content" role="tabpanel" aria-labelledby="step1-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Item Master Details</h5>
                    <small class="text-muted">Enter Your Item Master Details.</small>
                </div>

                <hr>

            </div>
            <div id="step2" class="content" role="tabpanel" aria-labelledby="step2-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Detail Info</h5>
                    <small>Enter Your Detail Info.</small>
                </div>


            </div>
            <div id="step3" class="content" role="tabpanel" aria-labelledby="step3-trigger">
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <h5> General Sales Order Report</h5>
                            <div class="list-group  list-group-flush">
                                <a href="<?php echo e(route("admin.sales.data")); ?>" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Sales Order Outstanding</a>
                                <a data-bs-toggle="modal" data-bs-target="#suratJalan" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i> Surat Jalan
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#packingList" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i> Packing List
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#salesInvoicing" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i> Invoicing
                                </a>
                            </div>
                        </div>

                        <div class="col-sm">
                            <h5> Shipment</h5>
                            <div class="list-group  list-group-flush">
                                <a href="<?php echo e(route("admin.sales.data_invoice")); ?>" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Invoice Report</a>
                                <a href="<?php echo e(route("admin.sales.data_shipment")); ?>" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i> Shipment Report
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#packingList" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i> Delivery Report
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#salesInvoicing" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i> Invoicing
                                </a>
                            </div>
                        </div>
                        <div class="col-sm">
                            <h5> General Sales Order Report</h5>
                            <div class="list-group  list-group-flush">
                                <a href="<?php echo e(route("admin.sales.data")); ?>" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Sales Order Outstanding</a>
                                <a data-bs-toggle="modal" data-bs-target="#poModal" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i> Surat Jalan
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#packingList" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i> Packing List
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#salesInvoicing" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i> Invoicing
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="step4" class="content" role="tabpanel" aria-labelledby="step4-trigger">
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <h5> General Purchase Order Report</h5>
                            <div class="list-group  list-group-flush">
                                <a data-bs-toggle="modal" data-bs-target="#poModal" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i> Purchase Order Report
                                </a>
                                <a href="<?php echo e(route("admin.pr-report.index")); ?>" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Purchase Requisition</a>
                                <a href="<?php echo e(route("admin.purchase.data")); ?>" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Purchase Order Outstanding</a>
                                <a href="<?php echo e(route("admin.rcv.index")); ?>" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Purchase Order Receive</a>
                                <a href="#demoModal" data-bs-toggle="modal" data-bs-target="#demoModal" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Good Receipt Notes</a>
                                <a href="#missExpenses" data-bs-toggle="modal" data-bs-target="#missExpenses" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Miscellaneous Expenses</a>
                                <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true"><i data-feather="arrow-right-circle"></i> A disabled link item</a>
                            </div>
                        </div>

                        <div class="col-sm">
                            <h5> General Purchase Order Report</h5>
                            <div class="list-group  list-group-flush">
                                <a data-bs-toggle="modal" data-bs-target="#poModal" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i> Purchase Order Report
                                </a>
                                <a href="<?php echo e(route("admin.pr-report.index")); ?>" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Purchase Requisition</a>
                                <a href="#" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Purchase Order Outstanding</a>
                                <a href="#" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Purchase Order Receive</a>
                                <a href="<?php echo e(route("admin.grn.index")); ?>" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Good Receipt Notes</a>
                                <a href="#missExpenses" data-bs-toggle="modal" data-bs-target="#missExpenses" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Miscellaneous Expenses</a>
                                <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true"><i data-feather="arrow-right-circle"></i> A disabled link item</a>
                            </div>
                        </div>
                        <div class="col-sm">
                            <h5> General Purchase Order Report</h5>
                            <div class="list-group  list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i> Purchase Order Report
                                </a>
                                <a href="<?php echo e(route("admin.pr-report.index")); ?>" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Purchase Requisition</a>
                                <a href="#" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Purchase Order Outstanding</a>
                                <a href="#" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Purchase Order Receive</a>
                                <a href="<?php echo e(route("admin.grn.index")); ?>" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Good Receipt Notes</a>
                                <a href="#missExpenses" data-bs-toggle="modal" data-bs-target="#missExpenses" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Miscellaneous Expenses</a>
                                <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true"><i data-feather="arrow-right-circle"></i> A disabled link item</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="step5" class="content" role="tabpanel" aria-labelledby="step5-trigger">
                <div class="container">
                    <div class="row">
                        <div class="col-sm">
                            <h5> General Inventory Report</h5>
                            <div class="list-group  list-group-flush">
                                <a data-bs-toggle="modal" data-bs-target="#inventoryReport" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i> Inventory Report
                                </a>
                                <a href="<?php echo e(route("admin.purchase.data")); ?>" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Purchase Order Outstanding</a>
                            </div>
                        </div>

                        <div class="col-sm">
                            <h5> General Inventory Report</h5>
                            <div class="list-group  list-group-flush">
                                <a data-bs-toggle="modal" data-bs-target="#inventoryReport" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i> Inventory Report
                                </a>
                                <a href="#" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Purchase Order Outstanding</a>
                            </div>
                        </div>
                        <div class="col-sm">
                            <h5> General Inventory Report</h5>
                            <div class="list-group  list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i>Inventory Report
                                </a>
                                <a href="#" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Purchase Order Outstanding</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div id="step6" class="content" role="tabpanel" aria-labelledby="step6-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Production</h5>
                    <small>Enter Your Social Links.</small>
                    <hr>
                </div>
                <div class="container" style="padding-top: 0px; !important">
                    <div class="row">
                        <div class="col-sm">
                            <h5> General Production Report</h5>
                            <div class="list-group  list-group-flush">
                                <a data-bs-toggle="modal" data-bs-target="#woDoc" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i> Work Order Document
                                </a>
                                <a href="<?php echo e(route("admin.purchase.data")); ?>" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Purchase Order Outstanding</a>
                            </div>
                        </div>

                        <div class="col-sm">
                            <h5> General Production Report</h5>
                            <div class="list-group  list-group-flush">
                                <a data-bs-toggle="modal" data-bs-target="#woDoc" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i> Inventory Report
                                </a>
                                <a href="#" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Purchase Order Outstanding</a>
                            </div>
                        </div>
                        <div class="col-sm">
                            <h5> General Production Report</h5>
                            <div class="list-group  list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                    <i data-feather="arrow-right-circle"></i>Inventory Report
                                </a>
                                <a href="#" class="list-group-item list-group-item-action"><i data-feather="arrow-right-circle"></i> Purchase Order Outstanding</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="step7" class="content" role="tabpanel" aria-labelledby="step7-trigger">
                <div class="content-header">
                    <h5 class="mb-0">Accounting Reports</h5>
                </div>
                <div class="col-sm">
                    <div class="list-group  list-group-flush">
                        <a data-bs-toggle="modal" data-bs-target="#apModal" class="list-group-item list-group-item-action" aria-current="true">
                            <i data-feather="arrow-right-circle"></i> Accounts Payable Report
                        </a>
                    </div>
                    <div class="list-group  list-group-flush">
                        <a data-bs-toggle="modal" data-bs-target="#glModal" class="list-group-item list-group-item-action" aria-current="true">
                            <i data-feather="arrow-right-circle"></i> General Ladger
                        </a>
                    </div>
                    <div class="list-group  list-group-flush">
                        <a data-bs-toggle="modal" data-bs-target="#bankModal" class="list-group-item list-group-item-action" aria-current="true">
                            <i data-feather="arrow-right-circle"></i> Bank Journal
                        </a>
                    </div>
                    <div class="list-group  list-group-flush">
                        <a data-bs-toggle="modal" data-bs-target="#cashModal" class="list-group-item list-group-item-action" aria-current="true">
                            <i data-feather="arrow-right-circle"></i> Cash Journal
                        </a>
                    </div>
                    <div class="list-group  list-group-flush">
                        <a data-bs-toggle="modal" data-bs-target="#paymentsModal" class="list-group-item list-group-item-action" aria-current="true">
                            <i data-feather="arrow-right-circle"></i> Payment Report
                        </a>
                    </div>
                    <div class="list-group  list-group-flush">
                        <a data-bs-toggle="modal" data-bs-target="#paymentsModal" class="list-group-item list-group-item-action" aria-current="true">
                            <i data-feather="arrow-right-circle"></i> Cash Flow
                        </a>
                    </div>
                    <div class="list-group  list-group-flush">
                        <a data-bs-toggle="modal" data-bs-target="#bsModal" class="list-group-item list-group-item-action" aria-current="true">
                            <i data-feather="arrow-right-circle"></i> Balance Sheet
                        </a>
                    </div>
                    <div class="list-group  list-group-flush">
                        <a data-bs-toggle="modal" data-bs-target="#paymentsModal" class="list-group-item list-group-item-action" aria-current="true">
                            <i data-feather="arrow-right-circle"></i> Bank Reconciliation
                        </a>
                    </div>
                    <div class="list-group  list-group-flush">
                        <a data-bs-toggle="modal" data-bs-target="#pnlModal" class="list-group-item list-group-item-action" aria-current="true">
                            <i data-feather="arrow-right-circle"></i> Profit & Lost (P/L)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Start Modal Filter -->
    <?php echo $__env->make('admin.stdReports.globalFilter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.stdReports.bsFilter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- END  Modal Filter -->




</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/stdReports/index.blade.php ENDPATH**/ ?>