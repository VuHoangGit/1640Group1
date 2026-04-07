@extends('layouts.app')

@section('content')
<style>
    .chart-box {
        position: relative;
        height: 320px;
        width: 100%;
    }

    @media (max-width: 768px) {
        .chart-box {
            height: 240px;
        }
    }
</style>

<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">
            <i class="bi bi-speedometer2"></i> System Dashboard
        </h3>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm bg-primary text-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 60px; height: 60px;">
                        <i class="bi bi-people-fill fs-3"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 opacity-75">Total Users</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalUsers }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm bg-success text-white h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-white text-success d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 60px; height: 60px;">
                        <i class="bi bi-lightbulb-fill fs-3"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 opacity-75">Total Ideas Submitted</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalIdeas }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm bg-warning text-dark h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-white text-warning d-flex align-items-center justify-content-center me-3 flex-shrink-0" style="width: 60px; height: 60px;">
                        <i class="bi bi-bar-chart-fill fs-3"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 opacity-75">Total Interactions</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalUpvotes + $totalDownvotes }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="fw-bold text-dark mb-4 text-center">1. User Role Distribution</h6>
                    <div class="chart-box">
                        <canvas id="roleChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="fw-bold text-dark mb-4 text-center">2. Global Reaction Sentiment</h6>
                    <div class="chart-box">
                        <canvas id="sentimentChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="fw-bold text-dark mb-4">3. Idea Submission Trend (Last 14 Days)</h6>
                    <div class="chart-box">
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="fw-bold text-dark mb-4">4. Top 5 Most Active Contributors</h6>
                    <div class="chart-box">
                        <canvas id="topStaffChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="fw-bold text-dark mb-4">5. Total Ideas by Category</h6>
                    <div class="chart-box">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="fw-bold text-dark mb-4">6. Reactions Analysis by Category</h6>
                    <div class="chart-box">
                        <canvas id="reactionCatChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const isMobile = window.innerWidth < 768;

    const roleData = @json($usersByRole);
    new Chart(document.getElementById('roleChart'), {
        type: 'pie',
        data: {
            labels: roleData.map(i => i.role),
            datasets: [{
                data: roleData.map(i => i.total),
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: isMobile ? 'bottom' : 'top'
                }
            }
        }
    });

    const upvotes = {{ $totalUpvotes }};
    const downvotes = {{ $totalDownvotes }};
    new Chart(document.getElementById('sentimentChart'), {
        type: 'doughnut',
        data: {
            labels: ['Thumbs Up', 'Thumbs Down'],
            datasets: [{
                data: [upvotes, downvotes],
                backgroundColor: ['#1cc88a', '#e74a3b']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: {
                    position: isMobile ? 'bottom' : 'top'
                }
            }
        }
    });

    const trendData = @json($ideasTrend);
    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: trendData.map(i => i.date),
            datasets: [{
                label: 'New Ideas Submitted',
                data: trendData.map(i => i.total),
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            },
            plugins: {
                legend: {
                    position: isMobile ? 'bottom' : 'top'
                }
            }
        }
    });

    const staffData = @json($topStaffs);
    new Chart(document.getElementById('topStaffChart'), {
        type: 'bar',
        data: {
            labels: staffData.map(i => i.fullName || i.username),
            datasets: [{
                label: 'Ideas Submitted',
                data: staffData.map(i => i.total),
                backgroundColor: '#f6c23e',
                borderRadius: 4
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            },
            plugins: {
                legend: {
                    position: isMobile ? 'bottom' : 'top'
                }
            }
        }
    });

    const catData = @json($ideasByCategory);
    new Chart(document.getElementById('categoryChart'), {
        type: 'bar',
        data: {
            labels: catData.map(i => i.name),
            datasets: [{
                label: 'Total Ideas',
                data: catData.map(i => i.total),
                backgroundColor: '#36b9cc',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            },
            plugins: {
                legend: {
                    position: isMobile ? 'bottom' : 'top'
                }
            }
        }
    });

    const reactCatData = @json($reactionsByCategory);
    new Chart(document.getElementById('reactionCatChart'), {
        type: 'bar',
        data: {
            labels: reactCatData.map(i => i.name),
            datasets: [
                {
                    label: 'Upvotes',
                    data: reactCatData.map(i => i.upvotes),
                    backgroundColor: '#1cc88a'
                },
                {
                    label: 'Downvotes',
                    data: reactCatData.map(i => i.downvotes),
                    backgroundColor: '#e74a3b'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: { stacked: true },
                y: {
                    stacked: true,
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            },
            plugins: {
                legend: {
                    position: isMobile ? 'bottom' : 'top'
                }
            }
        }
    });
});
</script>
@endsection
