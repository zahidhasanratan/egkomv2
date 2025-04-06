<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'name',
        'phone_number',
        'ownership_type',
        'trade_license',
        'bin',
        'tin',
        'nid_number',
        'date_of_birth',
        'passport_number',
        'present_address',
        'permanent_address',
        'property_ownership',
        'partner_name',
        'partner_contact',
        'partner_details',
        'lease_start_date',
        'lease_end_date',
        'facebook_link',
        'website_link',
        'nid_front_image',
        'nid_back_image',
        'status'
    ];
}
