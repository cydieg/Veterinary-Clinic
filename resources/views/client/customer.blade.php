@extends('back.layout.ecom-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Make an Appointment')

@section('content')
<div class="col-md-7 col-lg-6 col-xl-5 mx-auto">
    <div class="card">
        <div class="card-body">
            <h2 class="text-center mb-4">Make an Appointment</h2>

            <!-- Display success or error message -->
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                    @if(session('status') == 'pending')
                        Please wait for a notification in your email.
                    @endif
                </div>
            @elseif(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('appointments.store') }}" method="post" class="bg-light p-4 rounded">
                @csrf
                <div class="form-group">
                    <label for="service_type">Service Type:</label>
                    <select name="service_type" id="service_type" class="form-control" required onchange="toggleCheckOutDate()">
                        <option value="Grooming">Grooming</option>
                        <option value="Pet Hotel">Pet Hotel</option>                        
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="appointment_date">Reservation Date:</label>
                    <input type="date" name="appointment_date" id="appointment_date" class="form-control" value="{{ $selectedDate }}" min="{{ $selectedDate }}" required>
                </div>

                <div class="form-group" id="check_out_date_group" style="display: none;">
                    <label for="check_out_date">Check Out Date:</label>
                    <input type="date" name="check_out_date" id="check_out_date" class="form-control" value="{{ old('check_out_date') }}">
                </div>

                <div class="form-group">
                    <label for="branch_id">Select Branch:</label>
                    <select name="branch_id" class="form-control" required>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="pet_name">Pet Name:</label>
                    <input type="text" name="pet_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="animal_type">Animal Type:</label>
                    <select name="animal_type" id="animal_type" class="form-control" required onchange="updateBreedOptions()">
                        <option value="Dog">Dog</option>
                        <option value="Cat">Cat</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="breed">Breed:</label>
                    <select name="breed" id="breed" class="form-control" required>
                        <!-- Options will be populated dynamically based on the selected animal type -->
                    </select>
                </div>
                
                <!-- Size selection for Pet Hotel -->
                <div id="size_selection" style="display: none;">
                    <div class="form-group">
                        <label for="size">Size:</label>
                        <select name="size" id="size" class="form-control" onchange="updatePrice()">
                            <option value="Select">Select Size</option>
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>
                </div>
                
                <!-- Display price based on selected size -->
                <div id="price_display" style="display: none;">
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" id="price" class="form-control" readonly>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-info btn-block">Request Reservation</button>
            </form>
        </div>
    </div>
</div>

<script>
    function updateBreedOptions() {
        var animalType = document.getElementById('animal_type').value;
        var breedSelect = document.getElementById('breed');
        breedSelect.innerHTML = ''; // Clear previous options

        // Define breed options based on animal type
        var breedOptions = {};
        breedOptions['Dog'] = ['Shih Tzu', 'Poodle', 'Pomeranian'];
        breedOptions['Cat'] = ['Persian', 'Siamese', 'Maine Coon'];
        // Add more breeds for other animal types if needed

        // Populate breed select options based on selected animal type
        for (var i = 0; i < breedOptions[animalType].length; i++) {
            var option = document.createElement('option');
            option.text = breedOptions[animalType][i];
            option.value = breedOptions[animalType][i];
            breedSelect.add(option);
        }
    }

    // Call the function initially to populate breed options based on the default animal type
    updateBreedOptions();

    function toggleCheckOutDate() {
        var serviceType = document.getElementById('service_type').value;
        var checkOutDateGroup = document.getElementById('check_out_date_group');
        var checkOutDateInput = document.getElementById('check_out_date');
        var sizeSelection = document.getElementById('size_selection');

        if (serviceType === 'Pet Hotel') {
            checkOutDateGroup.style.display = 'block';
            checkOutDateInput.setAttribute('required', 'required');
            sizeSelection.style.display = 'block'; // Show size selection
        } else {
            checkOutDateGroup.style.display = 'none';
            checkOutDateInput.removeAttribute('required');
            sizeSelection.style.display = 'none'; // Hide size selection
        }
    }

    function updatePrice() {
        var size = document.getElementById('size').value;
        var priceDisplay = document.getElementById('price_display');
        var priceInput = document.getElementById('price');

        // Calculate price based on size
        var price = 0;
        switch (size) {
            case 'small':
                price = 250;
                break;
            case 'medium':
                price = 300;
                break;
            case 'large':
                price = 400;
                break;
        }

        // Display the calculated price
        priceInput.value = price + ' peso';
        priceDisplay.style.display = 'block';
    }
</script>

@endsection
