<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Ratings</title>
    <style>
        .star-ratings span {
            color: #ffd700;
        }
        .user-comment-rating {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .comment-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ratings</div>

                    <div class="card-body">
                        @if ($ratings->isEmpty())
                            <p>No ratings available for this product.</p>
                        @else
                            @php $imageDisplayed = false; @endphp
                            @foreach ($ratings as $index => $rating)
                                <div class="mb-3">
                                    @if (!$imageDisplayed)
                                        <img src="{{ asset('images/' . $rating->sale->product->image) }}" alt="{{ $rating->sale->product->name }}" style="max-width: 100px;">
                                        <br>
                                        <span>{{ $rating->sale->product->name }}</span>
                                        <br>
                                        <br>
                                        Total Percentage: 
                                        <div class="star-ratings">
                                            @for ($i = 1; $i <= $totalPercentage / 20; $i++)
                                                <span>&#9733;</span>
                                            @endfor
                                        </div>
                                        <span>{{ $totalPercentage }}%</span>
                                        <br>
                                        @php $imageDisplayed = true; @endphp
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
                                                @for ($i = 1; $i <= $rating->rating; $i++)
                                                    <span>&#9733;</span>
                                                @endfor
                                            </div>
                                        </div>
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
</body>
</html>
