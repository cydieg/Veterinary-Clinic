@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Clinics</title>
</head>
<body>
    <div class="card-box mb-30">
        <div class="table-responsive">
            <h2 class="h4 pd-20">View Clinics</h2>

            <!-- Button to go back to /create-clinic -->
            <a href="{{ route('clinic.create.form') }}" class="btn btn-primary mb-3">Add New Clinic</a>

            @if(isset($clinics) && count($clinics) > 0)
                <table class="table nowrap">
                    <thead>
                        <tr>     
                            <th>Name</th>
                            <th>Location</th>
                            <th>Contact Number</th>
                            <th>Status</th>
                            <th>Doctor Name</th> <!-- Display Doctor Name -->
                            <th>Action</th> <!-- New column for actions -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clinics as $clinic)
                            <tr>
                                <td class="table-plus">{{ $clinic->name }}</td>
                                <td>{{ $clinic->location }}</td>
                                <td>{{ $clinic->contact }}</td>
                                <td>{{ $clinic->status }}</td>
                                <td>{{ $clinic->doctor_name }}</td> <!-- Display Doctor Name -->
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" type="button" id="dropdownMenuButton{{ $clinic->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="dw dw-more"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $clinic->id }}">
                                            <button class="dropdown-item" type="button" onclick="window.location='{{ route('clinic.edit', $clinic->id) }}'"><i class="dw dw-edit2"></i> Edit</button>

                                            <form method="POST" action="{{ route('clinic.archive', $clinic->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item"><i class="dw dw-delete-3"></i> Archive</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No clinics found.</p>
            @endif
        </div>
    </div>
</body>
@endsection
