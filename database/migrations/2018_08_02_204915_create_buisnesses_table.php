<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuisnessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Buisnesses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->string("trip_advisor");
            $table->string("location_quarter");
            $table->string("address1");
            $table->string("address2");
            $table->string("town");
            $table->string("postcode");
            $table->decimal('long', 10, 7);
            $table->decimal('lat', 10, 7);
            $table->integer("telephone");
            $table->string("website");
            $table->string("email");
            $table->string("facebook");
            $table->string("instagram");
            $table->string("twitter");
            $table->string("youtube");
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
        Schema::dropIfExists('Buisnesses');
    }
}
