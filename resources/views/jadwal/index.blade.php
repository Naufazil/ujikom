@extends('layouts.admin')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
    <div class="pc-container rounded h-100 p-4">
        <h2 class="mb-4">Jadwal Ekstrakulikuler</h2>

    <form action="{{ route('jadwal.index') }}" method="GET" class="d-flex mb-4">
    <input name="search" value="{{ request('search') }}"
            class="form-control bg-dark border-0 text-white"
            type="search"
            placeholder="Cari nama eskul atau hari...">
        <button class="btn btn-success ms-2" type="submit">Cari</button>
    </form>
    
        <a href="{{ route('jadwal.create') }}" class="btn btn-primary d-flex justify-content-center align-items-center"><b>Tambah +</b></a><br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Eskul</th>
                    <th scope="col">Hari</th>
                    <th scope="col">Jam Mulai</th>
                    <th scope="col">Jam Selesai</th>
                    <th scope="col">Aksi</th>
                </tr>         
            </thead>

            <tbody>
                @forelse ($jadwal as $data)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $data->eskul->nama_eskul }}</td>
                    <td>{{ $data->hari }}</td>
                    <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $data->jam_mulai)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $data->jam_selesai)->format('H:i') }}</td>
                    <td>
                    <form  method="POST" action="{{ route('jadwal.destroy', $data->id) }}">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('jadwal.edit', $data->id) }}" class="btn btn-success">EDIT</a>
                        <button type="submit" class="btn btn-primary">DELETE</button>
                    </form>
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
