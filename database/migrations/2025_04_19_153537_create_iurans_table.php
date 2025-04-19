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
        Schema::create('iurans', function (Blueprint $table) {
            $table->id('id_bayar');
            $table->string('jenis_iuran');
            $table->date('tgl_bayar')->nullable();
            $table->integer('total_bayar');
            $table->string('no_kk'); // foreign key ke tabel users
            $table->enum('status', ['Belum Bayar', 'Sudah Bayar'])->default('Belum Bayar');
            $table->timestamps();

            $table->foreign('no_kk')->references('no_kk')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iurans');
    }
};

