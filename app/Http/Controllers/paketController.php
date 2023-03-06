<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paket;
use App\Models\Outlet;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
Use Exception;
use Illuminate\Support\Facades\Validator;

class paketController extends Controller
{
    //tampil data
    public function tampil(){
        
        //  $outlet = Outlet::all();
        // $paket = Paket::all();
        $data = DB::table('outlet')->join('paket','paket.id_outlet', '=', 'outlet.id')->paginate(5);
        Paginator::useBootstrap();
        return view('paket',['paket' => $data]);

        
        
    }
    //tampilan tambah data
    public function tambah(){
        $outlet = Outlet::all();
        return view('paket-tambah', compact('outlet'));
        return view('paket-tambah');
        

    }

    //simpan data
    public function simpan(Request $request){
        $validator = $request->validate([
            'id_outlet' => 'required',
            'jenis' => 'required|string',
            'nama_paket'=>'required|string',
            'harga'=>'required|string',
            ],
            [
                'id_outlet.required' => 'Outlet tidak boleh kosong!',
    
                'jenis.required' => 'Jenis paket tidak boleh kosong!',

                'nama_paket.required' => 'Nama paket tidak boleh kosong!',
    
                'harga.required' => 'Harga paket tidak boleh kosong!',
                
            ]
        );
        $paket = Paket::create([
        'id_outlet'=>$request->get('id_outlet'),
        'jenis'=>$request->get('jenis'),
        'nama_paket'=>$request->get('nama_paket'),
        'harga'=>$request->get('harga'),
        ]);
        
        return redirect()->route('tampil-paket')->with('message-simpan','Data berhasil disimpan!');
    }

    //tampil edit data
    public function edit($id){
        
        $paket = DB::table('paket')->select('*')->where('id', $id)->first();
        $outlet = DB::table('outlet')->select('id','nama')->get();
        return view('paket-edit', compact('outlet','paket'));

    }
    //update data
    public function update(Request $request, $id){
        $validator = $request->validate([
            'id_outlet' => 'required',
            'jenis' => 'required',
            'nama_paket'=>'required|max:50',
            'harga'=>'required|string|max:11',
            ],
            [
                'id_outlet.required' => 'Harap pilih outlet!',
                
                'jenis.required' => 'Jenis paket tidak boleh kosong!',

                'nama_paket.required' => 'Nama paket tidak boleh kosong!',
                'nama_paket.max' => 'Nama paket terlalu panjang!',
    
                'harga.required' => 'Harga tidak boleh kosong!',
                'harga.max' => 'Harga melebihi batas!',
            ]
        );
        $paket = Paket::where('id',$id)->update([
                	'id_outlet'=>$request->get('id_outlet'),
                	'jenis'=>$request->get('jenis'),
                    'nama_paket'=>$request->get('nama_paket'),
                	'harga'=>$request->get('harga'),
                ]);
        return redirect()->route('tampil-paket')->with('message-update','Data berhasil diupdate!');
    }

    //hapus data
    public function hapus($id){
        
        try{
            $paket = Paket::where('id',$id)->delete();
            return redirect()->back()->with('message-hapus','Data berhasil dihapus!');
        }
        catch(Exception $e){
            return redirect()->back()->with('message-gagal','Data gagal dihapus, paket masih digunakan dalam transaksi!');
        }
    }
        //search data
        public function cari(Request $request){
            // menangkap data pencarian
            $cari = $request->cari;
     
            // mengambil data dari nama sesuai pencarian data
        $paket = Outlet::join('paket','paket.id_outlet', '=', 'outlet.id')
        ->where('nama_paket','like',"%".$cari."%")
        ->orwhere('nama','like',"%".$cari."%")
        ->orwhere('jenis','like',"%".$cari."%")
        ->orwhere('harga','like',"%".$cari."%")
        ->paginate(5);
        Paginator::useBootstrap();
    
            // mengirim data ke view
        return view('paket',['paket' => $paket]);
        }
}
