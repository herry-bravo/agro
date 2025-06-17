<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use SoftDeletes;

    public $table = 'bm_vendor_header';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'vendor_id',
        'vendor_name',
        'address1',
        'address2',
        'city',
        'pic',
        'province',
        'vendor_location',
        'country',
        'currency',
        'phone',
        'email',
        'tax_code',
        'bank_number',
        'tax_number',
        'status',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'client_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(ClientStatus::class, 'status_id');
    }

    public function tax()
    {
        return $this->hasOne(Tax::class, 'tax_code','tax_code');
    }
}
