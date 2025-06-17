<?php $__env->startSection('styles'); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<a href="<?php echo e(route('admin.purchase-requisition.index')); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.quotation.po')); ?> </a>
<a href="<?php echo e(route('admin.purchase-requisition.index')); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.requisition.title_singular')); ?></a>
<a href="" class="breadcrumbs__item active"><?php echo e(trans('cruds.requisition.fields.view')); ?></a>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<ul class="nav navbar-nav align-items-end ms-auto">
    <li class="nav-item dropdown dropdown-user nav-item has">
        <button type="button" class="btn btn-primary btn-icon" id="dropdown-user" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="feather-16" data-feather="settings"> </i>
        </button>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
            <a class="dropdown-item" href="javascript:if(window.print)window.print()"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer font-small-4 me-50">
                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                        <rect x="6" y="14" width="12" height="8"></rect>
                    </svg>Print</span></a>
            <a class="dropdown-item" href="" data-toggle="modal"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard font-small-4 me-50">
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                        <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                    </svg>Export To Pdf</span></a>
            <a class="dropdown-item" href="#demoModal" data-toggle="modal"> <i class="me-50 feather-16" data-feather="sliders"> </i> More Filter</a>
        </div>
    </li>
</ul>
</br>
<?php $__currentLoopData = $purchaseRequisition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $raw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<page size="A5">
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <table>
                        <tr>
                            <td><br>
                                <img style="width: 5%; float:left;margin-left:4%;" src="<?php echo e(asset('app-assets/images/logo/favicon.png')); ?>" alt="buana-megah">
                                <p style="font-size:12px;"><b style="color: green;"> &nbsp;&nbsp;NEXZO-APP</b><br>
                                    <b>&nbsp;&nbsp;Head Office : </b>Jl. Argopuro 42, Surabaya 60251, East Java, Indonesia<br>&nbsp;
                                    <b>Pasuruan Office : </b>Jalan Raya Cangkringmalang km. 40, Beji Pasuruan 67154 East Java, Indonesia<br>&nbsp;
                                    <b>Tel. </b><a href="tel:+62343656288">656288</a>, <a href="tel:+62343656289">656289</a> Fax. <a href="fax:+62343655054">655054</a><br></p>
                            </td>
                        </tr>
                        <tr>
                    </table>
                    <hr style="color: green;    margin-left: 5%;    margin-right: 5%;">
                    <div class="d-flex justify-content-center ">
                        <h4><strong></br>Purchase Requisition </br></strong></h4>
                    </div>

                    <div class="card-body">
                        <div class="container-fluid mt-100 mb-100">
                            <div id="ui-view">
                                <div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-1">Number</h6>
                                                    <div><strong><?php echo e($raw->segment1 ?? ''); ?></strong></div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <h6 class="mb-1">Cost Center</h6>
                                                    <div><strong><?php echo e($raw->attribute1); ?> (<?php echo e($raw->CcBook->cc_name); ?>)</strong></div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <h6 class="mb-1">Requested By </h6>


                                                    <div><strong><?php echo e($raw->user->name?? ''); ?></strong></div>

                                                </div>
                                                <div class="col-sm-2">
                                                    <h6 class="mb-1">Creation Date</h6>
                                                    <div><strong><?php echo e($raw->transaction_date); ?></strong></div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <h6 class="mb-1">Status</h6>
                                                    <?php if($raw->authorized_status == 2): ?>
                                                    <div><strong>Approve</strong></div>
                                                    <?php elseif($raw->authorized_status == 13): ?>
                                                    <div><strong>Rejected By <?php echo e($user); ?></strong></div>
                                                    <?php else: ?>
                                                    <div><strong>Request Approval</strong></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="table-responsive-sm mb-4">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">#</th>
                                                            <th>Product</th>
                                                            <th class="center">UOM</th>
                                                            <th class="right">Quantity</th>
                                                            <th class="right">Estimated Cost</th>
                                                            <th>Need By Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $subtotal=0; ?>
                                                        <?php $__currentLoopData = $requisitionDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($row->header_id == $raw->id): ?>
                                                        <tr>
                                                            <td class="center"><?php echo e($row->header_id); ?></td>
                                                            <td><?php echo e($row->ItemMaster->item_code); ?> - <?php echo e($row->attribute1); ?> </td>
                                                            <td class="text-center"><?php echo e($row->pr_uom_code); ?></td>
                                                            <td class="text-right"><?php echo e($row->quantity); ?></td>
                                                            <td class="text-right"><?php echo e($row->estimated_cost); ?></td>
                                                            <td class="center"><?php echo e($row->requested_date); ?></td>
                                                        </tr>
                                                    <tfoot>

                                                        <?php $subtotal+= $row->estimated_cost; ?>
                                                        <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </tbody>

                                                </table>
                                            </div>
                                            <br>
                                            <div class="row ">
                                                <div class="col-lg-5 col-sm-5"></div>
                                                <div class="col-lg-4 col-sm-5 ml-auto">
                                                    <table class="table table-clear">
                                                        <tbody>
                                                            <tr>
                                                                <td class="left">

                                                                </td>
                                                                <td class="text-end"></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="left">

                                                                    <strong> Total</strong>
                                                                </td>
                                                                <td class="text-end">

                                                                </td>
                                                                <td class="text-end">
                                                                    <strong><?php echo e(number_format($subtotal+($subtotal), 2, ',', '.')); ?></strong>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-2  text-center">Created BY</div>
                                    <div class=" col-sm-2  text-center">Approved BY </div>
                                    <div class="col-sm-2  text-center">W/H Manager</div>
                                    <div class=" col-sm-2  text-center">Purchasing Manager</div>
                                </div>
                                <div class="row justify-content-end" style="padding-top: 2%;">
                                    <div class="col-sm-2 text-center"><?php echo e($raw->createdby->name); ?></div>
                                    <div class=" col-sm-2  text-center"> <?php if($raw->app_lvl==0): ?>
                                        #NA
                                        <?php else: ?>
                                        <?php echo e($raw->createdby->userManager->name ?? '#NA'); ?>

                                        <?php endif; ?></div>
                                    <div class="col-sm-2  text-center"><?php echo e($raw->appwh->name ?? '#NA'); ?></div>
                                    <div class=" col-sm-2  text-center"><?php if($raw->authorized_status==2): ?>
                                        Purchasing Manager
                                        <?php else: ?>
                                        #NA
                                        <?php endif; ?></div>
                                </div>
                                </br>
                                <div class="justify-content-start">
                                    <div class="col-sm-12  text-start">Approval Comments :</div>
                                    <?php $__currentLoopData = $comment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cmn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-sm-12  text-start"><?php echo e($cmn->userID ?? ''); ?> - <?php echo e($cmn->comments ?? ''); ?></div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                </br>
                                </br>
                                </br>
                                </br>
                                <div class="justify-content-start">
                                    <div class="col-sm-12  text-start">Generated from eWorkflow Online Workspace application system</div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <!-- /.content -->
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/purchaseRequisition/show.blade.php ENDPATH**/ ?>