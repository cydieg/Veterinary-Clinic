<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Us</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Your custom CSS -->
    <style>
        .rating-container {
            display: inline-block;
        }
        .rating-container .star {
            color: goldenrod;
            cursor: pointer;
            font-size: 24px; /* Adjust the size as needed */
        }
        .rating-container .star.filled {
            color: #ffc107; /* Filled star color */
        }
        .custom-card {
            border: 2px solid black;
        }
        .custom-bg-color {
            background-color: #BC7FCD;
            font-size: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="card custom-card">
        <div class="container p-3 custom-bg-color text-white">Rate {{ $sale->product->name }}</div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Display the product image -->
            <img src="{{ asset('images/' . $sale->product->image) }}" alt="{{ $sale->product->name }}" class="img-fluid mb-3">

            <form action="{{ route('ratings.store') }}" method="POST">
                @csrf
                <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                <!-- Input for rating (1 to 5 stars) -->
                <div class="form-group">
                    <label for="rating">Rating:</label>
                    <div class="rating-container">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="star" data-rating="{{ $i }}">&#9734;</span>
                        @endfor
                        <input type="hidden" name="rating" id="rating" value="0">
                    </div>
                </div>

                <!-- Input for comment -->
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit Rating</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS, jQuery, and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Your custom JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stars = document.querySelectorAll(".star");
        const ratingInput = document.getElementById("rating");

        stars.forEach(star => {
            star.addEventListener("click", function() {
                const ratingValue = this.getAttribute("data-rating");
                ratingInput.value = ratingValue;
                stars.forEach((s, index) => {
                    if (parseInt(s.getAttribute("data-rating")) <= ratingValue) {
                        s.innerHTML = "&#9733;"; // Filled star
                    } else {
                        s.innerHTML = "&#9734;"; // Empty star
                    }
                });
            });
        });
    });
</script>

</body>
</html>
