<div class="modal fade" id="deliveryNum" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-primary">
                    <h4 class="modal-title text-white">{{ trans('cruds.Delivery.modal.confirm') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form id="formship" action="{{ route("admin.deliveries.create") }}" method="get" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="mb-1">
                                        <br>
                                        <label class="form-label" for="segment1">{{ trans('cruds.Delivery.modal.deliverynumb') }}</label>
                                        <select type="text" id="idhead" name="idhead" class="form-control select2">
                                            @foreach($DeliveryHeader as $row)
                                            @if ($row->lvl==6)
                                            <option name="idhead" value="{{$row->id}}">{{$row->id}} </option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" name='action' value="add_item_second" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>{{ trans('cruds.Delivery.modal.conf') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
