<!-- Modal Actions -->

<form action="{{ route('admin.credit-memo.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal" novalidate>

    {{ csrf_field() }}
    <div class="modal fade" id="creditNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Credit Note</h5>
                    <button type="button" class="close border-0" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                </div>
                <div class="modal-body">
                    <div class="card-body mt-1">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">Reason :</label>
                                    <input type="text" class="form-control" name="memo" value="" autocomplete="off">
                                    <input type="hidden" class="form-control" name="invoice_id" i value="{{$ap->invoice_id}}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="number">Use Specific Account :</label>
                                    <select name="attribute_category" id="journal" class="form-control select2"  required>
                                        @foreach($acc as $row)
                                            <option value="{{ $row->account_code }}">{{ $row->account_code }} - {{$row->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label class="control-label" for="rate">Reversal Date : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                    <b class="text-end" id="diff"></b>
                                </label>
                                <input type="hidden" readonly class="form-control text-end" name="paid" id="" value="0" autocomplete="off">
                                <div class="form-check mt-1">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="logo" id="inlineRadio1" value="1" checked="">
                                        <label class="form-check-label" for="inlineRadio1">&nbsp;&nbsp; Spesific</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="logo" id="inlineRadio2" value="2">
                                        <label class="form-check-label" for="inlineRadio2">&nbsp;&nbsp; Journal Entry Date</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="col-sm-0 control-label" for="rate">Refund Date :</label>
                                    <input type="text" class="form-control flatpickr-basic flatpickr-input" name="accounting_date" value="{{date('Y-m-d')}}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit"  name='action' value="save" class="btn btn-sm btn-primary check">Create Credit Memo</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Actions -->
@push('script')
<script>
function myFunction() {
    var x = document.getElementById("myDIV");
    var payment =  $("#payment").val();
    var paid =  $("#paid").val();
    paid = paid.replace(/\,/g,'');
    console.log(payment, paid)
    if (paid !== payment) {
        paid =payment-parseInt(paid);
        $("#diff").text(paid.toLocaleString({ symbol: '', decimal: ',', separator: '' }));
        x.style.display = "block";
    }else{
        x.style.display = "none";
    }
}
</script>
@endpush

