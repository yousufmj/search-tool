<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        "title",
        "description",
        "trip_advisor",
        "location_quarter",
        "address1",
        "address2",
        "town",
        "postcode",
        "long",
        "lat",
        "telephone",
        "website",
        "email",
        "facebook",
        "instagram",
        "twitter",
        "youtube",
    ];
}
