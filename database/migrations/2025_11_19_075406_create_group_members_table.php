<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('group_members', function (Blueprint $table) {
            $table->id('group_member_id');

            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('customer_id');

            $table->timestamp('joined_at')->nullable();

            // FK → groups.group_id
            $table->foreign('group_id')
                  ->references('group_id')
                  ->on('groups')
                  ->onDelete('cascade');

            // FK → users.id (user_id = id)
            $table->foreign('customer_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_members');
    }
};
