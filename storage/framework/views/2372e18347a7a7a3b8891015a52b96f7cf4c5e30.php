<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title ">
                    <a href="<?php echo e(route("admin.purchase-requisition.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.quotation.po')); ?> </a>
                    <a href="<?php echo e(route("admin.purchase-requisition.index")); ?>" class="breadcrumbs__item"><?php echo e(trans('cruds.requisition.title_singular')); ?> </a>
                    <a href="#" class="breadcrumbs__item"><?php echo e(trans('cruds.requisition.fields.edit')); ?></a>
                </h6>
            </div>
            <hr>
            <div class="card-body">
                <form action="<?php echo e(route("admin.purchase-requisition.update", [$purchaseRequisition->id])); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="mb-25">
                                <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.requisition.fields.number')); ?></label>
                                <input type="text" class="form-control" value="<?php echo e($purchaseRequisition->segment1); ?>" name="segment1" autocomplete="off" maxlength="10" readonly>
                                <input type="hidden" id="id" name="id" value="<?php echo e($purchaseRequisition->id); ?>">
                                <input type="hidden" id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>">
                                <input type="hidden" id="created_by" name="updated_by" value="<?php echo e(auth()->user()->id); ?>">
                                <input type="hidden" id="organization_id" value='222' name="org_id">
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="mb-25">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.requisition.fields.cost_center')); ?></label>
                                <input readonly type="text" class="form-control search_cost_center " value="<?php echo e($purchaseRequisition->CcBook->cc_name ?? ''); ?>" placeholder="Type here ..." name="search_cost_center" autocomplete="off" required>
                                <input type="hidden" class="form-control search_cc_id" value="<?php echo e($purchaseRequisition->attribute1 ?? ''); ?>" name="attribute1" autocomplete="off">

                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="mb-25">
                                <label class="col-sm-0 control-label" for="number"> <?php echo e(trans('cruds.requisition.fields.requested')); ?></label>
                                <select name="requested_by" id="agent_id" class="form-control select2">
                                    <option value="<?php echo e(auth()->user()->id); ?>"><?php echo e(auth()->user()->name); ?></option>

                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-12">
                            <div class="mb-25">
                                <label class="col-sm-0 control-label" for="site">Creation Date</label>
                                <input type="text" id="transaction_date" name="transaction_date" class="form-control" value="<?php echo e($purchaseRequisition->transaction_date ?? ''); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="mb-25">
                                <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.requisition.fields.ref')); ?></label>
                                <select name="ref" id="agent_id" class="form-control select2">
                                    <option value="<?php echo e($purchaseRequisition->reference ?? ''); ?>">
                                        <?php if($purchaseRequisition->reference=='0'): ?>
                                        Others
                                        <?php else: ?>
                                        Material
                                        <?php endif; ?>
                                    </option>
                                </select>
                                <input type="hidden" class="form-control search_address1 " name="authorized_status" value="<?php echo e($purchaseRequisition->authorized_status ?? ''); ?>" autocomplete="off" readonly>
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        </hr>
                        <div class="box box-default">
                            <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                <table class="table table-fixed table-borderless">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="display:none;"></th>
                                            <th>Product</th>
                                            <th>Description</th>
                                            <th>Category</th>
                                            <th>UOM</th>
                                            <th>Quantity</th>
                                            <th>Need By Date</th>
                                            <th colspan="3" class="text-center">#</th>
                                        </tr>
                                    </thead>
                                    <tbody class="requisition_container">
                                        <?php $__currentLoopData = $requisitionDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $raw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="tr_input" data-entry-id="<?php echo e($raw->id); ?>">
                                            <td style="display:none;">
                                            </td>
                                            <td width="15%">
                                                <input type="text" class="form-control search_purchase_item" placeholder="Type here ..." name="item_code[]" id="searchitem_<?php echo e($key+1); ?>" autocomplete="off" value="<?php echo e($raw->itemMaster->item_code ?? ''); ?> - <?php echo e($raw->itemMaster->description ?? ''); ?>" required><span class="help-block search_item_code_empty" style="display: none;" required>No Results Found ...</span>
                                                <input type="hidden" class="search_inventory_item_id" id="id_<?php echo e($key+1); ?>" value='<?php echo e($raw->inventory_item_id); ?>' name="inventory_item_id[]" autocomplete="off">
                                                <input type="hidden" class="search_inventory_item_id" id="id_<?php echo e($key+1); ?>" value='<?php echo e($raw->id); ?>' name="lineId[]" autocomplete="off">
                                                
                                            </td>
                                            <td width="35%">
                                                <input type="text" class="form-control" id="description_<?php echo e($key+1); ?>" value="<?php echo e($raw->attribute1); ?>" name="description_item[]" autocomplete="off">
                                            </td>
                                            <td width="10%">
                                                <input type="text" class="form-control search_subcategory_code_" name="sub_category[]" id="subcategory_<?php echo e($key+1); ?>" value="<?php echo e($raw->attribute2); ?>" autocomplete="off">
                                                <span class="help-block search_uom_code_empty glyphicon" style="display: none;"> No Results Found </span>
                                            </td>
                                            <td width="10%">
                                                <input type="text" class="form-control float-center text-center search_uom_conversion" value="<?php echo e($raw->pr_uom_code); ?>" name="pr_uom_code[]" id="pr_uom_<?php echo e($key+1); ?>" autocomplete="off" readonly>
                                            </td>
                                            <td width="10%">
                                                <input type="text" class="form-control purchase_quantity float-end text-end" name="quantity[]" id="qty_<?php echo e($key+1); ?>" autocomplete="off" value="<?php echo e($raw->quantity); ?>" required>
                                            </td>
                                            <input type="hidden" class="form-control purchase_cost float-end text-end" name="estimated_cost[]" id="price_<?php echo e($key+1); ?>" onblur="cal()" autocomplete="off" value="<?php echo e($raw->estimated_cost); ?>" readonly>
                                            <td width="15%">
                                                <input type="text" name="requested_date[]" class="form-control datepicker_date float-center text-center" id="date_<?php echo e($key+1); ?>" value="<?php echo e($raw->requested_date); ?>" autocomplete="off">
                                                
                                            </td>
                                            <td>
                                                <a class="btn btn-ligth" data-bs-toggle="modal" data-bs-target="#modaladd_<?php echo e($raw->id); ?>">
                                                    <i data-feather='camera'> </i>
                                                </a>
                                            </td>
                                            <td>
                                                <?php if($raw->purchase_status ==3): ?>
                                                <button type="button" class="btn btn-edit  btn-secondary btn-sm" disabled> <i class="m-nav__link-icon " value="<?php echo e($raw->id); ?>" data-feather='edit'></i></button>
                                                <?php else: ?>
                                                <button type="button" class="btn btn-edit  btn-secondary btn-sm " data-index="<?php echo e($raw->id); ?>" data-qty="<?php echo e($raw->quantity); ?>" data-item="<?php echo e($raw->itemMaster->item_code ??''); ?> - <?php echo e($raw->itemMaster->description ??''); ?>" style="position: inherit;">
                                                    <i class="m-nav__link-icon " value="<?php echo e($raw->id); ?>" data-feather='edit'></i></button>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($loop->first): ?> <form></form> <?php endif; ?>
                                                <form type="hidden" action="<?php echo e(route('admin.requisition-detail.destroy',$raw->id)); ?>" enctype="multipart/form-data" method="POST" onsubmit="return confirm('<?php echo e(trans('global.areYouSure')); ?>');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                                    <button type="submit" class="btn btn-ligth  btn-sm" --disabled- style="position: inherit;" readonly>X</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">
                                                <button type="button" class="btn btn-light btn-sm add_requisition_product" style="font-size: 12px;">
                                                    <i data-feather='plus'></i> Add Rows</button>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    </br>
                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row ">
                                <div class="col-sm-8">
                                    <div class="form-group"></br>
                                        <label for="form-label textarea-counter ">Description</label>
                                        <textarea data-length="240" class="form-control char-textarea" id="textarea-counter" name="description" rows="2" required><?php echo e($purchaseRequisition->description); ?></textarea>
                                    </div>
                                    <small class="textarea-counter-value float-end">This Note Only For Internal Purposes, <b>Char Left : <span class="char-count">0</span> / 240 </b></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    </br>
                    <div class="d-flex justify-content-between mb-1">
                        <button type="reset" class="btn btn-warning pull-left btn-next" value="Reset">Reset</button>
                        <button type="submit" class="btn btn-success  btn-next" name='action' value="save"><i data-feather='save'></i> <?php echo e(trans('global.save')); ?></button>
                    </div>
                    <!-- Modal Example Start-->
                    <div class="modal fade" id="demoModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Split Line</h4>
                                    <div class="modal-header bg-primary">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2 col-12">
                                                <div class="mb-25">
                                                    <label class="col-sm-0 control-label" for="number">Line</label>
                                                    <input class="form-control" name="req_line_id" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-25">
                                                    <label class="col-sm-0 control-label" for="site">Items</label>
                                                    <input class="form-control" name="item" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="mb-25">
                                                    <label class="col-sm-0 control-label" for="site">Quantity</label>
                                                    <input class="form-control" name="split_quantity">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" name='action' value="add_lines" data-dismiss="modal"><i data-feather='plus'></i><?php echo e(trans('global.add')); ?></button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php $__currentLoopData = $requisitionDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $raw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="modal fade" id="modaladd_<?php echo e($raw->id); ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header  bg-primary">
                                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Attachment</h4>
                                    <div class="modal-header bg-primary">
                                        <button type="button" class="btn-close-img" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div id="dropBox">

                                            <div class="container">
                                                <div><img src="<?php echo e(asset($raw->img_path)); ?>" width="100%"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <!-- END Modal Example Start-->
                </form>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <!-- /.content -->
    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('script'); ?>
    <script>
        $(function() {
            $('.datepicker_date').datepicker({
                minDate: 1
            });
        });

    </script>
    <?php $__env->stopPush(); ?>
    <?php $__env->startSection('scripts'); ?>
    <?php $__env->startPush('script'); ?>
    <script>
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });

    </script>
    <?php $__env->stopPush(); ?>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/purchaseRequisition/edit.blade.php ENDPATH**/ ?>