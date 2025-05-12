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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('brand_id')->index();
            $table->unsignedBigInteger('size_id')->index();
            $table->integer('price');
            $table->integer('weight');
            $table->integer('qty');
            $table->string('image')->default('default.png');
            $table->text('summary')->nullable();
            $table->longText('description')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
