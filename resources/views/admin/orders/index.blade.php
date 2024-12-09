@extends('layouts.admin')

@section('content')
    <header>
        <div class="logo">
            <div class="logo-circle">
                <img src="{{ asset('images/jgab_logo3.png') }}" alt="JGAB Express Logo">
            </div>
            <div class="logo-text">
                <h1>JGAB Express</h1>
                <p>Stay Informed, Stay on Track</p>
            </div>
        </div>
        <nav>
            <a href="#">About Us</a>
            <a href="#">Services</a>
            <a href="{{ route('admin.orders.archived') }}" class="search-btn">Archived Orders</a>
            <a href="{{ route('admin.warehouses.index') }}" class="search-btn">Warehouse</a>
            <a href="{{ route('admin.orders.delivered') }}" class="search-btn">Delivered</a>
            <a href="{{ route('admin.location-fees.index') }}" class="btn btn-primary">Manage Location Fees</a>

        </nav>
    </header>

    <section class="content">
        <h1>Orders List</h1>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="search-btn">
                {{ __('Log Out') }}
            </button>
        </form>

        <form method="GET" action="{{ route('admin.orders.index') }}">
            <label for="date_ordered_from">Date From:</label>
            <input type="date" name="date_ordered_from" id="date_ordered_from" value="{{ request('date_ordered_from') }}">

            <label for="date_ordered_to">Date To:</label>
            <input type="date" name="date_ordered_to" id="date_ordered_to" value="{{ request('date_ordered_to') }}">

            <button type="submit" class="search-btn">Filter</button>
        </form>

        <a href="{{ route('admin.orders.create') }}" class="search-btn">Create New Order</a>

        <table class="order-table">
            <thead>
                <tr>
                    <th>Order Number</th>
                    <th>Customer</th>
                    <th>Base Total Price</th>
                    <th>Total Price (Including Fees)</th>
                    <th>Status</th>
                    <th>Duration</th>
                    <th>Warehouse</th>
                    <th>Parcel Location (Origin)</th>
                    <th>Destination</th>
                    <th>Fully Delivered</th>
                    <th>Driver</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ optional($order->user)->name ?? 'Anonymous' }}</td>
                    <td>₱{{ number_format($order->base_total_price, 2) }}</td>
                    <td>₱{{ number_format($order->total_price, 2) }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->duration ?? 'N/A' }}</td>
                    <td>{{ optional($order->warehouse)->name ?? 'No warehouse assigned' }}</td>
                    <td>{{ $order->parcel_location ?? 'No parcel location' }}</td>
                    <td>{{ $order->destination ?? 'No destination' }}</td>
                    <td>
                        {{ $order->is_fully_delivered ? 'Yes' : 'Pending Confirmation' }}
                    </td>
                    <td>
                        @if ($order->driver)
                            {{ $order->driver->name }}
                        @else
                            Not Assigned
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="search-btn">View</a>

                        @if ($order->status !== 'delivered')
                            <a href="{{ route('admin.orders.edit', $order->id) }}" class="search-btn">Edit</a>
                            @if ($order->status !== 'cancelled')
                                <!-- Cancel Order Button -->
                                <button class="btn btn-danger" onclick="showCancelModal({{ $order->id }})">Cancel Order</button>
                            @else
                                <span>Cancelled</span>
                            @endif
                        @endif

                        @if ($order->status === 'Pending')
                            <form action="{{ route('admin.orders.process', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="search-btn">Process Order</button>
                            </form>
                        @endif

                        {{-- Show Assign Driver dropdown only if no driver is assigned --}}
                        @if ($order->status === 'ready_for_shipping' && !$order->driver)
                            <form id="assignDriverForm-{{ $order->id }}" action="{{ route('admin.orders.assign_driver', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <label for="driver-{{ $order->id }}">Assign Driver:</label>
                                <select id="driver-{{ $order->id }}" name="driver_id" onchange="document.getElementById('assignDriverForm-{{ $order->id }}').submit();">
                                    <option value="">Select Driver</option>
                                    @foreach ($drivers as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        @endif

                        {{-- Show Confirm Fully Delivered button for delivered but not fully confirmed orders --}}
                        @if ($order->status === 'delivered' && !$order->is_fully_delivered)
                            <form action="{{ route('admin.orders.confirm_delivery', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="search-btn">Confirm Fully Delivered</button>
                            </form>
                        @endif
                    </td>

                    <!-- Modal for Cancel Order -->
                    <div id="cancelModal" style="display: none;">
                        <h2>Cancel Order</h2>
                        <form id="cancelForm" method="POST">
                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="cancel_reason" id="finalCancelReason"> <!-- For resolved reason -->
                            <input type="hidden" name="other_reason" id="otherReasonInputHidden"> <!-- To store the 'Other' reason -->

                            <!-- Radio Buttons -->
                            <label for="cancel_reason">Reason for Cancellation:</label>
                            <div>
                                <input type="radio" name="reason_option" value="Out of Stock" id="reason_out_of_stock"> Out of Stock<br>
                                <input type="radio" name="reason_option" value="Customer Request" id="reason_customer_request"> Customer Request<br>
                                <input type="radio" name="reason_option" value="Other" id="reason_other"> Other<br>
                            </div>

                            <!-- 'Other' Input -->
                            <div id="otherReasonContainer" style="display: none;">
                                <label for="other_reason">Specify Reason:</label>
                                <input type="text" id="otherReasonInput" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                            </div>

                            <button type="submit" class="btn btn-danger">Submit</button>
                            <button type="button" onclick="closeModal()" class="btn btn-secondary">Close</button>
                        </form>

                    </div>
                    




                </tr>
                @endforeach
            </tbody>
        </table>
    </section>



    <style>
        /* Add consistent styling from the main page */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #DBD3D3;
            color: #091057;
        }
        header {
            background-color: #091057;
            display: flex;
            justify-content: space-between;
            padding: 20px;
            align-items: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo-circle {
            width: 60px;
            height: 60px;
            background-color: #024CAA;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 15px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        }
        .logo-circle img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .logo-text h1 {
            font-size: 1.8em;
            margin-bottom: 5px;
            color: #ffffff;
        }
        .logo-text p {
            font-size: 0.9em;
            color: #ffffff;
            margin-top: -5px;
        }
        .content h1 {
            margin-top: 30px;
            color: #091057;
        }
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .order-table th, .order-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .order-table th {
            background-color: #024CAA;
            color: #ffffff;
        }
        .order-table tr:hover {
            background-color: #f1f1f1;
        }
        .search-btn {
            background-color: #024CAA;
            border: none;
            padding: 10px;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease, color 0.3s ease;
            margin-top: 10px;
            text-decoration: none;
        }
        .search-btn:hover {
            background-color: #EC8305;
            color: #ffffff;
        }
    </style>
    <!-- JavaScript for Assign Driver AJAX call -->
    <script>
        function assignDriver(orderId) {
            let form = document.getElementById(`assignDriverForm-${orderId}`);
            let formData = new FormData(form);

            fetch(form.action, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Driver assigned successfully');
                    location.reload();
                } else {
                    alert('Error assigning driver');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while assigning the driver.');
            });
        }

    </script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const radioOptions = document.querySelectorAll('input[name="reason_option"]');
        const otherReasonContainer = document.getElementById('otherReasonContainer');
        const otherReasonInput = document.getElementById('otherReasonInput');
        const finalCancelReason = document.getElementById('finalCancelReason');
        const cancelModal = document.getElementById('cancelModal');

        // Add change listeners to the radio buttons
        radioOptions.forEach((radio) => {
            radio.addEventListener('change', function () {
                if (this.value === 'Other') {
                    // Show the "Other" input field
                    otherReasonContainer.style.display = 'block';
                    otherReasonInput.focus();
                    finalCancelReason.value = ''; // Reset finalCancelReason
                } else {
                    // Hide the "Other" input field and update the hidden input value
                    otherReasonContainer.style.display = 'none';
                    finalCancelReason.value = this.value; // Set the reason
                    otherReasonInput.value = ''; // Clear "Other" input
                }
            });
        });

        // Update the hidden input when the "Other" reason is typed
        otherReasonInput.addEventListener('input', function () {
            if (document.getElementById('reason_other').checked) {
                finalCancelReason.value = this.value.trim();
            }
        });

        // Validate the form submission
        document.getElementById('cancelForm').addEventListener('submit', function (e) {
            const selectedReason = document.querySelector('input[name="reason_option"]:checked');
            if (!selectedReason || (selectedReason.value === 'Other' && !otherReasonInput.value.trim())) {
                alert('Please specify a reason for cancellation.');
                e.preventDefault(); // Prevent submission if no valid reason is provided
                return;
            }
        });
    });

    // Show modal and set form action dynamically
    function showCancelModal(orderId) {
        const form = document.getElementById('cancelForm');
        form.action = `/admin/orders/${orderId}/cancel`; // Set the dynamic action
        document.getElementById('cancelModal').style.display = 'block'; // Show the modal
        document.getElementById('modalOverlay').style.display = 'block'; // Show overlay for better UX
    }

    // Hide modal and reset input fields
    function closeModal() {
        document.getElementById('cancelModal').style.display = 'none'; // Hide the modal
        document.getElementById('modalOverlay').style.display = 'none'; // Hide overlay
        document.querySelectorAll('input[name="reason_option"]').forEach((radio) => (radio.checked = false)); // Reset radios
        document.getElementById('otherReasonInput').value = ''; // Clear the "Other" input
        document.getElementById('finalCancelReason').value = ''; // Reset the final reason
        document.getElementById('otherReasonContainer').style.display = 'none'; // Hide the "Other" field
    }



</script>

@endsection
