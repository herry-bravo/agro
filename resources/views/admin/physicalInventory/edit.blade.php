@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
  @endsection
@push('script')
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush
@section('breadcrumbs')
<a href="{{ route("admin.physic.index") }}" class="breadcrumbs__item">{{ trans('cruds.physic.fields.inv') }}</a>
<a href="{{ route("admin.physic.index") }}" class="breadcrumbs__item"> {{ trans('cruds.physic.title') }}</a>
<a href="" class="breadcrumbs__item active"> {{ trans('cruds.physic.fields.edit') }}</a>
@endsection
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
               {{ $error }}
            @endforeach
    </div>
@endif

<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-2">Add {{trans('cruds.physic.title')}}</h4>
                </div>
                <hr>
                <div class="card-body">
                    <form action="{{ route("admin.physic.update", [$physic->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                                <div class="col-md-4">
                                    <label class="col-sm-0 control-label" for="number">{{ trans('cruds.physic.fields.date') }}</label>
                                    <input type="date" name="gl_date" class="form-control" value="{{$physic->attribute_date1}}" required >
                                    <input type="hidden" id="created_by" name="last_updated_by" value="{{auth()->user()->id?? ''}}">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-sm-0 control-label" for="number">{{ trans('cruds.physic.fields.subinv_from') }}</label>
                                    <select id="order" name="segment1" class="form-control select2">
                                        @foreach ($sub as $key => $row)
                                            @if (($row->sub_inventory_name)==($physic->subinventory))
                                                <option value="{{$row->id}}" selected>{{$row->sub_inventory_name}} - {{$row->description}}</option>
                                            @else
                                                <option value="{{$row->id}}">{{$row->sub_inventory_name}} - {{$row->description}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-sm-0 control-label" for="site">{{ trans('cruds.physic.fields.subinv_to') }} </label>
                                    <select id="grn" name="receipt_num" class="form-control select2">
                                        @foreach ($sub as $key => $row)
                                            @if (($row->sub_inventory_name)==($physic->subinventory))
                                                <option value="{{$row->id}}" selected>{{$row->sub_inventory_name}} - {{$row->description}}</option>
                                            @else
                                                <option value="{{$row->id}}">{{$row->sub_inventory_name}} - {{$row->description}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <br>
                        <div class="row">
                        <hr>
                            <div class="box box-default">
                                <div class="box-body scrollx" style="height: 450px;overflow: scroll;">
                                     <table class="table table-striped tableFixHead">
                                        <thead>
                                            <th scope="col">Item</th>
                                            <th scope="col">UOM</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Subinventory</th>
                                            <th scope="col">Locator</th>
                                            <th scope="col">Rev</th>
                                            <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="physical_container">
                                            <tr class="tr_input">
                                                {{-- <td class="">1</td> an original code --}}
                                                <td width="30%">
													<input type="text" class="form-control search_item_code" value="{{$physic->itemMaster->item_code}} - {{$physic->itemMaster->description}}" placeholder="Type here ..." name="inventory_item_code[]" id="searchitem_1" autocomplete="off" required readonly>
													<input type="hidden" class="form-control" value="{{$physic->inventory_item_id}}"  name="inventory_item_id[]" required readonly>
													<input type="hidden" class="form-control" value="{{$physic->id}}"  name="id[]" required readonly>
													<input type="hidden" class="form-control" value="{{$physic->physical_inventory_id}}"  name="physical_inventory_id[]" required readonly>
                                                <td width="10%">
                                                    <input type="text" class="form-control" name="tag_uom[]" value="{{$physic->tag_uom}}" id="uom_1" autocomplete="off" readonly>
                                                </td>
                                                <td width="10%">
                                                    <input type="text" class="form-control" name="tag_quantity[]" value="{{$physic->tag_quantity}}" id="tag_quantity_1" autocomplete="off" >
                                                </td>
                                                <td width="20%">
                                                  <input type="text" class="form-control search_subinventory" value="{{$physic->subInventories->sub_inventory_name}} - {{$physic->subInventories->description}}" name="subinventory1[]" id="subinventoryfrom_1" autocomplete="off">
                                                  <input type="hidden" class="form-control" value="{{$physic->subinventory}}"  name="subinventory[]" required readonly>
                                                </td>
                                                <td width="20%">
                                                      <input type="text" name="locator_id[]" class="form-control" value="{{$physic->locator_id}}" id="locator_1" autocomplete="off" required>
                                                </td>
                                                <td width="20%">
                                                      <input type="text" name="revision[]" class="form-control " id="rev_1" value="{{$physic->revision}}" autocomplete="off">
                                                </td>
                                                <td width="10px">
                                                    <button type="button" class="btn btn-danger" style="position: inherit;">&times;</button>
                                                </td>
                                                </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <td colspan="2">
                                                <button type="button" class="btn btn-outline-success add_physicalInventory btn-sm" style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button>
                                            </td>
                                            <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <div></div>
                                <button class="btn btn-primary btn-submit"><i data-feather='save'></i> {{ trans('global.apply') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- /.content -->
@endsection
@section('scripts')
@parent
<script>
    $(function () {
        @can('order_delete')
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.purchase-requisition.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                        headers: {'x-csrf-token': _token},
                        method: 'POST',
                        url: config.url,
                        data: { ids: ids, _method: 'DELETE' }})
                        .done(function () { location.reload() })
                    }
                }
            }
            dtButtons.push(deleteButton)
        @endcan
    })

</script>

@endsection
