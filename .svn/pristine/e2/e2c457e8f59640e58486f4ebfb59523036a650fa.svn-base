<form action="#">
    <div class="modal fade" id="filtersales" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-white" id="exampleModalLongTitle">Filter Sales</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row mt-1">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">Customer</label>
                                    <select name="cust" id="cust" class="form-control select2" required>
                                        <option value=' 'selected>Default </option>
                                        @foreach ($cust as $id => $row)
                                            <option value="{{ $row->cust_party_code }}">{{ $row->party_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="rate">Status</label>
                                    <select name="status" id="status" class="form-control select2" required>
                                        <option value=' ' selected>Default</option>
                                        <option value='1'>Book</option>
                                        <option value='2'>Cancel</option>
                                        <option value='3'>Close</option>
                                        <option value='4'>Enter</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">Date From</label>
                                    <input required type="date" class="form-control text-center flatpickr-basic search_supplier_name " id="min" name="transaction_datefrom" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="rate">Date To</label>
                                    <input required type="date" class="form-control text-center flatpickr-basic search_supplier_name" id="max" name="transaction_dateto" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="sales_filter" class="btn btn-primary sales_filter"
                            name="action">View</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>