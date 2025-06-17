<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class AssetCatagory extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'bm_account_asset_category';
    protected $dates = [
        'write_date',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id',
        'active',
        'name',
        'account_analytic_id',
        'account_asset_id',
        'account_depreciation_id',
        'account_depreciation_expense_id',
        'journal_id',
        'company_id',
        'method',
        'method_number',
        'method_period',
        'method_progress_factor',
        'method_time',
        'method_end',
        'prorata',
        'open_asset',
        'group_entries',
        'type',
        'create_uid',
        'create_date',
        'write_uid',
        'write_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
