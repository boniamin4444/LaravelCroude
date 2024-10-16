<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['coupon_code', 'expire_date', 'status', 'value'];

    protected $casts = [
        'expire_date' => 'datetime', // Cast expire_date to a Carbon instance
    ];
}
