@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create New User')
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
                /* Allow wrapping to the next line */
                justify-content: space-between;
                margin-bottom: 20px;
            }

            .chart-container {
                width: 48%;
                /* Adjusted width */
                padding: 20px;
                /* Added padding */
                border-radius: 10px;
                /* Added border radius */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                /* Added box shadow */
                background-color: #fff;
                /* Added background color */
                box-sizing: border-box;
                /* Added box sizing */
                margin-bottom: 20px;
                /* Adjusted margin */
            }

            canvas {
                width: 100%;
                height: 100px;
                /* Adjusted height */
            }

            select {
                margin-bottom: 10px;
                /* Adjusted margin */
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="chart-container">
                <h4>Total Sales</h4>
                <label for="dataOption"></label>
                <select id="dataOption">
                    <option value="day">Daily</option>
                    <option value="week">Weekly</option>
                    <option value="month">Monthly</option>
                    <option value="year">Yearly</option>
                </select>
                <canvas id="salesChart" width="400" height="300"></canvas>
            </div>

            <div class="chart-container">
                <h4>Number of Sales for Each Branch</h4>
                <canvas id="salesPerBranchChart" width="400" height="300"></canvas>
            </div>
        </div>

        <div class="container">
            <div class="chart-container">
                <h4>Number of Users for Each Branch</h4>
                <canvas id="usersPerBranchChart" width="400" height="300"></canvas>
            </div>

            <div class="chart-container">
                <h4>Sales Distribution by Selected Data</h4>
                <select id="dataSelect">
                    <option value="region">Region</option>
                    <option value="province">Province</option>
                    <option value="city">City</option>
                    <option value="barangay">Barangay</option>
                </select>
                <canvas id="chartCanvas" width="400" height="300"></canvas>
            </div>
        </div>

        <div class="container">
            <div class="chart-container">
                <h4>Appointments</h4>
                <select id="appointmentType">
                    <option value="day">Appointments Completed by Day</option>
                    <option value="month">Appointments Completed by Month</option>
                    <option value="year">Appointments Completed by Year</option>
                </select>
                <canvas id="appointmentsChart" width="400" height="300"></canvas>
            </div>
        </div>

        <script>
            // Your JavaScript code here...
        </script>
    </body>

    </html>

    <script>
        var salesTotalBarData = {
            day: {!! json_encode($salesByDay) !!},
            week: {!! json_encode($salesByWeek) !!},
            month: {!! json_encode($salesByMonth) !!},
            year: {!! json_encode($salesByYear) !!}
        };

        var ctx = document.getElementById('salesChart').getContext('2d');
        var salesChart;

        function createChart(data, label, bgColor, borderColor) {
            return new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: Object.keys(data),
                    datasets: [{
                        label: label,
                        data: Object.values(data),
                        backgroundColor: bgColor,
                        borderColor: borderColor,
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

        function updateSalesChart(option) {
            if (salesChart) {
                salesChart.destroy();
            }
            var selectedData = salesTotalBarData[option];
            var label, bgColor, borderColor;
            switch (option) {
                case 'day':
                    label = 'Total Sales by Day';
                    bgColor = 'rgba(255, 99, 132, 0.5)';
                    borderColor = 'rgba(255, 99, 132, 1)';
                    break;
                case 'week':
                    label = 'Total Sales by Week';
                    bgColor = 'rgba(255, 159, 64, 0.5)';
                    borderColor = 'rgba(255, 159, 64, 1)';
                    break;
                case 'month':
                    label = 'Total Sales by Month';
                    bgColor = 'rgba(54, 162, 235, 0.5)';
                    borderColor = 'rgba(54, 162, 235, 1)';
                    break;
                case 'year':
                    label = 'Total Sales by Year';
                    bgColor = 'rgba(75, 192, 192, 0.5)';
                    borderColor = 'rgba(75, 192, 192, 1)';
                    break;
            }
            salesChart = createChart(selectedData, label, bgColor, borderColor);
        }

        // Initial chart display
        var initialOption = document.getElementById('dataOption').value;
        updateSalesChart(initialOption);

        // Update chart when dropdown option changes
        document.getElementById('dataOption').addEventListener('change', function() {
            var selectedOption = this.value;
            updateSalesChart(selectedOption);
        });
    </script>

    <script>
        // Parse the data from PHP to JavaScript for sales distribution by selected data
        var salesData = {!! json_encode($salesWithUserAddress) !!};

        // Function to count occurrences of selected data field
        function countOccurrences(dataField) {
            var dataCounts = {};
            salesData.forEach(function(sale) {
                var fieldValue = sale.user[dataField];
                // Increment the count for each sale
                dataCounts[fieldValue] = (dataCounts[fieldValue] || 0) + 1;
            });
            return dataCounts;
        }

        // Function to update the pie chart based on selected data
        function updatePieChart(selectedData) {
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
        updatePieChart('region');

        // Add event listener to update chart when selection changes
        document.getElementById('dataSelect').addEventListener('change', function() {
            var selectedData = this.value;
            updatePieChart(selectedData);
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
            var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ', ' + Math.floor(Math.random() * 256) + ', ' +
                Math.floor(Math.random() * 256) + ', 0.5)';
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
@endsection
