<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'person_id',
        'role_id',
        'email',
        'email_verified_at',
        'password',
        'is_logged_in',
        'logged_in_at',
        'logged_out_at',
        'is_active',
        'remember_token',
        'comments',
        'full_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the role associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(Rol::class, 'role_id');
    }

    /**
     * Get the person associated with the user.
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
