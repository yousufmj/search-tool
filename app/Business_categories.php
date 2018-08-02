<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business_categories extends Model
{
    protected $fillable = ['business_id', 'category_id'];

    public function businesses()
    {
        return $this->belongsTo('App\Businesses');
    }

    public function categories()
    {
        return $this->belongsTo('App\Categories');
    }

}
