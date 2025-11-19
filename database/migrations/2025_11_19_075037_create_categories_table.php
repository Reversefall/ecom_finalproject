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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id');

            $table->string('category_name');
            $table->text('category_desc')->nullable();
            $table->string('code')->nullable();

            $table->unsignedBigInteger('parent_category_id')->nullable();

            $table->foreign('parent_category_id')
                ->references('category_id')
                ->on('categories')
                ->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
