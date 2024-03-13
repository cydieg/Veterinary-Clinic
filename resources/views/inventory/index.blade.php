<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        /* Add your custom CSS styles here */
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-between mb-3">
            <div class="col-md-4">
                <!-- Button to open modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#clinicModal">
                    <i class="fas fa-hospital"></i> Select Clinic
                </button>
                <!-- Display selected clinic name -->
                <h4 id="selectedClinicName"></h4>
            </div>
            <div class="col-md-4 text-right">
                <!-- Button to add product -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">
                    <i class="fas fa-plus"></i> Add Product
                </button>
            </div>
        </div>

       <!-- Inventory table -->
       <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Category</th>
                <th>Price</th>
                <th>Created At</th>
                <th>Clinic</th>
                <th>Action</th>
                <th>Expiration</th>
            </tr>
        </thead>
        <tbody>
            <!-- Inventory items will be listed here -->
            @foreach($inventoryItems as $item)
            <tr data-clinic-id="{{ $item->clinic_id }}">
                <td>{{ $item->name }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->quantity }}</td>
                <td><img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}" style="max-width: 100px;"></td>
                <td>{{ $item->category }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->clinic->name }}</td>
                <td>
                    <!-- Update action to redirect to audit page -->
                    <a href="{{ route('inventory.audit.show', ['id' => $item->id]) }}" class="btn btn-primary">Audit</a>
                    <!-- Button to trigger quantity modal -->
                    <button type="button" class="btn btn-success add-quantity-btn" data-toggle="modal" data-target="#addQuantityModal" data-item-id="{{ $item->id }}">Add Quantity</button>
                </td>
                
                <td>{{ $item->expiration }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    

    <!-- Clinic Selection Modal -->
    <div class="modal fade" id="clinicModal" tabindex="-1" aria-labelledby="clinicModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clinicModalLabel">Select Clinic</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @foreach($clinics as $clinic)
                        <li class="list-group-item clinic-item" data-clinic-id="{{ $clinic->id }}">{{ $clinic->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product to Inventory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('inventory.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" id="category" name="category" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="created_at">Created At</label>
                            <input type="datetime-local" class="form-control" id="created_at" name="created_at" required>
                        </div>
                        <div class="form-group">
                            <label for="expiration">Expiration</label>
                            <input type="date" class="form-control" id="expiration" name="expiration" required>
                        </div>
                        <!-- Dropdown button for selecting clinic -->
                        <div class="form-group">
                            <label for="clinic">Clinic</label>
                            <select class="form-control" id="clinic" name="clinic_id" required>
                                @foreach($clinics as $clinic)
                                <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Quantity Modal -->
    <!-- Add Quantity Modal -->
<div class="modal fade" id="addQuantityModal" tabindex="-1" aria-labelledby="addQuantityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQuantityModalLabel">Add Quantity to Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addQuantityForm" method="POST" action="{{ route('inventory.addquantity', ['id' => ':id']) }}">
                    @csrf
                    <div class="form-group">
                        <label for="quantity">Quantity to Add</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Quantity</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <!-- Custom JS -->
    <script>
        $(document).ready(function () {
            // Handler for clinic selection
            $(".clinic-item").click(function () {
                var clinicId = $(this).data('clinic-id');
                $("#selectedClinicName").text($(this).text());
                filterInventoryByClinic(clinicId);
                $('#clinicModal').modal('hide');
            });

            // Function to filter inventory items by clinic
            function filterInventoryByClinic(clinicId) {
                // Hide all inventory items
                $('tbody tr').hide();

                // Show only inventory items for the selected clinic
                $('tbody tr[data-clinic-id="' + clinicId + '"]').show();
            }

            // Handler for clicking Add Quantity button
            $(".add-quantity-btn").click(function () {
                // Retrieve the item ID from the button data attribute
                var itemId = $(this).data('item-id');

                // Set the form action dynamically to include the item ID
                var formAction = "{{ route('inventory.addquantity', ['id' => ':id']) }}";
                formAction = formAction.replace(':id', itemId);
                $("#addQuantityForm").attr('action', formAction);
            });
        });
    </script>
</body>

</html>
