@extends('back.layout.main-layout')
@section('pageTitle', 'Add Product')
@section('content')
<style>
    .custom-bg-color {
        background-color: #BC7FCD;
        font-size: 20px;
    }
</style>
<div class="container p-3 my-3 custom-bg-color text-white">Add Product</div>
<div class="container">
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
            <label for="subcategory">Subcategory:</label> <!-- Add this block -->
            <input type="text" class="form-control" id="subcategory" name="subcategory" required>
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

        <div class="row">
            <div class="col-md-12 mb-3 text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
