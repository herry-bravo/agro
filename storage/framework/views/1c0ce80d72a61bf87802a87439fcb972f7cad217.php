

<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.js')); ?>"></script>
	<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item"><a href="../">Purchase Order</a>
    </li>
    <li class="breadcrumb-item"><a href="#">Purchase Order Edit</a>
    </li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <form action="<?php echo e(route('admin.rcv.update',[$parent->id])); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-2">Receive</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <?php if($parent->invoice_status_code==0): ?>
                                    <button type="submit"  class="btn btn-sm btn-primary pull-right" onclick="myFunction()"> <i data-feather="corner-down-right" class="font-medium-3"></i> Submit</button>
                                
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label class="col-sm-0  form-label" for="number"><?php echo e(trans('cruds.quotation.fields.number')); ?></label>
                                    <input type="text" class="form-control" readonly name="no_rcv" autocomplete="off" value="<?php echo e($parent->receipt_num); ?>" required>
                                    <input type="hidden" class="form-control" readonly name="id" autocomplete="off" value="<?php echo e($parent->id); ?>" required>
                                </div>
                            </div>
                             <div class="col-md-2">
                                <div class="mb-1">
                                     <label class="col-sm-0 form-label" for="site">PO Number</label>
                                    <input type="text" class="form-control" value="<?php echo e($parent->attribute1); ?>" name="po_number" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-1">
                                    <label class="col-sm-0 form-label" for="site"><?php echo e(trans('cruds.quotation.fields.supplier')); ?></label>
                                    <input type="text"value="<?php echo e($parent->vendor->vendor_name); ?>" class="form-control" readonly name="supplier_name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1">
                                     <label class="col-sm-0 form-label" for="site">Currency</label>
                                    <input type="text" class="form-control" value="<?php echo e($parent->currency_code); ?>" name="currency_code" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1">
                                     <label class="col-sm-0 form-label" for="site">Taxes</label>
                                    <input type="text" class="form-control" value="<?php echo e($parent->taxes->tax_code??''); ?>" name="taxes" autocomplete="off" readonly>
                                    <input type="hidden" class="form-control" value="<?php echo e($parent->taxes->tax_rate??''); ?>" name="taxe_rate" autocomplete="off" readonly>
                                </div>
                            </div>
                           
                            
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label class="col-sm-0 form-label" for="number">Seller</label>
                                    <input type="text" value="<?php echo e($parent->user->name); ?>" class="form-control" name="buyer" autocomplete="off" readonly>
                                </div>
                            </div>
							<div class="col-md-2">
                                <div class="mb-1">
                                    <label class="col-sm-0 form-label" for="">Sub Inventory</label>
									<input type="text" value="<?php echo e($parent->ship_to_location_id); ?>" readonly class="form-control" name="warehouse" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-1">
                                    <label class="col-sm-0 form-label" for="site">Delivery To</label>
                                    <input readonly type="text" class="form-control " placeholder="" value="<?php echo e($parent->comments); ?>" name="address1" autocomplete="off" required>
                                </div>
                            </div>
                           
                            <div class="col-md-4">
                                <div class="mb-1">
                                    <label class="col-sm-0 form-label" for="site">Creation Date</label>
									<input readonly type="text" id="created_at" name="created_at" class="form-control" value="<?php echo e(now()->format('d-M-Y H:i:s')); ?>" required>
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
                                        Receive Lines
                                    </button>
                                    <button class="nav-link" id="nav-journal-tab" data-bs-toggle="tab" data-bs-target="#nav-journal" type="button" role="tab" aria-controls="nav-journal" aria-selected="false">
                                        <span class="bs-stepper-box">
                                            <i data-feather="file-text" class="font-medium-3"></i>
                                        </span>
                                        Journal
                                    </button>
                                </div>
                            </nav>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-sales" role="tabpanel" aria-labelledby="nav-sales-tab">
                                    <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                        <table class="table table-fixed  table-borderless">
											<thead>
												<tr>
													<th>Purchase Item</th>
													<th>Category</th>
													<th>UOM</th>
													<th>Quantity</th>
													<th>Price</th>
													<th>Need By Date</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody class="purchase_container">
												<?php $__currentLoopData = $detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $raw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<tr class="tr_input">
														<td width="30%">
															<input type="text" readonly class="form-control" name="item_code[]" autocomplete="off" required value="<?php echo e($raw->itemmaster->item_code ?? ''); ?> - <?php echo e($raw->itemmaster->description ?? ''); ?>"><span class="help-block " style="display: none;" id="search_item_code_empty_1" required></span>
														</td>
														<td width="15%">
															<input type="text" readonly class="form-control" value="<?php echo e($raw->itemmaster->category->category_name); ?>" name="category[]" id="category_1" autocomplete="off" required>
														</td>
														<td width="10%">
															<input type="text" class="form-control" name="uom[]" value="<?php echo e($raw->uom_code); ?>" autocomplete="off" readonly>
														</td>
														<td width="10%">
															<input type="text" readonly class="form-control" name="qty[]" value="<?php echo e($raw->quantity_received); ?>" autocomplete="off"   required>
														</td>
														<td width="10%">
															<input type="text" readonly class="form-control" name="price[]" value="<?php echo e($raw->requested_amount); ?>" autocomplete="off" required>
														</td>
														<td width="10%">
															<input readonly type="text" name="need_by_date[]" value="<?php echo e(optional($raw->created_at)->format('d-M-Y')); ?>" class="form-control datepicker " id="need_1" autocomplete="off">
														</td>
														<td width="10%">
															<input readonly type="text" name="total[]" value="<?php echo e($raw->amount); ?>" class="form-control" id="need_1" autocomplete="off">
														</td>
													</tr>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

											</tbody>
											
										</table>
                                    </div>
                                </div>
								<!-- Tab Journal  -->
 								<div class="tab-pane fade show active" id="nav-journal" role="tabpanel" aria-labelledby="nav-journal-tab">
    <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
        <table class="table table-fixed table-borderless">
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

                // Hitung total transaksi dari semua detail
                $grandTotal = 0;
                foreach($detail as $row) {
                    $grandTotal += $row->amount;
                }

                // Asumsi PPN 11%, nilai bersih dihitung dari grand total
                $baseAmount = $grandTotal / (1 + ($parent->conversion_rate / 100));
                $ppnValue = $grandTotal - $baseAmount;
            ?>
            <tbody class="purchase_container">
                
                <?php $__currentLoopData = $detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td></td>
                        <td>
                            <?php echo e($row->itemmaster->category->inventory->account_code ?? ''); ?> - <?php echo e($row->itemmaster->category->inventory->description ?? ''); ?>

                            <input type="hidden" name="accDes[]" value="<?php echo e($row->itemmaster->category->inventory->account_code ?? ''); ?>">
                            <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_1" autocomplete="off">
                        </td>
                        <td>
                            <?php echo e($row->itemmaster->description ?? ''); ?>

                            <input type="hidden" name="desc[]" value="<?php echo e($row->user_description_item ?? ''); ?>">
                        </td>
                        <td>
                            <?php echo e(number_format($baseAmount, 2)); ?>

                            <input type="hidden" name="dr[]" value="<?php echo e(number_format($baseAmount, 2, '.', '')); ?>">
                        </td>
                        <td>
                            <?php echo e(number_format(0, 2)); ?>

                            <input type="hidden" name="cr[]" value="0">
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                
                <tr>
                    <td></td>
                    <td>
                        <?php echo e($ppn->account_code ?? ''); ?> - <?php echo e($ppn->description ?? ''); ?>

                        <input type="hidden" name="accDes[]" value="<?php echo e($ppn->account_code ?? ''); ?>">
                        <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_2" autocomplete="off">
                    </td>
                    <td>
                        PPN atas pembelian barang
                        <input type="hidden" name="desc[]" value="PPN atas pembelian barang">
                    </td>
                    <td>
                        <?php echo e(number_format($ppnValue, 2)); ?>

                        <input type="hidden" name="dr[]" value="<?php echo e(number_format($ppnValue, 2, '.', '')); ?>">
                    </td>
                    <td>
                        <?php echo e(number_format(0, 2)); ?>

                        <input type="hidden" name="cr[]" value="0">
                    </td>
                </tr>

                
                <tr>
                    <td></td>
                    <td>
                        <?php echo e($row->itemmaster->category->payable->account_code ?? ''); ?> - <?php echo e($row->itemmaster->category->payable->description ?? ''); ?>

                        <input type="hidden" name="accDes[]" value="<?php echo e($row->itemmaster->category->payable->account_code ?? ''); ?>">
                        <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_3" autocomplete="off">
                    </td>
                    <td>
                        <?php echo e($row->user_description_item ?? ''); ?>

                        <input type="hidden" name="desc[]" value="<?php echo e($row->user_description_item ?? ''); ?>">
                    </td>
                    <td>
                        <?php echo e(number_format(0, 2)); ?>

                        <input type="hidden" name="dr[]" value="0">
                    </td>
                    <td>
                        <?php echo e(number_format($grandTotal, 2)); ?>

                        <input type="hidden" name="cr[]" value="<?php echo e(number_format($grandTotal, 2, '.', '')); ?>">
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <?php
                    // Hitung ulang total Dr dan Cr
                    $totalDr = $baseAmount + $ppnValue;
                    $totalCr = $grandTotal;
                ?>
                <tr>
                    <td colspan="3" class="text-right"><strong>Total</strong></td>
                    <td>
                        <strong><?php echo e(number_format($totalDr, 2)); ?></strong>
                        <input type="hidden" name="running_total_dr" value="<?php echo e(number_format($totalDr, 2, '.', '')); ?>">
                    </td>
                    <td>
                        <strong><?php echo e(number_format($totalCr, 2)); ?></strong>
                        <input type="hidden" name="running_total_cr" value="<?php echo e(number_format($totalCr, 2, '.', '')); ?>">
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
                                <br>
                               
                               
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
<?php $__env->startSection('scripts'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\agro\resources\views/admin/rcv/edit.blade.php ENDPATH**/ ?>