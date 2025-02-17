<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'travel_id',
        'seat_number',
        'purchase_date',
        'purchase_time',
        'booking_status',
        'price',
        'quantity',
        'special_requests',
        'is_active',
        'note',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }
}
