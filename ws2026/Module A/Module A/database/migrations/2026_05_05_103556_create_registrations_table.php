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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('participant_id')->constrained('participants')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->enum('status', ['CONFIRMED', 'PENDING', 'CANCELLED'])->default('PENDING');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
