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
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('text');
            $table->enum('status', ['published', 'moderation','declined'])->default('moderation');
            $table->integer('price');
            $table->integer('views_count')->default(0);
            $table->foreignId('category_id')->constrained('categories')
                ->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->json('photos');
            $table->json('paid_services')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adverts');
    }
};
