<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationFee extends Model
{
    use HasFactory;

    protected $fillable = ['location_name', 'fee'];
}
