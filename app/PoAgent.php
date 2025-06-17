<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PoAgent extends Model
{
	 use SoftDeletes, Notifiable;
    public $table = 'bm_po_agent_access';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
		'agent_id',
		'organization_id',
		'category_id',
		'segment1',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
public function user()
	{
		 return $this->hasone(User::class, 'id', 'agent_id');
	}
}