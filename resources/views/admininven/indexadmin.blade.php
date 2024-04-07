@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Inventory</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-3">Admin Inventory</h1>
        <table class="table table-bordered mt-3">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Created At</th>
                    <th>Branch</th>
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
                        <td>{{ $item->branch->name }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.inventory.delete', $item->id) }}" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                        <td>{{ $item->expiration }}</td>
                        <td>{{ $item->upc }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Link Bootstrap JS (Optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
