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
            Schema::create('ocd_directories', function (Blueprint $table) {
                $table->id();
                $table->string('agency');
                $table->string('regionaldirector');
                $table->string('designation');
                $table->string('hotline');  
                $table->string('govmail');
                $table->string('address');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocd_directories');
    }
};
