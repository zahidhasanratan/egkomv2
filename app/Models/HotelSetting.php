<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelSetting extends Model
{
    use HasFactory;

    // Define the table name (if it's different from the default)
    protected $table = 'hotel_settings';

    // Define the fillable attributes
    protected $fillable = [
        'hotel_name',
        'hotel_logo',
        'hotel_address',
        'email',
        'phone',
        'copyright',
    ];
}
