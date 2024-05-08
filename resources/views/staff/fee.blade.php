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
                <th>Actions</th> <!-- Add a new column for actions -->
            </tr>
        </thead>
        <tbody>
            @foreach ($fees as $fee)
                <tr>
                    <td>{{ $fee->branch_id }}</td>
                    <td>{{ $fee->barangay }}</td>
                    <td>{{ $fee->delivering_fee }}</td>
                    <td>
                        <button class="edit-btn" data-id="{{ $fee->id }}">Edit</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <!-- Modal for editing -->
    <div id="editModal" class="edit-modal" style="display: none;">
        <form id="editForm" method="POST" action="{{ route('update_fee') }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="fee_id" id="editFeeId">
            <label for="editBarangay">Barangay:</label>
            <input type="text" name="edit_barangay" id="editBarangay">
            <br>
            <label for="editDeliveringFee">Delivering Fee:</label>
            <input type="text" name="edit_delivering_fee" id="editDeliveringFee">
            <br>
            <button type="submit">Update</button>
            <button type="button" onclick="closeModal()">Exit</button>
        </form>
    </div>

    <style>
        .edit-modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
        }
    </style>

    <script>
        // Function to open the modal and populate with data
        function openModal(id, barangay, deliveringFee) {
            document.getElementById('editFeeId').value = id;
            document.getElementById('editBarangay').value = barangay;
            document.getElementById('editDeliveringFee').value = deliveringFee;
            document.getElementById('editModal').style.display = 'block';
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        // Attach click event listener to edit buttons
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const feeId = this.getAttribute('data-id');
                const barangay = this.parentElement.previousElementSibling.previousElementSibling
                    .textContent;
                const deliveringFee = this.parentElement.previousElementSibling.textContent;
                openModal(feeId, barangay, deliveringFee);
            });
        });

        // Hide modal after successful form submission
        document.getElementById('editForm').addEventListener('submit', function() {
            closeModal();
        });
    </script>
@endsection
