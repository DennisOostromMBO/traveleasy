<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    use HasFactory;

    protected $table = 'communications';  // Als de tabelnaam anders is dan de standaard

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'persons_id'); // Pas de sleutel aan indien nodig
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
