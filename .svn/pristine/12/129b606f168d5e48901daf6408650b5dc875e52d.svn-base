@extends('layouts.admin')
@section('styles')
<style>
    @media print {
        .header-navbar {
            display: none;
        }

        .breadcrumb-wrapper {
            display: none;
        }

        footer {
            display: none;
        }

        .btn-icon {
            display: none;
        }

        #buttonscroll {
            display: none;
            visibility: hidden;
        }

        .nav {
            display: None;
        }

        .page-break {
            display: block;
            page-break-after: always;
        }

        .page {
            margin: 0;
            box-shadow: 0;
        }

        @page {
            size: 20cm 14.7cm;
            margin: 1mm 1mm 1mm 1mm;
            /* change the margins as you want them to be. */
        }
    }

    .body-row {

        width: 100%;
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
        font-size: 11px;
    }

    .table-cont {
        font-family: "Calibri", Courier, monospace;
        font-size: 11px;
        width: 100%;
        border-collapse: collapse;
    }

    .footer .page-number:after {
        content: counter(page);
    }

    page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.1cm rgba(0, 0, 0, 0.2);
    }

    page[size="A4"] {
        width: 29.7cm ;
        height: 18cm;
    }

    td {
        padding: 1rem;
    }

</style>
@endsection
@section('breadcrumbs')
<a href="{{route('admin.std-reports.index')}}" class="breadcrumbs__item">Purchase Report</a>

<a href="#" class="breadcrumbs__item active">Miss Expenses</a>

@endsection
@section('content')
<ul class="nav navbar-nav align-items-end ms-auto">
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
<section id="multiple-column-form" class='page-break'>
    <page size="A4">
        <div class="row body-row">
            <div class="table-responsive">
                <table id="table" class="table datatable">
                     <thead>
                         <tr>
                             <th></th>
                             <th>
                                 {{ trans('cruds.missExpense.head.orderno') }}
                             </th>
                             <th>
                                 {{ trans('cruds.missExpense.head.aju') }}
                             </th>
                             <th>
                                 {{ trans('cruds.missExpense.head.rate') }}
                             </th>
                             <th>
                                 {{ trans('cruds.missExpense.head.item') }}
                             </th>
                             <th>
                                 {{ trans('cruds.missExpense.head.qty') }}
                             </th>
                             <th>
                                 {{ trans('cruds.missExpense.head.logisticCost') }}
                             </th>
                             <th>
                                 {{ trans('cruds.missExpense.head.kso') }}
                             </th>
                             <th>
                                 {{ trans('cruds.missExpense.head.asuransi') }}
                             </th>
                             <th>
                                 {{ trans('cruds.missExpense.head.lc') }}
                             </th>
                             <th>
                                 {{ trans('cruds.missExpense.head.costTotal') }}
                             </th>
                             <th>
                                 {{ trans('cruds.missExpense.head.price') }}
                             </th>
                             <th>
                                 {{ trans('cruds.missExpense.head.cont') }}
                             </th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($missExpenses as $key =>$row)
                            <tr>
                                <td></td>
                                <td>
                                    {{ $row->order_number ?? '' }}
                                </td>
                                <td class="text-end">
                                    {{ $row->attributenumber ?? '' }}
                                </td>
                                <td class="text-end">
                                    {{ number_format($row->intattribute1, 2, ',', '.') ?? '' }}
                                </td>
                                <td>
                                    {{ $row->itemmaster->item_code ?? '' }} - {{$row->item_description}}
                                </td>
                                <td class="text-end">
                                    {{ $row->intattribute2 ?? '' }}
                                </td>
                                <td class="text-end">
                                    {{ number_format($row->intattribute3, 2, ',', '.') ?? '' }}
                                </td>
                                <td class="text-end">
                                    {{ number_format($row->intattribute4, 2, ',', '.') ?? '' }}
                                </td>
                                <td class="text-end">
                                    {{ number_format($row->intattribute5, 2, ',', '.') ?? '' }}
                                </td>
                                <td class="text-end">
                                    {{ number_format($row->intattribute6, 2, ',', '.') ?? '' }}
                                </td>
                                <td class="text-end">
                                    {{ number_format($row->intattribute8, 2, ',', '.') ?? '' }}
                                </td>
                                <td class="text-end">
                                    {{ number_format($row->rcv_price, 2, ',', '.') ?? '' }}
                                </td>
                                <td class="text-end">
                                    {{ $row->intattribute9 ?? '' }}
                                </td>
                            </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
        </div>
    </page>
</section>
<!-- /.content -->
@endsection
