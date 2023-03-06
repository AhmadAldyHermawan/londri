<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Transaksi extends Model
{
    use HasFactory;
    protected $table='detail_transaksi';
    protected $primaryKey='id';
    protected $fillable=[
    	'id_transaksi','subtotal','keterangan'
    ];
    public function transaksi()
    {
        return $this->belongsTo('App\Models\Transaksi', 'id_transaksi', 'id');
    }
}
