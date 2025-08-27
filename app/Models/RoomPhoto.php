<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomPhoto extends Model
{
    protected $fillable = [
        'room_id', 'photo_path', 'category',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
