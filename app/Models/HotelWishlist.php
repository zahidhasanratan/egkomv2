<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelWishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'hotel_id',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
