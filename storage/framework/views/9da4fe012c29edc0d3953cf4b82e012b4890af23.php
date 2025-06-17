
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<nav class="breadcrumbs">
    <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.OrderManagement.title')); ?></a>
    <a href="" class="breadcrumbs__item active">Invoice</a>
</nav>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <form action="<?php echo e(route('admin.invoices.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo e(csrf_field()); ?>

            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <h6 class="card-title ">
                            <a href="<?php echo e(route('admin.invoices.index')); ?>"
                                class="breadcrumbs__item">Accounting & GL</a>
                            <a href="<?php echo e(route('admin.invoices.index')); ?>"
                                class="breadcrumbs__item"><?php echo e(trans('cruds.OrderManagement.inv')); ?> </a>
                            <a href="<?php echo e(route('admin.invoices.index')); ?>"
                                class="breadcrumbs__item"> <?php echo e($sales->inv_number); ?></a>
                                
                        </h6>

                        <div class="row">
                            <div class="col-lg-12">
                                <a class="btn btn-primary" href="#" id="printButton">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-50 font-small-4">
                                            <path d="M19 8h-2V5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v3H5a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2zM9 5h6v3H9V5zM5 10h14v9H5v-9z"></path>
                                        </svg>
                                    </span>
                                    Print Invoice
                                </a>
                                <a class="btn btn-primary" href="#" id="printStruk">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-50 font-small-4">
                                            <path d="M19 8h-2V5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v3H5a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2zM9 5h6v3H9V5zM5 10h14v9H5v-9z"></path>
                                        </svg>
                                    </span>
                                    Struk
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-1">
                                <label class="form-label" for="bill_to"><?php echo e(trans('cruds.Invoice.field.cust')); ?></label>
                                <select name="bill_to" id="customer" class="form-control select2" required>
                                    <option readonly value="<?php echo e($sales->customer->party_name); ?>" <?php echo e(old('customer_name') ? 'selected' : ''); ?> selected> <?php echo e($sales->customer->party_name); ?> - <?php echo e($sales->customer->address1); ?>, <?php echo e($sales->customer->city); ?> </option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.faktur_no')); ?></label>
                                    <select name="faktur" id="faktur" class="form-control select2" required value="<?php echo e($sales->faktur); ?>">
                                    <option value="<?php echo e($sales->faktur); ?>" <?php echo e(old('customer_name') ? 'selected' : ''); ?> selected> <?php echo e($sales->faktur); ?></option>
                                    </select>
                                    <!-- <input autocomplete="off" type="text" id="segment1" name="segment1" class="form-control" value="" required> -->
                                    <input type="number" hidden id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>" class="form-control">
                                    <input type="number" hidden id="last_updated_by" name="last_updated_by" value="<?php echo e(auth()->user()->id); ?>" class="form-control">
                                    <input type="number" hidden id="status " name="status" value="0" class="form-control">
                                    <input type="number" hidden id="status " name="je_batch_id" value="<?php echo e(random_int(0, 999999)); ?>" class="form-control">
                                    <input type="number" hidden id="status " name="organization_id" value="222" class="form-control">
                                    <input type="number" hidden id="status " name="je_batch_id" value="<?php echo e(random_int(0, 999999)); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.so_number')); ?></label>
                                    <input type="text" readonly id="segment1" name="so_number" class="form-control" value="<?php echo e($sales->order_number); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.tax_date')); ?></label>
                                    <input type="text" id="segment1" name="segment1" class="form-control datepicker" value="<?php echo e($sales->tax_date && $sales->tax_date instanceof \Carbon\Carbon ? $sales->tax_date->format('d-M-Y') : ''); ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-1">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.currency')); ?></label>
                                    <select name="customer_currency" id="customer_currency" class="form-control select2" required value="<?php echo e($sales->attribute1); ?>">
                                    <option value="<?php echo e($sales->attribute1); ?>" <?php echo e(old('customer_name') ? 'selected' : ''); ?> selected> <?php echo e($sales->attribute1); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.tax')); ?></label>
                                    <select id="tax" name="tax" class="form-control select2" required>
                                        <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(($row->tax_rate)== $sales->tax_exempt_flag): ?>)
                                                <option value="<?php echo e($row->tax_rate); ?>" <?php echo e(old('customer_name') ? 'selected' : ''); ?>> <?php echo e($row->tax_name); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.journal')); ?></label>
                                    <select name="je_category" id="je_category" class="form-control select2" required>
                                        <?php $__currentLoopData = $trx; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->trx_source_types); ?>"> <?php echo e($row->trx_source_types); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.noinv')); ?></label>
                                    <input type="text" id="noinv" name="noinv" class="form-control" value="<?php echo e($sales->inv_number); ?>" readonly required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.invdate')); ?></label>
                                    <input type="text" id="tgl_invoice" name="tgl_invoice" value="<?php echo e($sales->tax_date && $sales->tax_date instanceof \Carbon\Carbon ? $sales->tax_date->format('d-M-Y') : ''); ?>" class="form-control" required>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-3">
                                <div class="mb-1">

                                </div>
                            </div>
                            <!-- <div class="col-md-1">
                                <div class="mb-1">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                    <?php echo e(trans('cruds.Invoice.field.tunai')); ?>

                                    </label>
                                </div>
                            </div> -->
                        </div>
                        <br>

                        <!-- tab jurnal -->
                        <div class="card-header">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-sales-tab" data-bs-toggle="tab" data-bs-target="#nav-sales" type="button" role="tab" aria-controls="nav-sales" aria-selected="true">
                                        <span class="bs-stepper-box">
                                            <i data-feather="file-text" class="font-medium-3"></i>
                                        </span>
                                        <?php echo e(trans('cruds.Invoice.field.invlines')); ?>

                                    </button>
                                   
                                    <button class="nav-link" id="nav-shipment-tab" data-bs-toggle="tab" data-bs-target="#nav-shipment" type="button" role="tab" aria-controls="nav-shipment" aria-selected="false">
                                        <span class="bs-stepper-box">
                                            <i data-feather="book-open" class="font-medium-3"></i>
                                        </span>
                                        <?php echo e(trans('cruds.Invoice.field.journalitm')); ?>

                                    </button>
                                </div>
                            </nav>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="tab-content" id="nav-tabContent">
                                
                                <div class="tab-pane fade show active" id="nav-sales" role="tabpanel" aria-labelledby="nav-sales-tab">
                                    <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                        <table class="table table-bordered table-striped table-hover datatable inv_datatable" id="inv_datatable">
                                            <thead>
                                                <tr>
                                                    <th>
                                                    </th>
                                                    <th scope="col">
                                                        <?php echo e(trans('cruds.Invoice.field.desc')); ?>

                                                    </th>
                                                    <th scope="col">
                                                        <?php echo e(trans('cruds.Invoice.field.qty')); ?>

                                                    </th>
                                                    <th scope="col">
                                                        <?php echo e(trans('cruds.Invoice.field.price')); ?>

                                                    </th>
                                                    <th scope="col">
                                                        <?php echo e(trans('cruds.Invoice.field.shpdate')); ?>

                                                    </th>
                                                    <th scope="col">
                                                        <?php echo e(trans('cruds.Invoice.field.up')); ?>

                                                    </th>
                                                    <th scope="col">
                                                        <?php echo e(trans('cruds.Invoice.field.subtotal')); ?>

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $unitprice = 0; // Variabel untuk menyimpan total
                                                    $total = 0; // Variabel untuk menyimpan total
                                                    $tax = 0; // Variabel untuk menyimpan total
                                                ?>
                                                <?php $__currentLoopData = $so_detil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td>

                                                        </td>
                                                        <td>
                                                            <?php echo e($row->user_description_item ?? ''); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e(number_format($row->ordered_quantity ?? '')); ?>


                                                        </td>
                                                        <td>
                                                            <?php echo e(number_format($row->unit_selling_price ?? '')); ?>


                                                        </td>
                                                        <td>
                                                            <?php echo e(\Carbon\Carbon::parse($row->schedule_ship_date)->format('d-m-Y') ?? ''); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e(number_format($row->unit_percent_base_price ?? '')); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e(number_format($row->unit_list_price ?? '')); ?>

                                                        </td>
                                                        <?php
                                                            // Tambahkan hasil perkalian ke total
                                                            $unitprice += $row->unit_percent_base_price ?? 0;
                                                            $total += $row->unit_list_price ?? 0;
                                                            $tax = $unitprice - $total;
                                                        ?>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                            <footer>
                                                <tr>
                                                    <th>
                                                        Total
                                                    </th>
                                                    <th>
                                                    </th>
                                                    <th>
                                                    </th>
                                                    <th>
                                                    </th>
                                                    <th>
                                                    </th>
                                                    <th >
                                                        <?php echo e(number_format($unitprice)); ?>

                                                    </th>
                                                    <th>
                                                        <?php echo e(number_format($total)); ?>

                                                    </th>
                                                </tr>
                                            </footer>
                                        </table>
                                    </div>
                                </div>
                                <br>
                               
                                
                                <div class="tab-pane fade" id="nav-shipment" role="tabpanel" aria-labelledby="nav-shipment-tab">
                                    <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                        <table class="table table-striped tableFixHead" id="tab_logic">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th scope="col"><?php echo e(trans('cruds.Invoice.field.account')); ?></th>
                                                    <th scope="col"><?php echo e(trans('cruds.Invoice.field.label')); ?></th>
                                                    <th scope="col"><?php echo e(trans('cruds.Invoice.field.debit')); ?></th>
                                                    <th scope="col"><?php echo e(trans('cruds.Invoice.field.credit')); ?></th>
                                                </tr>
                                            </thead>
                                            <?php
                                                $totalDr = 0;
                                                $totalCr = 0;
                                            ?>

                                            <tbody class="sales_order_shipment_container">
                                                <?php $__currentLoopData = $so_detil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $drValue = 0; // Karena DR pada loop pertama selalu 0
                                                        $crValue = $row->unit_list_price;
                                                        $totalDr += $drValue;
                                                        $totalCr += $crValue;
                                                    ?>
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <?php echo e($row->products->category->acc->account_code ?? ''); ?> - <?php echo e($row->products->category->acc->description ?? ''); ?>

                                                            <input type="hidden" name="accDes[]" value="<?php echo e($row->products->category->acc->account_code ?? ''); ?>">
                                                            <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_1" autocomplete="off">
                                                        </td>
                                                        <td>
                                                            <?php echo e($row->user_description_item ?? ''); ?>

                                                            <input type="hidden" name="desc[]" value="<?php echo e($row->user_description_item ?? ''); ?>">
                                                        </td>
                                                        <td>
                                                            <?php echo e(number_format($drValue)); ?>

                                                            <input type="hidden" name="dr[]" value="<?php echo e($drValue); ?>">
                                                        </td>
                                                        <td>
                                                            <?php echo e(number_format($crValue)); ?>

                                                            <input type="hidden" name="cr[]" value="<?php echo e($crValue); ?>">
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <?php $__currentLoopData = $so_detil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $drValue = $row->products->item_cost*$row->ordered_quantity;
                                                        $crValue = 0; // CR pada loop kedua selalu 0
                                                        $totalDr += $drValue;
                                                        $totalCr += $crValue;
                                                    ?>
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <input type="hidden" name="accDes[]" value="<?php echo e($row->products->category->cogs->account_code ?? ''); ?>">
                                                            <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_1" autocomplete="off">
                                                            <?php echo e($row->products->category->cogs->account_code ?? ''); ?> - <?php echo e($row->products->category->cogs->description ?? ''); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($row->user_description_item ?? ''); ?>

                                                            <input type="hidden" name="desc[]" value="<?php echo e($row->user_description_item ?? ''); ?>">
                                                        </td>
                                                        <td>
                                                            <?php echo e(number_format($drValue)); ?>

                                                            <input type="hidden" name="dr[]" value="<?php echo e($drValue); ?>">
                                                        </td>
                                                        <td>
                                                            <?php echo e(number_format($crValue)); ?>

                                                            <input type="hidden" name="cr[]" value="<?php echo e($crValue); ?>">
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <?php $__currentLoopData = $so_detil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $drValue = 0; // DR pada loop ketiga selalu 0
                                                        $crValue = $row->products->item_cost *$row->ordered_quantity;
                                                        $totalDr += $drValue;
                                                        $totalCr += $crValue;
                                                    ?>
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_1" autocomplete="off">
                                                            <input type="hidden" name="accDes[]" value="<?php echo e($row->products->category->cogs->account_code ?? ''); ?>">
                                                            <?php echo e($row->products->category->inventory->account_code ?? ''); ?> - <?php echo e($row->products->category->inventory->description ?? ''); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($row->user_description_item ?? ''); ?>

                                                            <input type="hidden" name="desc[]" value="<?php echo e($row->user_description_item ?? ''); ?>">
                                                        </td>
                                                        <td>
                                                            <?php echo e(number_format($drValue)); ?>

                                                            <input type="hidden" name="dr[]" value="<?php echo e($drValue); ?>">
                                                        </td>
                                                        <td>
                                                            <?php echo e(number_format($crValue)); ?>

                                                            <input type="hidden" name="cr[]" value="<?php echo e($crValue); ?>">
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                

                                                <!-- Account PPN -->
                                                <?php
                                                    $drValue = 0; // DR untuk PPN selalu 0
                                                    $crValue = $tax ?? 0;
                                                    $totalDr += $drValue;
                                                    $totalCr += $crValue;
                                                ?>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_1" autocomplete="off">
                                                        <input type="hidden" name="accDes[]" value="<?php echo e($ppn->account_code ?? ''); ?>">
                                                        <?php echo e($ppn->account_code ?? ''); ?> - <?php echo e($ppn->description ?? ''); ?>

                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="desc[]" value="<?php echo e($ppn->account_group ?? ''); ?>">
                                                        <?php echo e($ppn->account_group ?? ''); ?>

                                                    </td>
                                                    <td>
                                                        <?php echo e(number_format($drValue)); ?>

                                                        <input type="hidden" name="dr[]" value="<?php echo e($drValue); ?>">
                                                    </td>
                                                    <td>
                                                        <?php echo e(number_format($crValue)); ?>

                                                        <input type="hidden" name="cr[]" value="<?php echo e($crValue); ?>">
                                                    </td>
                                                </tr>

                                                <?php $__currentLoopData = $so_detil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $drValue = $row->unit_percent_base_price; // DR pada loop ketiga selalu 0
                                                        $crValue = 0;
                                                        $totalDr += $drValue;
                                                        $totalCr += $crValue;
                                                    ?>
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_1" autocomplete="off">
                                                            <input type="hidden" name="accDes[]" value="<?php echo e($row->products->category->cogs->account_code ?? ''); ?>">
                                                            <?php echo e($row->products->category->arTax->account_code ?? ''); ?> - <?php echo e($row->products->category->inventory->description ?? ''); ?>

                                                        </td>
                                                        <td>
                                                            INV-<?php echo e($sales->order_number); ?>

                                                            <input type="hidden" name="desc[]" value="<?php echo e($row->user_description_item ?? ''); ?>">
                                                        </td>
                                                        <td>
                                                            <?php echo e(number_format($drValue)); ?>

                                                            <input type="hidden" name="dr[]" value="<?php echo e($drValue); ?>">
                                                        </td>
                                                        <td>
                                                            <?php echo e(number_format($crValue)); ?>

                                                            <input type="hidden" name="cr[]" value="<?php echo e($crValue); ?>">
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                <!-- Total DR dan CR -->
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td>
                                                        <?php echo e($sales->attribute1); ?> <?php echo e(number_format($totalDr)); ?>

                                                        <input type="hidden" name="total_dr" value="<?php echo e($totalDr); ?>">
                                                    </td>
                                                    <td>
                                                        <?php echo e($sales->attribute1); ?> <?php echo e(number_format($totalCr)); ?>

                                                        <input type="hidden" name="total_cr" value="<?php echo e($totalCr); ?>">
                                                    </td>
                                                </tr>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-document" role="tabpanel" aria-labelledby="nav-document-tab">
                                    <div class="box-body scrollx" style="height: 300px;overflow: scroll;">

                                        <div class="d-flex justify-content-center" style="margin-top: 5%;">
                                            <a href="#imgModal" data-bs-toggle="modal" class="link-info">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="75" height="60" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                                    <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z" />
                                                </svg>
                                                <?php echo e(trans('cruds.itemMaster.fields.img')); ?>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-2 mt-2">
                            <div></div>
                            <!-- <button type="submit"  class="btn btn-sm btn-primary pull-right" onclick="myFunction()"> <i data-feather="corner-down-right" class="font-medium-3"></i> Submit</button> -->
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

    
    <script>
        const invoiceItems = <?php echo json_encode($so_detil, 15, 512) ?>;
    </script>

    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        
        // $('#inv_datatable').DataTable({
        //     ajax:'./../invoices/store',
        //     columns:[
        //         { data:'id',name:'id'},
        //         { data:'unique_no',name:'unique_no'},
        //         { data: 'name', name: 'name' },
        //         { data: 'created_at', name:'created_at'}
        //     ],
        // });
    </script>
  
 
    <script>
        document.getElementById('printStruk').addEventListener('click', function (e) {
            e.preventDefault();

            const { jsPDF } = window.jspdf;

            // Data toko
            const storeName = "TOKO PERTANIAN SURYA";
            const storeAddress = "SUMOBITO - JOMBANG";
            const cashierName = "Cashier: <?php echo e($user); ?>";
            const transactionId = "<?php echo e($sales->order_number); ?>";
            const purchaseDate = new Date().toLocaleDateString();

            // Data produk dari Laravel Blade
            const items = [
                <?php $__currentLoopData = $so_detil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                {
                    name : "<?php echo e($row->user_description_item ?? ''); ?>",
                    qty  : "<?php echo e(number_format($row->ordered_quantity ?? 0)); ?>",
                    price: "<?php echo e(number_format($row->unit_selling_price ?? 0)); ?>",
                    total: "<?php echo e(number_format($row->unit_list_price ?? 0)); ?>"
                },
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ];


            // Menghitung total harga
            let totalAmount = 0;
            items.forEach(item => {
                totalAmount += parseFloat(item.total.replace(/,/g, '')) || 0;
            });

            // Menghitung tinggi dokumen secara dinamis
            const baseHeight = 50; // Tinggi minimum
            const rowHeight = 12;  // Tinggi per item
            const totalHeight = baseHeight + (items.length * rowHeight);

            // Membuat dokumen dengan tinggi dinamis
            const doc = new jsPDF('p', 'mm', [57, totalHeight]);

            // Layout pengaturan margin dan font
            const margin = 2;
            let y = 7; // Posisi awal vertikal

            doc.setFont("helvetica");

            // Nama Toko (Besar & Tengah)
            doc.setFontSize(12);
            doc.setFont("helvetica", "bold");
            const textWidth = doc.getTextWidth(storeName);
            doc.text(storeName, (57 - textWidth) / 2, y);
            y += 3;

            // Alamat Toko
            doc.setFontSize(6);
            doc.setFont("helvetica", "normal");
            const addrWidth = doc.getTextWidth(storeAddress);
            doc.text(storeAddress, (57 - addrWidth) / 2, y);
            y += 4;

            const labelX = margin;         // posisi label kiri
            const valueX = margin + 14;    // posisi nilai rata setelah titik dua

            doc.setFontSize(6);
            doc.setFont("helvetica", "normal");

            doc.text('Cashier', labelX, y);
            doc.text(':', labelX + 12, y);
            doc.text(cashierName.replace('Cashier: ', ''), valueX, y);
            y += 3;

            doc.text('Transaction', labelX, y);
            doc.text(':', labelX + 12, y);
            doc.text(transactionId, valueX, y);
            y += 3;

            doc.text('Date', labelX, y);
            doc.text(':', labelX + 12, y);
            doc.text(purchaseDate, valueX, y);
            y += 4;

            // Garis pemisah
            doc.line(margin, y, 55, y);
            y += 3;

            // **Format tabel vertikal**
            let maxHeight = 200; // Maksimal tinggi sebelum pindah halaman
            function wrapText(doc, text, maxWidth) {
                return doc.splitTextToSize(text, maxWidth);
            }

            items.forEach(item => {
                doc.setFontSize(6);

                const labelX = margin;
                const valueX = margin + 13;

                // Hitung max width yang tersedia
                const pageWidth = doc.internal.pageSize.getWidth();
                const maxWidth = pageWidth - valueX - margin;

                // Bungkus teks jika terlalu panjang
                const wrappedName = doc.splitTextToSize(item.name, maxWidth);

                // Product
                doc.text("Product", labelX, y);
                doc.text(":", labelX + 12, y);
                doc.text(wrappedName, valueX, y);
                y += (wrappedName.length * 3); // naikkan Y sesuai baris

                // Qty
                doc.text("Qty", labelX, y);
                doc.text(":", labelX + 12, y);
                doc.text(item.qty, valueX, y);
                y += 3;

                // Price
                doc.text("Price", labelX, y);
                doc.text(":", labelX + 12, y);
                doc.text(item.price, valueX, y);
                y += 5;
            });

            // Update tinggi dokumen bila perlu
            const finalY = y + 20;
            if (finalY > doc.internal.pageSize.getHeight()) {
                doc.internal.pageSize.setHeight(finalY);
            }
            // Garis pemisah
            doc.line(margin, y, 55, y);
            y += 4;

            // **Total Harga**
            doc.setFontSize(8);
            doc.setFont("helvetica", "bold");
            doc.text('Total: ' + totalAmount.toLocaleString(), margin, y);

            // Cetak struk
            doc.autoPrint();
            const pdfData = doc.output('blob');
            const pdfWindow = window.open('', '', 'width=600,height=400');
            const iframe = pdfWindow.document.createElement('iframe');
            iframe.style.position = 'absolute';
            iframe.style.top = '0';
            iframe.style.left = '0';
            iframe.style.width = '100%';
            iframe.style.height = '100%';
            iframe.style.border = 'none';
            pdfWindow.document.body.appendChild(iframe);

            const blobURL = URL.createObjectURL(pdfData);
            iframe.src = blobURL;

            iframe.onload = function () {
                pdfWindow.print();
            };
        });
    </script>
    <script>
        document.getElementById('printButton').addEventListener('click', async function(e) {
            e.preventDefault();

            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('p', 'mm', 'a4');
            const margin = 15;

            // Ambil data dari Laravel Blade
            const customerName = "<?php echo e($sales->customer->party_name ?? ''); ?>";
            const customerAddress = "<?php echo e($sales->customer->address1 ?? ''); ?>, <?php echo e($sales->customer->city ?? ''); ?>";
            const invoiceNumber = "<?php echo e($sales->inv_number ?? ''); ?>";
            const soNumber = "<?php echo e($sales->order_number ?? ''); ?>";
            const invDate = "<?php echo e($sales->inv_date ?? ''); ?>";
            const taxDate = "<?php echo e($sales->tax_date ?? ''); ?>";
            const taxType = "<?php echo e($sales->tax->tax_name ?? ''); ?>";
            const subTotal = <?php echo e($unitprice ?? 0); ?>;
            const total = <?php echo e($total ?? 0); ?>;
            const tax = <?php echo e($tax ?? 0); ?>;
            const companyName = "TOKO PERTANIAN SURYA";

            // Format tanggal ke d-m-Y
            function formatDate(dateString) {
                if (!dateString) return '';
                const dateObj = new Date(dateString);
                const day = String(dateObj.getDate()).padStart(2, '0');
                const month = String(dateObj.getMonth() + 1).padStart(2, '0');
                const year = dateObj.getFullYear();
                return `${day}-${month}-${year}`;
            }

            const formattedInvDate = formatDate(invDate);
            const formattedTaxDate = formatDate(taxDate);

            // Header
            doc.setFont("helvetica");
            doc.setFontSize(18);
            doc.text('Invoice', margin, 20);
            doc.setFontSize(12);
            doc.text(invoiceNumber, 170, 20);
            doc.line(margin, 25, 200, 25);

            const infoLabelX = margin;
            const infoValueX = margin + 30;
            let infoY = 30;
            const infoGapY = 6;

            doc.setFontSize(10);
            doc.setFont("helvetica", "normal");

            doc.text('Customer:', infoLabelX, infoY);
            doc.text(customerName, infoValueX, infoY);

            infoY += infoGapY;
            doc.text('Address:', infoLabelX, infoY);
            doc.text(customerAddress, infoValueX, infoY);

            infoY += infoGapY;
            doc.text('Tax:', infoLabelX, infoY);
            doc.text(taxType, infoValueX, infoY);


            // Gunakan autoTable untuk tabel item
            doc.autoTable({
                head: [['Item', 'Quantity', 'Price', 'Unit Price', 'Sub Total']],
                body: invoiceItems.map(item => {
                    const qty = Number(item.ordered_quantity || 0);
                    const price = Number(item.unit_selling_price || 0);            // Harga awal per unit
                    const unitPrice = Number(item.unit_percent_base_price || 0);   // Harga diskon per unit
                    const subTotal = Number(item.unit_list_price || 0);            // Nilai akhir

                    return [
                        item.user_description_item || '',
                        qty.toLocaleString('id-ID'),
                        price.toLocaleString('id-ID'),
                        unitPrice.toLocaleString('id-ID'),
                        subTotal.toLocaleString('id-ID')
                    ];
                }),
                startY: 50,
                styles: {
                    fontSize: 10,
                    overflow: 'linebreak',
                    cellPadding: 3,
                    halign: 'center',
                },
                columnStyles: {
                    0: { cellWidth: 60, halign: 'left'   }, // Item
                    1: { cellWidth: 25, halign: 'center' }, // Quantity
                    2: { cellWidth: 30, halign: 'center' }, // Price (unit_selling_price)
                    3: { cellWidth: 30, halign: 'center' }, // Unit Price (unit_percent_base_price)
                    4: { cellWidth: 35, halign: 'center' }  // Sub Total (unit_list_price)
                }
            });



            // Tambahkan Total
            const finalY = doc.lastAutoTable.finalY + 10;
            const gapY = 8;
            const labelX = 140; // Kolom label
            const valueX = 195; // Kolom angka rata kanan

            doc.setFontSize(10);
            doc.setFont("helvetica", "normal");

            // Baris Sub Total
            doc.text('Sub Total', labelX, finalY);
            doc.text(subTotal.toLocaleString('id-ID'), valueX, finalY, { align: 'right' });

            // Baris PPN
            doc.text('PPN', labelX, finalY + gapY);
            doc.text(tax.toLocaleString('id-ID'), valueX, finalY + gapY, { align: 'right' });

            // Baris Total
            doc.setFont("helvetica", "bold");
            doc.text('Total', labelX, finalY + gapY * 2);
            doc.text(total.toLocaleString('id-ID'), valueX, finalY + gapY * 2, { align: 'right' });
            doc.setFont("helvetica", "normal");


            // Footer kiri
            doc.setFont("helvetica", "bold");
            doc.text(companyName, margin, finalY + 25);

            // Footer kanan: waktu pembelian
            const purchaseTime = new Date().toLocaleString('id-ID');
            const pageWidth = doc.internal.pageSize.width;
            const purchaseTimeWidth = doc.getTextWidth(purchaseTime);
            const xPosition = pageWidth - purchaseTimeWidth - margin;
            doc.text(purchaseTime, xPosition, finalY + 25);

            // Cetak otomatis
            const pdfData = doc.output('blob');
            const blobURL = URL.createObjectURL(pdfData);
            const pdfWindow = window.open('', '', 'width=600,height=400');
            const iframe = pdfWindow.document.createElement('iframe');
            iframe.style.position = 'absolute';
            iframe.style.top = '0';
            iframe.style.left = '0';
            iframe.style.width = '100%';
            iframe.style.height = '100%';
            iframe.style.border = 'none';
            pdfWindow.document.body.appendChild(iframe);
            iframe.src = blobURL;

            iframe.onload = function () {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
            };
        });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro_nexzo_app\resources\views/admin/invoices/show.blade.php ENDPATH**/ ?>