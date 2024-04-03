@extends('back.layout.superadmin-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Branches</title>
</head>
<body>
    <div class="card-box mb-30">
        <div class="table-responsive">
            <h2 class="h4 pd-20">View Branches</h2>

            <!-- Button to go back to /create-branch -->
            <a href="{{ route('branch.create.form') }}" class="btn btn-primary mb-3">Add New Branch</a>

            @if(isset($branches) && count($branches) > 0)
                <table class="table nowrap">
                    <thead>
                        <tr>     
                            <th>Name</th>
                            <th>Location</th>
                            <th>Contact Number</th>
                            <th>Status</th>
                            <th>Manager Name</th> <!-- Display Manager Name -->
                            <th>Action</th> <!-- New column for actions -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($branches as $branch)
                            <tr>
                                <td class="table-plus">{{ $branch->name }}</td>
                                <td>{{ $branch->location }}</td>
                                <td>{{ $branch->contact }}</td>
                                <td>{{ $branch->status }}</td>
                                <td>{{ $branch->manager_name }}</td> <!-- Display Manager Name -->
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" type="button" id="dropdownMenuButton{{ $branch->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="dw dw-more"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $branch->id }}">
                                            <button class="dropdown-item" type="button" onclick="window.location='{{ route('branch.edit', $branch->id) }}'"><i class="dw dw-edit2"></i> Edit</button>

                                            <form method="POST" action="{{ route('branch.archive', $branch->id) }}">
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
                <p>No branches found.</p>
            @endif
        </div>
    </div>
</body>
@endsection
