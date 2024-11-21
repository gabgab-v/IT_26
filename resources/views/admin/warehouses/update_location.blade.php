<form action="{{ route('admin.orders.update_location', $order->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <input type="text" name="current_location" placeholder="Enter new location" required>
    <button type="submit">Update Location</button>
</form>
