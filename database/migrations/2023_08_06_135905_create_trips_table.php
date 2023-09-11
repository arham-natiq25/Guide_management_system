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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('trip_name');
            $table->string('description');
            $table->string('image');
            $table->string('length');
            $table->boolean('lunch')->default(0);
            $table->string('start_time');
            $table->string('end_time');
            $table->string('days');
            $table->float('price_1_person');
            $table->float('price_2_person');
            $table->float('price_3_person');
            $table->float('price_4_person');
            $table->float('price_5_person');
            $table->float('price_6_person');
            $table->float('price_7_person');
            $table->float('price_8_person');
            $table->float('price_9_person');
            $table->string('period');
            $table->integer('display_order');
            $table->boolean('status')->default(0);
            $table->boolean('backend_only')->default(0);
            $table->boolean('tax')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
