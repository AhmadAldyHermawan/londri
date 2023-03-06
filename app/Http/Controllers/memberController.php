<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
Use Exception;

class memberController extends Controller
{
    //tampil data member
    public function tampil(){
        $data = DB::table('member')->paginate(5);
        Paginator::useBootstrap();
        return view('member',['member' => $data]);
    }

    //tampilan tambah data
    public function tambah(){
        return view('member-tambah') ;
    }

    //simpan data
    public function simpan(Request $request){
        $validator = $request->validate([
            'nama_member' => 'required|string|max:100',
            'alamat' => 'required|string',
            'jenis_kelamin'=>'required',
            'telp'=>'required|string|max:15',
            ],
            [
                'nama_member.required' => 'Nama member tidak boleh kosong!',
                'nama_member.max' => 'Nama melebihi batas!',
    
                'alamat.required' => 'Alamat member tidak boleh kosong!',

                'jenis_kelamin.required' => 'Jenis kelamin member tidak boleh kosong!',
    
                'telp.required' => 'Nomor telepon member tidak boleh kosong!',
                'telp.max' => 'Panjang nomor telepon melebihi batas!',
            ]
        );
        $member = Member::create([
        'nama_member'=>$request->get('nama_member'),
        'alamat'=>$request->get('alamat'),
        'jenis_kelamin'=>$request->get('jenis_kelamin'),
        'telp'=>$request->get('telp'),
        ]);
        return redirect()->route('tampil-member')->with('message-simpan','Data berhasil disimpan!');;
    }

     //tampil edit data
     public function edit($id){
        $member = DB::table('member')->where('id',$id)->first();
        return view('member-edit',['member' => $member]);
    }

    //update data
    public function update(Request $request, $id){
        $validator = $request->validate([
            'nama_member' => 'required|string|max:100',
            'alamat' => 'required|string',
            'jenis_kelamin'=>'required',
            'telp'=>'required|string|max:15',
            ],
            [
                'nama_member.required' => 'Nama member tidak boleh kosong!',
                'nama_member.max' => 'Nama melebihi batas!',
    
                'alamat.required' => 'Alamat member tidak boleh kosong!',

                'jenis_kelamin.required' => 'Jenis kelamin member tidak boleh kosong!',
    
                'telp.required' => 'Nomor telepon member tidak boleh kosong!',
                'telp.max' => 'Panjang nomor telepon melebihi batas!',
            ]
        );
        $member = Member::where('id',$id)->update([
                	'nama_member'=>$request->get('nama_member'),
                	'alamat'=>$request->get('alamat'),
                    'jenis_kelamin'=>$request->get('jenis_kelamin'),
                	'telp'=>$request->get('telp'),
                ]);
        return redirect()->route('tampil-member')->with('message-update','Data berhasil diupdate!');
    }

    //hapus data
    public function hapus($id){
        try
        {
            $member = Member::where('id',$id)->delete();
            return redirect()->back()->with('message-hapus','Data berhasil dihapus!');
        }
        catch(Exception $e)
        {
        return redirect()->back()->with('message-gagal','Data gagal dihapus, member masih digunakan dalam transaksi!');
        }

    }
        //search data
        public function cari(Request $request){
            // menangkap data pencarian
            $cari = $request->cari;
     
            // mengambil data dari nama sesuai pencarian data
        $member = DB::table('member')
        ->where('nama_member','like',"%".$cari."%")
        ->orwhere('alamat','like',"%".$cari."%")
        ->orwhere('telp','like',"%".$cari."%")
        ->paginate(5);
        Paginator::useBootstrap();
            // mengirim data ke view
        return view('member',['member' => $member]);
        }

}
