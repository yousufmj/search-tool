<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opening_hours extends Model
{
    protected $fillable = [
        'business_id',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'bank_holiday',
    ];
}
