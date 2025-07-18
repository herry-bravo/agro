 <!-- Start Modal PR -->
 <form action="<?php echo e(route("admin.item-img.store")); ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
     <?php echo csrf_field(); ?>

     <div class="modal fade" id="imgModal" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
             <div class="modal-content">
                 <div class="modal-header bg-primary">
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                     <div class="card-body">
                         <div class="row">
                                 <div class="col-sm-7">
                                    <div class="zoom">
                                        <img src="<?php echo e(asset('/'.$itemMaster->img_path)); ?>" type="hidden" id="category-img-tag" width="440px" />
                                        <!--for preview purpose --></br>
                                    </div>
                                    <div>
                                        <img id="my-image"  src="#" />
                                    </div>
                                    <div class="justify-content-sm-center text-center">
                                        <button type="button" id="use" class="btn btn-secondary" style="position: inherit;">Crop</button>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="justify-content-sm-center text-center">
                                        <img id="result" src=""> <br><br>
                                    </div>
                                     <input type="hidden" name="item_code" id="item_code" class="form-control" value="<?php echo e(isset($itemMaster->item_code)?$itemMaster->item_code :''); ?>" autocomplete="off" readonly required />
                                     <input type="file" id="imgInp" class="form-control" name="imgFile">
                                     <input type="hidden" id="cropped" class="form-control" name="cropped">
                                 </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="submit" id="" class="btn btn-primary" style="position: inherit;" name="action" value='pr'>Save</button>
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
                $('#my-image').attr('src', e.target.result);
                $('.zoom').remove();
                var resize = new Croppie($('#my-image')[0], {
                    viewport: {
                        width: 314,
                        height: 264,
                    },
                    boundary: {
                        width: 400,
                        height: 400
                    },
                    // showZoomer: false,
                    // enableResize: true,
                    enableOrientation: true
                });
                $('#use').fadeIn();
                $('#use').on('click', function() {
                    resize.result('base64').then(function(dataImg) {
                    var data = [{ image: dataImg }, { name: 'myimgage.jpg' }];

                    // use ajax to send data to php
                    $('.img').remove();
                    $('#result').attr('src', dataImg);
                    $('#cropped').attr('value', dataImg);
                        const fileInput = document.getElementById('cropped')
                        let myFiles = {}
                        // if you expect files by default, make this disabled
                        // we will wait until the last file being processed
                        let isFilesReady = true

                        fileInput.addEventListener('change', async (event) => {
                        const files = event.srcElement.files;

                        console.log(files)
                        })
                    })
                })
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });
    //  function readURL(input) {
    //      if (input.files && input.files[0]) {
    //          var reader = new FileReader();

    //          reader.onload = function(e) {
    //              $('#category-img-tag').attr('src', e.target.result);
    //          }

    //          reader.readAsDataURL(input.files[0]);
    //      }
    //  }

    //  $("#cat_image").change(function() {
    //      readURL(this);
    //  });

 </script>
 <?php $__env->stopPush(); ?>
 <!-- END  Modal pr -->
<?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/itemMaster/img.blade.php ENDPATH**/ ?>