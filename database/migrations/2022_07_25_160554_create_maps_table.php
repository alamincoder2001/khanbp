<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Map;

class CreateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maps', function (Blueprint $table) {
            $table->id();
            $table->text('link');
            $table->timestamps();
        });
        // Create a default one
        $map = new Map();
        $map->link = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.338326674586!2d90.36699521429803!3d23.806565392546872!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c72d1a5bf2a9%3A0x25a0f9a592e96ad8!2sLink-Up%20Technology%20Ltd.!5e0!3m2!1sen!2sbd!4v1658576232072!5m2!1sen!2sbd'; 
        $map->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maps');
    }
}
