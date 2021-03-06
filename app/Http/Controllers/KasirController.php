<?php

namespace App\Http\Controllers;

use App\pesanan;
// use App\Http\Requests\StorePesananRequest;
// use App\Http\Requests\UpdatePesananRequest;
use App\kategori;
use App\meja;
use App\menu;
use App\menupesan;
use DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

// use JavaScript;
use Mockery\Undefined;

class KasirController extends Controller
{
    public function index()
    {
        return view('pelanggan.index',[
            'dtmeja' => meja::where('status','=','Tersedia')->get(),
            'dtmenu' => menu::all(),
            'dtkat'=>kategori::all()
        ]);
    }
   
    public function simpan(Request $datapesan){
 
        $datapesan->validate([
            'nama_pemesan' =>'required',
            'meja_id' =>'required',
            'menu_id' =>'required',
            'jumlah' =>'required',
        ]);


        $menu = DB::table('menus')->where('id', $datapesan->menu_id)->get();
        $meja = DB::table('mejas')->where('meja_id', $datapesan->meja_id)->get();

        return view ('pelanggan.bayar', compact('datapesan','menu','meja')); 
    }

    public function store(Request $request)
    {
        //  dd($request);
        $pegawai= auth()->user()->name;
        // pesanan::create($request->all());
        Pesanan::create([
            'nama_pemesan'=>$request['nama_pemesan'],
            'harga'=>$request['harga'],
            'nama_menu'=>$request['nama_menu'],
            'jumlah'=>$request['jumlah'],
            'meja'=>$request['meja'],
            'total_beli'=>$request['total_beli'],
            'total_bayar'=>$request['total_bayar'],
            'kembalian'=>$request['kembalian'],
            'nama_pegawai'=>$pegawai,
        ]);
        meja::find($request->meja_id)->update(['status' => 'Tidak Tersedia']);
        activity()->log('Melakukan Transaksi');
        return redirect()->route('dpesan.index');
    }

    
    public function cetakpesan($id){
        return view('pelanggan.cetakpesanan',[
            'dtpemesan' => pesanan::find($id)
        ]);
        
    }

    public function show(Request $pesanan)
    {
        $pesanan = pesanan::all();
        return view('kasir/catatan_transaksi', ['pesanan' => $pesanan]);
    }

    public function destroy(Pesanan $pesanan)
    {
        //
    }
}
