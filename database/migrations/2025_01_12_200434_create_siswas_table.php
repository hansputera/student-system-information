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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nik');
            $table->string('nis');
            $table->string('nisn');
            $table->date('birth');
            $table->string('birth_place');
            $table->string('address');
            $table->string('religion');
            $table->string('photo_url')->nullable();
            $table->string('phone');
            $table->string('mother_name');
            $table->integer('grade_level');
            $table->string('grade');
            $table->string('email');
            $table->datetime('synced_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
