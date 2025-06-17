<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PurchaseRequisition extends Model
{
	 use SoftDeletes, Notifiable,LogsActivity;
    public $table = 'bm_req_header_all';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
		'transaction_date',
    ];

    protected $fillable = [
        'id',
        'req_header_id',
        'transaction_date',
        'created_by',
        'requested_by',
        'updated_by',
        'segment1',
        'attribute1',
        'reference',
        'description',
        'authorized_status',
        'app_lvl',
        'org_id',
        'img_path',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

  public function user()
    {
		return $this->hasone(User::class, 'id', 'requested_by');
    }
  public function trxStatuses()
    {
		return $this->hasone(TrxStatuses::class, 'trx_code', 'authorized_status');
    }

  public function RequisitionDetail()
    {
        return $this->hasOne(RequisitionDetail::class,'header_id','id');
    }
    public function ccbook()
    {
		return $this->hasone(CcBook::class, 'cost_center', 'attribute1');
    }
    public function createdby()
    {
        return $this->hasone(User::class, 'id','created_by' );
    }
    public function appmgr()
    {
        return $this->hasone(User::class, 'id','intattribute1' );
    }
    public function appwh()
    {
        return $this->hasone(User::class, 'user_status','intattribute2' );
    }

    public function applvl()
    {
        return $this->hasone(User::class, 'user_status','app_lvl' );
    }
    public function getAppMgr()
    {
        return $this->hasone(User::class,'id','created_by');
    }
    public function  getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                        ->logAll();
    }
}
