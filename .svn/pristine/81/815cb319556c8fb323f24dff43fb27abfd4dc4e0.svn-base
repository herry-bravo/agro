@extends('layouts.admin')
@section('content')
@push('script')
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
@endpush
@section('breadcrumbs')
    <a href="{{route('admin.home')}}" class="breadcrumbs__item">{{ trans('cruds.OrderManagement.title') }}</a>
    <a href="{{route('admin.shipment.index')}}" class="breadcrumbs__item">{{ trans('cruds.shiping.title_singular') }}</a>
    <a href="{{route('admin.shipment.create')}}" class="breadcrumbs__item">Fullfillment</a>
@endsection
<div class="card" >
    <div class="card-header">
        <h4 class="card-title mb-2">Fullfill-ment</h4>
    </div>
    <div class="card-body">
        <form id = "formship" action="{{ route("admin.shipment.update",$DeliveryHeader->delivery_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="form-group row">
                    <div class="col-md-2">
                        <div class="mb-1">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.customer_name') }}</label>
                            @if ($DeliveryHeader->lvl==6)
                                <select type="text" id="customer" name="customer" class="form-control select2" value="{{$DeliveryHeader->sold_to_party_id}}" required>
                                    <option value="{{$DeliveryHeader->id}}" >{{$DeliveryHeader->customer->cust_party_code}} -{{$DeliveryHeader->customer->party_name}} </option>
                                </select>
                            @else
                                <select disabled type="text" id="customer" name="customer" class="form-control select2" value="{{$DeliveryHeader->sold_to_party_id}}" required>
                                    <option value="{{$DeliveryHeader->id}}" >{{$DeliveryHeader->customer->cust_party_code}} -{{$DeliveryHeader->customer->party_name}} </option>
                                </select>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="mb-1">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.invoice_no') }}</label>
                            @if ($DeliveryHeader->lvl==6)
                                <input autocomplete="off" required id="invoice_no" name="invoice_no" class="form-control" value="{{$DeliveryHeader->packing_slip_number}}" required>
                            @else
                                <input readonly required id="invoice_no" name="invoice_no" class="form-control" value="{{$DeliveryHeader->packing_slip_number}}" required>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="mb-1">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.order_letter_no') }}</label>
                            <input readonly="readonly" id="delivery_name" name="delivery_name" class="form-control" value="{{$DeliveryHeader->delivery_id}}">
                            <input type="hidden" id="id" name="id" value="{{$DeliveryHeader->id}}">
                            <input type="hidden" id="delivery_id" name="delivery_id" value="{{$DeliveryHeader->delivery_id}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-1">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.invoice_date') }}</label>
                            @if ($DeliveryHeader->lvl==6)
                                <input type="date" id="invoice_date" name="invoice_date" class="form-control datepicker" value="{{$DeliveryHeader->on_or_about_date}}" required>
                                @if($errors->has('on_or_about_date'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('on_or_about_date') }}
                                    </em>
                                @endif
                                @else
                                <input disabled type="date" id="invoice_date" name="invoice_date" class="form-control datepicker" value="{{$DeliveryHeader->on_or_about_date}}" required>
                                @if($errors->has('on_or_about_date'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('on_or_about_date') }}
                                    </em>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="mb-1">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.status') }}</label>
                            @if ($DeliveryHeader->lvl==6)
                            <select type="text" id="status" name="status" class="form-control select2" value="{{$DeliveryHeader->status_code}}" required>
                                <option value="{{$DeliveryHeader->status_code}}}">{{$DeliveryHeader->trxstatus->trx_name}}</option>
                            </select>
                            @else
                            <select disabled type="text" id="status" name="status" class="form-control select2" value="{{$DeliveryHeader->status_code}}" required>
                                <option value="{{$DeliveryHeader->status_code}}}">{{$DeliveryHeader->trxstatus->trx_name}}</option>
                            </select>

                            @endif

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-1">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.currency') }}</label>

                            @if ($DeliveryHeader->lvl==6)
                            <select type="text" id="currencies" name="currencies" class="form-control select2" value="{{$DeliveryHeader->currency_code}}" required>
                                <option value="{{$DeliveryHeader->id}}">{{$DeliveryHeader->currency->currency_code}} -{{$DeliveryHeader->currency->currency_name}} </option>
                            </select>
                                @else
                                <select disabled type="text" id="currencies" name="currencies" class="form-control select2" value="{{$DeliveryHeader->currency_code}}" required>
                                    @foreach($global as $row)
                                        <option value="{{$row->id}}"{{ $DeliveryHeader->currency->currency_code == $row->id ? 'selected' : '' }}>{{$row->currency->currency_code}} - {{$row->currency->currency_name}} </option>
                                    @endforeach
                                </select>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="mb-1">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="mb-2">
                        <input class="form-check-input" type="checkbox" value="" id="do">
                          <label class="form-check-label" for="defaultCheck1">
                          {{ trans('cruds.shiping.fields.do') }}
                          </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <div class="mb-1">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.customer_shipto') }}</label>
                            @if ($DeliveryHeader->lvl==6)
                            <select type="text" id="customer_shipto" name="customer_shipto" class="form-control select2" value="{{$DeliveryHeader->ship_to_party_id}}" required>
                                @foreach($customershiipto as $row)
                                    <option value="{{$row->id}}"{{ $DeliveryHeader->ship_to_party_id == $row->id ? 'selected' : '' }}>{{$row->site_code}} / {{$row->address1}}</option>
                                @endforeach
                            </select>
                                @else
                                <select disabled type="text" id="customer_shipto" name="customer_shipto" class="form-control select2" value="{{$DeliveryHeader->ship_to_party_id}}" required>
                                    @foreach($customershiipto as $row)
                                        <option value="{{$row->id}}"{{ $DeliveryHeader->ship_to_party_id == $row->id ? 'selected' : '' }}>{{$row->site_code}} / {{$row->address1}}</option>
                                    @endforeach
                                </select>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-1">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.note') }}</label>
                            @if ($DeliveryHeader->lvl==6)
                            <input autocomplete="off" required type="text" id="note" name="note" class="form-control" value="{{$DeliveryHeader->attribute2}}" required>

                                @else
                            <input readonly required type="text" id="note" name="note" class="form-control" value="{{$DeliveryHeader->attribute2}}" required>

                            @endif
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="mb-1">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.freight_term') }}</label>
                            @if ($DeliveryHeader->lvl==6)
                            <select type="text" id="freight_term" name="freight_term" class="form-control select2" value="{{$DeliveryHeader->freight_terms_code}}" required>
                                @foreach($freight_terms as $row)
                                    <option value="{{$row->id}}"{{ $DeliveryHeader->freight_terms_code == $row->id ? 'selected' : '' }}>{{$row->term_code}}</option>
                                @endforeach
                            </select>
                                @else
                                <select disabled type="text" id="freight_term" name="freight_term" class="form-control select2" value="{{$DeliveryHeader->freight_terms_code}}"required>
                                    @foreach($freight_terms as $row)
                                        <option value="{{$row->id}}"{{$DeliveryHeader->freight_terms_code == $row->id ? 'selected' : ''}}>{{$row->term_code}}</option>
                                    @endforeach
                                </select>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="mb-1">
                            <label class="form-label" for="segment1">{{ trans('cruds.shiping.fields.gross_weight') }}</label>
                            @if ($DeliveryHeader->lvl==6)
                            <input autocomplete="off" required type="number" id="gross_weight" name="gross_weight" class="form-control" value="{{$DeliveryHeader->gross_weight}}" required>

                                @else
                            <input readonly required type="number" id="gross_weight" name="gross_weight" class="form-control" value="{{$DeliveryHeader->gross_weight}}" required>

                            @endif
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="mb-1">

                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="mb-1">
                        <input class="form-check-input" type="checkbox" value="" id="cash">
                        <label class="form-check-label" for="defaultCheck1">
                        {{ trans('cruds.shiping.fields.cash') }}
                        </label>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row mb-4">
                <div class="box box-default overflow-auto">
                    <div class="box-body" style="height: 350px;">
                        <table class="table table-bordered table-striped table-hover detailitem" id="detailitem">
                            <thead >
                                <tr>
                                    <th>NO</th>
                                    <th>{{ trans('cruds.shiping.table.sn') }}</th>
                                    <th>
                                        {{ trans('cruds.shiping.table.item_no') }}
                                        <input type="hidden"name="dvdtckcbx"id="dvdtckcbx"class="detilchbx">
                                    </th>
                                    <th>{{ trans('cruds.shiping.table.item_desc') }}</th>
                                    <th>{{ trans('cruds.shiping.modaltable.line') }}</th>
                                    <th >{{ trans('cruds.shiping.table.request_qty') }}</th>
                                    <th>{{ trans('cruds.shiping.table.uom') }}</th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($DeliveryDetail as $row)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{ $row->source_header_number ?? '' }}</td>
                                            <td>
                                                {{ $row->ItemMaster->item_code ?? '' }}
                                                <input type="hidden" value="{{$row->id}}" name="id[]" class="detilchbx" data-id="{{$row->header_id}}">
                                                <input type="hidden" value="{{$row->delivery_detail_id}}" name="delivery_detail_id[]" class="detilchbx" data-id="{{$row->delivery_detail_id}}">
                                                <input type="hidden" value="{{$row->source_header_id}}" name="source_header_id[]" class="detilchbx" data-id="{{$row->source_header_id}}">
                                                <input type="hidden" value="{{$row->source_line_id}}" name="source_line_id[]" class="detilchbx" data-id="{{$row->source_line_id}}">
                                                <input type="hidden" value="{{$row->sold_to_contact_id}}" name="sold_to_contact_id[]" class="detilchbx" data-id="{{$row->sold_to_contact_id}}">
                                                <input type="hidden" value="{{$row->delivery_name}}" name="delivery_name[]" class="detilchbx" data-id="{{$row->delivery_name}}">
                                            </td>
                                            <td>{{ $row->item_description ?? '' }}</td>
                                            <td>{{ $row->source_line_id ?? '' }}</td>
                                            <td>{{ $row->requested_quantity ?? '' }}</td>
                                            <td style="width: 0%">{{ $row->requested_quantity_uom ?? '' }}</td>
                                            <td style="width: 0%">
                                                @if ($DeliveryHeader->lvl==6)
                                                    <button type="button" name='action' value="delete" class="btn btn-sm btn-danger" onclick="deleteItem({{ $row->id }})" id="hapus" >X</button>
                                                @endif
                                            </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{-- <div class="d-flex justify-content-between">
                    @if ($DeliveryHeader->lvl==6)
                        <button class="btn btn-warning resetbtn" type="button"><i data-feather='refresh-ccw'></i> Reset</button>
                        <button class="btn btn-primary btn-submit"name='action' value="edit" id="add_all" type="submit"><i data-feather='save'></i> {{ trans('global.save') }}</button>
                    @endif
                </div> --}}
            </div>
        </form>
    </div>
</div>
@endsection
@push('script')
    <script>
        ///////////// DELETE BUTTON//////////////
        function deleteItem(id) {
            console.log(id);
            var check = confirm("Are you sure you want to Delete this row?");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if(check == true){
                console.log(check);
                $.ajax({
                    url:"./../destroy"+id,
                    type:'DELETE',
                    data:{id:id,},
                    success: function(result) {
                        location.reload();
                        alert('Success');
                    },
                    error:function(result){
                        alert('Success');
                        location.reload();

                    }
                });
            }
        }
        ///////////// DELETE BUTTON//////////////
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $(document).ready( function () {

            $('#detailitem').DataTable({
                dom:"<'row'<'col-sm-6'l><'col-sm-6'f>>" +"<'row'<'col-sm-12'tr>>" +"<'row'<'col-sm-8'i><'col-sm-4'p>>",

            });
            ///////////// RESET BUTTON//////////////
            $(".resetbtn").click(function(){
                $("#formship").trigger("reset");
            });
            ///////////// RESET BUTTON//////////////
        });
    </script>
@endpush
