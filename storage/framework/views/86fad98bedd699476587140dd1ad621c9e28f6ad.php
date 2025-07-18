 <!-- Start Modal GRN -->
 <form action="<?php echo e(route("admin.grn.index")); ?>" method="GET" enctype="multipart/form-data" class="form-horizontal">
     <?php echo csrf_field(); ?>
     <div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel" aria-hidden="true">

         <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class="modal-title text-white" id="exampleModalLongTitle">Good Receive Notes</h4>
                     <div class="modal-header bg-primary">
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                 </div>
                 <div class="modal-body">
                     <div class="card-body">
                         <div class="row">
                             <div class="col-md-6 col-12">
                                 <div class="mb-1">
                                     <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.rcv.fields.grnfrom')); ?></label>
                                     <input type="number" class="form-control search_supplier_name" name="grnfrom" autocomplete="off">
                                 </div>
                             </div>
                             <div class="col-md-6 col-12">
                                 <div class="mb-1">
                                     <label class="col-sm-0 control-label" for="site"><?php echo e(trans('cruds.rcv.fields.grnto')); ?></label>
                                     <input type="number" name="grnto" class="form-control datepicker">
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-md-6 col-12">
                                 <div class="mb-1">
                                     <label class="col-sm-0 control-label" for="number"><?php echo e(trans('cruds.rcv.fields.transactiondate')); ?></label>
                                     <input type="date" class="form-control search_supplier_name" name="transaction_datefrom" autocomplete="off">
                                 </div>
                             </div>
                             <div class="col-md-6 col-12">
                                 <div class="mb-1">
                                     <label class="col-sm-0 control-label" for="rate"><?php echo e(trans('cruds.rcv.fields.orderto')); ?></label>
                                     <input type="date" class="form-control search_supplier_name" name="transaction_dateto" autocomplete="off">
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="submit" class="btn btn-primary" name="action" value='grn'>View</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </form>
 <!-- END  Modal GRN -->

 <!-- Start Modal PO -->
 <form action="<?php echo e(route("admin.reportPDF.index")); ?>" method="GET" enctype="multipart/form-data" class="form-horizontal">
    <?php echo csrf_field(); ?>

    <div class="modal fade" id="poModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Purchase Order</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">PO Number From :</label>
                                    <input type="text" class="form-control" name="poFrom" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="site">PO Number To :</label>
                                    <input type="text" name="poTo" class="form-control datepicker" >
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">Created At From :</label>
                                    <input type="date" class="form-control flatpickr-basic flatpickr-input" name="createFrom" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="rate">Created At To :</label>
                                    <input type="date" class="form-control flatpickr-basic flatpickr-input" name="createTo" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-2 col-md-12 form-check-primary">
                                <label class="form-check-label mb-50" for="modern-last-name">Header</label>
                                <div class="form-check">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="logo" id="inlineRadio1" value="1" checked="">
                                        <label class="form-check-label" for="inlineRadio1">With</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="logo" id="inlineRadio2" value="2">
                                        <label class="form-check-label" for="inlineRadio2">Without</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END  Modal PO -->

 <!-- Start Modal PR -->
 <form action="<?php echo e(route("admin.pr-report.index")); ?>" method="GET" enctype="multipart/form-data" class="form-horizontal">
    <?php echo csrf_field(); ?>

    <div class="modal fade" id="pr" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Purchase Order</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row mt-1">
                            <div class="col-md-6 col-12">
                                <div class="">
                                    <label class="col-sm-0 control-label" for="number">PR Number From :</label>
                                    <input type="text" class="form-control" name="prFrom" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="">
                                    <label class="col-sm-0 control-label" for="site">PR Number To :</label>
                                    <input type="text" name="prTo" class="form-control datepicker" required>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class=" col-md-6 col-12 form-check-primary">
                                <label class="form-check-label mb-50" for="modern-last-name">Status</label>
                                <div class="form-check">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="aprv" type="checkbox" value="1" id="inlineCheckbox1" value="checked" checked="">
                                        <label class="form-check-label" for="inlineCheckbox1">Approved</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="wait_aprv" type="checkbox" value="2" id="inlineCheckbox1" value="checked" checked="">
                                        <label class="form-check-label" for="inlineCheckbox1">Waiting Approval</label>
                                    </div>
                                </div>
                            </div><div class=" col-md-6 col-12 form-check-primary">
                                <label class="form-check-label mb-50" for="modern-last-name">Header</label>
                                <div class="form-check">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="logo" id="inlineRadio1" value="1" checked="">
                                        <label class="form-check-label" for="inlineRadio1">With</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="logo" id="inlineRadio2" value="2">
                                        <label class="form-check-label" for="inlineRadio2">Without</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END  Modal PR -->

<!-- Start Modal Surat Jalan -->
<form action="<?php echo e(route("admin.suratJalan.index")); ?>" method="GET" enctype="multipart/form-data" class="form-horizontal">
    <?php echo csrf_field(); ?>

    <div class="modal fade" id="suratJalan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Surat Jalan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">Surat Jalan From :</label>
                                    <input type="text" class="form-control" name="psFrom" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="site">Surat Jalan Number To :</label>
                                    <input type="text" name="psTo" class="form-control" >
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">Delivery Date From :</label>
                                    <input type="text" class="form-control flatpickr-basic flatpickr-input" name="deliveryFrom" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="rate">Delivery Date To :</label>
                                    <input type="text" class="form-control flatpickr-basic flatpickr-input" name="deliveryTo" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-2 col-md-12 form-check-primary">
                                <label class="form-check-label mb-50" for="modern-last-name">Header</label>
                                <div class="form-check">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="logo" id="inlineRadio1" value="1" checked="">
                                        <label class="form-check-label" for="inlineRadio1">With</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="logo" id="inlineRadio2" value="2">
                                        <label class="form-check-label" for="inlineRadio2">Without</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Surat Jalan -->


<form action="<?php echo e(route("admin.packingList.index")); ?>" method="GET" enctype="multipart/form-data" class="form-horizontal">
    <?php echo csrf_field(); ?>

    <div class="modal fade" id="packingList" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Packing List</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">Packing List Number From :</label>
                                    <input type="text" class="form-control" name="psFrom" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="site">Packing List Number To :</label>
                                    <input type="text" name="psTo" class="form-control datepicker" >
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">Delivery Date From :</label>
                                    <input type="date" class="form-control flatpickr-basic flatpickr-input" name="deliveryFrom" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="rate">Delivery Date To :</label>
                                    <input type="date" class="form-control flatpickr-basic flatpickr-input" name="deliveryTo" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">Customer Name:</label>
                                    <input type="text" class="form-control search_customer" name="custmer_name" autocomplete="off">
                                    <input type="hidden" class="form-control cust_party_code" name="custmer_code" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mt-2 col-md-12 form-check-primary">
                                <label class="form-check-label mb-50" for="modern-last-name">Header</label>
                                <div class="form-check">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="logo" id="inlineRadio1" value="1" checked="">
                                        <label class="form-check-label" for="inlineRadio1">With</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="logo" id="inlineRadio2" value="2">
                                        <label class="form-check-label" for="inlineRadio2">Without</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>



<form action="<?php echo e(route("admin.salesInvoicing.index")); ?>" method="GET" enctype="multipart/form-data" class="form-horizontal">
    <?php echo csrf_field(); ?>

    <div class="modal fade" id="salesInvoicing" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header ">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Invoicing</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">Sales Date From :</label>
                                    <input type="date" class="form-control flatpickr-basic flatpickr-input" name="from" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="rate">Sales Date To :</label>
                                    <input type="date" class="form-control flatpickr-basic flatpickr-input" name="to" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>



<form action="<?php echo e(route("admin.inv-report.index")); ?>" method="GET" enctype="multipart/form-data" class="form-horizontal">
    <?php echo csrf_field(); ?>

    <div class="modal fade" id="inventoryReport" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Inventory Report</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row mt-1">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">Period Date From :</label>
                                    <input type="date" class="form-control flatpickr-basic flatpickr-input" name="datefrom" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="rate">Period Date To :</label>
                                    <input type="date" class="form-control flatpickr-basic flatpickr-input" name="dateto" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>




<form action="<?php echo e(route("admin.missExpenses-report.index")); ?>" method="GET" enctype="multipart/form-data" class="form-horizontal">
    <?php echo csrf_field(); ?>

    <div class="modal fade" id="missExpenses" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Inventory Report</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <div class="card-body">
                        
                        <div class="row mt-1">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">Period Date From :</label>
                                    <input type="date" class="form-control flatpickr-basic flatpickr-input" name="datefrom" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="rate">Period Date To :</label>
                                    <input type="date" class="form-control flatpickr-basic flatpickr-input" name="dateto" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


 <!-- Start Modal AP -->
 <form action="<?php echo e(route("admin.apreport.index")); ?>" method="GET" enctype="multipart/form-data" class="form-horizontal">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="apModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">AP Voucher</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                <br>
                                    <label class="col-sm-0 control-label" for="number">Number From</label>
                                    <input required type="number" class="form-control" name="voucher_from" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                <br>
                                    <label class="col-sm-0 control-label" for="number">Number To</label>
                                    <input required type="number" class="form-control" name="voucher_to" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END  Modal AP -->
 <!-- Start Modal PAYMENT -->
 <form action="<?php echo e(route("admin.paymentreport.index")); ?>" method="GET" enctype="multipart/form-data" class="form-horizontal">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="paymentsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Payments Voucher</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                <br>
                                    <label class="col-sm-0 control-label" for="number">Number From</label>
                                    <input required type="number" class="form-control" name="voucher_from" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                <br>
                                    <label class="col-sm-0 control-label" for="number">Number To</label>
                                    <input required type="number" class="form-control" name="voucher_to" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END  Modal PAYMENT -->



<form action="<?php echo e(route("admin.woPrint.index")); ?>" method="GET" enctype="multipart/form-data" class="form-horizontal">
    <?php echo csrf_field(); ?>

    <div class="modal fade" id="woDoc" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Work Order Document</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row mt-1">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">Period Date From :</label>
                                    <input type="date" class="form-control flatpickr-basic flatpickr-input" name="datefrom" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="rate">Period Date To :</label>
                                    <input type="date" class="form-control flatpickr-basic flatpickr-input" name="dateto" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>



<form action="<?php echo e(route("admin.paymentreport.glReport")); ?>" method="GET" enctype="multipart/form-data" class="form-horizontal">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="glModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">General Ladger</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                <br>
                                    <label class="col-sm-0 control-label" for="number">Period Form</label>
                                    <input type="date" class="form-control datepicker" id="datepicker" name="from" value="<?php echo e(date('Y-m-d')); ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                <br>
                                    <label class="col-sm-0 control-label" for="number">Period To</label>
                                    <input type="date" class="form-control datepicker" id="datepicker" name="to" value="<?php echo e(date('Y-m-d')); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<form action="<?php echo e(route("admin.paymentreport.bankReport")); ?>" method="GET" enctype="multipart/form-data" class="form-horizontal">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="bankModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">General Ladger</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                <br>
                                    <label class="col-sm-0 control-label" for="number">Period Form</label>
                                    <input type="date" class="form-control datepicker" id="datepicker" name="from" value="<?php echo e(date('Y-m-d')); ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                <br>
                                    <label class="col-sm-0 control-label" for="number">Period To</label>
                                    <input type="date" class="form-control datepicker" id="datepicker" name="to" value="<?php echo e(date('Y-m-d')); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<form action="<?php echo e(route("admin.paymentreport.cashReport")); ?>" method="GET" enctype="multipart/form-data" class="form-horizontal">
    <?php echo csrf_field(); ?>
    <div class="modal fade" id="cashModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-primary">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">General Ladger</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                <br>
                                    <label class="col-sm-0 control-label" for="number">Period Form</label>
                                    <input type="date" class="form-control datepicker" id="datepicker" name="from" value="<?php echo e(date('Y-m-d')); ?>">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                <br>
                                    <label class="col-sm-0 control-label" for="number">Period To</label>
                                    <input type="date" class="form-control datepicker" id="datepicker" name="to" value="<?php echo e(date('Y-m-d')); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php /**PATH C:\laragon\www\nexzo\agro\resources\views/admin/stdReports/globalFilter.blade.php ENDPATH**/ ?>