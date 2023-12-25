<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_name',
        'penalty_for_day',
        'register_cost',
        'update_cost',
        'max_user_reserve'
    ];
}
