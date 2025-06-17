<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class AssetLineDepreciation extends Model
{
    use HasFactory;use SoftDeletes;

    public $table = 'bm_line_depreciation';
    protected $dates = [
        'write_date',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id',
        'name',
        'sequence',
        'asset_id',
        'amount',
        'remaining_value',
        'depreciated_value',
        'depreciation_date',
        'move_id',
        'move_check',
        'move_posted_check',
        'create_uid',
        'create_date',
        'write_uid',
        'write_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
