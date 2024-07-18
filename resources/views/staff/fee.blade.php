@extends('back.layout.cashier-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
    <style>
        /* Additional styling */
        .table {
            margin-top: 20px; /* Add margin to the top of the table */
        }
        .table th,
        .table td {
            vertical-align: middle; /* Align content vertically in cells */
        }
        .action-buttons button {
            margin-right: 5px; /* Add some spacing between buttons */
            font-size: 12px; /* Adjust button font size */
        }
        .form-group {
            margin-bottom: 15px; /* Add some spacing between form groups */
        }
        .custom-bg-color {
            background-color: #BC7FCD;
            font-size: 20px;
        }
        .form-container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa;
        }
        .form-control {
            height: 40px;
        }
        .btn-primary {
            width: 100%;
        }
        .edit-modal .form-group {
            margin-bottom: 10px;
        }
    </style>

    <div class="container p-3 my-3 custom-bg-color text-white">Delivery Fee Settings</div>

    <!-- Display success message if it exists -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <!-- Form for inserting the content -->
            <div class="form-container">
                <form method="POST" action="{{ route('save_fee') }}">
                    @csrf
                    <div class="form-group">
                        <label for="branch_id">Branch ID:</label>
                        <input type="text" name="branch_id" id="branch_id" value="{{ $branchId }}" readonly class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="barangay">Barangay:</label>
                        <input type="text" name="barangay" id="barangay" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="delivering_fee">Delivering Fee:</label>
                        <input type="text" name="delivering_fee" id="delivering_fee" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <!-- Table to display fee data -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class ="container p-2 my-2 custom-bg-color text-white">Branch ID</th>
                        <th class ="container p-2 my-2 custom-bg-color text-white">Barangay</th>
                        <th class ="container p-2 my-2 custom-bg-color text-white">Delivering Fee</th>
                        <th class ="container p-2 my-2 custom-bg-color text-white">Actions</th> <!-- Add a new column for actions -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fees as $fee)
                        <tr>
                            <td>{{ $fee->branch_id }}</td>
                            <td>{{ $fee->barangay }}</td>
                            <td>{{ $fee->delivering_fee }}</td>
                            <td class="action-buttons">
                                <button class="btn btn-sm btn-success edit-btn" data-id="{{ $fee->id }}">Edit</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Modal for editing -->
    <div id="editModal" class="edit-modal" style="display: none;">
        <form id="editForm" method="POST" action="{{ route('update_fee') }}">
            @csrf
            @method('PUT')
            <input type="hidden" name="fee_id" id="editFeeId">
            <div class="form-group">
                <label for="editBarangay">Barangay:</label>
                <input type="text" name="edit_barangay" id="editBarangay" class="form-control">
            </div>
            <div class="form-group">
                <label for="editDeliveringFee">Delivering Fee:</label>
                <input type="text" name="edit_delivering_fee" id="editDeliveringFee" class="form-control">
            </div>
            <button type="submit" class="btn btn-sm btn-success edit-btn">Update</button>
            <button type="button" class="btn btn-sm btn-danger   edit-btn" onclick="closeModal()">Exit</button>
        </form>
    </div>

    <style>
        .edit-modal {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 30px;
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
                const barangay = this.parentElement.previousElementSibling.previousElementSibling.textContent;
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
