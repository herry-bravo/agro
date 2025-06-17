<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Deliveries extends Model
{
    use SoftDeletes;

    public $table = '';
    protected $dates = [
        'tgl_dibuat',
        'tgl_digunakan',
        
    ];

    protected $fillable = [
        'nama_manager',
        'no_permintaan',
        'proyek',
        'mata_uang',
        'masuk_gudang',
        'keperluan',
        'department',
        'catatan',
        'deskripsi_barang',
        'jumlah',
        'satuan',
        'job',
    ];

}