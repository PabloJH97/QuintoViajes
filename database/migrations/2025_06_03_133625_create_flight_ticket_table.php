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
        Schema::create('flight_ticket', function (Blueprint $table) {
            $table->uuid('id')->unique()->primary();
            $table->foreignUuid('flight_id')->constrained(table:'flights', indexName:'flight_id_flight_ticket');
            $table->foreignUuid('ticket_id')->constrained(table:'tickets', indexName: 'ticket_id_flight_ticket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_ticket');
    }
};
