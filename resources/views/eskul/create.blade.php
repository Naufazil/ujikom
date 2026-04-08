@extends('layouts.admin')

@section('content')
<div class="container-fluid pt-4 px-4">
    <h2>Tambah Eskul</h2>

    <form action="{{ route('eskul.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input name="nama_eskul" class="form-control mb-2" placeholder="Nama Eskul">

        <select name="pembina_id" class="form-control mb-2">
            <option value="">-- Pilih Pembina --</option>
            @foreach($pembinas as $pembina)
                <option value="{{ $pembina->id }}">{{ $pembina->name }}</option>
            @endforeach
        </select>

        <input name="no_hp" class="form-control mb-2" placeholder="No HP">
        <input name="alamat" class="form-control mb-2" placeholder="Alamat">

        <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi"></textarea>

        <input type="file" name="foto" class="form-control mb-3">

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection