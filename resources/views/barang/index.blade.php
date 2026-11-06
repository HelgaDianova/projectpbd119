@extends('layouts.app')
@section('title', 'Barang')
@section('content')
@php
    $jenis = ['M' => 'Makanan', 'N' => 'Minuman', 'L' => 'Lainnya'];
@endphp
<div class="d-flex justify-content-between mb-3">
    <h3>Data Barang</h3>
    <a href="{{ route('barang.create') }}" class="btn btn-primary">+ Tambah Barang</a>
</div>
<table class="table table-bordered bg-white">
    <thead class="table-light">
        <tr><th>ID</th><th>Nama</th><th>Jenis</th><th>Satuan</th><th class="text-end">Harga</th><th>Status</th><th style="width:160px">Aksi</th></tr>
    </thead>
    <tbody>
    @forelse ($rows as $r)
        <tr>
            <td>{{ $r->idbarang }}</td>
            <td>{{ $r->nama }}</td>
            <td>{{ $jenis[$r->jenis] ?? $r->jenis }}</td>
            <td>{{ $r->nama_satuan }}</td>
            <td class="text-end">Rp {{ number_format($r->harga, 0, ',', '.') }}</td>
            <td>{{ $r->status ? 'Aktif' : 'Nonaktif' }}</td>
            <td>
                <a href="{{ route('barang.edit', $r->idbarang) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('barang.destroy', $r->idbarang) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus barang ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="7" class="text-center">Belum ada data.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection
