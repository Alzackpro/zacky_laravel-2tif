<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $data['dataProduk'] = Produk::with('kategori')
            ->when($request->filled('kategori'), function ($query) use ($request) {
                $query->whereHas('kategori', function ($q) use ($request) {
                    $q->where('slug', $request->kategori);
                });
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('nama', 'like', '%' . $request->search . '%')
                      ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
                });
            })
            ->where('stok', '>', 0)
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $data['dataKategori'] = Kategori::withCount('produk')->orderBy('nama')->get();

        return view('guest.katalog', $data);
    }
}
