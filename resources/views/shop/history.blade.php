@extends('back.layout.ecom-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vet')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
    <!-- Include any CSS files or stylesheets here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 960px;
            margin: 50px auto;
            padding: 0 15px;
        }

        .card {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .card-body {
            padding: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #f7f7f7;
        }

        .table tbody tr:hover {
            background-color: #f2f2f2;
        }
        .custom-bg-color {
        background-color: #BC7FCD;
        font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="col-md-7 col-lg-8 col-xl-9">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="container p-3 my-3 custom-bg-color text-white">Purchase History</div>
                            @if($sales->isEmpty())
                                <p>You haven't made any purchases yet.</p>
                            @else
                    <table class="table mt-4 table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th> <!-- New column for the action button -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sales as $sale)
                                <tr>
                                    <td>{{ $sale->product->name }}</td>
                                    <td>{{ $sale->quantity }}</td>
                                    <td>₱{{ $sale->total_price }}</td>
                                    <td>{{ $sale->status }}</td>
                                    <td>
                                        @if($sale->status === 'delivered')
                                            <a href="{{ route('ratings.create', ['sale' => $sale->id]) }}" class="btn btn-primary">Rate Us Now</a>
                                         @endif
                                    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
