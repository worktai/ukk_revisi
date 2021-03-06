<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\kategori;
use DB;
class KategoriController extends Controller
{
    public function index()
    {
        return view('manejer.kategori',[
            'datakategori' => kategori::all()
        ]);
    }

    public function store(Request $request)
    {
        kategori::create($request->all());
        activity()->log('Menambah Kategori Menu');
        return redirect()->route('kategori.index');
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $deleted = DB::table('kategoris')->where('id', $id)->delete();
        activity()->log('Menghapus Kategori');
        return redirect()->route('kategori.index');
    }
}
