<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;

class Gramatur extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'bm_gsm_std_id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        'id',
        'inventory_item_id',
        'item_description',
        'value',
        'gsm',
        'operation',
        'org_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function item()
    {
        return $this->hasone(ItemMaster::class, 'inventory_item_id', 'inventory_item_id');
    }
}
