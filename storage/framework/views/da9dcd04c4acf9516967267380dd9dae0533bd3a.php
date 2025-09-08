
<style>
    @page  {
        margin: 0 !important;
        margin-top: 0 !important;
        /* padding: 5px !important; */
        size: auto;
        /*  auto is the current printer page size */

    }

    *

    /** Define the header rules **/
    header {
        position: fixed;
        top: 10px;
        left: 20px;
        right: 20px;
        height: 3cm;
    }

    /** Define the footer rules **/
    footer {
        position: relative;
        top: 26cm;
        bottom: 0cm;
        left: 0cm;
        right: 1cm;
        height: 1cm;
        text-align: right;
        margin-right: 20px;
    }


    #footer .page::before {
        /* counter-increment: page; */
        content: counter(page);
    }

    /* p{
                        counter-reset: page;
                    } */

    /* body{
                font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                color:#333;
                text-align:left;
                font-size:12;
                margin-top: 2cm;
                margin-left: 20px;
                margin-right: 20px;
                font-size: 11px;
            } */
    .container {
        /* to centre page on screen*/
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        color: #333;
        text-align: left;
        font-size: 12;
        margin-left: 0px;
        margin-right: 20px;
        font-size: 11px;
    }

    table {
        width: 100%;
        padding-left: 0;
        padding: 50px;
        margin-top: 10px;
        border-collapse: collapse;
    }

    tr,
    th {
        /* padding-right:3px; */
        padding: 10px;
        width: auto;
    }

    th {
        /* background-color: #E5E4E2; */
        font-size: 11px;
        /* width: 98%; */
        margin: 10px;
        text-align: center;
        border-top: 1px solid #000000;
        border-bottom: 1px solid #000000;
    }

    h4,
    p {
        margin: 0px;
        font-size: 14px;
    }

    td {
        padding: 5px;
        font-size: 12px;
        /* vertical-align: text-top; */
        width: auto;
    }

    .table-footer {
        margin-top: 10% !important;
        text-align: center;
        font-size: 14px;
        object-position: center bottom !important;
    }

    .bg {
        background-color: #E5E4E2;
    }

    tfoot {
        margin-top: 5% !important;
        border-top: 1px solid #cacaca;
        border-bottom: 1px dashed #cacaca;
    }

    .page_break {
        page-break-before: always;
    }

    hr {
        color: green;
    }

    .table-content {
        padding: 15px !important;
    }

    page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.1cm rgba(0, 0, 0, 0.2);
    }

    page[size="A4"] {
        width: 21cm;
        height: 29.7cm;
    }

</style>

<page size="A4">
    <body>
        <div class="container">
        <table>
            <tr style="height:90px">
                <td style="width: 85%;">
                    <img style="width: 12%; float:left" src="<?php echo e(asset('app-assets/images/logo/suryaagro.png')); ?>" alt="buana-megah">
                    <p style="font-size: 14px; line-height: 1.6; padding-left: 100px;">
                        <b style="color: green; display: inline-block; margin-left: 16px;">SURYA-AGRO</b><br>
                        <b style="display: inline-block; margin-left: 16px;">Head Office:</b><br>
                        <span style="display: inline-block; margin-left: 15px;">
                            Jl. Peterongan-Sumobito, RT.6/RW.1, Klampisan, Segodorejo,<br>
                            Kec. Sumobito, Kabupaten Jombang, Jawa Timur 61483
                        </span>
                        <br><br>
                        <b style="display: inline-block; margin-left: 16px;">No Telp:</b> 
                        <a href="tel:+62343656288" style="text-decoration: none; color: black;">
                            0816-1582-4494, 0851-0025-6990
                        </a>
                    </p>

                </td>
                <td>
                    <img style="float:right" src="data:image/png;base64,<?php echo e(DNS2D::getBarcodePNG('https://maps.app.goo.gl/ZjihaCAL3e3zYye48?g_st=iw', 'QRCODE')); ?>">
                </td>
            </tr>
        </table>

            <hr>

            <?php $__currentLoopData = $header; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $raw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <div class="container ">
                <table>
                    <tr>
                        <td colspan="4">
                            <h3 style="text-align: center"><b>Purchase Order</b></h3>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: text-top; !important">
                            <h4>Supplier</h4>
                        </td>
                        <td style="vertical-align: text-top; !important">
                            <p>: (<?php echo e($raw->vendor_id ?? ''); ?>) - <?php echo e($raw->vendor->vendor_name ?? ''); ?>

                                <br> <?php echo e($raw->vendor->address1 ?? ''); ?>

                                <?php echo e($raw->vendor->city ?? ''); ?>, <?php echo e($raw->vendor->province ?? ''); ?>

                                <br><?php echo e($raw->vendor->phone ?? ''); ?>

                            </p>
                        </td>
                        <td style="width: 100px; vertical-align: text-top; !important">
                            <h4>Delivery To</h4>
                        </td>
                        <td style="vertical-align: text-top; !important">
                            <p>: (<?php echo e($raw->ship_to_location ?? ''); ?>) <?php echo e($raw->site->address1); ?>

                                <br> <?php echo e($raw->site->address2); ?> <?php echo e($raw->site->city ?? ''); ?>, <?php echo e($raw->site->province ?? ''); ?>

                                <br><?php echo e($raw->site->phone ?? ''); ?>

                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Term</h4>
                        </td>
                        <td>
                            <p>: <?php echo e($raw->term_id ?? ''); ?> </p>
                        </td>
                        <td>
                            <h4> Number</h4>
                        </td>
                        <td>
                            <p>: <?php echo e($raw->segment1 ?? ''); ?> </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4 style="text-align: top">Freight</h4>
                        </td>
                        <td>
                            <p>: <?php echo e($raw->freight ?? ''); ?> </p>
                        </td>
                        <td>
                            <h4> Date</h4>
                        </td>
                        <td>
                            <p>: <?php echo e($raw->created_at ?? ''); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4 style="text-align: top">Carrier</h4>
                        </td>
                        <td>
                            <p>: <?php echo e($raw->carrier ?? ''); ?></p>
                        </td>
                        <td>
                            <h4>Curenncy</h4>
                        </td>
                        <td>
                            <p>: <?php echo e($raw->currency_code ?? ''); ?></p>
                        </td>
                    </tr>
                </table>
                <table>
                    <tbody>
                        <?php $subtotal=0; ?>
                        <tr>
                            <th>#</th>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Unit Cost</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>

                        
                        <?php $line = 0; ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($row->po_header_id==$raw->id): ?>
                        <?php $line ++;?>
                        <tr>
                            <td align="center"><?php echo e($row->line_id ?? ''); ?></td>
                            <td><?php echo e($row->itemMaster->item_code ?? ''); ?></td>
                            <td><?php echo e($row->item_description ?? ''); ?></td>
                            <td align="right"> <?php echo e(number_format($row->unit_price, 2, ',', '.')); ?></td>
                            <td align="right"><?php echo e($row->po_quantity ?? ''); ?></td>
                            <td align="right"><?php echo e(number_format($row->unit_price * $row->po_quantity, 2, ',', '.')); ?></td>
                        </tr>
                        
                        <?php $subtotal+=($row->unit_price * $row->po_quantity);?>

                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td align="left"><strong>Total</strong></td>
                            <td align="right"><?php echo e($raw->currency_code); ?> </td>
                            <td align="right"><?php echo e(number_format($subtotal, 2, ',', '.')); ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td align="left"><strong><?php echo e($raw->vendor->tax->tax_name); ?></strong></td>
                            <!-- <td align="right"><?php echo e($raw->currency_code); ?></td>
                            <td align="right"> <?php echo e(number_format(($raw->attribute1-$subtotal), 2, ',', '.')); ?></td> -->
                        </tr>
                        <!-- <tr>
                            <td colspan="3"></td>
                            <td align="left"><strong>Total</strong></td>
                            <td align="right"><?php echo e($raw->currency_code); ?> </td>
                            <td align="right"> <?php echo e(number_format(($raw->attribute1), 2, ',', '.')); ?></td>
                        </tr> -->
                        <tr>
                            <td>Note:</td>
                        </tr>
                    </tfoot>
                </table>

                
                <table class="table-footer">
                    <tr>
                        <td>Prepared By,</td>
                        <td>Checked By,</td>
                        <td>Approved By,</td>
                        <td>Receive By,</td>
                    </tr>
                    <tr>
                        <td style="height: 50px"></td>
                    </tr>
                    <tr>
                        <td> __________________ </td>
                        <td> __________________ </td>
                        <td> __________________ </td>
                        <td> Supplier </td>
                    </tr>
                </table>
                <table style="margin-top:10%;">
                    <tr>
                        <td style="height: 50px;">Note : <br><?php echo e($raw->notes); ?></td>
                    </tr>
                </table>
            </div>

            
            <?php if($loop->last): ?>
            <div style="page-break-before: avoid"> </div>
            <?php else: ?>
            <div class="page_break"></div>
            <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </body>
</page>
<?php /**PATH C:\laragon\www\agro\resources\views/admin/purchase/view.blade.php ENDPATH**/ ?>