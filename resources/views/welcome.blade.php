@extends('layouts.user')
@section('content')

<!-- Font Awesome (harus dalam <head>, tapi aman juga taruh di sini kalau belum ada) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Banner -->
<img src="{{ asset('user/images/download (10).png') }}" width="100%" alt="">

<!-- Notifikasi -->
    @php
        $daftar = \App\Models\DaftarEskul::where('user_id', Auth::id())->latest()->first();
    @endphp

    @if($daftar && $daftar->status == 'Diterima')
        <style>
            .alert-diterima {
                background-color: #e8f5e9;
                border-left: 5px solid #2e7d32;
                padding: 20px;
                border-radius: 8px;
                color: #1b5e20;
                font-family: 'Nunito', sans-serif;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
                opacity: 0;
                transform: translateY(30px);
                animation: fadeSlideIn 0.8s ease-out forwards;
            }

            @keyframes fadeSlideIn {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .icon-pulse {
                display: inline-block;
                animation: pulseIcon 1.2s ease-in-out infinite;
                color: #43a047;
                margin-top: 5px;
            }

            @keyframes pulseIcon {
                0%, 100% {
                    transform: scale(1);
                    opacity: 1;
                }
                50% {
                    transform: scale(1.2);
                    opacity: 0.7;
                }
            }
        </style>

        <div style="margin: 30px auto; max-width: 600px;">
            <div class="alert-diterima">
                <strong>🎉 Selamat!</strong> {{ Auth::user()->name }}
                <i class="fas fa-check-circle fa-lg mb-2 icon-pulse"></i><br>
                Kamu telah <strong>diterima</strong> di ekstrakurikuler <strong>{{ $daftar->eskul->nama_eskul }}</strong>.
            </div>
        </div>

    @elseif($daftar && $daftar->status == 'Ditolak')
        <style>
            .alert-ditolak {
                background-color: #fff8e1;
                border-left: 5px solid blue;
                padding: 20px;
                border-radius: 8px;
                color: #795548;
                font-family: 'Nunito', sans-serif;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
                opacity: 0;
                transform: translateY(30px);
                animation: fadeSlideIn 0.8s ease-out forwards;
            }

            @keyframes fadeSlideIn {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .icon-shake {
                display: inline-block;
                animation: shakeIcon 1s infinite;
                color: blue;
                margin-top: 5px;
            }

            @keyframes shakeIcon {
                0% { transform: rotate(0deg); }
                25% { transform: rotate(10deg); }
                50% { transform: rotate(-10deg); }
                75% { transform: rotate(10deg); }
                100% { transform: rotate(0deg); }
            }

            .btn-coba-lagi {
                margin-top: 15px;
                display: inline-block;
                background-color: #002147;
                color: #fff;
                padding: 10px 20px;
                border-radius: 25px;
                text-decoration: none;
                font-weight: bold;
                transition: background-color 0.3s ease;
            }

            .btn-coba-lagi:hover {
                background-color: #00472cff;
            }

            
        </style>

        <div style="margin: 30px auto; max-width: 600px;">
            <div class="alert-ditolak">
                <strong>⚠️ Maaf!</strong> {{ Auth::user()->name }}
                <i class="fas fa-times-circle fa-lg mb-2 icon-shake"></i><br>
                Kamu <strong>belum diterima</strong>. Silakan coba daftar eskul lainnya, ya!
                <br>
                <a href="{{ route('daftar-eskul') }}" class="btn-coba-lagi">🔁 Coba Daftar Lagi</a>
            </div>
        </div>

    @elseif(session('status'))
        <div style="margin: 30px auto; max-width: 600px;">
            <div style="background-color: #e0f7fa; border-left: 5px solid #00acc1; padding: 20px; border-radius: 8px; color: #006064; font-family: 'Nunito', sans-serif; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center;">
                <strong>✔ Pendaftaran Terkirim!</strong><br>
                {!! session('status') !!}
            </div>
        </div>

    @elseif($daftar && $daftar->status == 'Menunggu')
        <div style="margin: 30px auto; max-width: 600px;">
            <div style="background-color: #fff3e0; border-left: 5px solid blue; padding: 20px; border-radius: 8px; color: blue font-family: 'Nunito', sans-serif; box-shadow: 0 2px 5px rgba(0,0,0,0.1); text-align: center;">
                <strong>Sedang Diproses!</strong>&nbsp; <i class="fas fa-hourglass-half fa-pulse fa-lg mb-2"></i><br>
                Pendaftaranmu untuk ekstrakurikuler <strong>{{ $daftar->eskul->nama_eskul }}</strong> masih dalam proses. Silakan tunggu konfirmasi selanjutnya.
            </div>
        </div>
    @endif

<!-- Section One -->
<section id="one" class="wrapper">
    <div class="inner flex flex-3" style="align-items: center; gap: 20px;">
        <!-- Kiri -->
        <div class="flex-item left">
            <div>
                <h3>2 Mei 2009</h3>
                <p>Tanggal berdirinya SMK Assalaam Bandung, yang berkomitmen mencetak lulusan berkualitas dan berakhlak mulia.</p>
            </div>
            <div>
                <h3>H. Muhammad Luthfi Almanfaluthi, S.T., M.Pd</h3>
                <p>Kepala Sekolah SMK Assalaam Bandung yang visioner dan berpengalaman dalam dunia pendidikan.</p>
            </div>
        </div>

        <!-- Tengah -->
        <div class="flex-item image fit round" style="display: flex; justify-content: center; align-items: center;">
            <img src="{{ asset('user/images/nyes.png') }}" alt="Kepala Sekolah" style="width: 300px; height: 300px; object-fit: cover; border-radius: 50%; box-shadow: 0 5px 15px rgba(0,0,0,0.2);">
        </div>

        <!-- Kanan -->
        <div class="flex-item right">
            <div>
                <h3>SMK Assalaam Bandung</h3>
                <p>Sekolah Menengah Kejuruan berbasis islami yang berlokasi di Cibaduyut, Bandung, dengan berbagai jurusan unggulan.</p>
            </div>
            <div>
                <h3>Kabupaten Bandung</h3>
                <p>SMK Assalaam berada di wilayah strategis Kabupaten Bandung, memudahkan akses siswa dari berbagai daerah sekitar.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section Two -->
<section id="two" class="wrapper style1 special" style="text-align: center; padding: 50px 0;"> 
    <header class="major">
        <h2 style="font-family: 'Nunito', sans-serif;">Selamat Datang di Pendaftaran Ekstrakurikuler</h2>
    </header>
    <div class="inner">
        @guest
            {{-- Tidak menampilkan tombol jika belum login --}}
        @endguest
        @auth
            <a href="{{ route('daftar-eskul') }}" class="button alt-primary">Daftar Eskul Disini</a>
        @endauth
    </div>
</section>

<!-- Section Three -->



<section id="eskul" class="wrapper">
    <div class="inner eskul-grid">
    @foreach ($eskul as $data)
        <div class="eskul-box">

            <div class="eskul-img">
                <img src="{{ asset('storage/'.$data->foto) }}">
            </div>

            <div class="eskul-content">
                <h3>{{ $data->nama_eskul }}</h3>

                <p>{{ \Illuminate\Support\Str::limit($data->deskripsi, 120) }}</p>

                @auth
                    <a href="{{ route('eskul.show', $data->id) }}" class="btn-detail">
                        Lihat Lebih Detail
                    </a>
                @endauth
            </div>

        </div>
    @endforeach
</div>
</section>

@endsection

<style>
    /* GRID */
.eskul-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 25px;
}

/* CARD */
.eskul-box {
    background: #fff;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: 0.3s;
    display: flex;
    flex-direction: column;
}

.eskul-box:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
}

/* IMAGE */
.eskul-img {
    text-align: center;
    background: #f5f5f5;
    border-radius: 10px;
    padding: 10px;
}

.eskul-img img {
    width: 120px;
    height: 120px;
    object-fit: contain;
    transition: 0.3s;
}

.eskul-box:hover img {
    transform: scale(1.1);
}

/* CONTENT */
.eskul-content h3 {
    margin-top: 10px;
    color: #0d6efd;
}

.eskul-content p {
    font-size: 14px;
    color: #666;
    margin-top: 5px;
}

/* BUTTON */
.btn-detail {
    margin-top: 10px;
    display: inline-block;
    background: #ff6b35;
    color: white;
    padding: 7px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 13px;
    transition: 0.3s;
}

.btn-detail:hover {
    background: #e85a2a;
}
</style>