 <!-- Start Modal PR -->
 <form action="<?php echo e(route('admin.salesorder.update',[$sales->id])); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
     <div class="modal fade" id="imgModal" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
             <div class="modal-content">
                 <div class="modal-header bg-primary">
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <div class="card-body">
                         <div class="row">
                             <div class="row">
                                 <div class="col-sm-7 justify-content-sm-center ">
                                     <div class="zoom">
                                         <img src="<?php echo e(asset('/'.$sales->source_document_id)); ?>" type="hidden" id="category-img-tag" width=730px" />
                                         <!--for preview purpose --></br>
                                     </div>
                                     <input type="hidden" name="id" id="id" class="form-control" value="<?php echo e(isset($sales->id)?$sales->id :''); ?>" autocomplete="off" readonly required />
                                     <input id="cat_image" type="file" class="form-control" name="imgFile">
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="submit" class="btn btn-primary" style="position: inherit;" name="action" value='imageSo'>Save</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </form>
 <?php $__env->startPush('script'); ?>
 <script type="text/javascript">
     function readURL(input) {
         if (input.files && input.files[0]) {
             var reader = new FileReader();

             reader.onload = function(e) {
                 $('#category-img-tag').attr('src', e.target.result);
             }

             reader.readAsDataURL(input.files[0]);
         }
     }

     $("#cat_image").change(function() {
         readURL(this);
     });

 </script>
 <?php $__env->stopPush(); ?>
 <!-- END  Modal pr -->
<?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/sales/img.blade.php ENDPATH**/ ?>