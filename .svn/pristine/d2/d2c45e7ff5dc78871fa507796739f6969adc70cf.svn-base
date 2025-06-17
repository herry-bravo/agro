<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;

    public $table = 'bm_sub_category';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'sub_cat_code',
        'sub_cat_name',
        'attribute1',
        'attribute2',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function decategory()
    {
        return $this->hasMany(itemMaster::class);
    }
     public function rcvsubcategory()
    {
        return $this->hasMany(RcvDetail::class,'category_id','sub_cat_code');
    }

}
