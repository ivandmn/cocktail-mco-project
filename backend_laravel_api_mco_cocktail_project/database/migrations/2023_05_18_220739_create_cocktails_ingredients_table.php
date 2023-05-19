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
        Schema::create('cocktails_ingredients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cocktail_id')->constrained('cocktails')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('ingredient_id')->constrained('ingredients')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('order')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cocktails_ingredients');
    }
};
