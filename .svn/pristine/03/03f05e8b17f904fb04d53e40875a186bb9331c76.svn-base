@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/jquery-ui.css') }}">
  @endsection
@push('script')
    <script src="{{ asset('app-assets/js/scripts/default.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/jquery-ui.js')}}"></script>
@endpush
@section('breadcrumbs')
    <a href="{{ route('admin.arCalendar.index') }}" class="breadcrumbs__item">Account Receivable </a>
    <a href="{{ route('admin.arCalendar.index') }}" class="breadcrumbs__item">Calendar </a>
    <a href="" class="breadcrumbs__item active">Edit</a>
@endsection
@section('content')
<section id="multiple-column-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header  mt-1 mb-25">
                    <h6 class="card-title">
                        <a href="{{ route("admin.arCalendar.index") }}" class="breadcrumbs__item">{{ trans('cruds.aReceivable.title') }} </a>
                        <a href="{{ route("admin.arCalendar.index") }}" class="breadcrumbs__item">{{ trans('cruds.aReceivable.cal') }} </a>
                        <a href="/" class="breadcrumbs__item">Edit </a>
                    </h6>
                </div>
                <hr>

                <div class="card-body">
                    <form action="{{ route('admin.arCalendar.update',[$cal->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="box box-default">
                                <div class="box-body scrollx" style="height: 450px;overflow: scroll;">
                                     <table class="table table-striped tableFixHead">
                                        <thead>
                                            <th>Line</th>
                                            <th scope="col">{{ trans('cruds.aReceivable.ar_calendar.num') }}</th>
                                            <th scope="col"> {{ trans('cruds.aReceivable.ar_calendar.name') }}</th>
                                            <th scope="col">{{ trans('cruds.aReceivable.ar_calendar.year') }}</th>
                                            <th scope="col">{{ trans('cruds.aReceivable.ar_calendar.from') }}</th>
                                            <th scope="col">{{ trans('cruds.aReceivable.ar_calendar.to') }}</th>
                                            <th scope="col">{{ trans('cruds.aReceivable.ar_calendar.status') }}</th>
                                            <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="arCalendar_container">
                                            <tr class="tr_input">
                                                {{-- <td class="">1</td> an original code --}}
                                                <td class="rownumber">1</td>
                                                <td width="5%">
                                                    <input type="number" class="form-control" name="num[]" value="{{$cal->num}}" id="year_1" autocomplete="off">
                                                </td>
                                                <td width="30%">
													<input type="text" class="form-control"  name="setname" id="name_1" autocomplete="off" value="{{$cal->setname}}" >
                                                    <input type="hidden"  id="created_by" name="created_by" value="{{ auth()->user()->id }}" class="form-control">
                                                    <input type="hidden"  name="id" value="{{ $cal->id }}" class="form-control">
                                                </td>
                                                <td width="10%">
                                                    <input type="number" class="form-control" name="year" id="year_1" value="{{$cal->year}}" autocomplete="off">
                                                </td>
                                                <td width="20%">
                                                      <input type="date" name="startdate" class="form-control datepicker" value="{{$cal->startdate}}" id="from_1" autocomplete="off" required>
                                                </td>
                                                <td width="20%">
                                                      <input type="date" name="enddate" class="form-control datepicker" id="to_1" value="{{$cal->enddate}}" autocomplete="off">
                                                </td>
                                                <td width="10%">
                                                    <select type="text" id="status" name="status" class="form-control select2"  required>
                                                        @if($cal->confirmationstatus == 12)
                                                            <option value="12" selected>Closed</option>
                                                            <option value="14">Open</option>
                                                        @else
                                                            <option value="12" >Close</option>
                                                            <option value="14" selected>Open</option>
                                                        @endif
                                                    </select>
                                                </td>
                                                <td width="5%"><button type="button"  class="btn btn-ligth btn-sm remove_tr_quotation" disabled>X</button></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <td colspan="2">
                                                <button type="button" class="btn btn-light btn-sm add_arCalendar btn-sm" style="font-size: 12px;"><i data-feather='plus'></i> Add Rows</button>
                                            </td>
                                            <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
						</br>
                            <div class="d-flex justify-content-between mb-2">
                                <button class="btn btn-warning" type="reset"><i data-feather='refresh-ccw'></i> Reset</button>
                                <button class="btn btn-primary btn-submit"><i data-feather='save'></i> {{ trans('global.save') }}</button>
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
