<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'persons_id',
        'customer_number',
        'is_active',
        'note',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class, 'persons_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
