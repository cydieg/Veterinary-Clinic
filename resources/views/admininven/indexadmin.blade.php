<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Inventory</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Admin Inventory</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Category</th>
                <th>Price</th>
                <th>Created At</th>
                <th>Branch</th> <!-- Updated column name from Clinic to Branch -->
                <th>Action</th>
                <th>Expiration</th>
                <th>UPC</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventoryItems as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td><img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}" style="max-width: 100px;"></td>
                    <td>{{ $item->category }}</td>
                    <td>&#8369;{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->branch->name }}</td> <!-- Updated relationship to branch -->
                    <td>
                        <form method="POST" action="{{ route('admin.inventory.delete', $item->id) }}" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                    <td>{{ $item->expiration }}</td>
                    <td>{{ $item->upc }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
