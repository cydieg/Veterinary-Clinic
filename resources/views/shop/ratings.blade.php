<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Us</title>
    <!-- Include Font Awesome for star icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Include your CSS files here -->
    <style>
        .rating-container {
            display: inline-block;
        }
        .rating-container .star {
            color: goldenrod;
            cursor: pointer;
        }
        .rating-container .star:hover,
        .rating-container .star:hover ~ .star {
            color: #ffc107;
        }
        .rating-container .star.checked {
            color: #ffc107;
        }
    </style>
</head>
<body>

<h1>Rate {{ $sale->product->name }}</h1>

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
<img src="{{ asset('images/' . $sale->product->image) }}" alt="{{ $sale->product->name }}">

<form action="{{ route('ratings.store') }}" method="POST">
    @csrf
    <input type="hidden" name="sale_id" value="{{ $sale->id }}">
    <!-- Input for rating (1 to 6 stars) -->
    <div class="form-group">
        <label for="rating">Rating:</label>
        <div class="rating-container">
            @for($i = 1; $i <= 6; $i++)
                <i class="star far fa-star" data-rating="{{ $i }}"></i>
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

<!-- Include your JavaScript files here -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stars = document.querySelectorAll(".star");
        const ratingInput = document.getElementById("rating");

        stars.forEach(star => {
            star.addEventListener("click", function() {
                const ratingValue = this.getAttribute("data-rating");
                ratingInput.value = ratingValue;
                stars.forEach(s => {
                    if (parseInt(s.getAttribute("data-rating")) <= ratingValue) {
                        s.classList.add("checked");
                    } else {
                        s.classList.remove("checked");
                    }
                });
            });
        });
    });
</script>

</body>
</html>
