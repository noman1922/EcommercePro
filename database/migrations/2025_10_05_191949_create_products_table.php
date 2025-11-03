<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('catagory')->nullable();           // ← YOUR spelling: CORRECT
            $table->integer('quantity')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('discount_price', 8, 2)->nullable(); // ← Fixed: decimal, not string
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};