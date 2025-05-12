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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->unique();
            $table->string('customer_id');
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_address2')->nullable();
            $table->string('customer_country')->nullable();
            $table->string('customer_postal_code')->nullable();
            $table->unsignedBigInteger('district_id')->index();
            $table->integer('subtotal');
            $table->string('courier')->nullable();
            $table->integer('cost')->nullable();
            $table->tinyInteger('condition')->default(0)->nullable();
            $table->char('status', 1)->default(0)->comment('0: new, 1: confirm, 2: process, 3: shipping, 4: done');
            $table->string('tracking_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
