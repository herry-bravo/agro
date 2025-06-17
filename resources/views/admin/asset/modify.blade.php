
<div class="modal fade" id="modify" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white" id="exampleModalLongTitle">Modify Asset</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="mb-1">
                            <br>
                                <label class="col-sm-0 control-label" for="number">Reason</label>
                                <input type="text" class="form-control datepicker" id="datepicker" name="note" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                            <br>
                                <label class="col-sm-0 control-label" for="number">Number of Depreciations :</label>
                                <input type="number" class="form-control" id="method_number" name="to" value="{{date('Y-m-d')}}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                            <br>
                                <label class="col-sm-0 control-label" for="number">Period Length :</label>
                                <input type="number" class="form-control" id="method_period" name="note" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" name="action" data-bs-dismiss="modal" onclick="period()">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
