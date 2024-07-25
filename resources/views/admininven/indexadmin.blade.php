@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('pageTitle')</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional styling */
        .custom-bg-color {
            background-color: #BC7FCD;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="p-3 my-3 custom-bg-color text-white">Inventory</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Add Product button -->
                <a href="{{ route('admin.inventory.add') }}" class="btn btn-success mb-3">Add Product</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Inventory table -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Price</th>
                                <th>Created At</th>
                                <th>Branch</th>
                                <th>Expiration</th>
                                <th>UPC</th>
                                <th>Action</th>
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
                                    <td>{{ $item->subcategory }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->branch->name }}</td>
                                    <td>{{ $item->expiration }}</td>
                                    <td>{{ $item->upc }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-sm mb-2" data-toggle="modal" data-target="#quantityModal{{ $item->id }}">Add</button>
                                            <a href="{{ route('admin.inventory.audit', ['productId' => $item->id]) }}" class="btn btn-warning btn-sm mb-2">Audit</a>
                                            <form method="POST" action="{{ route('admin.inventory.delete', $item->id) }}" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mb-2">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Quantity Modal -->
                                <div class="modal fade" id="quantityModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="quantityModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="quantityModalLabel{{ $item->id }}">Add Quantity</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('admin.inventory.addQuantity', $item->id) }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="quantity">Quantity:</label>
                                                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Add</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Link Bootstrap JS (Optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
