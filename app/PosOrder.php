<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PosOrder extends Model
{
    use SoftDeletes;

    public $table = 'bm_pos_orders';

    protected $dates = [
        'order_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'order_number',
        'session_id',
        'cashier_id',
        'customer_id',
        'customer_name',
        'org_id',
        'order_date',
        'subtotal',
        'tax_amount',
        'total',
        'amount_paid',
        'change_amount',
        'status',
        'so_number',
        'so_id',
        'invoice_number',
        'delivery_number',
        'delivery_id',
        'notes',
        'created_by',
        'last_updated_by',
    ];

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id', 'id');
    }

    // Fallback: user yang create order (untuk data sebelum kolom cashier_id ada)
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    // Helper: ambil nama kasir dari cashier_id atau fallback ke created_by
    public function getCashierNameAttribute(): string
    {
        return $this->cashier->name ?? $this->createdBy->name ?? '—';
    }

    public function session()
    {
        return $this->belongsTo(PosSession::class, 'session_id', 'id');
    }

    public function lines()
    {
        return $this->hasMany(PosOrderLine::class, 'pos_order_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(PosPayment::class, 'pos_order_id', 'id');
    }
}
