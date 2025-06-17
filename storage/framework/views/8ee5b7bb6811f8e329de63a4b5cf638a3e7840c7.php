
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
<section>
        <div class="row card h-100">
            <div class="table-responsive">
                <table id="table" class="table w-100">
                     <thead>
                        <tr>
                            <th colspan="8" class="text-center">
                            CV SURYA AGRO PRADHANA

                            </th>
                        </tr>
                        <tr>
                            <th colspan="8" class="text-center">
                                PROFIT AND LOSS
                            </th>
                        </tr>
                        <tr>
                            <th colspan="8" class="text-center">
                                Period <?php echo e($period); ?>

                            </th>
                        </tr>
                         <tr>
                             <th>
                                 Account &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
                             </th>
                             <th  class="text-center">
                                 Balance
                             </th>
                         </tr>
                     </thead>
                     <tbody>
                        <?php if($totalpendapatanUsahaKotor != 0): ?>
                            <tr>
                                <td><strong>Pendapatan Usaha Kotor (Sales Revenue)</strong></td>
                                <td class="text-end"><strong><?php echo e(number_format($totalpendapatanUsahaKotor, 2, ',', '.')); ?></strong></td>
                            </tr>
                        <?php endif; ?>

                        <?php $subtotal_dr=0; $subtotal_cr=0; ?>
                        <?php $__currentLoopData = $pendapatanUsahaKotor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $amount =$row->entered_cr - $row->entered_dr;
                            ?>
                            <?php if($amount != 0): ?>
                                <tr>
                                    <td width="auto">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($row->code_combination_id); ?> <?php echo e(optional($row->coa)->description); ?></td>
                                    <td class="text-end"><?php echo e(number_format($amount, 2)); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($totalreturPenjualan != 0): ?>
                            <tr>
                                <td><strong>Retur Penjualan</strong></td>
                                <td class="text-end"><strong><?php echo e(number_format($totalreturPenjualan, 2, ',', '.')); ?></strong></td>
                            </tr>
                        <?php endif; ?>

                        <?php $subtotal_dr=0; $subtotal_cr=0; ?>
                        <?php $__currentLoopData = $returPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $amount = $row->entered_dr - $row->entered_cr;
                            ?>
                            <?php if($amount != 0): ?>
                                <tr>
                                    <td width="auto">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($row->code_combination_id); ?> <?php echo e(optional($row->coa)->description); ?></td>
                                    <td class="text-end"><?php echo e(number_format($amount, 2)); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if($totalpenjualanBersih != 0): ?>
                            <tr>
                                <td><strong>Penjualan Bersih</strong></td>
                                <td class="text-end"><strong><?php echo e(number_format($totalpenjualanBersih, 2, ',', '.')); ?></strong></td>
                            </tr>
                        <?php endif; ?>
                        
                        <?php if($totalbebanPokokPenjualan != 0): ?>
                            <tr>
                                <td><strong>Beban Pokok Penjualan (COGS)</strong></td>
                                <td class="text-end"><strong><?php echo e(number_format($totalbebanPokokPenjualan, 2, ',', '.')); ?></strong></td>
                            </tr>
                        <?php endif; ?>

                        <?php $subtotal_dr=0; $subtotal_cr=0; ?>
                        <?php $__currentLoopData = $bebanPokokPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $amount = $row->entered_dr - $row->entered_cr;
                            ?>
                            <?php if($amount != 0): ?>
                                <tr>
                                    <td width="auto">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($row->code_combination_id); ?> <?php echo e(optional($row->coa)->description); ?></td>
                                    <td class="text-end"><?php echo e(number_format($amount, 2)); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($totalpendapatankotor != 0): ?>
                            <tr>
                                <td><strong>Pendapatan Kotor</strong></td>
                                <td class="text-end"><strong><?php echo e(number_format($totalpendapatankotor, 2, ',', '.')); ?></strong></td>
                            </tr>
                        <?php endif; ?>

                        <?php if($totalbebanPemasaran != 0): ?>
                            <tr>
                                <td><strong>Beban Pemasaran</strong></td>
                                <td class="text-end"><strong><?php echo e(number_format($totalbebanPemasaran, 2, ',', '.')); ?></strong></td>
                            </tr>
                        <?php endif; ?>

                        <?php $subtotal_dr=0; $subtotal_cr=0; ?>
                        <?php $__currentLoopData = $bebanPemasaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $amount = $row->entered_dr - $row->entered_cr;
                            ?>
                            <?php if($amount != 0): ?>
                                <tr>
                                    <td width="auto">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($row->code_combination_id); ?> <?php echo e(optional($row->coa)->description); ?></td>
                                    <td class="text-end"><?php echo e(number_format($amount, 2)); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($totalbebanAdministrasiUmum != 0): ?>
                            <tr>
                                <td><strong>Beban  Administrasi & Umum</strong></td>
                                <td class="text-end"><strong><?php echo e(number_format($totalbebanAdministrasiUmum, 2, ',', '.')); ?></strong></td>
                            </tr>
                        <?php endif; ?>

                        <?php $subtotal_dr=0; $subtotal_cr=0; ?>
                        <?php $__currentLoopData = $bebanAdministrasiUmum; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $amount = $row->entered_dr - $row->entered_cr;
                            ?>
                            <?php if($amount != 0): ?>
                                <tr>
                                    <td width="auto">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo e($row->code_combination_id); ?> <?php echo e(optional($row->coa)->description); ?></td>
                                    <td class="text-end"><?php echo e(number_format($amount, 2)); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($totalBebanPemasarandanadministrasiumum != 0): ?>
                            <tr>
                                <td><strong>Total Beban Pemasaran & Administrasi umum </strong></td>
                                <td class="text-end"><strong><?php echo e(number_format($totalBebanPemasarandanadministrasiumum, 2, ',', '.')); ?></strong></td>
                            </tr>
                        <?php endif; ?>
                        <?php if($totalLabaBersihSebelumPajak != 0): ?>
                            <tr>
                                <td><strong>Laba Bersih Sebelum Pajak </strong></td>
                                <td class="text-end"><strong><?php echo e(number_format($totalLabaBersihSebelumPajak, 2, ',', '.')); ?></strong></td>
                            </tr>
                        <?php endif; ?>
                     </tbody>
                     <!-- <tfoot>
                        <tr>
                            <th colspan="5" class="text-center">Total</th>
                            <th><?php echo e(number_format($subtotal_dr,2)); ?></th>
                            <th><?php echo e(number_format($subtotal_cr,2)); ?></th>
                            <th><?php echo e(number_format(($subtotal_dr-$subtotal_cr),2)); ?></th>
                        </tr>
                     </tfoot> -->
                 </table>
             </div>
        </div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>

    $(document).ready(function() {
         $('#table').DataTable({
            responsive: false,
            scrollX: true,
            searching: true,
            dom: '<"card-header border-bottom"\
                                            <"head-label">\
                                            <"dt-action-buttons text-end">\
                                        >\
                                        <"d-flex justify-content-between row mt-1"\
                                            <"col-sm-12 col-md-7"Bl>\
                                            <"col-sm-12 col-md-2"f>\
                                            <"col-sm-12 col-md-2"p>\
                                        ti>',
            displayLength: 25,
            "lengthMenu": [
                [7, 25, 50, -1],
                [7, 25, 50, "All"]
            ],
            buttons: [{
                    extend: 'print',
                    text: feather.icons['printer'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Print',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'excel',
                    text: feather.icons['file'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Excel',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'pdf',
                    text: feather.icons['clipboard'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Pdf',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'copy',
                    text: feather.icons['copy'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Copy',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'colvis',
                    text: feather.icons['eye'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Colvis',
                    className: ''
                },
            ],
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            order: false
        });
    });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\nexzo_app\resources\views/admin/stdReports/pnlReport.blade.php ENDPATH**/ ?>