<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class CustomerDetail
 */
class CustomerDetail extends Model
{
    use SoftDeletes, LogsActivity;

    protected $table = 'customer_details';

    public $timestamps = true;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_address',
        'customer_contact1',
        'customer_contact2',
        'balance',
        'due'
    ];

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function  getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                        ->logAll();
    }   
}