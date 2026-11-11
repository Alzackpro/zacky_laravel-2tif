<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['dataProduk'] = Produk::with('kategori')
            ->when($request->filled('kategori_id'), function ($query) use ($request) {
                $query->where('kategori_id', $request->kategori_id);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $data['dataKategori'] = Kategori::orderBy('nama')->get();

        return view('admin.produk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['dataKategori'] = Kategori::orderBy('nama')->get();
        return view('admin.produk.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'nama'        => 'required|max:150',
            'harga'       => 'required|integer|min:0',
            'stok'        => 'required|integer|min:0',
        ]);

        $data['kategori_id'] = $request->kategori_id;
        $data['nama']        = $request->nama;
        $data['deskripsi']   = $request->deskripsi;
        $data['harga']       = $request->harga;
        $data['stok']        = $request->stok;

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataProduk']   = Produk::findOrFail($id);
        $data['dataKategori'] = Kategori::orderBy('nama')->get();
        return view('admin.produk.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,kategori_id',
            'nama'        => 'required|max:150',
            'harga'       => 'required|integer|min:0',
            'stok'        => 'required|integer|min:0',
        ]);

        $produk = Produk::findOrFail($id);

        $produk->kategori_id = $request->kategori_id;
        $produk->nama        = $request->nama;
        $produk->deskripsi   = $request->deskripsi;
        $produk->harga       = $request->harga;
        $produk->stok        = $request->stok;

        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Data berhasil dihapus');
    }
}
