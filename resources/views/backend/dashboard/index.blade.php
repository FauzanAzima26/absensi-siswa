@extends('backend.layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div class="text-center w-100">
                <h3 class="fw-bold mb-3">Selamat Datang, {{ auth()->user()->name }}!</h3>
                <h6 class="op-7 mb-2">Dashboard &amp; Statistics</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Daftar Kelas</p>
                                    <h4 class="card-title">{{ $totalKelas ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-info bubble-shadow-small">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Daftar Guru</p>
                                    <h4 class="card-title">{{ $totalGuru ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Daftar Siswa</p>
                                    <h4 class="card-title">{{ $totalSiswa ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                    <i class="far fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Absensi Siswa</p>
                                    <h4 class="card-title">{{ $totalAbsensi ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Statistics Absensi</div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-label-success btn-round btn-sm me-2" data-bs-toggle="modal" data-bs-target="#downloadModal">
                                    <span class="btn-label"><i class="fa fa-pencil"></i></span>
                                    Export
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="min-height: 375px">
                            <canvas id="statisticsChart"></canvas>
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var ctx = document.getElementById('statisticsChart').getContext('2d');
                                    var statisticsChart = new Chart(ctx, {
                                        type: 'line',
                                        data: {
                                            labels: @json($months), // Data labels
                                            datasets: [{
                                                label: 'Alpha',
                                                borderColor: '#f3545d',
                                                pointBackgroundColor: 'rgba(243, 84, 93, 0.6)',
                                                pointRadius: 0,
                                                backgroundColor: 'rgba(243, 84, 93, 0.4)',
                                                legendColor: '#f3545d',
                                                fill: true,
                                                borderWidth: 2,
                                                data: @json(array_values($alpha)),
                                            }, {
                                                label: 'Sakit',
                                                borderColor: '#fdaf4b',
                                                pointBackgroundColor: 'rgba(253, 175, 75, 0.6)',
                                                pointRadius: 0,
                                                backgroundColor: 'rgba(253, 175, 75, 0.4)',
                                                legendColor: '#fdaf4b',
                                                fill: true,
                                                borderWidth: 2,
                                                data: @json(array_values($sakit)),
                                            }, {
                                                label: 'Izin',
                                                borderColor: '#177dff',
                                                pointBackgroundColor: 'rgba(23, 125, 255, 0.6)',
                                                pointRadius: 0,
                                                backgroundColor: 'rgba(23, 125, 255, 0.4)',
                                                legendColor: '#177dff',
                                                fill: true,
                                                borderWidth: 2,
                                                data: @json(array_values($izin)),
                                            }, {
                                                label: 'Hadir',
                                                borderColor: '#28a745',
                                                pointBackgroundColor: 'rgba(40, 167, 69, 0.6)',
                                                pointRadius: 0,
                                                backgroundColor: 'rgba(40, 167, 69, 0.4)',
                                                legendColor: '#28a745',
                                                fill: true,
                                                borderWidth: 2,
                                                data: @json(array_values($hadir)),
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            legend: {
                                                display: true,
                                                position: 'bottom',
                                                labels: {
                                                    usePointStyle: true
                                                }
                                            },
                                            tooltips: {
                                                bodySpacing: 4,
                                                mode: "nearest",
                                                intersect: 0,
                                                position: "nearest",
                                                xPadding: 10,
                                                yPadding: 10,
                                                caretPadding: 10
                                            },
                                            layout: {
                                                padding: {
                                                    left: 5,
                                                    right: 5,
                                                    top: 15,
                                                    bottom: 15
                                                }
                                            },
                                            scales: {
                                                yAxes: [{
                                                    ticks: {
                                                        fontStyle: "500",
                                                        padding: 10,
                                                        beginAtZero: true,
                                                        suggestedMin: 0,
                                                        maxTicksLimit: 5,
                                                    },
                                                    gridLines: {
                                                        drawTicks: false,
                                                        display: false
                                                    }
                                                }],
                                                xAxes: [{
                                                    gridLines: {
                                                        zeroLineColor: "transparent"
                                                    },
                                                    ticks: {
                                                        padding: 10,
                                                        fontStyle: "500"
                                                    }
                                                }]
                                            },
                                            legendCallback: function(chart) {
                                                var text = [];
                                                text.push('<ul class="' + chart.id + '-legend html-legend">');
                                                for (var i = 0; i < chart.data.datasets.length; i++) {
                                                    text.push('<li><span style="background-color:' + chart.data.datasets[i]
                                                        .legendColor + '"></span>');
                                                    if (chart.data.datasets[i].label) {
                                                        text.push(chart.data.datasets[i].label);
                                                    }
                                                    text.push('</li>');
                                                }
                                                text.push('</ul>');
                                                return text.join('');
                                            }
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>

            @include('backend.dashboard._modal-export')

        @endsection
