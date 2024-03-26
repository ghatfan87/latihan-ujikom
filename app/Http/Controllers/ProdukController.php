<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function landing()
    {
        return view('landing-page.dashboard');
    }
    public function index()
    {
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png',
        ]);

        $imageData = file_get_contents($request->file('foto')->path());
        $base64Image = base64_encode($imageData);

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'foto' => $base64Image,
        ]);
        return redirect()->route('product.data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        $data = Produk::all();
        return view('product.data', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Produk::where('id', '=', $id)->firstOrFail();
        return view('product.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required',
            'foto' => 'image|mimes:jpeg,jpg,png',
        ]);

        $produk = Produk::findOrFail($id);

        $produk->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
        ]);

        if ($request->hasFile('foto')) {
            $imageData = file_get_contents($request->file('foto')->path());
            $base64Image = base64_encode($imageData);
            $produk->foto = $base64Image;
        }
        $produk->save();

        return redirect()->route('product.data');


        // public function updateStok(Request $request,$id)
        // {
        //     $request->validate([
        //         'nama_produk' => 'required',
        //         'stok' => 'required',
        //     ]);

        //     Produk::where('id','=', $id)->update([
        //         'nama_produk' => $request->nama_produk,
        //         'stok' => $request->stok,
        //     ]);
        //     return redirect()->route('product.data');
        // }

        /**
         * Remove the specified resource from storage.
         */
    }

    public function destroy($id)
    {
        Produk::where('id', '=', $id)->delete();
        return redirect()->route('delete');
    }
}
