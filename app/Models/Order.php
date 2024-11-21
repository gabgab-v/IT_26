<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id', 'total_price', 'status', 'order_number', 'cancel_reason',
        'is_archived', 'warehouse_id',
        'current_location',
    ];

    public static function boot()
    {
        parent::boot();

        // Automatically generate the order number when an order is created
        static::creating(function ($order) {
            $order->order_number = self::generateOrderNumber();
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
}
