<?php

use App\CurrencyGlobal;
use App\RequisitionDetail;
use App\User;

    function currencyglobal($id)
    {
        $value =  CurrencyGlobal::find($id);
        return $value->currency_name;
    }

    function user_name($id)
    {
        $value =  User::find($id);
        return $value->name;
    }

    function stock_notif()
    {
        $jumlah = RequisitionDetail::where('purchase_status',2)->count();
        return $jumlah;
    }

    function notification()
    {
        $isi = RequisitionDetail::where('purchase_status',2)->get();
        return $isi;
    }
?>
