<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table='transaksi';
    protected $primaryKey='id';
    protected $fillable=[
    	'id_outlet','id_member','id_paket','id_petugas','qty','tgl', 'batas_waktu','tgl_bayar','status','dibayar'
    ];

    public function outlet()
    {
        return $this->belongsTo('App\Models\Outlet', 'id_outlet', 'id');
    }

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'id_member', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_petugas', 'id');
    }

    public function paket()
    {
        return $this->belongsTo('App\Models\Paket', 'id_paket', 'id');
    }
}
