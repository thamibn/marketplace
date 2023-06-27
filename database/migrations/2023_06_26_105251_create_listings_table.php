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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('title')->index();
            $table->string('slug')->unique();
            $table->longText('description');
            $table->date('date_online');
            $table->date('date_offline');
            $table->bigInteger('price');
            $table->string('currency');
            $table->string('mobile');
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
