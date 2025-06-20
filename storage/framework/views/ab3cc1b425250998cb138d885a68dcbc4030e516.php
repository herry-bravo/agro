<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/drop-image.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('app-assets/js/scripts/default.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title ">
                        <a href="<?php echo e(route("admin.purchase-requisition.index")); ?>" class="breadcrumbs__item">Purchase Requisition </a>
                        <a href="<?php echo e(route("admin.purchase-requisition.create")); ?>" class="breadcrumbs__item">Create</a>
                    </h6>
                </div>
                <hr>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.purchase-requisition.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.requisition.fields.number')); ?></label>
                                    <input type="text" class="form-control" value="<?php echo e($number); ?>" name="segment1" autocomplete="off" maxlength="10" readonly>
                                    <input type="hidden" id="id" name="id" value="<?php echo e($head_id); ?>">
                                    <input type="hidden" id="created_by" name="created_by" value="<?php echo e(auth()->user()->id); ?>">
                                    <input type="hidden" id="created_by" name="updated_by" value="<?php echo e(auth()->user()->id); ?>">
                                    <input type="hidden" id="organization_id" value='222' name="org_id">
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.requisition.fields.cost_center')); ?></label>
                                    <input type="text" class="form-control search_cost_center " placeholder="Type here ..." name="search_cost_center" autocomplete="off" required>
                                    <input type="hidden" class="form-control search_cc_id" name="attribute1" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-2 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number"> <?php echo e(trans('cruds.requisition.fields.requested')); ?></label>
                                    <select name="requested_by" id="agent_id" class="form-control select2">
                                        
                                        <option value="<?php echo e(auth()->user()->id); ?>"><?php echo e(auth()->user()->name); ?></option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="site">Creation Date</label>
                                    <input readonly type="text" id="transaction_date" name="transaction_date" class="form-control" value="<?php echo e(date('d-M-Y H:i:s')); ?>">
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.requisition.fields.ref')); ?></label>
                                    <select name="ref" id="ref_id" class="form-control select2">
                                        <option value="0">Others</option>
                                        <option value="4">Material</option>
                                    </select>
                                    <input type="hidden" class="form-control search_address1 " name="authorized_status" value="1" autocomplete="off" readonly>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">

                            <div class="box box-default">
                                <div class="box-body scrollx tableFixHead" style="height: 380px;overflow: scroll;">
                                    <table class="table table-fixed table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Description</th>
                                                <th>Category</th>
                                                <th class='float-center text-center'>UOM</th>
                                                <th>Quantity</th>
                                                <th>Need By Date</th>
                                                <th class="text-center">Img</th>
                                                <th class="text-center">#</th>
                                            </tr>
                                        </thead>
                                        <tbody class="requisition_container">
                                            <tr class="tr_input">
                                                <td width="15%">
                                                    <input type="text" class="form-control search_purchase_item" placeholder="Type here ..." name="item_code[]" id="searchitem_1" autocomplete="off"><span class="help-block search_item_code_empty" style="display: none;">No Results Found ..</span>
                                                    <input type="hidden" class="search_inventory_item_id" id="id_1" value='0' name="inventory_item_id[]" autocomplete="off">
                                                    
                                                    <input type="hidden" class="form-control" id="category_1" value="" name="category[]" autocomplete="off">
                                                </td>
                                                <td width="35%">
                                                    <input type="text" class="form-control" id="description_1" value="" name="description_item[]" autocomplete="off">
                                                </td>
                                                <td width="10%">
                                                    <input type="text" class="form-control search_subcategory_code_" name="sub_category[]" id="subcategory_1" autocomplete="off">
                                                    <span class="help-block search_uom_code_empty glyphicon" style="display: none;"> No Results Found </span>
                                                </td>
                                                <td width="10%">
                                                    <input type="text" class="form-control search_uom_conversion text-center" name="pr_uom_code[]" id="uom_1" autocomplete="off">
                                                    <span class="help-block search_uom_code_empty glyphicon" style="display: none;"> No Results Found </span>
                                                </td>
                                                <td width="10%">
                                                    <input type="text" class="form-control purchase_quantity float-end text-end" value="0" name="quantity[]" id="qty_1" autocomplete="off" required>
                                                </td>
                                                <input type="hidden" class="form-control purchase_cost float-end text-end" value="0" name="estimated_cost[]" id="price_1" onblur="cal()" autocomplete="off" readonly>
                                                <td width="15%">
                                                    <input required type="text" name="requested_date[]" class="form-control datepicker float-center text-center" id="date_1" autocomplete="off">
                                                </td>
                                                <td width="5%" class="text-center">
                                                    <div class="input-group">
                                                        <label class="input-group-btn">
                                                            <span class="btn btn-default btn-file">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="15" fill="currentColor" class="bi bi-image-fill" viewBox="0 0 16 16">
                                                                    <path d="M.002 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-12a2 2 0 0 1-2-2V3zm1 9v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V9.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12zm5-6.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0z"></path>
                                                                </svg>
                                                                <input id="file-input_1" type="file" name="img_path[]" style="display: none;">
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td width="5%" class="text-center">
                                                    <button type="button" class="btn btn-ligth btn-sm" style="position: inherit;">X</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2">
                                                    <button type="button" class="btn btn-light btn-sm add_requisition_product " style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group"></br>
                                    <label for="form-label textarea-counter ">Description</label>
                                    <textarea data-length="240" class="form-control char-textarea" id="textarea-counter" name="description" rows="2" required></textarea>

                                </div>
                                <small class="textarea-counter-value float-end">This Note Only For Internal Purposes, <b>Char Left : <span class="char-count">0</span> / 240 </b></small>
                            </div>
                            
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <button type="reset" class="btn btn-warning btn-next">
                                <i data-feather="arrow-left" class="align-middle ms-sm-25 ms-0"></i>Reset

                            </button>
                            <button type="submit" class="btn btn-primary btn-next">
                                <?php echo e(trans('global.save')); ?>

                                <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
                            </button>
                        </div>
                </div>

                <div class="modal fade" id="modaladd" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header  bg-primary">
                                <h4 class="modal-title text-white" id="exampleModalLongTitle">Add Attachment</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="card-body">
                                    <div id="dropBox">
                                        
                                        <input type="file" id="imgUpload" class="imgUpload" name="path" multiple accept="image/*" onchange="filesManager(this.files)">
                                        <label class="btn btn-primary" for="imgUpload">Upload From Your Computer</label>
                                        
                                        <div id="gallery"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    
                                    <button type="button" class="btn btn-primary" name='action' data-bs-dismiss="modal" value="existing">Create</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </form>
        <!-- /.box-body -->
    </div>
    </div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<script>
    $(function() {
        $('#date_1').datepicker({
            minDate: 1
        });
    });
    let dropBox = document.getElementById('dropBox');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(evt => {
        dropBox.addEventListener(evt, prevDefault, false);
    });

    function prevDefault(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // remove and add the hover class, depending on whether something is being
    // actively dragged over the box area
    ['dragenter', 'dragover'].forEach(evt => {
        dropBox.addEventListener(evt, hover, false);
    });
    ['dragleave', 'drop'].forEach(evt => {
        dropBox.addEventListener(evt, unhover, false);
    });

    function hover(e) {
        dropBox.classList.add('hover');
    }

    function unhover(e) {
        dropBox.classList.remove('hover');
    }

    dropBox.addEventListener('drop', mngDrop, false);

    function mngDrop(e) {
        let dataTrans = e.dataTransfer;
        let files = dataTrans.files;

        document.querySelector('.imgUpload').files = e.dataTransfer.files; // Transfer dragged type file to form input file
        filesManager(files);
    }

    function previewFile(file) { // ------------ Untuk menampilkan preview images ----------
        let imageType = /image.*/;
        if (file.type.match(imageType)) {
            let fReader = new FileReader();
            let gallery = document.getElementById('gallery');

            fReader.readAsDataURL(file);

            fReader.onloadend = function() {
                let wrap = document.createElement('div');
                let img = document.createElement('img');
                let imgCapt = document.createElement('p');

                img.src = fReader.result;

                let fSize = (file.size / 1000) + ' KB';
                imgCapt.innerHTML = `<span class="fName">${file.name}</span><span class="fSize">${fSize}</span><span class="fType">${file.type}</span>`;
                gallery.appendChild(wrap).appendChild(img);
                gallery.appendChild(wrap).appendChild(imgCapt);
            }
        } else {
            alert("Only images are allowed!", file);
        }
    }

    function filesManager(files) {
        files = [...files];
        files.forEach(previewFile);
    }

</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('scripts'); ?>
<?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
<script>
    $(function() {
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('order_delete')): ?>
        let deleteButtonTrans = '<?php echo e(trans('
        global.datatables.delete ')); ?>'
        let deleteButton = {
            text: deleteButtonTrans
            , url: "<?php echo e(route('admin.purchase-requisition.massDestroy')); ?>"
            , className: 'btn-danger'
            , action: function(e, dt, node, config) {
                var ids = $.map(dt.rows({
                    selected: true
                }).nodes(), function(entry) {
                    return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                    alert('<?php echo e(trans('
                        global.datatables.zero_selected ')); ?>')

                    return
                }

                if (confirm('<?php echo e(trans('
                        global.areYouSure ')); ?>')) {
                    $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            }
                            , method: 'POST'
                            , url: config.url
                            , data: {
                                ids: ids
                                , _method: 'DELETE'
                            }
                        })
                        .done(function() {
                            location.reload()
                        })
                }
            }
        }
        dtButtons.push(deleteButton)
        <?php endif; ?>
    })

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/purchaseRequisition/create.blade.php ENDPATH**/ ?>