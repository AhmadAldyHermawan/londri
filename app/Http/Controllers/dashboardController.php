<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Outlet;
use App\Models\Paket;
use App\Models\Member;
use App\Models\Transaksi;
use App\Models\Detail_Transaksi;
use DB;
use Illuminate\Pagination\Paginator;

class dashboardController extends Controller
{
    public function dashboard(){
        $outlet = Outlet::all();
        $paket = Paket::all();
        $member = Member::all();
        $transaksi_count = Transaksi::where('status', '=', 'proses')->get();
        $transaksi_selesai = Transaksi::where('status', '=', 'selesai')->get();
        $total = Detail_Transaksi::sum('subtotal');
        $transaksi = Transaksi::latest()->take(5)->get();
         return view('index', compact('outlet','paket','member','transaksi','transaksi_count','transaksi_selesai','total'));

        // $transaksi2 = DB::table('transaksi')->select('transaksi.id as id_transaksi','transaksi.*','outlet.*','member.*',"paket.*")
        // ->join('outlet','outlet.id', '=', 'transaksi.id_outlet')
        // ->join('member','member.id', '=', 'transaksi.id_member')
        // ->join('paket','paket.id', '=', 'transaksi.id_paket')->latest(6);
        // $detail = DB::table('detail_transaksi')->latest(6);
       
        // return view('index', compact('transaksi','detail'));

    }
}
