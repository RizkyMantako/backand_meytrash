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
        Schema::create('proses_donasis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('nama');
            $table->string('no_hp');
            $table->string('alamat');
            $table->string('foto_makanan')->nullable();
            $table->string('jenis_makanan');
            $table->bigInteger('berat_makanan');
            $table->string('poin_transaksi');
            $table->text('deskripsi');
            $table->string('status', 10)->default('In Progres');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proses_donasis');
    }
};
