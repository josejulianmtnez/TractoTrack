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
        Schema::create('trucks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('flatbed_id')->nullable();
            $table->string('license_plate');
            $table->string('brand');
            $table->string('model');
            $table->string('year');
            $table->string('color');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('flatbed_id')->references('id')->on('flatbeds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trucks');
    }
};
