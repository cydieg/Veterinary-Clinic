<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Audit Log</title>
    <!-- Include any necessary CSS or styling -->
</head>
<body>
    <h1>Inventory Audit Log</h1>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>UPC</th>
                <th>Name</th>
                <th>Description</th>
                <th>Old Quantity</th>
                <th>New Quantity</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach($audits as $audit)
            <tr>
                <td>{{ $audit->created_at }}</td>
                <td>{{ $audit->upc }}</td>
                <td>{{ $audit->name }}</td>
                <td>{{ $audit->description }}</td>
                <td>{{ $audit->old_quantity }}</td>
                <td>{{ $audit->quantity }}</td>
                <td>{{ $audit->type }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Include any necessary JavaScript or additional HTML -->

</body>
</html>
