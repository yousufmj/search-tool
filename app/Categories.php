<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['name'];

    public function business()
    {
        return $this->belongsToMany('\App\Business', 'business_categories');
    }
}
