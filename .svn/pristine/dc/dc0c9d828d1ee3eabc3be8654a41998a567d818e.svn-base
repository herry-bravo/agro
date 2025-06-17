<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkOrderDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'bm_wie_wo_operation_materials';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'wo_operation_material_id',
        'object_version_float',
        'organization_id',
        'wo_operation_id',
        'work_order_id',
        'material_seq_float',
        'material_type',
        'inventory_item_id',
        'item_revision',
        'quantity_per_product',
        'basis_type',
        'quantity',
        'inverse_quantity',
        'uom_code',
        'required_date',
        'yield_factor',
        'include_in_planning_flag',
        'supply_type',
        'supply_subinventory',
        'supply_locator_id',
        'issued_quantity',
        'produced_quantity',
        'picked_quantity',
        'allocated_quantity',
        'remaining_allocated_quantity',
        'tia_ref_line_id',
        'tia_ref_entity',
        'wd_operation_material_id',
        'created_by',
        'creation_date',
        'last_updated_by',
        'last_update_date',
        'last_update_login',
        'attribute_category',
        'attribute_char1',
        'attribute_char2',
        'attribute_float1',
        'attribute_float2',
        'attribute_float3',
        'attribute_float4',
        'attribute_date1',
        'attribute_date2',
        'attribute_datetime1',
        'attribute_datetime2',
        'request_id',
        'job_definition_name',
        'job_definition_package',
        'created_at',
        'updated_at'
    ];

    public function bomChild()
    {
        return $this->hasOne(Bom::class,'child_inventory_id','inventory_item_id');
    }

    public function wo_detail()
    {
        return $this->hasMany(WorkOrderDetail::class,'id');
    }

    public function item_list()
    {
        return $this->hasone(ItemMaster::class, 'inventory_item_id', 'inventory_item_id')->select('inventory_item_id','description','item_code');
    }

    public function roll()
    {
        return $this->hasone(InvOnhandFG::class, 'id', 'attribute_char1');
    }

}
