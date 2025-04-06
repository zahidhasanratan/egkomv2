<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Add this
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Authenticatable // Extend Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'hotel_name',
        'contact_person_name',
        'contact_person_dob',
        'contact_person_designation',
        'phone',
        'email',
        'address_house',
        'address_city',
        'address_district',
        'address_area',
        'address_landmark',
        'profile_picture',
        'logo',
        'hotel_pictures',
        'bank_check_picture',
        'nid',
        'trade_license_bin_tin',
        'bank_details',
        'password',
        'vendorId',
    ];

    protected $hidden = ['password', 'remember_token'];
}
