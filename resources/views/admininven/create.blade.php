@extends('back.layout.main-layout')
@section('pageTitle', 'Add Product')
@section('content')

<div class="container">
    <h2>Add Product</h2>
    <form action="{{ route('admin.inventory.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" class="form-control" id="category" name="category" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="expiration">Expiration Date:</label>
            <input type="date" class="form-control" id="expiration" name="expiration">
        </div>
        <!-- Hidden input field for creation date -->
        <input type="hidden" name="created_at" value="{{ now() }}">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection
