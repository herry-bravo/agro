@extends('layouts.admin')
@section('content')

<div class="card" style="margin-top: 3%;">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.quotation.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.quotation.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row{{ $errors->has('customer_name') ? 'has-error' : '' }}">
                <label class="col-sm-1 control-label" for="number">{{ trans('cruds.quotation.fields.number') }}</label>
                <div class="col-sm-4">
                <input type="text" id="number" name="number" class="form-control" value="{{ old('number', isset($quotation) ? $quotation->number : '') }}" required>
                @if($errors->has('number'))
                    <em class="invalid-feedback">
                        {{ $errors->first('number') }}
                    </em>
                @endif
                </div>
                <label class="col-sm-1 control-label" for="status">{{ trans('cruds.quotation.fields.status') }}</label>
                <div class="col-sm-4">
                <input type="text" id="status" name="status" class="form-control" value="{{ old('status', isset($quotation) ? $quotation->status : '') }}" required>
                @if($errors->has('status'))
                    <em class="invalid-feedback">
                        {{ $errors->first('customer_name') }}
                    </em>
                @endif
                </div>
            </div>
            <div class="form-group row {{ $errors->has('supplier') ? 'has-error' : '' }}">
                <label class="col-sm-1 control-label" for="supplier">{{ trans('cruds.quotation.fields.supplier') }}</label>
                <div class="col-sm-4">
                <input type="email" id="supplier" name="supplier" class="form-control" value="{{ old('supplier', isset($order) ? $order->supplier : '') }}">
                @if($errors->has('supplier'))
                    <em class="invalid-feedback">
                        {{ $errors->first('supplier') }}
                    </em>
                @endif
                </div>
                <label class="col-sm-1 control-label" for="site">{{ trans('cruds.quotation.fields.site') }}</label>
                <div class="col-sm-4">
                <input type="email" id="site" name="site" class="form-control" value="{{ old('site', isset($quotation) ? $quotation->site : '') }}">
                @if($errors->has('site'))
                    <em class="invalid-feedback">
                        {{ $errors->first('site') }}
                    </em>
                @endif

            </div>
            </div>
            <div class="form-group row {{ $errors->has('customer_email') ? 'has-error' : '' }}">
                <label class="col-sm-1 control-label" for="customer_email">{{ trans('cruds.quotation.fields.effective_date') }}</label>
                <div class="col-sm-4">
                <input type="email" id="customer_email" name="customer_email" class="form-control" value="{{ old('customer_email', isset($quotation) ? $quotation->customer_email : '') }}">
                @if($errors->has('customer_email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('customer_email') }}
                    </em>
                @endif

                </div>
                <label class="col-sm-1 control-label" for="currency">{{ trans('cruds.quotation.fields.currency') }}</label>
                <div class="col-sm-4">
                <input type="email" id="currency" name="currency" class="form-control" value="{{ old('currency', isset($currency) ? $quotation->currency : '') }}">
                @if($errors->has('customer_email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('customer_email') }}
                    </em>
                @endif

            </div>
            </div>
            <div class="card">
                <div class="card-body ">
                    <table class="table" id="products_table">
                        <thead >
                            <tr>
                                <th>line</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th>UOM</th>
                                <th>Price</th>
                                <th>From</th>
                                <th>To</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (old('products', ['']) as $index => $oldProduct)
                                <tr id="product{{ $index }}">
                                    <td>
                                         <input type="number" name="quantities[]" class="form-control" value="{{ old('quantities.' . $index) ?? '1' }}" />
                                    </td>
                                    <td>
                                        <select name="products[]" class="form-control">
                                            <option value="">-- choose product --</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"{{ $oldProduct == $product->id ? ' selected' : '' }}>
                                                    {{ $product->name }} (${{ number_format($product->price, 2) }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    <input type="number" name="quantities[]" class="form-control" value="{{ old('quantities.' . $index) ?? '1' }}" />
                                    </td>
                                    <td>
                                        <input type="number" name="quantities[]" class="form-control" value="{{ old('quantities.' . $index) ?? '1' }}" />
                                    </td>
                                    <td>
                                    <input type="number" name="quantities[]" class="form-control" value="{{ old('quantities.' . $index) ?? '1' }}" />
                                    </td>
                                    <td>
                                    <input type="number" name="quantities[]" class="form-control" value="{{ old('quantities.' . $index) ?? '1' }}" />
                                    </td>
                                    <td>
                                    <input type="number" name="quantities[]" class="form-control" value="{{ old('quantities.' . $index) ?? '1' }}" />
                                    </td>
                                </tr>
                            @endforeach
                            <tr id="product{{ count(old('products', [''])) }}"></tr>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-12">
                            <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                            <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                            </div>
                    </div>
                </div>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>>
@endsection

@section('scripts')
<script>
  $(document).ready(function(){
    let row_number = {{ count(old('products', [''])) }};
    $("#add_row").click(function(e){
      e.preventDefault();
      let new_row_number = row_number - 1;
      $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
      $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
      row_number++;
    });

    $("#delete_row").click(function(e){
      e.preventDefault();
      if(row_number > 1){
        $("#product" + (row_number - 1)).html('');
        row_number--;
      }
    });
  });
</script>
@endsection
