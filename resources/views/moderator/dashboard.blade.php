@extends('moderator.layouts.master')
@section('page-title', 'Dashboard')

@section('content')
<div class="xs-pd-20-10 pd-ltr-20">
    <div class="title pb-20">
        <h2 class="h3 mb-0">Overview</h2>
    </div>

    <div class="row pb-10">
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ $totalGroups }}</div>
                        <div class="font-14 text-secondary weight-500">Group Buys</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon">
                            <i class="icon-copy fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-box mb-30 p-20 shadow-sm rounded-lg" style="background: #ffffff;">
        <h4 class="h4 text-blue mb-20" style="font-weight: 600;">
            Group Buy Chart by Month ({{ $year }})
        </h4>

        <div style="padding: 10px 10px 20px 10px;">
            <canvas id="groupsChart" height="120"></canvas>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        $('.dropdown-toggle').dropdown();
    });

    const ctxGroups = document.getElementById('groupsChart').getContext('2d');

    new Chart(ctxGroups, {
        type: 'bar',
        data: {
            labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
            datasets: [{
                label: 'Number of Group Buys',
                data: @json(array_values($groupsData)),
                borderWidth: 2,
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
                    display: true
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
@endsection
