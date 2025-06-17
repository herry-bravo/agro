
@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
@endsection
@push('script')
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@endpush
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="../">Purchase Order</a>
    </li>
    <li class="breadcrumb-item"><a href="#">Purchase Order Edit</a>
    </li>
@endsection
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <form action="{{ route('admin.rcv.update',[$parent->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-2">Receive</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                @if($parent->invoice_status_code==0)
                                    <button type="submit"  class="btn btn-sm btn-primary pull-right" onclick="myFunction()"> <i data-feather="corner-down-right" class="font-medium-3"></i> Submit</button>
                                
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label class="col-sm-0  form-label" for="number">{{ trans('cruds.quotation.fields.number') }}</label>
                                    <input type="text" class="form-control" readonly name="no_rcv" autocomplete="off" value="{{$parent->receipt_num}}" required>
                                    <input type="hidden" class="form-control" readonly name="id" autocomplete="off" value="{{$parent->id}}" required>
                                </div>
                            </div>
                             <div class="col-md-2">
                                <div class="mb-1">
                                     <label class="col-sm-0 form-label" for="site">PO Number</label>
                                    <input type="text" class="form-control" value="{{$parent->attribute1}}" name="po_number" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-1">
                                    <label class="col-sm-0 form-label" for="site">{{ trans('cruds.quotation.fields.supplier') }}</label>
                                    <input type="text"value="{{$parent->vendor->vendor_name}}" class="form-control" readonly name="supplier_name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1">
                                     <label class="col-sm-0 form-label" for="site">Currency</label>
                                    <input type="text" class="form-control" value="{{$parent->currency_code}}" name="currency_code" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-1">
                                     <label class="col-sm-0 form-label" for="site">Taxes</label>
                                    <input type="text" class="form-control" value="{{$parent->taxes->tax_code??''}}" name="taxes" autocomplete="off" readonly>
                                    <input type="hidden" class="form-control" value="{{$parent->taxes->tax_rate??''}}" name="taxe_rate" autocomplete="off" readonly>
                                </div>
                            </div>
                           
                            
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="mb-1">
                                    <label class="col-sm-0 form-label" for="number">Seller</label>
                                    <input type="text" value="{{$parent->user->name}}" class="form-control" name="buyer" autocomplete="off" readonly>
                                </div>
                            </div>
							<div class="col-md-2">
                                <div class="mb-1">
                                    <label class="col-sm-0 form-label" for="">Sub Inventory</label>
									<input type="text" value="{{$parent->ship_to_location_id}}" readonly class="form-control" name="warehouse" autocomplete="off" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-1">
                                    <label class="col-sm-0 form-label" for="site">Delivery To</label>
                                    <input readonly type="text" class="form-control " placeholder="" value="{{$parent->comments}}" name="address1" autocomplete="off" required>
                                </div>
                            </div>
                           
                            <div class="col-md-4">
                                <div class="mb-1">
                                    <label class="col-sm-0 form-label" for="site">Creation Date</label>
									<input readonly type="text" id="created_at" name="created_at" class="form-control" value="{{ now()->format('d-M-Y H:i:s') }}" required>
                                </div>
                            </div>
                            <br>
                            <div class="col-md-3">
                                <div class="mb-1">

                                </div>
                            </div>
                        </div>
                        <br>
                       

                        <!-- tab jurnal -->
                        <div class="card-header">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-sales-tab" data-bs-toggle="tab" data-bs-target="#nav-sales" type="button" role="tab" aria-controls="nav-sales" aria-selected="true">
                                        <span class="bs-stepper-box">
                                            <i data-feather="file-text" class="font-medium-3"></i>
                                        </span>
                                        Receive Lines
                                    </button>
                                    <button class="nav-link" id="nav-journal-tab" data-bs-toggle="tab" data-bs-target="#nav-journal" type="button" role="tab" aria-controls="nav-journal" aria-selected="false">
                                        <span class="bs-stepper-box">
                                            <i data-feather="file-text" class="font-medium-3"></i>
                                        </span>
                                        Journal
                                    </button>
                                </div>
                            </nav>
                        </div>
                        <hr>
                        <div class="card-body">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-sales" role="tabpanel" aria-labelledby="nav-sales-tab">
                                    <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                        <table class="table table-fixed  table-borderless">
											<thead>
												<tr>
													<th>Purchase Item</th>
													<th>Category</th>
													<th>UOM</th>
													<th>Quantity</th>
													<th>Price</th>
													<th>Need By Date</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody class="purchase_container">
												@foreach($detail as $key => $raw)
													<tr class="tr_input">
														<td width="30%">
															<input type="text" readonly class="form-control" name="item_code[]" autocomplete="off" required value="{{$raw->itemmaster->item_code ?? ''}} - {{$raw->itemmaster->description ?? ''}}"><span class="help-block " style="display: none;" id="search_item_code_empty_1" required></span>
														</td>
														<td width="15%">
															<input type="text" readonly class="form-control" value="{{$raw->itemmaster->category->category_name}}" name="category[]" id="category_1" autocomplete="off" required>
														</td>
														<td width="10%">
															<input type="text" class="form-control" name="uom[]" value="{{$raw->uom_code}}" autocomplete="off" readonly>
														</td>
														<td width="10%">
															<input type="text" readonly class="form-control" name="qty[]" value="{{$raw->quantity_received}}" autocomplete="off"   required>
														</td>
														<td width="10%">
															<input type="text" readonly class="form-control" name="price[]" value="{{$raw->requested_amount}}" autocomplete="off" required>
														</td>
														<td width="10%">
															<input readonly type="text" name="need_by_date[]" value="{{ optional($raw->created_at)->format('d-M-Y') }}" class="form-control datepicker " id="need_1" autocomplete="off">
														</td>
														<td width="10%">
															<input readonly type="text" name="total[]" value="{{$raw->amount}}" class="form-control" id="need_1" autocomplete="off">
														</td>
													</tr>
												@endforeach

											</tbody>
											
										</table>
                                    </div>
                                </div>
								<!-- Tab Journal  -->
 								<div class="tab-pane fade" id="nav-journal" role="tabpanel" aria-labelledby="nav-journal-tab">
                                    <div class="box-body scrollx" style="height: 300px;overflow: scroll;">
                                        <table class="table table-fixed  table-borderless">
											<thead>
												<tr>
													<th></th>
                                                    <th scope="col">{{ trans('cruds.Invoice.field.account')}}</th>
                                                    <th scope="col">{{ trans('cruds.Invoice.field.label') }}</th>
                                                    <th scope="col">{{ trans('cruds.Invoice.field.debit')}}</th>
                                                    <th scope="col">{{ trans('cruds.Invoice.field.credit')}}</th>
												</tr>
											</thead>
											@php
                                                $totalDr = 0;
                                                $totalCr = 0;
                                            @endphp
											<tbody class="purchase_container">
												@foreach($detail as $row)
                                                   @php
                                                        $subtot = $row->amount;
                                                        $potongan = $subtot*($parent->conversion_rate/100);
                                                        $drValue = $subtot-$potongan;
                                                        $crValue = 0; // CR pada loop kedua selalu 0
                                                        $totalDr += $drValue;
                                                        $totalCr += $crValue;
                                                    @endphp
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            {{ $row->itemmaster->category->inventory->account_code ?? '' }} - {{ $row->itemmaster->category->inventory->description ?? '' }}
                                                            <input type="hidden" name="accDes[]" value="{{ $row->itemmaster->category->inventory->account_code ?? '' }}">
                                                            <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_1" autocomplete="off">
                                                        </td>
                                                        <td>
                                                            {{ $row->itemmaster->description ?? '' }}
                                                            <input type="hidden" name="desc[]" value="{{ $row->user_description_item ?? '' }}">
                                                        </td>
                                                        <td>
                                                            {{ number_format($drValue) }}
                                                            <input type="hidden" name="dr[]" value="{{ $drValue }}">
                                                        </td>
                                                        <td>
                                                            {{ number_format($crValue) }}
                                                            <input type="hidden" name="cr[]" value="{{ $crValue }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @foreach($detail as $row)
                                                   @php
                                                        $subtot = $row->amount;
                                                        $potongan = $subtot*($parent->conversion_rate/100);
                                                        $drValue = $potongan;
                                                      
                                                        $crValue = 0; // CR pada loop kedua selalu 0
                                                        $totalDr += $drValue;
                                                        $totalCr += $crValue;
                                                    @endphp
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            {{ $ppn->account_code ?? '' }} - {{ $ppn->description ?? '' }}
                                                            <input type="hidden" name="accDes[]" value="{{$ppn->account_code}}">
                                                            <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_1" autocomplete="off">
                                                        </td>
                                                        <td>
                                                            {{ $row->itemmaster->description ?? '' }}
                                                            <input type="hidden" name="desc[]" value="{{ $row->user_description_item ?? '' }}">
                                                        </td>
                                                        <td>
                                                            {{ number_format($drValue) }}
                                                            <input type="hidden" name="dr[]" value="{{ $drValue }}">
                                                        </td>
                                                        <td>
                                                            {{ number_format($crValue) }}
                                                            <input type="hidden" name="cr[]" value="{{ $crValue }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
												@foreach($detail as $row)
                                                   @php
                                                        $drValue = 0;
                                                        $crValue =  $row->amount; // CR pada loop kedua selalu 0
                                                        $totalDr += $drValue;
                                                        $totalCr += $crValue;
                                                    @endphp
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            {{ $row->itemmaster->category->payable->account_code ?? '' }} - {{ $row->itemmaster->category->payable->description ?? '' }}
                                                            <input type="hidden" name="accDes[]" value="{{ $row->itemmaster->category->payable->account_code ?? '' }}">
                                                            <input type="hidden" name="code_combinations[]" value="" class="form-control datepicker" id="acc_1" autocomplete="off">
                                                        </td>
                                                        <td>
                                                            {{ $row->itemmaster->description ?? '' }}
                                                            <input type="hidden" name="desc[]" value="{{ $row->user_description_item ?? '' }}">
                                                        </td>
                                                        <td>
                                                            {{ number_format($drValue) }}
                                                            <input type="hidden" name="dr[]" value="{{ $drValue }}">
                                                        </td>
                                                        <td>
                                                            {{ number_format($crValue) }}
                                                            <input type="hidden" name="cr[]" value="{{ $crValue }}">
                                                        </td>
                                                    </tr>
                                                @endforeach

											</tbody>
											<tfoot>
                                                <tr>
                                                    <td colspan="3" class="text-right"><strong>Total</strong></td>
                                                    <td>
                                                        <strong>{{ number_format($totalDr) }}</strong>
                                                        <input type="hidden" name="running_total_dr" value="{{ $totalDr }}">
                                                    </td>
                                                    <td>
                                                        <strong>{{ number_format($totalCr) }}</strong>
                                                        <input type="hidden" name="running_total_cr" value="{{ $totalCr }}">
                                                    </td>
                                                </tr>
                                            </tfoot>


										</table>
                                    </div>
                                </div>
                                <br>
                               
                               
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mb-2 mt-2">
                            <div></div>
                            <!-- <button type="submit"  class="btn btn-sm btn-primary pull-right" onclick="myFunction()"> <i data-feather="corner-down-right" class="font-medium-3"></i> Submit</button> -->
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('scripts')
@parent
@endsection