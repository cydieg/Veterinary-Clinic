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
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .chart-container {
            width: 45%;
        }
        canvas {
            width: 100%;
            height: 400px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="chart-container">
            <h1>Number of Sales for Each Branch</h1>
            <canvas id="salesPerBranchChart" width="400" height="400"></canvas>
        </div>

        <div class="chart-container">
            <h1>Number of Users for Each Branch</h1>
            <canvas id="usersPerBranchChart" width="400" height="400"></canvas>
        </div>
    </div>

    <div class="container">
        <div class="chart-container">
            <h1>Sales Distribution by Selected Data</h1>
            <select id="dataSelect">
                <option value="region">Region</option>
                <option value="province">Province</option>
                <option value="city">City</option>
                <option value="barangay">Barangay</option>
                <option value="address">Address</option>
            </select>
            <canvas id="chartCanvas" width="400" height="400"></canvas>
        </div>

        <div class="chart-container">
            <h1>Appointments</h1>
            <select id="appointmentType">
                <option value="day">Appointments Completed by Day</option>
                <option value="month">Appointments Completed by Month</option>
                <option value="year">Appointments Completed by Year</option>
            </select>
            <canvas id="appointmentsChart" width="400" height="400"></canvas>
        </div>
    </div>
    <script>
        // Parse the data from PHP to JavaScript for sales distribution by selected data
        var salesData = {!! json_encode($salesWithUserAddress) !!};

        // Function to count occurrences of selected data field
        function countOccurrences(dataField) {
            var dataCounts = {};
            salesData.forEach(function(sale) {
                var fieldValue = sale.user[dataField];
                dataCounts[fieldValue] = (dataCounts[fieldValue] || 0) + 1;
            });
            return dataCounts;
        }

        // Function to update the chart based on selected data
        function updateChart(selectedData) {
            var dataCounts = countOccurrences(selectedData);
            var labels = Object.keys(dataCounts);
            var counts = Object.values(dataCounts);

            // Clear previous chart
            if (window.myChart) {
                window.myChart.destroy();
            }

            // Create a new pie chart
            var ctx = document.getElementById('chartCanvas').getContext('2d');
            window.myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: counts,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(153, 102, 255, 0.5)',
                            'rgba(255, 159, 64, 0.5)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            });
        }

        // Initial chart with default selection
        updateChart('region');

        // Add event listener to update chart when selection changes
        document.getElementById('dataSelect').addEventListener('change', function() {
            var selectedData = this.value;
            updateChart(selectedData);
        });

        // Parse the data from PHP to JavaScript for sales per branch
        var salesPerBranchData = {!! json_encode($branchesWithSalesCount) !!};

        // Extract branch names and total sales
        var branchNames = salesPerBranchData.map(function(item) {
            return item.name;
        });
        var totalSales = salesPerBranchData.map(function(item) {
            return item.sales_count;
        });

        // Create a bar chart for sales per branch
        var ctx1 = document.getElementById('salesPerBranchChart').getContext('2d');
        var salesPerBranchChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: branchNames,
                datasets: [{
                    label: 'Total Sales',
                    data: totalSales,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Parse the data from PHP to JavaScript for users per branch
        var usersPerBranchData = {!! json_encode($usersPerBranch) !!};

        // Extract branch names and total users
        var usersBranchIds = usersPerBranchData.map(function(item) {
            return item.branch_id;
        });
        var totalUsers = usersPerBranchData.map(function(item) {
            return item.total;
        });

        // Generate random colors for each dataset
        var backgroundColors = [];
        for (var i = 0; i < branchNames.length; i++) {
            var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() * 256) + ', 0.5)';
            backgroundColors.push(randomColor);
        }

        // Create a bar chart for users per branch with random colors
        var ctx2 = document.getElementById('usersPerBranchChart').getContext('2d');
        var usersPerBranchChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: branchNames,
                datasets: [{
                    label: 'Total Users',
                    data: totalUsers,
                    backgroundColor: backgroundColors,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Initialize the appointments chart
        var appointmentTypeSelect = document.getElementById('appointmentType');
        var appointmentsChartCanvas = document.getElementById('appointmentsChart');
        var appointmentsChart;

        appointmentTypeSelect.addEventListener('change', function() {
            var selectedType = this.value;
            updateAppointmentsChart(selectedType);
        });

        function updateAppointmentsChart(selectedType) {
            if (appointmentsChart) {
                appointmentsChart.destroy();
            }

            var chartData;
            var chartLabel;

            switch (selectedType) {
                case 'day':
                    chartData = {!! json_encode($appointmentsByDay) !!};
                    chartLabel = 'Appointments Completed by Day';
                    break;
                case 'month':
                    chartData = {!! json_encode($appointmentsByMonth) !!};
                    chartLabel = 'Appointments Completed by Month';
                    break;
                case 'year':
                    chartData = {!! json_encode($appointmentsByYear) !!};
                    chartLabel = 'Appointments Completed by Year';
                    break;
                default:
                    chartData = {};
                    chartLabel = 'No Data';
            }

            appointmentsChart = new Chart(appointmentsChartCanvas, {
                type: 'line',
                data: {
                    labels: Object.keys(chartData),
                    datasets: [{
                        label: chartLabel,
                        data: Object.values(chartData),
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }

        // Initialize the chart with default value
        updateAppointmentsChart('day');
    </script>
</body>
</html>
