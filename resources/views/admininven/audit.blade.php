<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Records</title>
</head>
<body>
    <div class="container">
        <h2>Audit Records for Product</h2>
        @if ($auditRecords->isEmpty())
            <p>No audit records found for this product.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Old Quantity</th>
                        <th>New Quantity</th>
                        <th>Type</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auditRecords as $auditRecord)
                        <tr>
                            <td>{{ $auditRecord->old_quantity }}</td>
                            <td>{{ $auditRecord->quantity }}</td>
                            <td>{{ ucfirst($auditRecord->type) }}</td>
                            <td>{{ $auditRecord->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
