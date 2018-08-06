<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_history extends Model
{
    protected $fillable = ['session_id', 'search_term', 'result_count'];
}
