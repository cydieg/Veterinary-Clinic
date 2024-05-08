@extends('back.layout.cashier-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
    <h1>Delivery Fee Settings</h1>

    <!-- Display success message if it exists -->
    @if (session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <!-- Your form for inserting the content here -->
    <form method="POST" action="{{ route('save_fee') }}">
        @csrf
        <label for="branch_id">Branch ID:</label>
        <input type="text" name="branch_id" id="branch_id" value="{{ $branchId }}" readonly>
        <br>
        <label for="barangay">Barangay:</label>
        <input type="text" name="barangay" id="barangay">
        <br>
        <label for="delivering_fee">Delivering Fee:</label>
        <input type="text" name="delivering_fee" id="delivering_fee">
        <br>
        <button type="submit">Save</button>
    </form>

    <!-- Table to display fee data -->
    <table border="1">
        <thead>
            <tr>
                <th>Branch ID</th>
                <th>Barangay</th>
                <th>Delivering Fee</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fees as $fee)
                <tr>
                    <td>{{ $fee->branch_id }}</td>
                    <td>{{ $fee->barangay }}</td>
                    <td>{{ $fee->delivering_fee }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
