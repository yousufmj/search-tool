<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business_times extends Model
{
    protected $fillable = ['business_id', 'category_id'];

    public function businesses()
    {
        return $this->belongsTo('App\Businesses');
    }

    public function openingHours()
    {
        return $this->belongsTo('App\Opening_hours');
    }

}
