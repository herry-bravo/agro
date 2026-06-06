@extends('layouts.admin')
@section('content')

<div class="d-print-none mb-3 px-2 d-flex gap-2">
    <a href="{{ route('admin.salesorder.show', $sales->id) }}" class="btn btn-sm btn-secondary">
        <i class="fa fa-arrow-left"></i> Kembali ke SO
    </a>
    <button onclick="window.print()" class="btn btn-sm btn-primary">
        <i class="fa fa-print"></i> Cetak
    </button>
</div>

<page size="A5">
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">

                    {{-- Header --}}
                    <table style="width:100%">
                        <tr>
                            <td>
                                <img style="width:5%; float:left; margin-left:4%;"
                                     src="{{ asset('app-assets/images/logo/favicon.png') }}" alt="logo">
                                <p style="font-size:12px;">
                                    <b style="color:green;">&nbsp;&nbsp;NEXZO-APP</b><br>
                                    <b>&nbsp;&nbsp;Head Office : </b>Jl. Argopuro 42, Surabaya 60251, East Java, Indonesia<br>
                                </p>
                            </td>
                        </tr>
                    </table>
                    <hr style="color:green; margin-left:5%; margin-right:5%;">

                    <div class="d-flex justify-content-center">
                        <h5><strong><br>SURAT JALAN<br><br></strong></h5>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3" style="font-size:12px; padding:0 10px;">
                            <div class="col-6">
                                <table>
                                    <tr><td style="width:110px"><b>No. Surat Jalan</b></td><td>: SJ-{{ $sales->order_number }}</td></tr>
                                    <tr><td><b>No. Sales Order</b></td><td>: {{ $sales->order_number }}</td></tr>
                                    <tr><td><b>Tanggal</b></td><td>: {{ optional($delivery)->actual_ship_date ? \Carbon\Carbon::parse($delivery->actual_ship_date)->format('d/m/Y') : date('d/m/Y') }}</td></tr>
                                </table>
                            </div>
                            <div class="col-6">
                                <table>
                                    <tr><td style="width:80px"><b>Kepada</b></td><td>: {{ optional($sales->customer)->party_name ?? 'Walk-in Customer' }}</td></tr>
                                    <tr><td><b>Alamat</b></td><td>: {{ optional($sales->party_site)->id ?? '-' }}</td></tr>
                                </table>
                            </div>
                        </div>

                        <div class="table-responsive" style="padding:0 10px;">
                            <table class="table table-bordered table-sm" style="font-size:11px;">
                                <thead style="background:#f5f5f5;">
                                    <tr>
                                        <th class="text-center" style="width:30px">#</th>
                                        <th>Nama Barang</th>
                                        <th class="text-center" style="width:70px">Qty</th>
                                        <th class="text-center" style="width:50px">UOM</th>
                                        <th class="text-right" style="width:90px">Harga</th>
                                        <th class="text-right" style="width:90px">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $subtotal = 0; @endphp
                                    @foreach($detail as $key => $row)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $row->user_description_item }}</td>
                                        <td class="text-center">{{ $row->fulfilled_quantity ?? $row->ordered_quantity }}</td>
                                        <td class="text-center">{{ $row->order_quantity_uom }}</td>
                                        <td class="text-right">{{ number_format($row->unit_selling_price, 0, ',', '.') }}</td>
                                        <td class="text-right">{{ number_format($row->unit_selling_price * ($row->fulfilled_quantity ?? $row->ordered_quantity), 0, ',', '.') }}</td>
                                    </tr>
                                    @php $subtotal += $row->unit_selling_price * ($row->fulfilled_quantity ?? $row->ordered_quantity); @endphp
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right fw-bold">Total</td>
                                        <td class="text-right fw-bold">{{ number_format($subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        {{-- Keterangan --}}
                        <div style="font-size:11px; padding:0 10px; margin-top:8px;">
                            <p>Keterangan: Barang diterima dalam kondisi baik dan lengkap sesuai dengan jumlah di atas.</p>
                        </div>

                        {{-- Tanda Tangan --}}
                        <div class="row text-center mt-4" style="font-size:11px; padding:0 10px;">
                            <div class="col-4">
                                <p>Pengirim</p>
                                <br><br><br>
                                <p>( __________________ )</p>
                            </div>
                            <div class="col-4">
                                <p>Pengemudi</p>
                                <br><br><br>
                                <p>( __________________ )</p>
                            </div>
                            <div class="col-4">
                                <p>Penerima</p>
                                <br><br><br>
                                <p>( __________________ )</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</page>

@endsection
