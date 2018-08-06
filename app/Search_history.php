<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search_history extends Model
{
    protected $fillable = ['count', 'search_term'];
}
