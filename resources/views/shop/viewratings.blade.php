<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Ratings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #BC7FCD;
            color: #fff;
            border-radius: 10px 10px 0 0;
            font-weight: bold;
        }
        .card-body {
            padding: 20px;
        }
        .product-info {
            margin-bottom: 20px;
        }
        .product-img {
            max-width: 100px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .star-ratings span {
            color: #ffd700;
        }
        .user-comment-rating {
            margin-top: 20px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        .comment-label {
            font-weight: bold;
            margin-top: 20px;
        }
        .back-button {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="back-button">
                    <a href="javascript:history.back()" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="card">
                    <div class="card-header">Ratings</div>
                    <div class="card-body">
                        <!-- Check if ratings are available -->
                        @if ($ratings->isEmpty())
                            <p>No ratings available for this product.</p>
                        @else
                            <!-- Loop through ratings -->
                            @foreach ($ratings as $index => $rating)
                                <div class="mb-3">
                                    <!-- Display product image and name once -->
                                    @if ($index === 0)
                                        <div class="product-info">
                                            <img src="{{ asset('images/' . $rating->sale->product->image) }}" alt="{{ $rating->sale->product->name }}" class="product-img">
                                            <br>
                                            <span>{{ $rating->sale->product->name }}</span>
                                            <br>
                                            <br>
                                            <!-- Calculate and display average star rating -->
                                            Average Rating: 
                                            <div class="star-ratings">
                                                @for ($i = 1; $i <= round($averageRating); $i++)
                                                    <span>&#9733;</span>
                                                @endfor
                                            </div>
                                            <span>{{ $averageRating }}</span>
                                            <br>
                                        </div>
                                    @endif
                                    
                                    <!-- Label for Comment Section, displayed only once -->
                                    @if ($index === 0)
                                        <div class="comment-label">Comment Section</div>
                                    @endif
                                    
                                    <!-- User's Comment and Rating Section -->
                                    <div class="user-comment-rating">
                                        <div>
                                            {{ $rating->user->firstName }} {{ $rating->user->lastName }}
                                            <br>
                                            Rating: 
                                            <div class="star-ratings">
                                                <!-- Display star ratings based on user's rating -->
                                                @for ($i = 1; $i <= $rating->rating; $i++)
                                                    <span>&#9733;</span>
                                                @endfor
                                            </div>
                                        </div>
                                        <!-- Display user's comment if available -->
                                        @if ($rating->comment)
                                            <div>
                                                Comment: {{ $rating->comment }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
