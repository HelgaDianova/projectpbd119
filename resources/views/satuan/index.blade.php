@extends('layouts.app')
@section('title', 'Satuan')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Satuan</h3>
    <a href="{{ route('satuan.create') }}" class="btn btn-primary">+ Tambah Satuan</a>
</div>
<table class="table table-bordered bg-white">
    <thead class="table-light">
        <tr><th>ID</th><th>Nama Satuan</th><th>Status</th><th style="width:160px">Aksi</th></tr>
    </thead>
    <tbody>
    @forelse ($rows as $r)
        <tr>
            <td>{{ $r->idsatuan }}</td>
            <td>{{ $r->nama_satuan }}</td>
            <td>{{ $r->status ? 'Aktif' : 'Nonaktif' }}</td>
            <td>
                <a href="{{ route('satuan.edit', $r->idsatuan) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('satuan.destroy', $r->idsatuan) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus satuan ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="4" class="text-center">Belum ada data.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection
