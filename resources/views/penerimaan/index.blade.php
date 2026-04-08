@extends('layouts.admin')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
    <div class="pc-container rounded h-100 p-4">
        <h2 class="mb-4">Penerimaan Eskul</h2>

        <form action="{{ route('penerimaan.index') }}" method="GET" class="d-flex mb-4">
            <input name="search" value="{{ request('search') }}"
                class="form-control bg-dark border-0 text-white" type="search" placeholder="Cari berdasarkan apa aja..." aria-label="Search">
            <button class="btn btn-success ms-2" type="submit">Cari</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Data Formulir</th>
                    <th scope="col">Nama Eskul</th>
                    <th scope="col">Tahun Ajaran</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>         
            </thead>
            <tbody>
                @forelse ($penerimaan as $data)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $data->daftar->user->name ?? '-' }}</td>
                    <td>{{ $data->daftar->eskul->nama_eskul ?? '-' }}</td>
                    <td>{{ $data->daftar->tahun_ajaran ?? '-' }}</td>

                    <td>
                        @if ($data->catatan == 'Diterima')
                            <span class="badge bg-success">Diterima</span>
                        @elseif ($data->catatan == 'Ditolak')
                            <span class="badge bg-danger">Ditolak</span>
                        @else
                            {{ $data->catatan }}
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('penerimaan.destroy', $data->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary">HAPUS</button>
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
