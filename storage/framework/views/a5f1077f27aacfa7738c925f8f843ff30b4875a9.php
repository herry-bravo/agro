
<?php $__env->startSection('styles'); ?>
<style>
    .grid.grid-cols-1.md\:grid-cols-2.lg\:grid-cols-3.xl\:grid-cols-5.gap-8.md\:gap-8 {
        margin-left: 1%;
        margin-right: 1%;
    }

    input.appearance-none.w-full.bg-white.border-gray-300.hover\:border-gray-500.px-3.py-2.pr-8.rounded.leading-tight.focus\:outline-none.focus\:bg-white.focus\:border-gray-500.focus\:border-2.border {
        margin-left: 2%;
    }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="card">

    <div class="card-header">
        <h6 class="card-title mb-2 mt-2">
            <a href="" class="breadcrumbs__item"><?php echo e(trans('cruds.physic.fields.inv')); ?></a>
            <a href="<?php echo e(route("admin.item-master.index")); ?>" class="breadcrumbs__item"> <?php echo e(trans('cruds.itemMaster.title_singular')); ?></a>
            <a href="<?php echo e(route("admin.gallery.index")); ?>" class="breadcrumbs__item">Gallery Items</a>
        </h6>
    </div>
    <hr>
    <div class="card-body mt-25">
        <!-- Livewire Styles -->
<style >
    [wire\:loading], [wire\:loading\.delay], [wire\:loading\.inline-block], [wire\:loading\.inline], [wire\:loading\.block], [wire\:loading\.flex], [wire\:loading\.table], [wire\:loading\.grid], [wire\:loading\.inline-flex] {
        display: none;
    }

    [wire\:loading\.delay\.shortest], [wire\:loading\.delay\.shorter], [wire\:loading\.delay\.short], [wire\:loading\.delay\.long], [wire\:loading\.delay\.longer], [wire\:loading\.delay\.longest] {
        display:none;
    }

    [wire\:offline] {
        display: none;
    }

    [wire\:dirty]:not(textarea):not(input):not(select) {
        display: none;
    }

    input:-webkit-autofill, select:-webkit-autofill, textarea:-webkit-autofill {
        animation-duration: 50000s;
        animation-name: livewireautofill;
    }

    @keyframes livewireautofill { from {} }
</style>
<link rel="stylesheet" href="http://192.168.0.124:8000/vendor/tailwind.css" />
<link rel="stylesheet" href="http://192.168.0.124:8000/vendor/laravel-views.css" />
        <?php echo $__env->yieldContent('content'); ?>
        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('items-grid-view', [])->html();
} elseif ($_instance->childHasBeenRendered('p1x9ahh')) {
    $componentId = $_instance->getRenderedChildComponentId('p1x9ahh');
    $componentTag = $_instance->getRenderedChildComponentTagName('p1x9ahh');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('p1x9ahh');
} else {
    $response = \Livewire\Livewire::mount('items-grid-view', []);
    $html = $response->html();
    $_instance->logRenderedChild('p1x9ahh', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
        <?php echo \Livewire\Livewire::scripts(); ?>


        <!-- Livewire Scripts -->
<script >
    console.warn("Livewire: The published Livewire assets are out of date
 See: https://laravel-livewire.com/docs/installation/")
</script>
<script src="/vendor/livewire/livewire.js?id=de3fca26689cb5a39af4" data-turbo-eval="false" data-turbolinks-eval="false" ></script>
<script data-turbo-eval="false" data-turbolinks-eval="false" >
    if (window.livewire) {
	    console.warn('Livewire: It looks like Livewire\'s @livewireScripts JavaScript assets have already been loaded. Make sure you aren\'t loading them twice.')
	}

    window.livewire = new Livewire();
    window.livewire.devTools(true);
    window.Livewire = window.livewire;
    window.livewire_app_url = '';
    window.livewire_token = '9eMmeRBdFTdxdbFc254le2hT8oDjYkNJpCZyA0Mb';

	/* Make sure Livewire loads first. */
	if (window.Alpine) {
	    /* Defer showing the warning so it doesn't get buried under downstream errors. */
	    document.addEventListener("DOMContentLoaded", function () {
	        setTimeout(function() {
	            console.warn("Livewire: It looks like AlpineJS has already been loaded. Make sure Livewire\'s scripts are loaded before Alpine.\\n\\n Reference docs for more info: http://laravel-livewire.com/docs/alpine-js")
	        })
	    });
	}

	/* Make Alpine wait until Livewire is finished rendering to do its thing. */
    window.deferLoadingAlpine = function (callback) {
        window.addEventListener('livewire:load', function () {
            callback();
        });
    };

    let started = false;

    window.addEventListener('alpine:initializing', function () {
        if (! started) {
            window.livewire.start();

            started = true;
        }
    });

    document.addEventListener("DOMContentLoaded", function () {
        if (! started) {
            window.livewire.start();

            started = true;
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
<script src="http://192.168.0.124:8000/vendor/laravel-views.js" type="text/javascript" defer></script>
    </div>
</div>
<div class="modal fade" id="modaladd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="col-lg-14 ">
                                <img src="" class="img-fluid ml-12 mb-2" id="my-image" alt="Responsive image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
    $(document).on('click', '#url', function() {
        var img = $(this).data('img');
        var localhostUrl = 'http://localhost:8000/' + img
        let myImage = document.getElementById('my-image');
        myImage.setAttribute('src', localhostUrl);
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/livewire/index.blade.php ENDPATH**/ ?>