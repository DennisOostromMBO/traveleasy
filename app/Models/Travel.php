<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $table = 'travels';

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function departure()
    {
        return $this->belongsTo(Departure::class, 'departure_id');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }
}