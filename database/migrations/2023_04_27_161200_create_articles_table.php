<?php

use App\Models\Kind;
use App\Models\Type;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id()->from(10000);
            $table->string('identifier')->unique()->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('first_image');
            $table->string('second_image')->nullable();
            $table->string('third_image')->nullable();
            $table->float('price')->nullable();
            $table->unsignedBigInteger('quantity');
            $table->json('color')->nullable();
            $table->text('description');
            $table->boolean('disponibility')->default(true);
            $table->string('size')->nullable();
            $table->string('weight')->nullable();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Brand::class)->constrained()->cascadeOnDelete();
            $table->integer('model_id')->index()->nullable();
            $table->foreignIdFor(Kind::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Type::class)->constrained()->cascadeOnDelete();
            //$table->foreignId('statut_id')->constrained()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
