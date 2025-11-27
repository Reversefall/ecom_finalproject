<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');

            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('product_id');

            $table->date('order_date')->nullable();
            $table->decimal('unit_price', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);

            $table->string('status')->default('pending');

            $table->timestamps();

            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('group_id')->references('group_id')->on('groups')->onDelete('set null');

            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
