@extends('layouts.app')

@section('content')
    <h1>Create Warehouse</h1>

    <form action="{{ route('admin.warehouses.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label for="location">Location:</label>
            <input type="text" name="location" required>
        </div>
        <button type="submit">Save</button>
    </form>
@endsection
