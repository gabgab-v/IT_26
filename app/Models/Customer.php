<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'customers';

    // Specify the fillable attributes for mass assignment
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    // Define the relationship with orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
