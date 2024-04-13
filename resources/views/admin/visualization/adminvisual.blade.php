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
            flex-wrap: wrap; /* Allow wrapping to the next line */
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .chart-container {
            width: 48%; /* Adjusted width */
            padding: 10px; /* Added padding */
            border-radius: 10px; /* Added border radius */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Added box shadow */
            background-color: #fff; /* Added background color */
            box-sizing: border-box; /* Added box sizing */
            margin-bottom: 20px; /* Adjusted margin */
        }
        canvas {
            width: 200px; /* Adjusted width */
        }
        select {
            margin-bottom: 10px; /* Adjusted margin */
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
            <!-- Adjusted canvas size to make it super small -->
            <canvas id="salesChart" width="200" height="5"></canvas> <!-- Changed height to 5 -->
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
                        // Adjusted chart options to make it smaller
                        responsive: true,
                        maintainAspectRatio: true,
                        aspectRatio: 0.7
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
