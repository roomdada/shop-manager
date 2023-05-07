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
        Schema::create('private_sales', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->unique();
            $table->integer('quantity');
            $table->integer('price');
            $table->foreignId('article_id')->constrained()->cascadeOnDelete();
            $table->timestamp('opening_date')->nullable();
            $table->timestamp('closing_date')->nullable();
            $table->boolean('disponibility')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('private_sales');
    }
};
