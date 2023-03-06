<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $table='paket';
    protected $primaryKey='id';
    protected $fillable=[
    	'id_outlet','jenis','nama_paket', 'harga'
    ];

    public function outlet()
    {
        return $this->belongsTo('App\Models\Outlet', 'id_outlet', 'id');
    }
}
