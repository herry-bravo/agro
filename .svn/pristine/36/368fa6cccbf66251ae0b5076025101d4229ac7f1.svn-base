<div class="modal fade bd-example-modal-sm" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@yield('pageTitle') Edit Cart Of Account</h5>
                <a href="#"><i class="m-nav__link-icon fa fa-close" data-dismiss="modal" aria-label="Close"></i></a>
            </div>
            </br>
            <form class="form-horizontal" id="formData" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="account_payable">{{ trans('cruds.coa.fields.parent') }}</label>
                            <input type="text" name="parent_code" id="parent_code" class="form-control" required>
                            <input type="hidden" name="id" id="id" class="form-control" required>
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="account_receivable">{{ trans('cruds.coa.fields.code') }}</label>
                            <input type="text" name="account_code" id="account_code" class="form-control" required />
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="description">{{ trans('cruds.coa.fields.description') }}</label>
                            <input type="text" name="description" id="description" class="form-control" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="account_payable">{{ trans('cruds.coa.fields.parent') }}</label>
                            <input name="type" id="type" class="form-control " required>
                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="account_receivable">{{ trans('cruds.coa.fields.level') }}</label>
                            <input type="text" name="level" id="level" class="form-control " required>

                        </div>
                        <div class="mb-1 col-md-4">
                            <label class="form-label" for="account_inventory">{{ trans('cruds.coa.fields.group') }}</label>
                            <input type="text" name="account_group" id="account_group" class="form-control" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
                </div>
        </div>
    </div>
</div>
