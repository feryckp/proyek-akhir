<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Pelanggan;




class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $produk = Produk::all();
        $pelanggan = Pelanggan::all();
        return view('transaksi.create', compact('produk', 'pelanggan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'jumlah_produk' => 'required|integer|min:1',
            'total_harga' => 'required|numeric|min:0',
            'tanggal_transaksi' => 'required|date',
            'bukti_transaksi' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);
    
        $input = $request->all();
    
        if ($request->hasFile('bukti_transaksi')) {
            $buktiTransaksiPath = $request->file('bukti_transaksi')->store('public/bukti_transaksi');
            $input['bukti_transaksi'] = basename($buktiTransaksiPath);
        }
    
        Transaksi::create($input);
    
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $transaksi = Transaksi::find($id);
        return view('transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::find($id);
        $produk = Produk::all();
        $pelanggan = Pelanggan::all();
        return view('transaksi.edit', compact('transaksi', 'produk', 'pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::find($id);
    
        $request->validate([
            'bukti_transaksi' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // tambahkan validasi lainnya
        ]);
    
        // Hapus bukti transaksi lama jika ada
        if ($transaksi->bukti_transaksi) {
            Storage::delete('public/' . $transaksi->bukti_transaksi);
        }
    
        // Update data transaksi
        $transaksi->update($request->except('bukti_transaksi'));
    
        // Upload bukti transaksi baru jika ada
        if ($request->hasFile('bukti_transaksi')) {
            $file = $request->file('bukti_transaksi');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('bukti_transaksi', $fileName, 'public');
            $transaksi->bukti_transaksi = $path;
            $transaksi->save();
        }
    
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Transaksi::find($id)->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}