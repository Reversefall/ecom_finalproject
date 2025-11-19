<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');

            $table->string('product_name');

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('seller_id');

            $table->decimal('price', 10, 2);
            $table->string('status')->default('active');
            $table->integer('current_quantity')->default(0);

            $table->timestamps();

            // FK → categories
            $table->foreign('category_id')
                ->references('category_id')
                ->on('categories')
                ->onDelete('cascade');

            // FK → users (id)
            $table->foreign('seller_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
