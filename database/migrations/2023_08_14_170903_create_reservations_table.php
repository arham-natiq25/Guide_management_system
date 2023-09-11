<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('trip_id');
            $table->unsignedBigInteger('user_id');
            $table->string('date');
            $table->string('total_persons');
            $table->string('referred')->nullable();
            $table->string('host')->nullable();
            $table->integer('guide_id');
            $table->boolean('int_customer')->default(0);
            $table->string('fname');
            $table->string('lname');
            $table->string('phone');
            $table->text('notes')->nullable();
            $table->boolean('automated_payment')->default(0);
            $table->boolean('return_customer')->default(0);
            $table->boolean('private_water')->default(0);
            $table->boolean('request_guide')->default(0);
            $table->boolean('complete_address')->default(0);
            $table->boolean('repeat_request')->default(0);
            $table->double('calculate_price')->default(0);
            $table->boolean('special_rate')->default(0);
            $table->double('rod_price')->default(0);
            $table->double('special_price')->nullable();
            $table->double('tax')->default(0);
            $table->double('total_fee')->default(0);
            $table->boolean('email_to_guest')->default(0);
            $table->boolean('email_to_guide')->default(0);
            $table->boolean('customer_details_text')->default(0);
            $table->boolean('guide_details_text')->default(0);
            $table->boolean('custom_customer_text')->default(0);
            $table->boolean('custom_guide_text')->default(0);
            $table->string('meeting_time')->nullable();
            $table->integer('location_id');
            $table->boolean('upcoming_reservation')->nullable();
            $table->boolean('archieved_reservation')->nullable();
            $table->boolean('cancelled_reservation')->nullable();
            $table->string('created_by');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
