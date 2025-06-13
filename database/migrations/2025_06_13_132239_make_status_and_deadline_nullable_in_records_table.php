<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up(): void
    {
        Schema::table('records', function (Blueprint $table) {
            $table->date('status_as_of_date')->nullable()->change();
            $table->date('deadline_of_compliance')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('records', function (Blueprint $table) {
            $table->date('status_as_of_date')->nullable(false)->change();
            $table->date('deadline_of_compliance')->nullable(false)->change();
        });
    }
};
