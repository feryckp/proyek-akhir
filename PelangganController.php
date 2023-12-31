<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required|email',
            'tanggal_bergabung' => 'required|date',
            // Add validation rules for other fields as needed
        ]);
    
        Pelanggan::create($request->all());
    
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }
    

    public function show($id)
    {
        $pelanggan = Pelanggan::find($id);
        return view('pelanggan.show', compact('pelanggan'));
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        Pelanggan::find($id)->update($request->all());
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Pelanggan::find($id)->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}