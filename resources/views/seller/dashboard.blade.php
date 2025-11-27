@extends('seller.layouts.master')
@section('page-title', 'Dashboard')

@section('content')
<div class="xs-pd-20-10 pd-ltr-20">
    <div class="title pb-20">
        <h2 class="h3 mb-0">Tổng quan</h2>
    </div>

    <div class="row pb-10">
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $totalOrders }}</div>
                        <div class="font-14 text-secondary weight-500">Đơn hàng</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf">
                            <i class="icon-copy dw dw-calendar1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $totalProducts }}</div>
                        <div class="font-14 text-secondary weight-500">Sản phẩm</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#ff5b5b">
                            <span class="icon-copy ti-heart"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $totalGroups }}</div>
                        <div class="font-14 text-secondary weight-500">Nhóm mua</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon">
                            <i class="icon-copy fa fa-stethoscope"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">
                            {{ number_format($totalRevenue, 0, ',', '.') }}₫
                        </div>
                        <div class="font-14 text-secondary weight-500">Doanh thu</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#09cc06">
                            <i class="icon-copy fa fa-money"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-box mb-30 p-20 shadow-sm rounded-lg" style="background: #ffffff;">
        <h4 class="h4 text-blue mb-20" style="font-weight: 600;">
            Biểu đồ số sản phẩm đăng theo tháng ({{ $year }})
        </h4>

        <div style="padding: 10px 10px 20px 10px;">
            <canvas id="productsChart" height="120"></canvas>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('productsChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
                datasets: [{
                    label: 'Sản phẩm đã đăng',
                    data: @json(array_values($monthlyData)),
                    borderWidth: 3,
                    tension: 0.4,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            },
            options: {
                layout: {
                    padding: 20 
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            padding: 20
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            padding: 10
                        }
                    },
                    x: {
                        ticks: {
                            padding: 10
                        }
                    }
                }
            }
        });
    </script>
</div>
@endsection