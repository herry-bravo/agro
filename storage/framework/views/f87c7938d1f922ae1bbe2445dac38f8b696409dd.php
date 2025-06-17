
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
                    <div class="card-header">
                        <h4 class="card-title mb-2"><?php echo e(trans('cruds.Invoice.title')); ?></h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit"  class="btn btn-sm btn-primary pull-right" onclick="myFunction()"> <i data-feather="corner-down-right" class="font-medium-3"></i> Submit</button>
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
                            <!-- <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.faktur_no')); ?></label>
                                    <select id="tax" name="tax" class="form-control select2" required>
                                        <?php $__currentLoopData = $faktur; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->faktur_code); ?>" <?php echo e(old('customer_name') ? 'selected' : ''); ?> selected> <?php echo e($row->faktur_code); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    
                                    <input autocomplete="off" type="text" id="segment1" name="segment1" class="form-control" value="" required>
                                    <input type="number" hidden id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>" class="form-control">
                                    <input type="number" hidden id="last_updated_by" name="last_updated_by" value="<?php echo e(auth()->user()->id); ?>" class="form-control">
                                    <input type="number" hidden id="status " name="status" value="0" class="form-control">
                                    <input type="number" hidden id="status " name="je_batch_id" value="<?php echo e(random_int(0, 999999)); ?>" class="form-control">
                                    <input type="number" hidden id="status " name="organization_id" value="222" class="form-control">
                                    <input type="number" hidden id="status " name="je_batch_id" value="<?php echo e(random_int(0, 999999)); ?>" class="form-control">
                                </div>
                            </div> -->
                            <!-- <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.faktur_no')); ?></label>

                                    <select id="faktur" name="faktur" class="form-control select2" required>
                                        <?php $__currentLoopData = $faktur; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->faktur_code); ?>" <?php echo e(old('customer_name') ? 'selected' : ''); ?>> <?php echo e($row->faktur_code); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.so_number')); ?></label>
                                    <input type="text" readonly id="segment1" name="so_number" class="form-control" value="<?php echo e($sales->order_number); ?>" required>
                                    <input type="hidden" readonly id="term" name="term" class="form-control" value="<?php echo e($sales->attribute3); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.tax_date')); ?></label>
                                    <input type="date" id="segment1" name="segment1" class="form-control datepicker" value="" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.tax')); ?></label>
                                    <select id="tax" name="tax" class="form-control select2" >
                                        <?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(($row->tax_rate)== $sales->tax_exempt_flag): ?>)
                                                <option value="<?php echo e($row->tax_rate); ?>" <?php echo e(old('customer_name') ? 'selected' : ''); ?>> <?php echo e($row->tax_name); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.currency')); ?></label>
                                    <select name="customer_currency" id="customer_currency" class="form-control select2" required value="<?php echo e($sales->attribute1); ?>">
                                    <option value="<?php echo e($sales->attribute1); ?>" <?php echo e(old('customer_name') ? 'selected' : ''); ?> selected> <?php echo e($sales->attribute1); ?></option>
                                    </select>
                                </div>
                            </div>
                           
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.journal')); ?></label>
                                    <select name="je_category" id="je_category" class="form-control select2" >
                                        <?php $__currentLoopData = $trx; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($row->trx_source_types); ?>"> <?php echo e($row->trx_source_types); ?> </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.noinv')); ?></label>
                                    <input type="text" id="noinv" name="noinv" class="form-control" value="INV-<?php echo e($sales->order_number); ?>" readonly required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-1">
                                    <label class="form-label" for="segment1"><?php echo e(trans('cruds.Invoice.field.invdate')); ?></label>
                                    <input type="date" id="tgl_invoice" name="tgl_invoice" class="form-control" required>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-3">
                                <div class="mb-1">

                                </div>
                            </div>
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
                                                            <?php if($sales->attribute3 == 'cash'): ?>
                                                                <?php echo e($row->products->category->cash->account_code ?? ''); ?> - <?php echo e($row->products->category->acccash->description ?? ''); ?>

                                                            <?php else: ?>
                                                                <?php echo e($row->products->category->arTax->account_code ?? ''); ?> - <?php echo e($row->products->category->accReceivable->description ?? ''); ?>

                                                            <?php endif; ?>

                                                            <!-- <?php echo e($row->products->category->cash->account_code ?? ''); ?> - <?php echo e($row->products->category->accReceivable->description ?? ''); ?>

                                                            <?php echo e($row->products->category->arTax->account_code ?? ''); ?> - <?php echo e($row->products->category->accReceivable->description ?? ''); ?> -->
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/invoices/create.blade.php ENDPATH**/ ?>