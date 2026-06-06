<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosPayment extends Model
{
    public $table = 'bm_pos_payments';

    protected $fillable = [
        'pos_order_id',
        'payment_method',
        'amount',
        'reference_number',
        'notes',
        'created_by',
    ];

    public function order()
    {
        return $this->belongsTo(PosOrder::class, 'pos_order_id', 'id');
    }
}
