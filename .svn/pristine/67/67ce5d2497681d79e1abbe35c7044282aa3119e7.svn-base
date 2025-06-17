<div class="modal fade" id="demoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  bg-primary">
                <h4 class="modal-title text-white" id="exampleModalLongTitle">{{ trans('cruds.autocreate.title') }} Invoice</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="number">Invoices will be created in draft so that you can review them before validation.</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-0 control-label">Type : </label></br>
                        <div class="col-md-10 col-12">
                            <div class="col-sm-10">
                                <div class="form-check format-label">
                                    <input class="form-check-input" type="radio" name="options" id="gridRadios1" value="1" checked>
                                    <label class="form-check-label" for="gridRadios1">
                                        Reguler Invoice
                                    </label>
                                </div>
                                <div class="form-check format-label">
                                    <input class="form-check-input" type="radio" name="options" id="gridRadios2" value="2">
                                    <label class="form-check-label" for="gridRadios2">
                                        Down Payment (fixed amount)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="div1">
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="number">Amount</label>
                                <input type="number" class="form-control " name="dp_amount" id="dp_amount" autocomplete="off">
                            </div>
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="number">TAX %</label>
                                <select class="form-control pajak" id="pajak_1" name="tax_rate" required>
                                    @foreach($tax as $row)
                                        <option value="{{$row->tax_rate}}" {{old('tax_code') == $row->tax_rate ? 'selected' : '' }}>{{$row->tax_code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="Submit" class="btn btn-primary" name='view' id="view" value="new">Create & View</button>
                <button type="Submit" class="btn btn-warning" name='action' value="new">Create</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
