@extends('layouts.admin')
@section('content')
<ul class="nav navbar-nav align-items-end ms-auto mb-2">
    <li class="nav-item dropdown dropdown-user nav-item has">
        <button type="button" class="btn btn-primary btn-icon" id="dropdown-user" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="feather-16" data-feather="settings"> </i>
        </button>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
            <a class="dropdown-item" href="javascript:if(window.print)window.print()"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer font-small-4 me-50">
                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                        <rect x="6" y="14" width="12" height="8"></rect>
                    </svg>Print</span></a>
            <a class="dropdown-item" href="" data-toggle="modal" target="_blank"><span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard font-small-4 me-50">
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                        <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                    </svg>Export To Pdf</span></a>
            <a class="dropdown-item" href="#demoModal" data-bs-toggle="modal"> <i class="me-50 feather-16" data-feather="sliders"> </i> More Filter</a>
        </div>
    </li>
</ul>
<section>
        <div class="row card h-100">
            <div class="table-responsive">
                <table id="table" class="table w-100">
                     <thead>
                        <tr>
                            <th colspan="8" class="text-center">
                            CV SURYA AGRO PRADHANA
                            </th>
                        </tr>
                        <tr>
                            <th colspan="8" class="text-center">
                                BALANCE SHEET
                            </th>
                         </tr>
                         <tr>
                             <th colspan="8" class="text-center">
                                 Period {{$period}}
                             </th>
                         </tr>
                         <tr>
                             <th>
                                 Account &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
                             </th>
                             <th  class="text-center">
                                 Balance
                             </th>
                         </tr>
                     </thead>
                     <tbody>
                        {{-- Aset Lancar --}}
                        @if ($totalAsetLancar != 0)
                        <tr>
                            <td><strong>Aset Lancar (Current Assets)</strong></td>
                            <td class="text-end"><strong>{{ number_format($totalAsetLancar, 2, ',', '.') }}</strong></td>
                        </tr>
                        @foreach ($asetLancar as $row)
                            @php $amount = $row->entered_dr - $row->entered_cr; @endphp
                            @if ($amount != 0)
                            <tr>
                                <td width="auto">&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->code_combination_id }} {{ optional($row->coa)->description }}</td>
                                <td class="text-end">{{ number_format($amount, 2) }}</td>
                            </tr>
                            @endif
                        @endforeach
                        @endif

                        {{-- Aset Tetap --}}
                        @if ($totalAsetTetap != 0)
                        <tr>
                            <td><strong>Aset Tetap (Fixed Assets)</strong></td>
                            <td class="text-end"><strong>{{ number_format($totalAsetTetap, 2, ',', '.') }}</strong></td>
                        </tr>
                        @foreach ($asetTetap as $row)
                            @php $amount = $row->entered_dr - $row->entered_cr; @endphp
                            @if ($amount != 0)
                            <tr>
                                <td width="auto">&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->code_combination_id }} {{ optional($row->coa)->description }}</td>
                                <td class="text-end">{{ number_format($amount, 2) }}</td>
                            </tr>
                            @endif
                        @endforeach
                        @endif

                        {{-- Total Asset --}}
                        @if ($totalAset != 0)
                        <tr>
                            <td><strong>Total Asset</strong></td>
                            <td class="text-end"><strong>{{ number_format($totalAset, 2, ',', '.') }}</strong></td>
                        </tr>
                        @endif

                        {{-- Liabilitas Jangka Pendek --}}
                        @if ($totalljangkapendek != 0)
                        <tr>
                            <td><strong>Liabilitas Jangka Pendek (Short-Term Liabilities)</strong></td>
                            <td class="text-end"><strong>{{ number_format($totalljangkapendek, 2, ',', '.') }}</strong></td>
                        </tr>
                        @foreach ($ljangkapendek as $row)
                            @php $amount = $row->entered_cr - $row->entered_dr; @endphp
                            @if ($amount != 0)
                            <tr>
                                <td width="auto">&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->code_combination_id }} {{ optional($row->coa)->description }}</td>
                                <td class="text-end">{{ number_format($amount, 2) }}</td>
                            </tr>
                            @endif
                        @endforeach
                        @endif

                        {{-- Liabilitas Jangka Panjang --}}
                        @if ($totalljangkapanjang != 0)
                        <tr>
                            <td><strong>Liabilitas Jangka Panjang (Long-Term Liabilities)</strong></td>
                            <td class="text-end"><strong>{{ number_format($totalljangkapanjang, 2, ',', '.') }}</strong></td>
                        </tr>
                        @foreach ($ljangkapanjang as $row)
                            @php $amount = $row->entered_cr - $row->entered_dr; @endphp
                            @if ($amount != 0)
                            <tr>
                                <td width="auto">&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->code_combination_id }} {{ optional($row->coa)->description }}</td>
                                <td class="text-end">{{ number_format($amount, 2) }}</td>
                            </tr>
                            @endif
                        @endforeach
                        @endif

                        {{-- Total Liabilities --}}
                        @php $totalLiabilities = $totalljangkapendek + $totalljangkapanjang; @endphp
                        @if ($totalLiabilities != 0)
                        <tr>
                            <td><strong>Total Liabilities</strong></td>
                            <td class="text-end"><strong>{{ number_format($totalLiabilities, 2, ',', '.') }}</strong></td>
                        </tr>
                        @endif

                        {{-- Modal Pemilik --}}
                        @if ($totalmodalPemilik != 0)
                        <tr>
                            <td><strong>Modal Pemilik</strong></td>
                            <td class="text-end"><strong>{{ number_format($totalmodalPemilik, 2, ',', '.') }}</strong></td>
                        </tr>
                        @foreach ($modalPemilik as $row)
                            @php $amount = $row->entered_cr - $row->entered_dr; @endphp
                            @if ($amount != 0)
                            <tr>
                                <td width="auto">&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->code_combination_id }} {{ optional($row->coa)->description }}</td>
                                <td class="text-end">{{ number_format($amount, 2) }}</td>
                            </tr>
                            @endif
                        @endforeach
                        @endif
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{$codelabatahunberjalan->account_code}} - {{$codelabatahunberjalan->description}}</td>
                            <td class="text-end"><strong>{{ number_format($labaDiTahan, 2, ',', '.') }}</strong></td>
                        </tr>
                        {{-- Total Liabilities & Modal --}}
                        @php $totalLiabilitiesModal = $totalLiabilities + $totalmodalPemilik; @endphp
                        @if ($totalLiabilitiesModal != 0)
                        <tr>
                            <td><strong>Total Liabilities & Modal</strong></td>
                            <td class="text-end">{{ number_format($totalLiabilitiesModal, 2, ',', '.') }}</td>
                        </tr>
                        @endif
                    </tbody>
                    
                 </table>
             </div>
        </div>
</section>
<!-- /.content -->
@endsection

@push('script')
    <script>

    $(document).ready(function() {
         $('#table').DataTable({
            responsive: false,
            scrollX: true,
            searching: true,
            dom: '<"card-header border-bottom"\
                                            <"head-label">\
                                            <"dt-action-buttons text-end">\
                                        >\
                                        <"d-flex justify-content-between row mt-1"\
                                            <"col-sm-12 col-md-7"Bl>\
                                            <"col-sm-12 col-md-2"f>\
                                            <"col-sm-12 col-md-2"p>\
                                        ti>',
            displayLength: 25,
            "lengthMenu": [
                [7, 25, 50, -1],
                [7, 25, 50, "All"]
            ],
            buttons: [{
                    extend: 'print',
                    text: feather.icons['printer'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Print',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
                , {
                    extend: 'excel',
                    text: feather.icons['file'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Excel',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'pdf',
                    text: feather.icons['clipboard'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Pdf',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'copy',
                    text: feather.icons['copy'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Copy',
                    className: '',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'colvis',
                    text: feather.icons['eye'].toSvg({
                        class: 'font-small-4 me-50'
                    }) + 'Colvis',
                    className: ''
                },
            ],
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            order: false
        });
    });
    </script>
@endpush
