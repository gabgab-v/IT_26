@extends('layouts.admin')

@section('content')
    <h1>Pending Driver Registrations</h1>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>License</th>
                <th>Vehicle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drivers as $driver)
                <tr>
                    <td>{{ $driver->name }}</td>
                    <td>{{ $driver->email }}</td>
                    <td>{{ $driver->license }}</td>
                    <td>{{ $driver->vehicle }}</td>
                    <td>
                        <form action="{{ route('admin.drivers.approve', $driver->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit">Approve</button>
                        </form>
                        <form action="{{ route('admin.drivers.reject', $driver->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit">Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
