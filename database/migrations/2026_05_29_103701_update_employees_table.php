<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {

            $table->dropColumn([
                'jam_masuk',
                'jam_pulang'
            ]);

        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {

            $table->string('jam_masuk')->nullable();
            $table->string('jam_pulang')->nullable();

        });
    }
};
