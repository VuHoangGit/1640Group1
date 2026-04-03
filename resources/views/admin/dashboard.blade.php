@extends('layouts.app')

@section('content')
<style>
    .dashboard-page {
        width: 100%;
    }

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
        flex-wrap: wrap;
    }

    .dashboard-title {
        margin: 0;
        font-weight: 700;
        color: #1f2937;
    }

    .stat-card-custom {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        height: 100%;
    }

    .stat-card-custom .card-body {
        padding: 22px;
    }

    .stat-icon {
        width: 58px;
        height: 58px;
        min-width: 58px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.95);
        font-size: 1.5rem;
    }

    .chart-card {
        border: 0;
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        height: 100%;
    }

    .chart-card .card-body {
        padding: 22px;
    }

    .chart-title {
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 18px;
        font-size: 1rem;
    }

    .chart-wrapper {
        position: relative;
        width: 100%;
        height: 320px;
    }

    .chart-wrapper.chart-tall {
        height: 360px;
    }

    @media (max-width: 767.98px) {
        .dashboard-header {
            margin-bottom: 20px;
        }

        .dashboard-title {
            font-size: 1.35rem;
        }

        .stat-card-custom .card-body,
        .chart-card .card-body {
            padding: 18px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            min-width: 50px;
            font-size: 1.25rem;
        }

        .chart-title {
            font-size: 0.95rem;
            margin-bottom: 14px;
        }

        .chart-wrapper {
            height: 260px;
        }

        .chart-wrapper.chart-tall {
            height: 300px;
        }
    }
</style>

<div class="container-fluid px-0 dashboard-page">
    <div class="dashboard-header">
        <h3 class="dashboard-title"><i class="bi bi-speedometer2 me-2"></i>System Dashboard</h3>
    </div>

    <div class="row g-3 g-lg-4 mb-4">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card stat-card-custom bg-primary text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon text-primary me-3">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div class="min-w-0">
                        <h6 class="mb-1 opacity-75">Total Users</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalUsers }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card stat-card-custom bg-success text-white">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon text-success me-3">
                        <i class="bi bi-lightbulb-fill"></i>
                    </div>
                    <div class="min-w-0">
                        <h6 class="mb-1 opacity-75">Total Ideas Submitted</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalIdeas }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card stat-card-custom bg-warning text-dark">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon text-warning me-3">
                        <i class="bi bi-bar-chart-fill"></i>
                    </div>
                    <div class="min-w-0">
                        <h6 class="mb-1 opacity-75">Total Interactions</h6>
                        <h2 class="mb-0 fw-bold">{{ $totalUpvotes + $totalDownvotes }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 g-lg-4 mb-4">
        <div class="col-12 col-xl-6">
            <div class="card chart-card">
                <div class="card-body">
                    <h6 class="chart-title text-center">1. User Role Distribution</h6>
                    <div class="chart-wrapper">
                        <canvas id="roleChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6">
            <div class="card chart-card">
                <div class="card-body">
                    <h6 class="chart-title text-center">2. Global Reaction Sentiment</h6>
                    <div class="chart-wrapper">
                        <canvas id="sentimentChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 g-lg-4 mb-4">
        <div class="col-12 col-xl-6">
            <div class="card chart-card">
                <div class="card-body">
                    <h6 class="chart-title">3. Idea Submission Trend (Last 14 Days)</h6>
                    <div class="chart-wrapper">
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6">
            <div class="card chart-card">
                <div class="card-body">
                    <h6 class="chart-title">4. Top 5 Most Active Contributors</h6>
                    <div class="chart-wrapper">
                        <canvas id="topStaffChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 g-lg-4">
        <div class="col-12 col-xl-6">
            <div class="card chart-card">
                <div class="card-body">
                    <h6 class="chart-title">5. Total Ideas by Category</h6>
                    <div class="chart-wrapper chart-tall">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-6">
            <div class="card chart-card">
                <div class="card-body">
                    <h6 class="chart-title">6. Reactions Analysis by Category</h6>
                    <div class="chart-wrapper chart-tall">
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
    const upvotes = {{ $totalUpvotes }};
    const downvotes = {{ $totalDownvotes }};
    const trendData = @json($ideasTrend);
    const staffData = @json($topStaffs);
    const catData = @json($ideasByCategory);
    const reactCatData = @json($reactionsByCategory);

    const commonLegend = {
        position: isMobile ? 'bottom' : 'top',
        labels: {
            boxWidth: isMobile ? 10 : 12,
            padding: isMobile ? 12 : 16,
            font: {
                size: isMobile ? 11 : 12
            }
        }
    };

    const truncateLabel = (label, max = 12) => {
        if (!label) return '';
        return label.length > max ? label.substring(0, max) + '…' : label;
    };

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
                legend: commonLegend
            }
        }
    });

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
                legend: commonLegend
            }
        }
    });

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
            plugins: {
                legend: {
                    display: !isMobile
                }
            },
            scales: {
                x: {
                    ticks: {
                        autoSkip: true,
                        maxTicksLimit: isMobile ? 6 : 10,
                        maxRotation: isMobile ? 45 : 0,
                        minRotation: isMobile ? 45 : 0
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

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
            plugins: {
                legend: {
                    display: !isMobile
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                },
                y: {
                    ticks: {
                        callback: function(value) {
                            const label = this.getLabelForValue(value);
                            return truncateLabel(label, isMobile ? 14 : 22);
                        }
                    }
                }
            }
        }
    });

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
            plugins: {
                legend: {
                    display: !isMobile
                }
            },
            scales: {
                x: {
                    ticks: {
                        callback: function(value) {
                            const label = this.getLabelForValue(value);
                            return truncateLabel(label, isMobile ? 10 : 16);
                        },
                        autoSkip: false,
                        maxRotation: isMobile ? 45 : 0,
                        minRotation: isMobile ? 45 : 0
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

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
            plugins: {
                legend: commonLegend
            },
            scales: {
                x: {
                    stacked: true,
                    ticks: {
                        callback: function(value) {
                            const label = this.getLabelForValue(value);
                            return truncateLabel(label, isMobile ? 10 : 16);
                        },
                        autoSkip: false,
                        maxRotation: isMobile ? 45 : 0,
                        minRotation: isMobile ? 45 : 0
                    }
                },
                y: {
                    stacked: true,
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
@endsection
