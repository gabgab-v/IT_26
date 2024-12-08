@extends('layouts.admin')

@section('content')
    <h1>Edit Location Fee</h1>
    <form action="{{ route('location-fees.update', $location->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Location Name:</label>
            <input type="text" name="name" id="name" value="{{ $location->name }}" required>
        </div>
        <div>
            <label for="fee">Fee:</label>
            <input type="number" name="fee" id="fee" step="0.01" value="{{ $location->fee }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
