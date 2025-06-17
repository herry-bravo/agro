<!-- Modal Actions -->

<div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Options</h5>
                <button type="button" class="close border-0" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    @if ($ap->routing_status_lookup_code == 1)
                    <div class="form-check format-label">
                        <input type="checkbox" class="form-check-input radio" name="status" id="Check4" value="0">
                        <label class="form-check-label" for="exampleCheck1">Back to Draft</label>
                    </div>
                    <div class="form-check format-label">
                        <input type="checkbox" class="form-check-input radio" name="status" id="Check4" value="2">
                        <label class="form-check-label" for="exampleCheck1">Create Accounting</label>
                    </div>
                    @elseif($ap->routing_status_lookup_code == 0)
                    <div class="form-check format-label">
                        <input type="checkbox" class="form-check-input radio" name="status" id="Check1" value="1">
                        <label class="form-check-label" for="exampleCheck1">Validate</label>
                    </div>
                    <div class="form-check format-label">
                        <input type="checkbox" class="form-check-input radio" name="status" id="Check3" value="3">
                        <label class="form-check-label" for="exampleCheck1">Cancel</label>
                    </div>
                    @endif
                </div>

                </br>
                <div class="row">
                    <div class="col-md-10 col-12 form-check format-label">
                        <div class="mb-3">
                            <label class="col-sm-0 control-label" for="number">Note</label>
                            <input type="text" class="form-control " name="counter" autocomplete="off" required>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name='action' value="status" class="btn btn-sm btn-primary check">Confirm</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Regiaster Payment</h5>
                <button type="button" class="close border-0" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="number">Journal :</label>
                                <select name="attribute_category" id="journal" class="form-control select2" required>
                                    @foreach($journal as $row)
                                    <option value="{{ $row->category_code }}" {{ $payment->attribute_category ?? '' == $row->category_code ? 'selected' : '' }}>{{$row->description}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="site">Amount :</label>
                                <input type="text" class="form-control calculate" value="{{number_format($ap->invoice_amount - $ap->amount_paid ?? 0 ,2)}}" name="amount_paid" id="paid" oninput="myFunction()" autocomplete="off">
                                <input type="hidden" class="form-control calculate" value="{{$ap->invoice_amount - $ap->amount_paid ?? 0}}" name="amount" id="payment" autocomplete="off">
                                <input type="hidden" class="form-control " name="paid_status" value="4" autocomplete="off" required>
                                <input type="hidden" class="form-control " name="payment[]" value="21010100" autocomplete="off" required>
                                <input type="hidden" class="form-control " name="payment[]" value="21010000" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="site"></label>
                                <select name="payment_currency_code" id="currency" class="form-control select2" required>
                                    @foreach($currency as $row)
                                    <option value="{{$row->currency_code}}" {{ $ap->invoice_currency_code == $row->currency_code ? 'selected' : '' }}> {{$row->currency_code}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="number">Payment Method :</label>
                                <select name="invoice_payment_type" id="payment_method" class="form-control select2" required>
                                    <option value="Manual">Manual</option>
                                    <option selected value="Auto">Auto</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="rate">Payment Date :</label>
                                <input type="text" class="form-control flatpickr-basic flatpickr-input" name="accounting_date" value="{{date('Y-m-d')}}" autocomplete="off">
                            </div>
                        </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="number">Receipt Bank Account :</label>
                                <select name="bank_num" id="bank_account" class="form-control select2" required>
                                    @foreach($ba as $row)
                                    <option value="{{ $row->bank_account_id }}" {{ $payment->bank_num ??''  == $row->bank_account_id ? 'selected' : '' }}">{{$row->attribute1}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-1">
                                <label class="col-sm-0 control-label" for="rate">Memo :</label>
                                <input type="text" class="form-control" name="memo" value="{{$ap->voucher_num}}" autocomplete="off">
                                <input type="hidden" class="form-control" name="invoice_id" value="{{$ap->invoice_id}}" autocomplete="off">
                                <input type="hidden" class="form-control" name="global_attribute1" value="Send" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div id="myDIV" style="display: none;">
                        <div class="mt-2">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label class="control-label" for="rate">Payement Difference : &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                        <b class="text-end" id="diff"></b>
                                    </label>
                                    <input type="hidden" readonly class="form-control text-end" name="paid" id="" value="0" autocomplete="off">
                                    <div class="form-check mt-1">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="logo" id="inlineRadio1" value="1" checked="">
                                            <label class="form-check-label" for="inlineRadio1">&nbsp;&nbsp; Keep Open</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="logo" id="inlineRadio2" value="2">
                                            <label class="form-check-label" for="inlineRadio2">&nbsp;&nbsp; Mark as fully paid</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#creditNote"> <span class="bs-stepper-box">Credite Memo</button>
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name='action' value="payment" class="btn btn-sm btn-primary check">Create Payment</button>

            </div>
        </div>
    </div>
</div>
</div>
<!-- End Modal Actions -->
@push('script')
<script>
    function myFunction() {
        var x = document.getElementById("myDIV");
        var payment = $("#payment").val();
        var paid = $("#paid").val();
        paid = paid.replace(/\,/g, '');
        console.log(payment, paid)
        if (paid !== payment) {
            paid = payment - parseInt(paid);
            $("#diff").text(paid.toLocaleString({
                symbol: ''
                , decimal: ','
                , separator: ''
            }));
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

</script>
@endpush
