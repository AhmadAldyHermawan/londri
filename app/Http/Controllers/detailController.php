<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Paket;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
class detailController extends Controller
{
    // public function tampil(){


    //     $detail = DB::table('detail_transaksi')->first();
    //     Paginator::useBootstrap();
    //     return view('detail-transaksi', compact('detail'));

        
    // }

        public function laporan($id){
            
        $transaksi = DB::table('transaksi')->select('*')->where('id', $id)->first();
        $outlet = DB::table('outlet')->where('id', $transaksi->id_outlet)->get();
        $member = DB::table('member')->where('id', $transaksi->id_member)->get();
        $paket  = DB::table('paket')->where('id', $transaksi->id_paket)->get();

        $detail = DB::table('detail_transaksi')->where('id_transaksi', $id)->first();
        return view('laporan', compact('transaksi','outlet','member','paket','detail',));

        }

}
