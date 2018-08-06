<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string("trip_advisor")->nullable();
            $table->string("location_quarter")->nullable();
            $table->string("address1")->nullable();
            $table->string("address2")->nullable();
            $table->string("town")->nullable();
            $table->string("postcode")->nullable();
            $table->decimal('long', 10, 7)->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->string("telephone")->nullable();
            $table->string("website")->nullable();
            $table->string("email")->nullable();
            $table->string("facebook")->nullable();
            $table->string("instagram")->nullable();
            $table->string("twitter")->nullable();
            $table->string("youtube")->nullable();
            $table->string("monday")->nullable();
            $table->string("tuesday")->nullable();
            $table->string("wednesday")->nullable();
            $table->string("thursday")->nullable();
            $table->string("friday")->nullable();
            $table->string("saturday")->nullable();
            $table->string("sunday")->nullable();
            $table->string("bank_holiday")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}
