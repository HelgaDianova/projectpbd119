@extends('layouts.app')
@section('title', 'Vendor')
@section('content')
@php
    $bh = ['P' => 'PT', 'C' => 'CV', 'U' => 'UD', 'N' => 'Perorangan'];
@endphp
<div class="d-flex justify-content-between mb-3">
    <h3>Data Vendor</h3>
    <a href="{{ route('vendor.create') }}" class="btn btn-primary">+ Tambah Vendor</a>
</div>
<table class="table table-bordered bg-white">
    <thead class="table-light">
        <tr><th>ID</th><th>Nama Vendor</th><th>Badan Hukum</th><th>Status</th><th style="width:160px">Aksi</th></tr>
    </thead>
    <tbody>
    @forelse ($rows as $r)
        <tr>
            <td>{{ $r->idvendor }}</td>
            <td>{{ $r->nama_vendor }}</td>
            <td>{{ $bh[$r->badan_hukum] ?? $r->badan_hukum }}</td>
            <td>{{ $r->status === 'A' ? 'Aktif' : 'Nonaktif' }}</td>
            <td>
                <a href="{{ route('vendor.edit', $r->idvendor) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('vendor.destroy', $r->idvendor) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus vendor ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection
