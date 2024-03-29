<?php

use App\Models\Category;
use App\Models\RestaurantBranche;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->double('price');
            $table->double('kcal');
            $table->string('image');
            $table->boolean('featured')->default(false);
            $table->boolean('status')->default(false);
            $table
                ->foreignIdFor(Category::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
                $table
                ->foreignIdFor(RestaurantBranche::class)
                // ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
