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
        Schema::table('guests', function (Blueprint $table) {
            $table->date('date_of_visit')->nullable();  // Add the date_of_visit column
            $table->date('date_of_out')->nullable();    // Add the date_of_out column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guests', function (Blueprint $table) {
            $table->dropColumn('date_of_visit');
            $table->dropColumn('date_of_out');
        });
    }
};
