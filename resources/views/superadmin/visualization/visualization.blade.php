<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualization</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Visualization</h1>

        <h2>Number of Users Registered to Each Branch</h2>
        <ul>
            @foreach($usersPerBranch as $userCount)
                <li>Branch ID: {{ $userCount->branch_id }}, Total Users: {{ $userCount->total }}</li>
            @endforeach
        </ul>

        <h2>Select Data to Visualize:</h2>
        <select id="dataSelect">
            <option value="region">Region</option>
            <option value="province">Province</option>
            <option value="city">City</option>
            <option value="barangay">Barangay</option>
            <option value="address">Address</option>
        </select>

        <canvas id="chartCanvas" width="400" height="400"></canvas>
    </div>

    <script>
        // Parse the data from PHP to JavaScript
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
    </script>
</body>
</html>
