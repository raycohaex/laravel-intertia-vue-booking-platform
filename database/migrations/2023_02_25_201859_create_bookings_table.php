<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        /**
         * bookings table for storing accommodation bookings and stripe session ids
         */
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('accommodation_id')->constrained();
            $table->date('check_in');
            $table->date('check_out');
            $table->string('status');
            $table->string('stripe_session_id');
            $table->decimal('amount', 6, 2);
            $table->decimal('amount_paid', 6, 2);
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
        Schema::dropIfExists('bookings');
    }
};
