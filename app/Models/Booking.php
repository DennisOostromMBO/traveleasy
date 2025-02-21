<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'travel_id',
        'departure_country',
        'destination_country',
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

    public function departure()
    {
        return $this->belongsTo(Travel::class, 'departure_country');
    }

    public function destination()
    {
        return $this->belongsTo(Travel::class, 'destination_country');
    }

    public function getAllBookings()
    {
        return DB::select('CALL GetAllBookings()');
    }
}
