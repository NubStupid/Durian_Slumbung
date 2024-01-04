<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('img_url')->nullable();
        });
    }

    public function down(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->dropColumn('img_url');
        });
    }
};
