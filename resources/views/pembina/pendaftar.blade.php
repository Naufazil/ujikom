@extends('layouts.pembina')

@section('content')
<h4 class="mb-3">Daftar Pendaftar Eskul Saya</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Siswa</th>
            <th>Eskul</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pendaftarans as $item)
            <tr>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->eskul->nama_eskul }}</td>

                <!-- ✅ FIX STATUS -->
               <td>
    @if($item->status == 'menunggu')
        <span class="badge bg-warning">MENUNGGU</span>
    @elseif($item->status == 'diterima')
        <span class="badge bg-success">DITERIMA</span>
    @elseif($item->status == 'ditolak')
        <span class="badge bg-danger">DITOLAK</span>
    @endif
</td>

                <!-- ✅ FIX tombol -->
               <td>
    @if ($item->status === 'menunggu')
        <form action="{{ route('pembina.pendaftar.accept', $item->id) }}"
              method="POST" class="d-inline">
            @csrf
            @method('PUT')
            <button class="btn btn-success btn-sm">Terima</button>
        </form>

        <form action="{{ route('pembina.pendaftar.reject', $item->id) }}"
              method="POST" class="d-inline">
            @csrf
            @method('PUT')
            <button class="btn btn-danger btn-sm">Tolak</button>
        </form>
    @else
        -
    @endif
</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada pendaftar</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection

