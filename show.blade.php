<!-- resources/views/transaksi/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Detail Transaksi</h1>

        <div class="card">
            <div class="card-body">
                <p class="card-text">ID: {{ $transaksi->id }}</p>
                <p class="card-text">Produk: {{ $transaksi->produk->nama_produk }}</p>
                <p class="card-text">Pelanggan: {{ $transaksi->pelanggan->nama_pelanggan }}</p>
                <p class="card-text">Jumlah Produk: {{ $transaksi->jumlah_produk }}</p>
                <p class="card-text">Total Harga: {{ $transaksi->total_harga }}</p>
                <p class="card-text">Tanggal Transaksi: {{ $transaksi->tanggal_transaksi }}</p>
                
                {{-- Tambahkan ini untuk menampilkan gambar --}}
                <p class="card-text">Bukti Transaksi:</p>
                <img src="{{ asset('storage/bukti_transaksi/' . $transaksi->bukti_transaksi) }}" alt="Bukti Transaksi" class="img-thumbnail">
            </div>
        </div>

        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary mt-2">Kembali</a>
    </div>
@endsection
