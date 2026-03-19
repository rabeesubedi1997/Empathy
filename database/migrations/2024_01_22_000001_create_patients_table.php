<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->string('sex');
            $table->text('address');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('diagnosis')->nullable();
            $table->integer('empathy_score')->default(50);
            $table->string('mood_state')->default('Neutral');
            $table->text('empathy_trend')->nullable();
            $table->text('notes')->nullable();
            $table->string('avatar_initials')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};