<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Uom extends Model
{
    use SoftDeletes;

    public $table = 'bm_unit_of_measurement';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'uom_code',
        'uom_name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
