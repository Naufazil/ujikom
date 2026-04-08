@extends('layouts.admin')

@section('content')
<div class="container-fluid pt-4 px-4">
    <h2>Edit Eskul</h2>

    <form action="{{ route('eskul.update', $eskul) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <input name="nama_eskul" value="{{ $eskul->nama_eskul }}" class="form-control mb-2">

        <select name="pembina_id" class="form-control mb-2">
            @foreach($pembinas as $pembina)
                <option value="{{ $pembina->id }}"
                    {{ $eskul->pembina_id == $pembina->id ? 'selected' : '' }}>
                    {{ $pembina->name }}
                </option>
            @endforeach
        </select>

        <input name="no_hp" value="{{ $eskul->no_hp }}" class="form-control mb-2">
        <input name="alamat" value="{{ $eskul->alamat }}" class="form-control mb-2">

        <textarea name="deskripsi" class="form-control mb-2">{{ $eskul->deskripsi }}</textarea>

        @if($eskul->foto)
            <img src="{{ asset('storage/'.$eskul->foto) }}" width="120" class="mb-2">
        @endif

        <input type="file" name="foto" class="form-control mb-3">

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection