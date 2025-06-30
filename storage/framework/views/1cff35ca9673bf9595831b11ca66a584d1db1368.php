
<?php $__env->startSection('styles'); ?>
<style>
    @media  print {
        .header-navbar {
            display: none;
        }

        .breadcrumb-wrapper {
            display: none;
        }

        footer {
            display: none;
        }

        .btn-icon {
            display: none;
        }

        #buttonscroll {
            display: none;
            visibility: hidden;
        }

        .nav {
            display: None;
        }

        .page-break {
            display: block;
            page-break-after: always;
        }

        .page {
            margin: 0;
            box-shadow: 0;
        }

        @page  {
            size: 20cm 14.7cm;
            margin: 1mm 1mm 1mm 1mm;
            /* change the margins as you want them to be. */
        }
    }

    .body-row {

        width: 100%;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
        font-size: 11px;
    }

    .table-cont {
        font-family: "Calibri", Courier, monospace;
        font-size: 11px;
        width: 100%;
        border-collapse: collapse;
    }

    .footer .page-number:after {
        content: counter(page);
    }

    page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.1cm rgba(0, 0, 0, 0.2);
        border-radius: 5px;
    }

    page[size="A4"] {
        width: auto ;
        height: auto;
    }

    td {
        padding: 1rem;
    }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<a href="<?php echo e(route('admin.std-reports.index')); ?>" class="breadcrumbs__item">Purchase Report</a>

<a href="#" class="breadcrumbs__item">GRN Report</a>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<ul class="nav navbar-nav align-items-end ms-auto mb-2">
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
            <a class="dropdown-item" href="" data-toggle="modal" target="_blank"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard font-small-4 me-50">
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                        <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                    </svg>Export To Pdf</span></a>
            <a class="dropdown-item" href="#demoModal" data-bs-toggle="modal"> <i class="me-50 feather-16" data-feather="sliders"> </i> More Filter</a>
        </div>
    </li>
</ul>
<section id="multiple-column-form" class='page-break'>
    <page size="A4">
        <div class="row body-row">
            <div class="table-responsive table-cont">
                <table id="table" class="table datatable">
                     <thead>
                         <tr>
                             <th></th>
                             
                             <th>
                                 <?php echo e(trans('cruds.inventory.reports.subinventory')); ?>

                             </th>
                             <th class="text-center">
                                 <?php echo e(trans('cruds.inventory.fields.item_number')); ?>

                             </th>
                             <th  class="text-center">
                                 <?php echo e(trans('cruds.inventory.fields.description')); ?>

                             </th>
                             <th  class="text-center">
                                 <?php echo e(trans('cruds.inventory.reports.avgPrice')); ?>

                             </th>
                             <th  class="text-center">
                                 <?php echo e(trans('cruds.inventory.reports.begStock')); ?>

                             </th>
                             <th  class="text-center">
                                 <?php echo e(trans('cruds.inventory.reports.in')); ?>

                             </th>
                             <th  class="text-center">
                                 <?php echo e(trans('cruds.inventory.reports.out')); ?>

                             </th>
                             <th  class="text-center">
                                 <?php echo e(trans('cruds.inventory.reports.endStock')); ?>

                             </th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php $__currentLoopData = $txns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td></td>
                                
                                <td><?php echo e($row->subinventory_code); ?></td>
                                <td><?php echo e($row->itemmaster->item_code ?? ''); ?></td>
                                <td><?php echo e($row->itemmaster->description ?? ''); ?></td>
                                <td class="text-end"><?php echo e(number_format($row->harga,2,'.')); ?></td>
                                <td class="text-end"><?php echo e($row->beg_stock); ?></td>
                                <td class="text-end"><?php echo e($row->in_item); ?></td>
                                <td class="text-end"><?php echo e($row->out_item); ?></td>
                                <td class="text-end"><?php echo e($row->beg_stock + $row->in_item - $row->out_item); ?></td>
                            </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </tbody>
                 </table>
             </div>
        </div>
    </page>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/stdReports/invReport.blade.php ENDPATH**/ ?>