<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // Import Authenticatable class
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuperAdmin extends Authenticatable  // Extend Authenticatable
{
    use HasFactory;

    // Optional: if you need custom attributes like 'role', define them
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    // Optional: If you want to protect sensitive attributes, e.g., password, use 'hidden'
    protected $hidden = [
        'password',
    ];
}
