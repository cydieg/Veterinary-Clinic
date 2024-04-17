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
                            @foreach ($ratings as $rating)
                                <div class="mb-3">
                                    @if (!$imageDisplayed)
                                        <img src="{{ asset('images/' . $rating->sale->product->image) }}" alt="{{ $rating->sale->product->name }}" style="max-width: 100px;">
                                        <br>
                                        
                                        <br>
                                        Total Percentage: {{ $totalPercentage }}%
                                        <br>
                                        @php $imageDisplayed = true; @endphp
                                   @endif
                                
                                    <hr>
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
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
