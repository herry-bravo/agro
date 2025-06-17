 <!-- Start Modal GRN -->
 <form action="{{ route("admin.grn.index") }}" method="GET" enctype="multipart/form-data" class="form-horizontal">
     @csrf
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
                                     <label class="col-sm-0 control-label" for="number">{{ trans('cruds.rcv.fields.grnfrom') }}</label>
                                     <input type="number" class="form-control search_supplier_name" name="grnfrom" autocomplete="off">
                                 </div>
                             </div>
                             <div class="col-md-6 col-12">
                                 <div class="mb-1">
                                     <label class="col-sm-0 control-label" for="site">{{ trans('cruds.rcv.fields.grnto') }}</label>
                                     <input type="number" name="grnto" class="form-control datepicker">
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-md-6 col-12">
                                 <div class="mb-1">
                                     <label class="col-sm-0 control-label" for="number">{{ trans('cruds.rcv.fields.transactiondate') }}</label>
                                     <input type="date" class="form-control search_supplier_name" name="transaction_datefrom" autocomplete="off">
                                 </div>
                             </div>
                             <div class="col-md-6 col-12">
                                 <div class="mb-1">
                                     <label class="col-sm-0 control-label" for="rate">{{ trans('cruds.rcv.fields.orderto') }}</label>
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
