<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['dataKategori'] = DB::table('kategori')
            ->leftJoin('produk', 'produk.kategori_id', '=', 'kategori.kategori_id')
            ->select('kategori.*', DB::raw('COUNT(produk.produk_id) as jumlah_produk'))
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('kategori.nama', 'like', '%' . $request->search . '%')
                      ->orWhere('kategori.slug', 'like', '%' . $request->search . '%');
                });
            })
            ->groupBy('kategori.kategori_id', 'kategori.nama', 'kategori.slug', 'kategori.created_at', 'kategori.updated_at')
            ->orderBy('kategori.nama')
            ->paginate(10)
            ->withQueryString();

        return view('admin.kategori.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100|unique:kategori,nama',
        ]);

        DB::table('kategori')->insert([
            'nama'       => $request->nama,
            'slug'       => Str::slug($request->nama),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('kategori.index')->with('success', 'Penambahan Data Berhasil!');
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
        $data['dataKategori'] = DB::table('kategori')->where('kategori_id', $id)->first();

        if (! $data['dataKategori']) {
            abort(404);
        }

        return view('admin.kategori.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|max:100|unique:kategori,nama,' . $id . ',kategori_id',
        ]);

        DB::table('kategori')->where('kategori_id', $id)->update([
            'nama'       => $request->nama,
            'slug'       => Str::slug($request->nama),
            'updated_at' => now(),
        ]);

        return redirect()->route('kategori.index')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('kategori')->where('kategori_id', $id)->delete();

        return redirect()->route('kategori.index')->with('success', 'Data berhasil dihapus');
    }
}
