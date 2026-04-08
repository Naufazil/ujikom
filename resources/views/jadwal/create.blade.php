@extends('layouts.admin')

@section('content')
<div class="container-fluid pt-4 px-4">
<div class="row g-4">
<div class="col-sm-12 col-xl-12">
    <div class="bg-secondary rounded h-100 p-4">
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <h2 class="mb-4">Tambah Jadwal Eskul</h2>
        <form action="{{ route('jadwal.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Eskul</label>
                <select class="form-select mb-3" aria-label="Default select example" name="eskul_id">
                    @foreach($eskul as $data)
                    <option value="{{ $data->id }}">{{ $data->nama_eskul }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Hari</label>
                <input type="text" class="form-control" name="hari">
            </div>

            <div class="mb-3">
                <label class="form-label">Jam Mulai</label>
                <input type="time" class="form-control" name="jam_mulai">
            </div>

            <div class="mb-3">
                <label class="form-label">Jam Selesai</label>
                <input type="time" class="form-control" name="jam_selesai">
            </div>

            <button type="submit" class="btn btn-primary">Tambah</button>

        </form>
    </div>
</div>
@endsection
