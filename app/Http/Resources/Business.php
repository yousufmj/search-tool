<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Business extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // customise categories to just show an array of names
        $categories = [];
        foreach ($this->categories as $c) {
            array_push($categories, $c->name);
        }

        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'trip_advisor' => $this->trip_advisor,
            'location_quarter' => $this->location_quarter,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'town' => $this->town,
            'postcode' => $this->postcode,
            'long' => $this->long,
            'lat' => $this->lat,
            'telephone' => $this->telephone,
            'website' => $this->website,
            'email' => $this->email,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'twitter' => $this->twitter,
            'youtube' => $this->youtube,
            'monday' => $this->monday,
            'tuesday' => $this->tuesday,
            'wednesday' => $this->wednesday,
            'thursday' => $this->thursday,
            'friday' => $this->friday,
            'saturday' => $this->saturday,
            'sunday' => $this->sunday,
            'bank_holiday' => $this->bank_holiday,
            'categories' => $categories,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
