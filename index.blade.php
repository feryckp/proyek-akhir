<!-- resources/views/transaksi/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Daftar Transaksi</h1>

        <a href="{{ route('transaksi.create') }}" class="btn btn-success mb-3">Tambah Transaksi Baru</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produk</th>
                    <th>Pelanggan</th>
                    <th>Jumlah Produk</th>
                    <th>Total Harga</th>
                    <th>Tanggal Transaksi</th>
                    <th>Bukti Transaksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $t)
                    <tr>
                        <td>{{ $t->id }}</td>
                        <td>{{ $t->produk->nama_produk }}</td>
                        <td>{{ $t->pelanggan->nama_pelanggan }}</td>
                        <td>{{ $t->jumlah_produk }}</td>
                        <td>{{ $t->total_harga }}</td>
                        <td>{{ $t->tanggal_transaksi }}</td>

                        <td>
                            @if($t->bukti_transaksi)
                                <img src="{{ asset('storage/bukti_transaksi/' . $t->bukti_transaksi) }}" alt="{{ $t->bukti_tansaksi}}" style="width: 50px; height: 50px;">
                            @else
                                No Photo
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('transaksi.show', $t->id) }}" class="btn btn-info">Lihat</a>
                            <a href="{{ route('transaksi.edit', $t->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
