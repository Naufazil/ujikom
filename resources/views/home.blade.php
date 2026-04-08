@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Ringkasan Statistik --}}
    <div class="row g-4 mb-4">
        @php
            $stats = [
                ['icon' => 'bx bx-check-circle', 'label' => 'Siswa Diterima', 'value' => $keterima, 'color' => 'success'],
                ['icon' => 'bx bx-x-circle', 'label' => 'Siswa Ditolak', 'value' => $jumlahDitolak, 'color' => 'danger'],
                ['icon' => 'bx bx-user', 'label' => 'Total Siswa', 'value' => $jumlahSiswa, 'color' => 'primary'],
                ['icon' => 'bx bx-layer', 'label' => 'Jumlah Eskul', 'value' => $jumlahEskul, 'color' => 'info'],
            ];
        @endphp

        @foreach ($stats as $stat)
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-{{ $stat['color'] }}">
                                <i class="{{ $stat['icon'] }}"></i>
                            </span>
                        </div>
                        <div>
                            <span class="fw-semibold d-block mb-1">{{ $stat['label'] }}</span>
                            <h4 class="card-title mb-0">{{ $stat['value'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

   

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const eskulLabels = ['Basket', 'Futsal', 'PMR', 'Pramuka', 'Paskibra'];
    const diterima = [10, 15, 8, 12, 6];
    const ditolak = [2, 1, 3, 0, 4];

    // Bar Chart
    new Chart(document.getElementById('chartEskul'), {
        type: 'bar',
        data: {
            labels: eskulLabels,
            datasets: [
                {
                    label: 'Diterima',
                    data: diterima,
                    backgroundColor: '#28c76f'
                },
                {
                    label: 'Ditolak',
                    data: ditolak,
                    backgroundColor: '#ea5455'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Doughnut Chart
    new Chart(document.getElementById('chartTotal'), {
        type: 'doughnut',
        data: {
            labels: ['Diterima', 'Ditolak'],
            datasets: [{
                data: [
                    diterima.reduce((a, b) => a + b, 0),
                    ditolak.reduce((a, b) => a + b, 0)
                ],
                backgroundColor: ['#28c76f', '#ea5455']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection
