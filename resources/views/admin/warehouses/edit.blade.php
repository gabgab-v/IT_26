@extends('layouts.app')

@section('content')
    <h1>Edit Warehouse</h1>

    <form action="{{ route('admin.warehouses.update', $warehouse) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ $warehouse->name }}" required>
        </div>
        <div>
            <label for="location">Location:</label>
            <input type="text" name="location" value="{{ $warehouse->location }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
