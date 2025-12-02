<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class CoHost extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'hotel_id',
        'vendor_id',
        'name',
        'email',
        'phone',
        'photo',
        'password',
        'bio',
        'language',
        'response_rate',
        'response_time',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
