@extends('layouts.admin')

@section('content')
    <h1>Add Location Fee</h1>
    <form action="{{ route('admin.location-fees.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Location Name:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="fee">Fee:</label>
            <input type="number" name="fee" id="fee" step="0.01" required>
        </div>
        <button type="submit">Add</button>
    </form>
@endsection
