@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vet')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventory Item</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        .custom-bg-color {
        background-color: #BC7FCD;
        font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container p-3 my-3 custom-bg-color text-white">Edit Inventory Item</div>
    <div class="container">
        <!-- Edit form for inventory item -->
        <form method="POST" action="{{ route('inventory.update', ['id' => $inventoryItem->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $inventoryItem->name }}" required>
            </div>
    
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ $inventoryItem->description }}</textarea>
            </div>
    
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $inventoryItem->quantity }}" required>
            </div>
    
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
    
            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="Dog" {{ $inventoryItem->category == 'Dog' ? 'selected' : '' }}>Dog</option>
                    <option value="Cat" {{ $inventoryItem->category == 'Cat' ? 'selected' : '' }}>Cat</option>
                    <option value="Fish" {{ $inventoryItem->category == 'Fish' ? 'selected' : '' }}>Fish</option>
                    <option value="Bird" {{ $inventoryItem->category == 'Bird' ? 'selected' : '' }}>Bird</option>
                    <option value="Other" {{ $inventoryItem->category == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="subcategory">Subcategory:</label>
                <input type="text" class="form-control" id="subcategory" name="subcategory" value="{{ $inventoryItem->subcategory }}" required>
            </div>

            <div class="form-group">
                <label for="created_at">Created At:</label>
                <input type="datetime-local" class="form-control" id="created_at" name="created_at" value="{{ \Carbon\Carbon::parse($inventoryItem->created_at)->format('Y-m-d\TH:i') }}" required>
            </div>
            
            <div class="form-group">
                <label for="expiration">Expiration:</label>
                <input type="date" class="form-control" id="expiration" name="expiration" value="{{ $inventoryItem->expiration }}" required>
            </div>
    
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $inventoryItem->price }}" required>
            </div>

            <div class="form-group">
                <label for="branch">Branch:</label>
                <select class="form-control" id="branch" name="branch_id" required>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ $inventoryItem->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3 text-right">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <!-- Custom JS -->
    <script>
        // Your custom JavaScript code can go here
    </script>
</body>
</html>
@endsection
