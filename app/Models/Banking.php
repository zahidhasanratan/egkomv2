<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banking extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'payment_method',
        'account_number',
        'bank_name',
        'routing_number',
        'account_type',
        'bank_cheque_image',
        'bakshe_number',
        'nagad_number',
        'dutch_bangla_number',
        'status',
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
}
