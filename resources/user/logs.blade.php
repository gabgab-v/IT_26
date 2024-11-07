@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Your Search Logs</h2>
    <table>
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->order_number }}</td>
                    <td>{{ $log->searched_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
