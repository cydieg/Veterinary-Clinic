@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create New User')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Superadmin Dashboard - Weekly Report</title>
</head>
<body>
    <h2>Weekly Report ({{ \Carbon\Carbon::now()->startOfWeek()->format('Y-m-d') }} to {{ \Carbon\Carbon::now()->endOfWeek()->format('Y-m-d') }})</h2>
    <h3>Total Sales: ${{ $totalSales }}</h3>
    <h4>Delivered Sales:</h4>
    <ul>
        @foreach($deliveredSales as $sale)
            <li>{{ $sale->id }} - {{ $sale->total_price }}</li>
        @endforeach
    </ul>
</body>
</html>
@endsection