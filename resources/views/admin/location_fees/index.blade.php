@extends('layouts.admin')

@section('content')
    <h1>Location Fees</h1>
    <a href="{{ route('admin.location-fees.create') }}" class="btn btn-primary">Add New Location Fee</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Fee</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $location)
                <tr>
                    <td>{{ $location->location_name }}</td>
                    <td>₱{{ number_format($location->fee, 2) }}</td>
                    <td>
                        <a href="{{ route('admin.location-fees.edit', $location->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.location-fees.destroy', $location->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
