@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualization</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 50px;
        }
        .chart-container {
            width: 60%;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            box-sizing: border-box;
            margin-bottom: 50px;
            margin-top: 50px;
            margin-left: 50px;
            border: 2px solid #ccc; 
        }
        select {
            margin-bottom: 10px;
        }
        canvas {
            max-width: 100%;
            height: 50;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="chart-container">
            <h4>Total Sales</h4>
            <select id="salesType">
                <option value="Daily">Daily</option>
                <option value="Weekly">Weekly</option>
                <option value="Monthly">Monthly</option>
                <option value="Yearly">Yearly</option>
            </select>
            <canvas id="salesChart"></canvas>
        </div>
        <!-- Add more divs with charts here -->
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart;

        function updateChart(type) {
            var data = <?php echo json_encode(compact('dailySales', 'weeklySales', 'monthlySales', 'yearlySales', 'datesOfWeek')); ?>;
            var labels, salesData;

            switch (type) {
                case 'Daily':
                    labels = ['Today'];
                    salesData = [data.dailySales];
                    break;
                case 'Weekly':
                    labels = data.datesOfWeek;
                    salesData = Object.values(data.weeklySales);
                    break;
                case 'Monthly':
                    labels = Object.keys(data.monthlySales);
                    salesData = Object.values(data.monthlySales);
                    break;
                case 'Yearly':
                    labels = Object.keys(data.yearlySales);
                    salesData = Object.values(data.yearlySales);
                    break;
                default:
                    labels = [];
                    salesData = [];
            }

            if (salesChart) {
                salesChart.data.labels = labels;
                salesChart.data.datasets[0].data = salesData;
                salesChart.update();
            } else {
                salesChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Sales',
                            data: salesData,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: true // Changed to false
                    }
                });
            }
        }

        document.getElementById('salesType').addEventListener('change', function() {
            var selectedType = this.value;
            updateChart(selectedType);
        });

        updateChart(document.getElementById('salesType').value);
    </script>
</body>
</html>
@endsection