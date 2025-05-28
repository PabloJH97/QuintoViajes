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
        Schema::create('flights', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('code');
            $table->foreignUuid('plane_id')->constrained(table:'planes', indexName: 'flight_id_plane')->cascadeOnDelete();
            $table->string('origin');
            $table->string('destination');
            $table->float('price');
            $table->string('seats');
            $table->date('date');
            $table->string('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
