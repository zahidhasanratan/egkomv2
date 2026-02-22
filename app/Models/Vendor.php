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
        'status',
        'vendorId',
        'password_reset_token',
        'password_reset_expires_at',
        'rejection_message',
    ];

    protected $hidden = ['password', 'remember_token'];

    /** Vendor approval: pending | approved | rejected */
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    public function isApproved(): bool
    {
        return ($this->status ?? '') === self::STATUS_APPROVED;
    }
    
    public function isRejected(): bool
    {
        return ($this->status ?? '') === self::STATUS_REJECTED;
    }
}
