@extends('layouts.app')
@section('title', 'Form Vendor')
@section('content')
<h3>{{ $row ? 'Edit' : 'Tambah' }} Vendor</h3>
<form method="POST"
      action="{{ $row ? route('vendor.update', $row->idvendor) : route('vendor.store') }}"
      class="card card-body" style="max-width:480px">
    @csrf
    @if ($row) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">Nama Vendor</label>
        <input type="text" name="nama_vendor" class="form-control"
               value="{{ old('nama_vendor', $row->nama_vendor ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Badan Hukum</label>
        <select name="badan_hukum" class="form-select">
            @foreach (['P' => 'PT', 'C' => 'CV', 'U' => 'UD', 'N' => 'Perorangan'] as $k => $v)
                <option value="{{ $k }}" @selected(old('badan_hukum', $row->badan_hukum ?? 'P') === $k)>{{ $v }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="A" @selected(old('status', $row->status ?? 'A') === 'A')>Aktif</option>
            <option value="N" @selected(old('status', $row->status ?? 'A') === 'N')>Nonaktif</option>
        </select>
    </div>
    <div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('vendor.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection
