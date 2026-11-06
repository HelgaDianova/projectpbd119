@extends('layouts.app')
@section('title', 'Stok')
@section('content')
<h3>Stok Barang <small class="text-muted fs-6">(dari view <code>v_stok_barang</code>)</small></h3>
<table class="table table-bordered bg-white mb-5">
    <thead class="table-light">
        <tr><th>ID</th><th>Nama Barang</th><th>Satuan</th><th class="text-end">Stok</th></tr>
    </thead>
    <tbody>
    @forelse ($rows as $r)
        <tr>
            <td>{{ $r->idbarang }}</td>
            <td>{{ $r->nama_barang }}</td>
            <td>{{ $r->satuan }}</td>
            <td class="text-end">{{ $r->stok }}</td>
        </tr>
    @empty
        <tr><td colspan="4" class="text-center">Belum ada data.</td></tr>
    @endforelse
    </tbody>
</table>

<h3>Harga Jual <small class="text-muted fs-6">(dari function <code>fn_harga_jual</code>)</small></h3>
<table class="table table-bordered bg-white">
    <thead class="table-light">
        <tr><th>ID</th><th>Nama Barang</th><th class="text-end">Harga Jual</th></tr>
    </thead>
    <tbody>
    @foreach ($harga as $h)
        <tr>
            <td>{{ $h->idbarang }}</td>
            <td>{{ $h->nama }}</td>
            <td class="text-end">Rp {{ number_format($h->harga_jual, 0, ',', '.') }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
