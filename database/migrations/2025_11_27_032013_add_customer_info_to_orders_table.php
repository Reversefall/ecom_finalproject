<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('address')->nullable()->after('buyer_id');
            $table->string('phone')->nullable()->after('address');
            $table->string('full_name')->nullable()->after('phone');
            $table->string('email')->nullable()->after('full_name');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['address', 'phone', 'full_name', 'email']);
        });
    }
};
