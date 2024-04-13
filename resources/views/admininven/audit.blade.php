@extends('back.layout.main-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vet')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Records</title>
    <style>
        .custom-bg-color {
            background-color: #BC7FCD;
            font-size: 20px;
            color: white;
            padding: 10px;
            margin-bottom: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container p-3 my-3 custom-bg-color text-white">Audit Records for Product</div>
    @if ($auditRecords->isEmpty())
        <p>No audit records found for this product.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>UPC</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Old Quantity</th>
                    <th>New Quantity</th>
                    <th>Total Quantity</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($auditRecords as $auditRecord)
                    <tr>
                        <td>{{ $auditRecord->created_at }}</td>
                        <td>{{ $auditRecord->upc }}</td>
                        <td>{{ $auditRecord->name }}</td>
                        <td>{{ $auditRecord->description }}</td>
                        <td>{{ $auditRecord->old_quantity }}</td>
                        <td>{{ $auditRecord->quantity }}</td>
                        <td>{{ $auditRecord->old_quantity + $auditRecord->quantity }}</td>
                        <td>{{ ucfirst($auditRecord->type) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
</body>
</html>
@endsection