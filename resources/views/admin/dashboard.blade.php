@extends('admin.layouts.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">
                            Welcome, {{ Auth::guard('admin')->user()->nama }}
                        </h3>
                        <h6 class="font-weight-normal mb-0">
                            All systems are running smoothly!
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin transparent">
                <div class="row">
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">
                                    Number of Users
                                </p>
                                <p class="fs-30 mb-2">{{ $totalUsers }}</p>
                                <p>Penyewa Users</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <div class="card-body">
                                <p class="mb-4">
                                    Number of Penyedia
                                </p>
                                <p class="fs-30 mb-2">{{ $penyediaCount }}</p>
                                <p>Penyedia Users</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">
                                    Number of orders
                                </p>
                                <p class="fs-30 mb-2">{{ $orderCount }}</p>
                                <p>Users Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin transparent">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-tale">
                            <div class="card-body">
                                <h4 class="card-title">User Statistics</h4>
                                <div class="chart-container">
                                    <canvas id="userChart" style="height: 300px; background-color: white;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- partial:partials/_footer.html -->
    @include('admin\layouts\footer')
    <!-- partial -->
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('userChart').getContext('2d');
            var userChart = new Chart(ctx, {
                type: 'pie', // Menggunakan tipe pie chart
                data: {
                    labels: ['Number of Users', 'Number of Penyedia', 'Number of Orders'],
                    datasets: [{
                        data: [{{ $totalUsers }}, {{ $penyediaCount }}, {{ $orderCount }}],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 99, 132, 0.8)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        display: true,
                        position: 'right'
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                                    return previousValue + currentValue;
                                });
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = Math.round((currentValue / total) * 100);
                                return currentValue + " (" + percentage + "%)";
                            }
                        }
                    }
                }
            });
        });
</script>
@endsection