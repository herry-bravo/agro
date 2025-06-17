@extends('layouts.admin')
@section('styles')
@section('content')
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="#">Purchase Order</a>
    </li>
    <li class="breadcrumb-item"><a href="#">Requisition</a>
    </li>
@endsection
@section('content')
<section id="multiple-column-form">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-2">{{$purchaseRequisition->segment1}}</h4>
                </div>
                <hr>
                <div class="card-body">
<div class="container-fluid mt-100 mb-100">
    <div id="ui-view">
        <div>
            <div class="card">
                <div class="card-header"> Invoice<strong>#BBB-245432</strong>

                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <h6 class="mb-3">From:</h6>
                            <div><strong>BBBootstrap Inc.</strong></div>
                            <div>546 Aston Avenue</div>
                            <div>NYC, NY 12394</div>
                            <div>Email: contact@bbbootstrap.com</div>
                            <div>Phone: +1 848 389 9289</div>
                        </div>
                        <div class="col-sm-4">
                            <h6 class="mb-3">To:</h6>
                            <div><strong>Facebook Inc.</strong></div>
                            <div>345, SA Road</div>
                            <div>Cupertino CA 92154</div>
                            <div>Email: billings@facebook.com</div>
                            <div>Phone: +1 894 989 9898</div>
                        </div>
                        <div class="col-sm-4">
                            <h6 class="mb-3">Details:</h6>
                            <div>Invoice<strong> #BBB-245432</strong></div>
                            <div>March 22, 2020</div>
                            <div>VAT: BBB0909090</div>
                            <div>Account Name: BANK OF AMERICA</div>
                            <div><strong>SWIFT code: 985798579487</strong></div>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="center">#</th>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th class="center">UNIT</th>
                                    <th class="right">COST</th>
                                    <th class="right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="center">1</td>
                                    <td class="left">Laptops</td>
                                    <td class="left">Macbook Air 8GB RAM, 256GB SSD</td>
                                    <td class="center">5</td>
                                    <td class="right">$900</td>
                                    <td class="right">$4500</td>
                                </tr>
                                <tr>
                                    <td class="center">2</td>
                                    <td class="left">Samsung SSD</td>
                                    <td class="left">Samsung SSD(256 GB)</td>
                                    <td class="center">20</td>
                                    <td class="right">$50</td>
                                    <td class="right">$3000</td>
                                </tr>
                                <tr>
                                    <td class="center">3</td>
                                    <td class="left">PEN DRIVES</td>
                                    <td class="left">Samsung Pendrives(32GB)</td>
                                    <td class="center">100</td>
                                    <td class="right">$10</td>
                                    <td class="right">$1000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia.</div>
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left"><strong>Subtotal</strong></td>
                                        <td class="right">$8500</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Discount (20%)</strong></td>
                                        <td class="right">$160</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>VAT (10%)</strong></td>
                                        <td class="right">$90</td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Total</strong></td>
                                        <td class="right"><strong>$9000</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="pull-right"> <a class="btn btn-sm btn-success" href="#" data-abc="true"><i class="fa fa-paper-plane mr-1"></i> Proceed to payment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
          <!-- /.box-body -->
          </div>
        </div>  
      </div>  
      </div>  
    </section>
    <!-- /.content -->
@endsection
