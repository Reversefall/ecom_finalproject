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
        Schema::table('groups', function (Blueprint $table) {
            // thêm cột description
            $table->text('description')->nullable()->after('group_name');

            // thêm product_id
            $table->unsignedBigInteger('product_id')->nullable()->after('creator_id');

            // khóa ngoại
            $table->foreign('product_id')
                ->references('product_id')
                ->on('products')
                ->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            // drop foreign key trước
            $table->dropForeign(['product_id']);

            // drop cột
            $table->dropColumn(['product_id', 'description']);
        });
    }
};
