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
        Schema::create('community_user_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('community_default_tasks_id')->constrained('community_default_tasks');
            $table->foreignId('community_task_id')->constrained('community_tasks');
            $table->foreignId('task_status_id')->constrained('task_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_user_tasks');
    }
};
