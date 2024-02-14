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
        Schema::create('container_seed', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('seed_id');
            $table->unsignedBiginteger('container_id');
            
            $table->foreign('container_id')->references('id')->on('containers')->onDelete('cascade');
            $table->foreign('seed_id')->references('id')->on('seeds')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('container_seed');
    }
};
