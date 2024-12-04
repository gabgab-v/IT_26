<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id', 
        'total_price', 
        'status', 
        'order_number', 
        'cancel_reason', 
        'is_archived', 
        'warehouse_id', 
        'current_location', // for the location of warehouse
        'parcel_location', //for parcel
        'date_ordered', 
        'estimated_date_of_arrival', 
        'duration_of_order', 
        'weight', 
        'is_delivered',
        'duration_of_order',
        'delivered_at',
    ];

    protected $casts = [
        'date_ordered' => 'datetime',
        'delivered_at' => 'datetime',
        'estimated_date_of_arrival' => 'datetime',
    ];
    
    
    

    public static function boot()
    {
        parent::boot();

        // Automatically generate the order number when an order is created
        static::creating(function ($order) {
            $order->order_number = self::generateOrderNumber();
            $order->date_ordered = now(); // Automatically set the date ordered when created
        });
    }

    // Method to generate unique order number
    public static function generateOrderNumber()
    {
        do {
            // Generate a random alphanumeric string or number
            $orderNumber = 'JGAB-' . strtoupper(uniqid());
        } while (self::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class); // Adjust the class name and namespace as needed
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function parcelLocations()
    {
        return $this->hasMany(ParcelLocation::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    // If you want to calculate it dynamically in PHP instead of relying on the trigger:
    public function getDurationAttribute()
    {
        // Use delivered_at if available, otherwise use the current time
        $end = $this->delivered_at ?? now();
    
        // Ensure the order has a creation date
        if ($this->created_at) {
            return $this->created_at->diffForHumans($end, true); // Human-readable duration
        }
    
        return null;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



}
