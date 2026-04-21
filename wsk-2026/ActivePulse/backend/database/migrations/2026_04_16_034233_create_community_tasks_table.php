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
        Schema::create('community_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('community_id')->constrained('communities')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('name');
            $table->string('description');
            $table->integer('count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_tasks');
    }
};
