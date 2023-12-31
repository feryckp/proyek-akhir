<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required',
            // Add other necessary validation rules
        ]);

        try {
            // Create the product
            Produk::create($request->all());

            // Redirect with success message
            return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Redirect with error message if an exception occurs
            return redirect()->route('produk.index')->with('error', 'Gagal menambahkan produk. Silakan coba lagi.');
        }
    }

    public function show($id)
    {
        $produk = Produk::find($id);
        return view('produk.show', compact('produk'));
    }

    public function edit($id)
    {
        $produk = Produk::find($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        Produk::find($id)->update($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Produk::find($id)->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
