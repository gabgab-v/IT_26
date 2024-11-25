<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelLocation extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'location'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
