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
        Schema::create('groups', function (Blueprint $table) {
            $table->id('group_id');

            $table->unsignedBigInteger('creator_id'); 
            $table->string('group_name');
            $table->date('deadline')->nullable();
            $table->string('status')->default('pending');

            $table->foreign('creator_id')
                ->references('id') 
                ->on('users')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
