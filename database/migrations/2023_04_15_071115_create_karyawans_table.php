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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departemen_id')->references('id')->on('departemens')->onDelete('cascade');
            $table->string('nama', 30);
            $table->string('noKTP', 20);
            $table->string('telp', 20);
            $table->string('kota_tinggal', 20);
            $table->date('tanggal_lahir');
            $table->date('tanggal_masuk');
            $table->string('kota_penempatan', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
