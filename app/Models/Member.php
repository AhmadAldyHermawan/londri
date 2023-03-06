<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table='member';
    protected $primaryKey='id';
    protected $fillable=[
    	'nama_member','alamat','jenis_kelamin','telp'
    ];
}
