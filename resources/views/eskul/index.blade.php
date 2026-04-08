@extends('layouts.admin')

@section('content')
<div class="container-fluid pt-4 px-4">
    <h2>Data Eskul</h2>

    <form method="GET" class="d-flex mb-3">
        <input name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari eskul">
        <button class="btn btn-success ms-2">Cari</button>
    </form>

    <a href="{{ route('eskul.create') }}" class="btn btn-primary mb-3">Tambah +</a>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Eskul</th>
                <th>Pembina</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($eskul as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->nama_eskul }}</td>
                <td>{{ $data->pembina->name ?? '-' }}</td>
                <td>{{ $data->no_hp }}</td>
                <td>{{ $data->alamat }}</td>
                <td>
                    @if($data->foto)
                        <img src="{{ asset('storage/'.$data->foto) }}" width="60">
                    @endif
                </td>
                <td>
                    <form method="POST" action="{{ route('eskul.destroy', $data->id) }}">
                        @csrf @method('DELETE')
                        <a href="{{ route('eskul.edit', $data->id) }}" class="btn btn-success btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection