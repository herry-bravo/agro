<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemStatuses extends Model
{
    use SoftDeletes;

    public $table = 'bm_mtl_system_statuses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'created_at',
        'stts_code',
        'stts_name',
        'updated_at',
        'deleted_at',
    ];
}
