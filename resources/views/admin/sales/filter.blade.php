<div class="modal fade" id="filtersales" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header py-1 px-2">
                <h6 class="modal-title mb-0">Filter Sales Order</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-2 py-2">
                <div class="row g-2">
                    <div class="col-12">
                        <label class="form-label small mb-1">Customer</label>
                        <select name="cust" id="cust" class="form-select form-select-sm select2">
                            <option value="">All Customers</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label small mb-1">Status</label>
                        <select name="status" id="status" class="form-select form-select-sm">
                            <option value="">All Status</option>
                            <option value="1">Active</option>
                            <option value="2">Cancelled</option>
                            <option value="3">Completed</option>
                            <option value="4">Draft</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label small mb-1">Date From</label>
                        <input type="date" class="form-control form-control-sm" id="min" name="transaction_datefrom" autocomplete="off">
                    </div>
                    <div class="col-6">
                        <label class="form-label small mb-1">Date To</label>
                        <input type="date" class="form-control form-control-sm" id="max" name="transaction_dateto" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="modal-footer py-1 px-2">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm btn-primary sales_filter">Apply Filter</button>
            </div>
        </div>
    </div>
</div>
