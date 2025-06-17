<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArCalendar extends Model
{
    use SoftDeletes,Notifiable;

    public $table='bm_acc_calendar';

    protected $dates=[
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    protected $fillable=[
        'id',
        'attributecategory',
        'confirmationstatus',
        'createdby',
        'startdate',
        'enddate',
        'setname',
        'num',
        'year',
        'created_at',
        'updated_at'
    ];

    public function trx_code()
    {
        return $this->hasOne(TrxStatuses::class,'trx_code','confirmationstatus');
    }

}
