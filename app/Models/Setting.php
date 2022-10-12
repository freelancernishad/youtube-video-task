<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'notice',
        'new_regitration',
        'refer_bonus',
        'a',
        'min_deposit',
    ];
}
