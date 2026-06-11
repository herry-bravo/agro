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
                    <table style="width:94%; margin-left:3%;">
                        <tr>
                            <td style="width:70px; vertical-align:middle;">
                                <img style="width:60px;" src="{{ asset('app-assets/images/logo/suryaagro.png') }}" alt="surya-agro">
                            </td>
                            <td style="vertical-align:middle; padding-left:10px; font-size:12px; line-height:1.6;">
                                <b style="color:green;">SURYA-AGRO</b><br>
                                <b>Head Office : </b>Jl. Peterongan-Sumobito, RT.6/RW.1, Klampisan, Segodorejo,
                                Kec. Sumobito, Kabupaten Jombang, Jawa Timur 61483<br>
                                <b>Tel. </b>0816-1582-4494, 0851-0025-6990
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
                                        <th style="width:120px">Keterangan</th>
                                        <th class="text-center" style="width:90px">Expired</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($detail as $key => $row)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $row->user_description_item }}</td>
                                        <td class="text-center">{{ $row->fulfilled_quantity ?? $row->ordered_quantity }}</td>
                                        <td class="text-center">{{ $row->order_quantity_uom }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
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
