@extends('layouts.admin')

@section('libary')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
@endsection

@section('content')
<style>
    .container {
        max-width: 1000px;
        margin: 0 auto;
    }

    #myChart {
        width: 100%;
        margin-top: 20px;
    }
</style>
    <div class="container">
        <h1 class="text-center mt-4">
            Daily Revenue Breakdown and Order Count
        </h1>
        <canvas id="myChart"></canvas>
    </div>
    <script>
       function createChart(data, options) {
            var ctx = document.getElementById('myChart').getContext('2d');
            return new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });
        }
        var chartData = {
            labels: {!! json_encode($data->pluck('date')) !!},
            datasets: [{
                label: 'Order Count',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                data: {!! json_encode($data->pluck('order_count')) !!}
            }, {
                label: 'Total Amount',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: {!! json_encode($data->pluck('total_amount')) !!}
            }]
        };
        var chartOptions = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };
        var myChart = createChart(chartData, chartOptions);
    </script>
@endsection
