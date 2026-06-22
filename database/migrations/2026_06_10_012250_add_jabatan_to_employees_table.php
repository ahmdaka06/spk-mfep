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
    Schema::table('employees', function ($table) {
        $table->string('jabatan')->nullable();
    });
}

public function down(): void
{
    Schema::table('employees', function ($table) {
        $table->dropColumn('jabatan');
    });
}
};
