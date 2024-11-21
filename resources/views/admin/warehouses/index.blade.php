@extends('layouts.app')

@section('content')
    <h1>Warehouses</h1>

    <a href="{{ route('admin.warehouses.create') }}" class="btn btn-primary">Add Warehouse</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($warehouses as $warehouse)
                <tr>
                    <td>{{ $warehouse->id }}</td>
                    <td>{{ $warehouse->name }}</td>
                    <td>{{ $warehouse->location }}</td>
                    <td>
                        <a href="{{ route('admin.warehouses.edit', $warehouse) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.warehouses.destroy', $warehouse) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
