<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buisnesses extends Model
{
    protected $fillable = [
        "trip_advisor",
        "location_quarter",
        "address1",
        "address2",
        "town",
        "postcode",
        "longitude",
        "latitude",
        "telephone",
        "website",
        "email",
        "facebook",
        "instagram",
        "twitter",
        "youtube",
        "date_created",
        "date_edited",
    ];
}
