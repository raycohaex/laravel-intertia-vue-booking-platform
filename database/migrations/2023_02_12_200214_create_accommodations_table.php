<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('city');
            $table->string('country');
            $table->double('latitude');
            $table->double('longitude');
            $table->boolean('wifi');
            $table->double('cleaning_cost')->nullable();
            $table->double('price');
            $table->integer('bed');
            $table->text('amenities')->nullable();
            $table->string('slug');
            $table->unsignedBigInteger('host_id');
            $table->foreign('host_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('accommodations');
    }
};
