<?php

use App\Business;
use App\Categories;
use Illuminate\Database\Seeder;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = File::get('database/seeds/fixtures/business.json');
        $json = json_decode($file, true);

        // clear rows and remove foreign key restrains
        DB::table('businesses')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('businesses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($json as $business => $details) {
            $data = array(
                "title" => $business,
                "description" => $details[0]['Body'],
                "trip_advisor" => $details[0]['Trip Advisor ID'],
                "location_quarter" => $details[0]['Quarter'],
                "address1" => $details[0]['Address Line 1'],
                "address2" => $details[0]['Address Line 2'],
                "town" => $details[0]['Town'],
                "postcode" => $details[0]['Postcode'],
                "long" => $details[0]['Longitude'],
                "lat" => $details[0]['Latitude'],
                "telephone" => $details[0]['Telephone Number'],
                "website" => $details[0]['Website'],
                "email" => $details[0]['Email Address'],
                "facebook" => $details[0]['Facebook'],
                "instagram" => $details[0]['Instagram'],
                "twitter" => $details[0]['Twitter'],
                "youtube" => $details[0]['Youtube'],
                "monday" => $details[0]['Monday Opening Times'],
                "tuesday" => $details[0]['Tuesday Opening Times'],
                "wednesday" => $details[0]['Wednesday Opening Times'],
                "thursday" => $details[0]['Thursday Opening Times'],
                "friday" => $details[0]['Friday Opening Times'],
                "saturday" => $details[0]['Thursday Opening Times'],
                "sunday" => $details[0]['Friday Opening Times'],
                "bank_holiday" => $details[0]['Bank Holiday Opening Times'],
            );

            $categories = $details[0]['Business Category'];

            $categoriesArray = array_map('trim', explode(',', $categories));

            $newCategories = [];
            foreach ($categoriesArray as $c) {
                $cat = Categories::where('name', $c)->first();

                array_push($newCategories, $cat['id']);
            }

            $create = Business::create($data);

            $create->categories()->attach($newCategories);

        }
    }
}
