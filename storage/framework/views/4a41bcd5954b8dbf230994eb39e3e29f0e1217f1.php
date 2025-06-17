<!DOCTYPE html>
<html class="loaded light-layout">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(trans('panel.site_title')); ?></title>
    <link rel="apple-touch-icon" href="<?php echo e(asset('app-assets/images/ico/favicon.png')); ?>">
    <link rel="icon" href="<?php echo e(asset('app-assets/images/ico/favicon.png')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('app-assets/images/ico/favicon.png')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/vendors.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/extensions/toastr.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/tables/datatable/buttons.dataTables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/forms/select/select2.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/vendors/css/extensions/sweetalert2.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/pages/modal-create-app.css')); ?>">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/bootstrap.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/bootstrap-extended.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/colors.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/components.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/themes/dark-layout.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/themes/bordered-layout.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/themes/semi-dark-layout.css')); ?>">

    <!-- BEGIN: Page CSS-->

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/core/menu/menu-types/horizontal-menu.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/extensions/ext-component-sweet-alerts.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/extensions/ext-component-toastr.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-validation.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/form-wizard.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/app-assets/css/pages/dashboard-ecommerce.css')); ?>">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/jquery-ui.css')); ?>">
    <?php echo $__env->yieldContent('styles'); ?>
    <!-- END: Custom CSS -->

</head>
<body class="horizontal-layout horizontal-menu navbar-static footer-static" data-open="hover" data-menu="horizontal-menu" data-col="">
    <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper container-xxl">
            <div class="content-body">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script src="<?php echo e(asset('app-assets/js/scripts/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/vendors.min.js')); ?>"></script>
    
    <?php echo $__env->yieldPushContent('script'); ?>
    



    <!-- BEGIN: Page Vendor JS-->
    <script src="<?php echo e(asset('app-assets/js/scripts/notify.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/extensions/moment.min.js')); ?>"></script>
    <?php echo $__env->make('layouts.flash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/buttons.colVis.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/js/scripts/tables/table-datatables-basic.js')); ?>"></script>

    
    <script src="<?php echo e(asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/forms/select/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')); ?>"></script>

    
    <script src="<?php echo e(asset('app-assets/vendors/js/pickers/pickadate/picker.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/pickers/pickadate/picker.date.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/pickers/pickadate/picker.time.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/pickers/pickadate/legacy.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/js/scripts/forms/pickers/form-pickers.js')); ?>"></script>

    
    <script src="<?php echo e(asset('app-assets/js/scripts/extensions/ext-component-sweet-alerts.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/js/scripts/forms/form-validation.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/js/scripts/ui/ui-feather.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/js/scripts/jquery-ui.min.js')); ?>"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?php echo e(asset('app-assets/js/core/app-menu.js')); ?>"></script>
    <script src="<?php echo e(asset('app-assets/js/core/app.js')); ?>"></script>
    <!-- END: Theme JS-->

    <script type="text/javascript">
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 10
                    , height: 10
                });
            }
            $.notify("'<?php echo e(@auth::user()->name); ?>' Wellcome back" , "success");
            
        })

    </script>
    <script type="text/javascript">
        var url = "<?php echo e(route('admin.changelang')); ?>";
        $("#inggris").click(function(){
            window.location.href = url + "?lang="+"en";
        });
        // console.log(window.location.href);
        $("#indonesia").click(function(){
            window.location.href = url + "?lang="+"id";
        });
        // console.log(window.location.href);

        // Navbar Dark / Light Layout Toggle Switch
        $("#change").on('click', function () {
        var currentLayout = getCurrentLayout(),
            switchToLayout = '',
            prevLayout = localStorage.getItem(dataLayout + '-prev-skin', currentLayout);

        // If currentLayout is not dark layout
        if (currentLayout !== 'dark-layout') {
            // Switch to dark
            switchToLayout = 'dark-layout';
        } else {
            // Switch to light
            // switchToLayout = prevLayout ? prevLayout : 'light-layout';
            if (currentLayout === prevLayout) {
            switchToLayout = 'light-layout';
            } else {
            switchToLayout = prevLayout ? prevLayout : 'light-layout';
            }
        }
        // Set Previous skin in local db
        localStorage.setItem(dataLayout + '-prev-skin', currentLayout);
        // Set Current skin in local db
        localStorage.setItem(dataLayout + '-current-skin', switchToLayout);

        // Call set layout
        setLayout(switchToLayout);

        // ToDo: Customizer fix
        $('.horizontal-menu .header-navbar.navbar-fixed').css({
            background: 'inherit',
            'box-shadow': 'inherit'
        });
        $('.horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', 'inherit');
        });
    </script>

</body>
</html>
<?php /**PATH C:\laragon\www\nexzo_app\resources\views/layouts/admin.blade.php ENDPATH**/ ?>