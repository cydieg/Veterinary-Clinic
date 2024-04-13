@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div class="container p-3 my-3 custom-bg-color text-white">Inventory</div>
    <!-- Link Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Additional styling */
    .form-group {
        margin-bottom: 20px; /* Add some spacing between form groups */
    }
    .custom-bg-color {
        background-color: #BC7FCD;
        font-size: 20px;
    }
</style>
</head>
<body>
    <div class="container">
        <!-- Add Product button -->
        <a href="{{ route('admin.inventory.add') }}" class="btn btn-success mb-3">Add Product</a>

        
        <!-- Inventory table -->
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
                                <button type="submit" class="btn btn-danger btn-sm mr-2">Delete</button>
                            </form>
                            <a href="{{ route('admin.inventory.audit') }}" class="btn btn-primary btn-sm">Audit</a>
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
