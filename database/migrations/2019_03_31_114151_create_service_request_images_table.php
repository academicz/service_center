<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequestImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_request_images', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('service_request_id')->unsigned();
            $table->string('image_path');
        });
        Schema::table('service_request_images', function (Blueprint $table) {
            $table->foreign('service_request_id')->references('id')->on('service_requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_request_images');
    }
}
