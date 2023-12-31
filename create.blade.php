<!-- resources/views/transaksi/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Tambah Transaksi Baru</h1>

        <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="produk_id">Produk:</label>
                <select name="produk_id" class="form-control" required>
                    @foreach ($produk as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_produk }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="pelanggan_id">Pelanggan:</label>
                <select name="pelanggan_id" class="form-control" required>
                    @foreach ($pelanggan as $pl)
                        <option value="{{ $pl->id }}">{{ $pl->nama_pelanggan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="jumlah_produk">Jumlah Produk:</label>
                <input type="text" name="jumlah_produk" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="total_harga">Total Harga:</label>
                <input type="text" name="total_harga" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal_transaksi">Tanggal Transaksi:</label>
                <input type="date" name="tanggal_transaksi" class="form-control" required>
            </div>         
            <div class="mb-3">
                <label for="Bukti Transaksi" class="form-label">Bukti Transaksi</label>
                <input type="file" class="form-control" id="bukti_transaksi" name="bukti_transaksi" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
