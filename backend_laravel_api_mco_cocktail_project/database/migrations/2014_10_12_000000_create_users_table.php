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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100)->unique()->nullable(false);
            $table->string('password', 100)->nullable(false);
            $table->string('name', 150)->nullable(true);
            $table->string('address', 400)->nullable(true);
            $table->string('phone', 20)->nullable(true);
            $table->string('email', 150)->unique()->nullable(true);
            $table->timestamp('email_verified_at')->nullable(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
