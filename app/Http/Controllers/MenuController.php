<?php

namespace App\Http\Controllers;
use App\menu;
use App\menupesan;
use App\kategori;
use DB;
use Image;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // $menu = DB::table('menus')->paginate(5);
        // return view('manejer.menu',['menu' => $menu], ["title" => "Manejer"]);
        return view('manejer.menu',[
            'datakategori'=>kategori::all(),
            'datamenu'=>menu::with('kategori')->latest()->get()

        ]);
    }
    public function store(Request $request)
    {       

        
        $request->validate([
            'foto' => 'image|file',
            'nama_menu' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required',
            // dd($request)
        ]);

      
          $image = $request->file('foto');
          $nameImage = $request->file('foto')->getClientOriginalName();
      
          
      
          $oriPath = public_path() . '/fotohotel/' . $nameImage;
          $oriImage = image::make($image)->save($oriPath);
      
    
            menu::create([
            'foto'=> $nameImage,
            'nama_menu'=>$request['nama_menu'],
            'kategori_id'=>$request['kategori_id'],
            'harga'=>$request['harga'],
        ]);
            //   dd($request);

        $kat = Kategori::find($request->kategori_id);
        $jml = $kat->jumlah + 1;
        $kat->update(['jumlah' => $jml]);
        activity()->log('Menambahkan Menu');
        return redirect()->route('menu.index');
    }

    public function edit($id)
    {
        
        // $menu = menu::find($id);
        // return view('manejer.editmenu', ['menu' => $menu]);
        $menu = DB::table('menus')->where('id', $id)->get();
        
        return view('manejer/editmenu', compact('menu'));
    
    }
    public function update(Request $request, $id)
    {
        // dd($request);
        $menu = DB::table('menus')->where('id', $id)->update([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'foto' => $request->foto
        ]);
        activity()->log('Mengedit Menu');
        return redirect()->route('menu.index'); 

        }

    public function destroy($id)
    {
        // dd($id);
        $deleted = DB::table('menus')->where('id', $id)->delete();
        activity()->log('Menghapus Menu');
        return redirect()->route('menu.index');
    }
}
