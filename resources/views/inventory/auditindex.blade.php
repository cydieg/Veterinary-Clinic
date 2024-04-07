@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vet')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div class="container p-3 my-3 custom-bg-color text-white">Inventory Audit Log</div>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include any necessary CSS or styling -->
    <style>
        .custom-bg-color {
        background-color: #BC7FCD;
        font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>UPC</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Old Quantity</th>
                    <th>New Quantity</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach($audits as $audit)
                <tr>
                    <td>{{ $audit->created_at }}</td>
                    <td>{{ $audit->upc }}</td>
                    <td>{{ $audit->name }}</td>
                    <td>{{ $audit->description }}</td>
                    <td>{{ $audit->old_quantity }}</td>
                    <td>{{ $audit->quantity }}</td>
                    <td>{{ $audit->type }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include any necessary JavaScript or additional HTML -->
</body>
</html>
@endsection
