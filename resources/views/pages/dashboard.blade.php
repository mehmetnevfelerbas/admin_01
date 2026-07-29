@extends('layouts.app.app')

@section('content')
<div class="container-fluid py-3">
    
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h3 class="fw-bold mb-0">Hoş geldin, {{ auth()->user()->name ?? 'Yönetici' }}</h3>
        <span class="badge bg-white text-dark shadow-sm border px-3 py-2">
            <i class="bi bi-calendar3 me-1"></i> {{ date('d.m.Y') }}
        </span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 border-start border-primary border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-semibold">TOPLAM KULLANICI</div>
                        <h3 class="fw-bold my-1">{{ $totalUsers ?? 0 }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 border-start border-danger border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-semibold">ONAY BEKLEYEN İSTEK</div>
                        <h3 class="fw-bold my-1">{{ $pendingUsersCount ?? 0 }}</h3>
                    </div>
                    <div class="bg-danger bg-opacity-10 text-danger p-3 rounded-circle">
                        <i class="bi bi-person-exclamation fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 border-start border-success border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-semibold">TOPLAM BLOG / HABER</div>
                        <h3 class="fw-bold my-1">{{ $totalBlogs ?? 0 }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle">
                        <i class="bi bi-journal-text fs-4"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-3 border-start border-warning border-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-muted small fw-semibold">SİSTEM DURUMU</div>
                        <h3 class="fw-bold my-1 text-success fs-5">Aktif</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-circle">
                        <i class="bi bi-shield-check fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h5 class="fw-bold mb-3">Aylık Kullanıcı Kayıt Grafiği</h5>
                <canvas id="lineChart" style="max-height: 300px;"></canvas>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4 h-100">
                <h5 class="fw-bold mb-3">Kullanıcı Onay Durumları</h5>
                <div class="d-flex justify-content-center align-items-center" style="height: 250px;">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="row my-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold text-dark mb-4">
                <i class="bi bi-bar-chart-line-fill text-primary me-2"></i>Haber Beğeni / Beğenmeme İstatistikleri
            </h5>
            <div style="height: 350px; position: relative;">
                <canvas id="reactionChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- grafik -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('reactionChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($blogTitles) !!},
            datasets: [
                {
                    label: 'Beğeni 👍',
                    data: {!! json_encode($likes) !!},
                    backgroundColor: 'rgba(25, 135, 84, 0.85)',
                    borderColor: 'rgb(25, 135, 84)',
                    borderWidth: 1,
                    borderRadius: 6
                },
                {
                    label: 'Beğenmeme 👎',
                    data: {!! json_encode($dislikes) !!},
                    backgroundColor: 'rgba(220, 53, 69, 0.85)',
                    borderColor: 'rgb(220, 53, 69)',
                    borderWidth: 1,
                    borderRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxLine = document.getElementById('lineChart').getContext('2d');
    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz'],
            datasets: [{
                label: 'Yeni Kullanıcı Kaydı',
                data: [2, 4, 3, 6, 8, 10, {{ $totalUsers ?? 0 }}],
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });

    const ctxPie = document.getElementById('pieChart').getContext('2d');
    new Chart(ctxPie, {
        type: 'doughnut',
        data: {
            labels: ['Onaylı Kullanıcılar', 'Bekleyen İstekler'],
            datasets: [{
                data: [{{ $approvedUsersCount ?? 0 }}, {{ $pendingUsersCount ?? 0 }}],
                backgroundColor: ['#198754', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
@endsection