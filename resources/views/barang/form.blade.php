@extends('layouts.app')
@section('title', 'Form Barang')
@section('content')
<h3>{{ $row ? 'Edit' : 'Tambah' }} Barang</h3>
<form method="POST"
      action="{{ $row ? route('barang.update', $row->idbarang) : route('barang.store') }}"
      class="card card-body" style="max-width:480px">
    @csrf
    @if ($row) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">Nama Barang</label>
        <input type="text" name="nama" class="form-control"
               value="{{ old('nama', $row->nama ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Jenis</label>
        <select name="jenis" class="form-select">
            @foreach (['M' => 'Makanan', 'N' => 'Minuman', 'L' => 'Lainnya'] as $k => $v)
                <option value="{{ $k }}" @selected(old('jenis', $row->jenis ?? 'M') === $k)>{{ $v }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Satuan</label>
        <select name="idsatuan" class="form-select" required>
            @foreach ($satuan as $s)
                <option value="{{ $s->idsatuan }}" @selected(old('idsatuan', $row->idsatuan ?? null) == $s->idsatuan)>
                    {{ $s->nama_satuan }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Harga Beli (Rp)</label>
        <input type="number" name="harga" min="0" class="form-control"
               value="{{ old('harga', $row->harga ?? 0) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="1" @selected(old('status', $row->status ?? 1) == 1)>Aktif</option>
            <option value="0" @selected(old('status', $row->status ?? 1) == 0)>Nonaktif</option>
        </select>
    </div>
    <div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection
