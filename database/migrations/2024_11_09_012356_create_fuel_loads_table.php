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
        Schema::create('fuel_loads', function (Blueprint $table) {
            $table->id();
            $table->string('folio')->unique();
            $table->unsignedBigInteger('truck_id');
            $table->decimal('total_cost', 10, 2);
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('truck_id')->references('id')->on('trucks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_loads');
    }
};
