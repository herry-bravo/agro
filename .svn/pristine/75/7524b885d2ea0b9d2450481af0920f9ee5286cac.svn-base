<!-- Modal supplier Example Start-->
<div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog  modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-white">{{ trans('cruds.vendor.title') }}</h4>
                {{-- <button type="button" class="close border-0" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="flase">X</span></button> --}}
            </div>

            <div class="top-nav-search mt-50">
                <form style="float: right; width: 280px;">
                    <input type="text" name='search_vendor' id="search_vendor" class="form-control" style="border-top: 1px solid #cccbcb;    width: 30rem;    float: right;    border-left: 1px solid #cccbcb;    border-right: 1px solid #cccbcb;    margin-right: 1rem;" placeholder="Search here" autocomplete="off">
                </form>
            </div>
            <div class="modal-body" style="padding: 0.1rem 0.2rem;">
                <div class="box-body">
                    <table data-toggle="table" id="tableap" class="table display nowrap table-striped table-bordered w-100">
                        <thead>
                            <tr>
                                <th class="text-start">Vendor ID</th>
                                <th class="text-start">Vendor Name</th>
                                <th class="text-start">Address</th>
                                <th class="text-start">Telp</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
@push('script')
<script>
    var table;
    var searchValue = '';
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        $('#btn-vendor').on('click', function() {
            table = $('#tableap').DataTable({
                "bServerSide": true
                , "scrollY": 300
                , "scrollX": true
                , "lengthMenu": [
                    [10, 25, 50, -1]
                    , [10, 25, 50, "All"]
                ]
                , "processing": true
                , "order": [
                    [1, "desc"]
                ]
                , "autoWidth": true
                , "displayLength": 10
                , "ajax": {
                    url: "/search/data-vendor"
                    , type: "GET"
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , data: function(d) {
                        d.search = searchValue;
                        return d;
                    }
                }
                , "dom": '<"table-body"t><"table-footer"p>'
                , "columnDefs": [{
                        "targets": 0
                        , "width": "20 %"
                        , "class": "text-nowrap"
                        , "render": function(data, type, row, meta) {
                            return row.vendor_id;
                        }
                    }
                    , {
                        "targets": 1
                        , "width": "20 %"
                        , "class": "text-nowrap"
                        , "render": function(data, type, row, meta) {
                            return row.vendor_name;
                        }
                    }
                    , {
                        "targets": 2
                        , "width": "20 %"
                        , "class": "text-nowrap"
                        , "render": function(data, type, row, meta) {
                            return row.address1;
                        }
                    }
                    , {
                        "targets": 3
                        , "width": "20 %"
                        , "class": "text-nowrap"
                        , "render": function(data, type, row, meta) {
                            return row.phone;
                        }
                    }
                    , {
                        "targets": 4
                        , "width": "20 %"
                        , "class": "text-center text-nowrap"
                        , "render": function(data, type, row, meta) {
                            return `<button type="button" id="select_vendor" data-id="${row.vendor_id}" data-name="${row.vendor_name}" class="btn btn-info btn-sm">Select</button>`;
                        }
                    }
                , ]
                , searching: false
            })
        })

        $('#search_vendor').on('keyup', function() {
            searchValue = this.value;
            table.draw();
        });
        var modal = $('#demoModal');
        modal.find('.btn-secondary').on('click', function() {
            modal.modal('hide');
            $('#search_vendor').val('');
        });
    });

</script>
@endpush
