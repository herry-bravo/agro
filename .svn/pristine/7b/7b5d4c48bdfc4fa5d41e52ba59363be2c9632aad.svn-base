<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Asset extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'bm_account_asset_asset';
    protected $dates = [
        'write_date',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id',
        'message_main_attachment_id',
        'name',
        'code',
        'value',
        'currency_id',
        'company_id',
        'note',
        'category_id',
        'date',
        'state',
        'active',
        'partner_id',
        'method',
        'method_number',
        'method_period',
        'method_end',
        'method_progress_factor',
        'method_time',
        'prorata',
        'salvage_value',
        'invoice_id',
        'create_uid',
        'create_date',
        'write_uid',
        'write_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function category()
    {
        return $this->hasOne(AssetCatagory::class, 'id', 'category_id');
    }
}
