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
        Schema::create('employees', function (Blueprint $table) {

            $table->id();

            $table->string('nip');
            $table->string('nama');
            $table->string('departemen');

            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();

            $table->integer('kedisiplinan')->nullable();
            $table->integer('kualitas_kerja')->nullable();
            $table->integer('tanggung_jawab')->nullable();
            $table->integer('kerjasama')->nullable();
            $table->integer('loyalitas')->nullable();

            $table->double('total_nilai')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};