@extends('layouts.admin')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
@endsection
@push('script')
<script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
@endpush
@section('breadcrumbs')
<a href="{{route('admin.deliveries.index')}}" class="breadcrumbs__item">{{ trans('cruds.OrderManagement.title') }}</a>
<a href="{{route('admin.deliveries.index')}}" class="breadcrumbs__item">{{ trans('cruds.Delivery.title') }}</a>
<a href="" class="breadcrumbs__item active">{{ trans('cruds.Delivery.fields.detail') }}</a>
@endsection
@section('content')
<section class="invoice-preview-wrapper">
    <div class="row invoice-preview">
        <div class="col-xl-12 col-md-12 col-12">
            <div class="card invoice-preview-card">
                <div class="card-body invoice-padding pb-0">
                    <!-- Header starts -->
                    @if($DeliveryHeader->status_code == 12)
                    <form action="{{ route('admin.deliveries.update', [$DeliveryHeader->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT') 
                        <button type="submit" class="btn btn-danger" name="action" value="return">
                        <input type="hidden" name="delivery_id" value="{{ $DeliveryHeader->delivery_id }}">

                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                                    stroke-linejoin="round" class="feather feather-return">
                                    <path d="M9 5L4 10l5 5"></path>
                                    <path d="M4 10h10a6 6 0 1 1 0 12h-1"></path>
                                </svg>
                            </span>
                            Return
                        </button>
                    </form>
                    @else
                    @endif
                    <br>
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                        <div>
                            <div class="logo-wrapper">
                                <h3 class="text-primary invoice-logo">{{ trans('cruds.Delivery.fields.orderletter') }} #{{$DeliveryHeader->delivery_id}}</h3>
                            </div>
                            <h6 class="mb-25">{{ trans('cruds.Delivery.fields.surat_jalan') }} : <i class="text-primary">{{$DeliveryHeader->dock_code}}</i></h6>
                            <h6 class="mb-25">{{ trans('cruds.Delivery.fields.customername') }}: <i class="text-primary">{{$DeliveryHeader->customer->cust_party_code}} -{{$DeliveryHeader->customer->party_name}} </i></h6>
                            <h6 class="mb-25">{{ trans('cruds.Delivery.fields.customershipto') }}: <i class="text-primary">{{$DeliveryHeader->site->site_code}} / {{$DeliveryHeader->site->address1}}</i></h6>
                            <h6 class="mb-25">{{ trans('cruds.Delivery.fields.currency') }}: <i class="text-primary">{{$DeliveryHeader->currency->currency_name}}</i></h6>
                            <h6 class="mb-25">{{ trans('cruds.Delivery.fields.createdby') }}: <i class="text-primary">{{$DeliveryHeader->name}}</i></h6>
                            <h6 class="mb-25">{{ trans('cruds.Delivery.fields.status') }}: <i class="text-primary">{{$DeliveryHeader->trxstatus->trx_name}}</i></h6>
                            <h4 class="invoice-title">
                                <span class="invoice-number">{{ trans('cruds.Delivery.fields.actualdate') }} : <i class="text-primary"> {{ \Carbon\Carbon::parse($DeliveryHeader->actual_ship_date)->format('d/M/Y') }}</i> </span>
                            </h4>
                        </div>
                        <div class="mt-md-0 mt-2 me-5">
                            <a class="btn btn-primary" href="#" id="printButton"data-delivery-date="{{ date('d/m/Y') }}"
   data-delivery-number="{{ $do->number ?? '' }}">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer me-50 font-small-4">
                                        <path d="M19 8h-2V5a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v3H5a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2zM9 5h6v3H9V5zM5 10h14v9H5v-9z"></path>
                                    </svg>
                                </span>
                                Print Delivery Order
                            </a>
                        </div>
                    </div>
                    <!-- Header ends -->
                </div>

                <hr class="invoice-spacing">

                <!-- Invoice Description starts -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="delivery-show" class="table table-bordered table-striped table-hover datatable-Transaction">
                            <thead>
                                <tr>
                                    <th style="width: 0%">

                                    </th>
                                    <th>
                                        NO
                                    </th>
                                    <th style="width: 10%">{{ trans('cruds.shiping.table.sn') }}</th>
                                    <th>{{ trans('cruds.Delivery.table.line') }}</th>
                                    <th>{{ trans('cruds.shiping.table.item_no') }}</th>
                                    <th>{{ trans('cruds.shiping.table.custpo') }}</th>
                                    <th>{{ trans('cruds.shiping.table.item_desc') }}</th>
                                    <th>{{ trans('cruds.Delivery.table.qty') }}</th>
                                    <th>{{ trans('cruds.shiping.table.uom') }}</th>
                                    <th style="width: 0%">{{ trans('cruds.Delivery.table.inv') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($DeliveryDetail as $deliveryDetail)
                                <tr>
                                    <td width="auto">
                                        <input type="checkbox"name="item_ids[]" id="item_ids" value="{{ $deliveryDetail->id }}" class="form-check-input sub_chk" data-id="{{ $deliveryDetail->id }}">
                                    </td>
                                    <td style="width: 0%">
                                        <h6>
                                            {{$no++}}
                                        </h6>
                                    </td>
                                    <td style='font-size:11px'>
                                        <h6>
                                            {{ $deliveryDetail->source_header_number ?? '' }}
                                        </h6>
                                    </td>
                                    <td style="width: 0%">
                                        <h6>
                                            {{ (FLOAT)$deliveryDetail->source_line_id ?? '' }}
                                        </h6>
                                    </td>

                                    <td>
                                        <h6>{{ $deliveryDetail->ItemMaster->item_code ?? '' }}</h6>
                                    </td>
                                    <td>
                                        <h6>
                                            {{ $deliveryDetail->cust_po_number ?? '' }}
                                        </h6>
                                    </td>
                                    <td>
                                        <h6>
                                            {{ $deliveryDetail->item_description ?? '' }}
                                        </h6>
                                    </td>


                                    <td style="width: 0%">
                                        <h6>
                                            {{ $deliveryDetail->requested_quantity ?? '' }}
                                        </h6>
                                    </td>

                                    <td style="width: 0%">
                                        <h6>
                                            {{ $deliveryDetail->requested_quantity_uom ?? '' }}
                                        </h6>
                                    </td>
                                    <td >
                                        <h6>
                                            {{ $deliveryDetail->subinventory ?? '' }}
                                        </h6>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <br>
                    <div class="d-flex justify-content-between">
                        <a href="" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modaladdterm"><i data-feather='file-text'></i>Term</a>
                        
                    </div>
                </div>
                <div class="modal fade" id="modaladdterm" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header bg-primary">
                                <h4 class="modal-title text-white">{{ trans('cruds.Delivery.modal.deliveryterm') }}</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="form-group">
                                    <br>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <label class="form-label" for="segment1">{{ trans('cruds.Delivery.modal.shipmethodcode') }}</label>
                                                <input readonly placeholder="Input Ship Method Code..." type="text" id="ship_method_code" name="ship_method_code" class="form-control" value="{{$DeliveryHeader->ship_method_code}}" required>
                                                <input type="hidden" id="created_by" name="created_by" class="form-control" value="{{$DeliveryHeader->created_by}}" required>
                                                <input type="hidden" id="updated_by" name="updated_by" class="form-control" value="{{$DeliveryHeader->last_updated_by}}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <label class="form-label" for="segment1">{{ trans('cruds.Delivery.modal.fobcode') }}</label>
                                                <input readonly placeholder="Input Fob Code..." type="text" id="fob_code" name="fob_code" class="form-control" value="{{$DeliveryHeader->fob_code}}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- MODAL TERM --}}
                {{-- MODAL SUB INVENTORY --}}
                <div class="modal fade" id="modaladdinv" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">{{ trans('cruds.Delivery.modal.addweight') }}</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="form-group">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <label class="form-label" for="segment1">{{ trans('cruds.Delivery.fields.pjg') }}</label>
                                                <input autocomplete="off" placeholder="Input Length..." type="number" name="panjang" class="form-control" required>
                                                <input type="hidden" id="id" name="id" class="form-control">
                                                <input type="hidden" name="head_id" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <label class="form-label" for="segment1">{{ trans('cruds.Delivery.fields.lbr') }}</label>
                                                <input autocomplete="off" placeholder="Input Width..." type="number" name="lebar" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <label class="form-label" for="segment1">{{ trans('cruds.Delivery.fields.brt') }}</label>
                                                <input autocomplete="off" placeholder="Input Weight..." type="number" name="xnet_weight" class="form-control" required>
                                                <input type="hidden" id="id" name="id" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <label class="form-label" for="segment1">{{ trans('cruds.Delivery.fields.gsm') }}</label>
                                                <input autocomplete="off" placeholder="Input Gsm..." type="number" name="gsm" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="segment1">{{ trans('cruds.Delivery.fields.sub') }}</label>
                                                <input autocomplete="off" name="shipping_inventory" class="form-control search_subinventory" id="subinventoryfrom_1" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="invoice-spacing">
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        , }
    });
    $(document).ready(function() {
        $('#delivery-show').DataTable({
            dom: '<"card-header border-bottom"<"head-label"><"dt-action-buttons text-end">><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-8"Bl><"col-sm-12 col-md-4"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            ordering:false,
            lengthMenu: [
                [10, 25, 50, -1]
                , [10, 25, 50, "All"]
            ],
            buttons: [{
                    extend: 'print'
                    , text: feather.icons['printer'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Print'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'csv'
                    , text: feather.icons['file-text'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Csv'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'excel'
                    , text: feather.icons['file'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Excel'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'pdf'
                    , text: feather.icons['clipboard'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Pdf'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'copy'
                    , text: feather.icons['copy'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Copy'
                    , className: ''
                    , exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'colvis'
                    , text: feather.icons['eye'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Colvis'
                    , className: ''
                , }
            , ]
        });
    })

</script>
   
    <script>
        const deliveryItems = @json($DeliveryDetail);
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<script>
    document.getElementById('printButton').addEventListener('click', function (e) {
        e.preventDefault();
        const deliveryDate = "{{ \Carbon\Carbon::parse($DeliveryHeader->actual_ship_date)->format('d/M/Y') }}";
        const deliveryNumber = "{{ $DeliveryHeader->delivery_id }}";
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('p', 'mm', 'a4');
        const pageWidth = doc.internal.pageSize.getWidth();
        const margin = 15;
        const contentWidth = pageWidth - margin * 2;
        const lineHeight = 7;

        const companyName = "CV SURYA AGRO PRADHANA";
        const companyAddress = "Jl. Peterongan-Sumobito, Jombang";
        const noPolisi = "..............................";

        // Header
        doc.setFont("helvetica", "bold");
        doc.setFontSize(12);
        doc.text(companyName, margin, 15);
        doc.setFont("helvetica", "normal");
        doc.text(companyAddress, margin, 21);

        doc.setFont("helvetica", "bold");
        doc.setFontSize(14);
        doc.text("DELIVERY ORDER", pageWidth / 2, 35, { align: "center" });

        // Detail Info
        doc.setFontSize(10);
        doc.setFont("helvetica", "normal");
        let y = 45;
        const labelX = margin;
        const valueX = labelX + 30;

        doc.text("Tanggal", labelX, y);
        doc.text(": " + deliveryDate, valueX, y);
        y += lineHeight;
        doc.text("No. DO", labelX, y);
        doc.text(": " + deliveryNumber, valueX, y);
        y += lineHeight;
        doc.text("No Polisi", labelX, y);
        doc.text(": " + noPolisi, valueX, y);

        // Table data
        y += 10;
        const body = deliveryItems.map((item, index) => [
            index + 1,
            item.item_description ?? '',
            item.requested_quantity ?? '',
            item.subinventory ?? ''
        ]);

        doc.autoTable({
            startY: y,
            head: [['No', 'Item', 'Qty', 'Warehouse']],
            body: body,
            styles: {
                fontSize: 10,
                cellPadding: 3,
                halign: 'center',
                valign: 'middle',
                textColor: [0, 0, 0],
                lineColor: [0, 0, 0],
                lineWidth: 0.2,
            },
            headStyles: {
                fillColor: [255, 255, 255],
                textColor: [0, 0, 0],
                fontStyle: 'bold',
                lineColor: [0, 0, 0],
                lineWidth: 0.5,
            },
            columnStyles: {
                0: { cellWidth: contentWidth * 0.1 },
                1: { cellWidth: contentWidth * 0.5, halign: 'left' },
                2: { cellWidth: contentWidth * 0.2 },
                3: { cellWidth: contentWidth * 0.2 }
            },
            tableLineColor: [0, 0, 0],
        });

        const tableEndY = doc.lastAutoTable.finalY;

        // Signature block
        const signatureY = tableEndY + 20;
        const sectionWidth = contentWidth / 3;

        doc.setFontSize(10);
        doc.setFont("helvetica", "normal");

        doc.text("Checker,", margin + sectionWidth * 0, signatureY);
        doc.text("Gudang,", margin + sectionWidth * 1, signatureY);
        doc.text("Sopir,", margin + sectionWidth * 2, signatureY);

        doc.text("(....................)", margin + sectionWidth * 0, signatureY + 20);
        doc.text("(....................)", margin + sectionWidth * 1, signatureY + 20);
        doc.text("(....................)", margin + sectionWidth * 2, signatureY + 20);

        // Show and Print
        const pdfData = doc.output('blob');
        const blobURL = URL.createObjectURL(pdfData);
        const pdfWindow = window.open('', '', 'width=600,height=400');
        const iframe = pdfWindow.document.createElement('iframe');
        iframe.style.position = 'absolute';
        iframe.style.top = '0';
        iframe.style.left = '0';
        iframe.style.width = '100%';
        iframe.style.height = '100%';
        iframe.style.border = 'none';
        pdfWindow.document.body.appendChild(iframe);
        iframe.src = blobURL;

        iframe.onload = function () {
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
        };
    });
</script>



@endpush
