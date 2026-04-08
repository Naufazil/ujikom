@extends('layouts.pembina')

@section('content')
<div class="row g-4">

    <!-- Diterima -->
    <div class="col-sm-6 col-xl-3">
        <div class="card dashboard-card success">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <span>Siswa Diterima</span>
                    <h3>{{ $keterima }}</h3>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Ditolak -->
    <div class="col-sm-6 col-xl-3">
        <div class="card dashboard-card danger">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <span>Siswa Ditolak</span>
                    <h3>{{ $jumlahDitolak }}</h3>
                </div>
                <div class="icon">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total -->
    <div class="col-sm-6 col-xl-3">
        <div class="card dashboard-card primary">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <span>Total Pendaftar</span>
                    <h3>{{ $jumlahSiswa }}</h3>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Eskul -->
    <div class="col-sm-6 col-xl-3">
        <div class="card dashboard-card warning">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <span>Jumlah Eskul</span>
                    <h3>{{ $jumlahEskul }}</h3>
                </div>
                <div class="icon">
                    <i class="fas fa-layer-group"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .dashboard-card {
    border: none;
    border-radius: 15px;
    color: white;
    padding: 10px;
    transition: 0.3s;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

.dashboard-card h3 {
    margin-top: 5px;
    font-weight: bold;
}

.dashboard-card span {
    font-size: 14px;
    opacity: 0.9;
}

/* ICON */
.dashboard-card .icon {
    font-size: 35px;
    opacity: 0.8;
}

/* WARNA */
.success {
    background: linear-gradient(135deg, #00c853, #64dd17);
}

.danger {
    background: linear-gradient(135deg, #d50000, #ff1744);
}

.primary {
    background: linear-gradient(135deg, #2962ff, #448aff);
}

.warning {
    background: linear-gradient(135deg, #ff6d00, #ffab00);
}

/* HOVER */
.dashboard-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}
</style>
@endsection
