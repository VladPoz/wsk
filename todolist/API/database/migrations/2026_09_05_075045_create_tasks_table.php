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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->string("title");
            $table->text("description")->nullable();
            $table->enum("type", ["single", "multiple"])->default("single");
            $table->integer('count')->default(1);
            $table->integer('count_completed')->default(0);
            $table->enum("priority", ['low', 'medium', 'high'])->default('low');
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
