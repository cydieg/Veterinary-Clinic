<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit View</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Audit View</h2>
        <table class="table table-bordered mt-3">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Type</th> <!-- Add this line for the 'Type' column -->
                    <th>Created At</th>
                    <th>UPC</th>
                </tr>
            </thead>
            <tbody>
                @if($auditRecords->isNotEmpty())
                    @foreach($auditRecords as $record)
                        <tr>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->description }}</td>
                            <td>{{ $record->quantity }}</td>
                            <td>&#8369;{{ number_format($record->inventory->price, 2) }}</td>
                            <td>&#8369;{{ number_format($record->inventory->price * $record->quantity, 2) }}</td>
                            <td>{{ $record->type }}</td> <!-- Display the 'type' column -->
                            <td>{{ $record->created_at }}</td>
                            <td>{{ $record->upc }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10">No audit records found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <!-- Link Bootstrap JS (Optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
