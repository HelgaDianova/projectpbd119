@extends('layouts.app')
@section('title', 'Form Satuan')
@section('content')
<h3>{{ $row ? 'Edit' : 'Tambah' }} Satuan</h3>
<form method="POST"
      action="{{ $row ? route('satuan.update', $row->idsatuan) : route('satuan.store') }}"
      class="card card-body" style="max-width:480px">
    @csrf
    @if ($row) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">Nama Satuan</label>
        <input type="text" name="nama_satuan" class="form-control"
               value="{{ old('nama_satuan', $row->nama_satuan ?? '') }}" required>
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
        <a href="{{ route('satuan.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection
