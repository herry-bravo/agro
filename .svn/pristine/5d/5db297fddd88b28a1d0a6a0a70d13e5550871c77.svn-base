<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialTransaction extends Model
{
    use SoftDeletes;
    public $table = 'bm_mtl_material_trn_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
		'trx_code',
		'trx_types',
		'trx_actions',
        'trx_source_types',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
