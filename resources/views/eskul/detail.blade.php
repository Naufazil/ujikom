@extends('layouts.user')

@section('content')

<div class="container-detail">

    <div class="card-detail">

        <!-- Gambar -->
        <div class="img-wrapper">
            <img src="{{ asset('storage/'.$eskul->foto) }}" alt="">
        </div>

        <!-- Isi -->
        <div class="content-detail">
            <h2>{{ $eskul->nama_eskul }}</h2>

            <p class="desc">
                {{ $eskul->deskripsi }}
            </p>

            <div class="info">
                <p><b>Pembina:</b> {{ $eskul->pembina->name ?? '-' }}</p>
                <p><b>No HP:</b> {{ $eskul->no_hp ?? '-' }}</p>
                <p><b>Alamat:</b> {{ $eskul->alamat ?? '-' }}</p>
            </div>

          @if($eskul->jadwals->count())
    <div class="jadwal">
        <h4>Jadwal:</h4>

        <div class="jadwal-list">
            @foreach($eskul->jadwals as $j)
                <div class="jadwal-card">
                    <div class="hari">{{ ucfirst($j->hari) }}</div>
                    <div class="jam">
                        {{ $j->jam_mulai }} - {{ $j->jam_selesai }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

             <a href="{{ url()->previous() }}" class="btn-kembali">← Kembali</a>

        </div>

    </div>
</div>

<style>
.container-detail {
    max-width: 900px;
    margin: 30px auto;
    padding: 15px;
}

.btn-kembali {
    display: inline-block;
    margin-bottom: 15px;
    background: #6c757d;
    color: white;
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
}

.card-detail {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.img-wrapper {
    width: 100%;
    text-align: center;
    background: #f5f5f5;
    padding: 10px;
}

.img-wrapper img {
    max-width: 100%;
    height: auto;
    object-fit: contain;
}

.content-detail {
    padding: 20px;
}

.desc {
    color: #555;
    margin-bottom: 15px;
}

.info p {
    margin: 5px 0;
}

.jadwal {
    margin-top: 15px;
}

.jadwal ul {
    padding-left: 20px;
}

/* 🔥 RESPONSIVE HP */
@media (max-width: 600px) {
    .img-wrapper {
        height: 180px;
    }

    .content-detail {
        padding: 15px;
    }
}

.jadwal-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 10px;
}

.jadwal-card {
    background: linear-gradient(135deg, #6a5af9, #8f7afe);
    color: white;
    padding: 12px 16px;
    border-radius: 10px;
    min-width: 140px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.jadwal-card:hover {
    transform: translateY(-3px);
}

.jadwal-card .hari {
    font-weight: bold;
    font-size: 14px;
}

.jadwal-card .jam {
    font-size: 13px;
    margin-top: 5px;
}
</style>



@endsection