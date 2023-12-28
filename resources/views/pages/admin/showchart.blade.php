@extends('layouts.admin')
@section('libary')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <canvas id="myChart"></canvas>
</div>

<script>
    // Dữ liệu mẫu cho biểu đồ
    var data = {
        labels: ['January', 'February', 'March', 'April', 'May'],
        datasets: [{
            label: 'Monthly Revenue',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            data: [1500, 2000, 1800, 2500, 2100]
        }]
    };

    // Cấu hình biểu đồ
    var options = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    // Vẽ biểu đồ vào canvas
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });
</script>

@endsection