@extends('layouts.admin')

@section('content')
<header>
    <div class="logo">
        <div class="logo-circle">
            <img src="{{ asset('images/jgab_logo3.png') }}" alt="JGAB Express Logo">
        </div>
        <div class="logo-text">
            <h1>Warehouse Management</h1>
            <p>Efficient Stock and Order Handling</p>
        </div>
    </div>
    <nav>
        <a href="{{ route('admin.orders.index') }}" class="search-btn">Orders</a>
        <a href="{{ route('admin.orders.delivered') }}" class="search-btn">Delivered</a>
    </nav>
</header>

<section class="content">
    <h1>Manage Warehouses</h1>
    <a href="{{ route('admin.warehouses.create') }}" class="search-btn">Add New Warehouse</a>

    <table class="order-table">
        <thead>
            <tr>
                <th>Warehouse Name</th>
                <th>Location</th>
                <th>Manager</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($warehouses as $warehouse)
            <tr>
                <td>{{ $warehouse->name }}</td>
                <td>{{ $warehouse->location }}</td>
                <td>{{ $warehouse->manager }}</td>
                <td>{{ $warehouse->contact }}</td>
                <td>
                    <a href="{{ route('admin.warehouses.edit', $warehouse->id) }}" class="search-btn">Edit</a>
                    <form action="{{ route('admin.warehouses.destroy', $warehouse->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="search-btn" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
@endsection
