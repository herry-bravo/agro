<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PosSession extends Model
{
    use SoftDeletes;

    public $table = 'bm_pos_sessions';

    protected $dates = [
        'opened_at',
        'closed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'session_number',
        'org_id',
        'subinventory_code',
        'cashier_id',
        'opening_cash',
        'closing_cash',
        'status',
        'opened_at',
        'closed_at',
        'notes',
        'created_by',
        'last_updated_by',
    ];

    public function cashier()
    {
        return $this->hasOne(User::class, 'id', 'cashier_id');
    }

    public function orders()
    {
        return $this->hasMany(PosOrder::class, 'session_id', 'id');
    }
}
