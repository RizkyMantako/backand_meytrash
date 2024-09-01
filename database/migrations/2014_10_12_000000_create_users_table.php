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
            $table->string('foto_profil');
            $table->string('name');
            $table->string('no_hp', 15);
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedInteger('poin')->default(0);
            $table->bigInteger('rupiah')->default(0);
            $table->string('alamat')->nullable();
            $table->string('rekening')->default(0);
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
