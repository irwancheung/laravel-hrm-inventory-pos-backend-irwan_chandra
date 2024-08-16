<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // get fillable property name from migration file
    protected $fillable = [
        'name',
        'email',
        'phone',
        'website',
        'logo',
        'address',
        'status',
        'total_users',
        'clock_in_time',
        'clock_out_time',
        'early_clock_in_time',
        'allow_clock_out_until',
        'self_clocking',
    ];
}
